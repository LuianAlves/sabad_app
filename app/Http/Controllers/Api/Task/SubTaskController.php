<?php

namespace App\Http\Controllers\Api\Task;
use App\Http\Controllers\Controller;

use App\Http\Requests\StoreSubTaskRequest;
use App\Http\Requests\UpdateSubTaskRequest;

use App\Models\SubTask;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubTaskController extends Controller
{
    public function index(string $taskId): JsonResponse
    {
        $subtasks = SubTask::with(['status','user'])
            ->where('parent_task_id', $taskId)
            ->orderBy('created_at')
            ->get();

        return response()->json($subtasks);
    }

    public function store(StoreSubTaskRequest $request, string $taskId): JsonResponse
    {
        $data = $request->validated();
        $data['parent_task_id'] = $taskId;

        $subtask = SubTask::create($data);

        return response()->json($subtask, 201);
    }

    public function update(UpdateSubTaskRequest $request, string $taskId, string $subtaskId): JsonResponse
    {
        $subtask = SubTask::where('parent_task_id', $taskId)->findOrFail($subtaskId);

        $subtask->update($request->validated());

        return response()->json($subtask);
    }

    // DELETE /tasks-api/{task}/subtasks/{subtask}
    public function destroy(string $taskId, string $subtaskId): JsonResponse
    {
        SubTask::where('parent_task_id', $taskId)->findOrFail($subtaskId)->delete();

        return response()->json(null, 204);
    }
}
