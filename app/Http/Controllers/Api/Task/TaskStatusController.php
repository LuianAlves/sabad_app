<?php

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskStatusRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\Models\TaskStatus;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskStatusController extends Controller
{
    public function index(): JsonResponse
    {
        $statuses = TaskStatus::orderBy('order')->get();

        return response()->json($statuses);
    }

    public function store(StoreTaskStatusRequest $request): JsonResponse
    {
        $data = $request->validated();

        $lastOrder = TaskStatus::max('order') ?? 0;

        $data['order'] = is_null($lastOrder) ? 0 : $lastOrder + 1;

        $status = TaskStatus::create($data);

        return response()->json($status, 201);
    }


    public function show(string $id): JsonResponse
    {
        $status = TaskStatus::findOrFail($id);

        return response()->json($status);
    }

    public function update(UpdateTaskStatusRequest $request, string $id): JsonResponse
    {
        $status = TaskStatus::findOrFail($id);
        $status->update($request->validated());

        return response()->json($status);
    }

    public function destroy(string $id): JsonResponse
    {
        $status = TaskStatus::findOrFail($id);
        $status->delete();
        return response()->json(null, 204);
    }

    public function reorder(Request $request): JsonResponse
    {
        $statuses = $request->input('statuses');

        foreach ($statuses as $index => $id) {
            TaskStatus::where('task_status_id', $id)->update(['order' => $index]);
        }

        return response()->json(['message' => 'Ordem atualizada com sucesso']);
    }

}
