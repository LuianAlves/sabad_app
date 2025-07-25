<?php

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TaskController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Task::query();

        // 1) Responsáveis (JSON array)
        if ($request->has('responsible')) {
            foreach ((array)$request->input('responsible') as $userId) {
                $query->whereJsonContains('responsible', $userId);
            }
        }

        // 2) Prioridade
        if ($prio = $request->input('priority')) {
            $query->where('priority', $prio);
        }

        // 3) Intervalo de datas de vencimento
        if ($from = $request->input('date_from')) {
            $query->whereDate('due_date', '>=', $from);
        }
        if ($to = $request->input('date_to')) {
            $query->whereDate('due_date', '<=', $to);
        }

        // 4) Só com anexos
        if ($request->boolean('has_attachments')) {
            $query->whereJsonLength('attachments', '>', 0);
        }

        $tasks = $query
            ->with(['status','documents'])
            ->orderBy('order')
            ->get()
            ->map(function($task){
                $respIds = $task->responsible;
                $assignees = User::whereIn('id', $respIds)
                    ->get(['id','name','image'])
                    ->map(function($u) {
                        // monta a URL de avatar
                        $avatar = null;
                        if ($u->image) {
                            $avatar = Str::startsWith($u->image, 'data:')
                                ? $u->image
                                : 'data:image/png;base64,' . $u->image;
                        }
                        return [
                            'name'       => $u->name,
                            'avatar_url' => $avatar,
                        ];
                    });

                return [
                    'task_status_id'      => $task->task_status_id,    // <— essencial pro “col-…”
                    'task_id'             => $task->task_id,
                    'status_label'        => $task->status->name,
                    'status_color'        => $task->status->color,
                    'task_code'           => $task->code ?? substr($task->task_id,0,8),
                    'name'                => $task->name,
                    'tags'                => $task->tags ?? [],
                    'due_date'            => optional($task->due_date)->toDateString(),
                    'assignees'           => $assignees,
                    'attachments_count'   => $task->documents->count(),
                ];
            });

        return response()->json($tasks);
    }

    public function store(StoreTaskRequest $request): JsonResponse
    {
        $task = Task::create($request->validated());
        return response()->json($task, 201);
    }

    public function show(string $id): JsonResponse
    {
        $task = Task::with('status')->findOrFail($id);
        return response()->json($task);
    }

    public function update(UpdateTaskRequest $request, string $id): JsonResponse
    {
        $task = Task::findOrFail($id);
        $task->update($request->validated());
        return response()->json($task);
    }

    public function destroy(string $id): JsonResponse
    {
        Task::findOrFail($id)->delete();
        return response()->json(null, 204);
    }

    public function reorder(Request $request): JsonResponse
    {
        foreach ($request->order as $item) {
            Task::where('task_id', $item['id'])
                ->update(['order' => $item['order']]);
        }
        return response()->json(null, 204);
    }
}
