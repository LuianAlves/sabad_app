<?php

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Task::with('status')->orderBy('order');
        if ($request->has('task_status_id')) {
            $query->where('task_status_id', $request->task_status_id);
        }
        return response()->json($query->get());
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
