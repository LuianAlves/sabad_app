<?php

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskStatusRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\Models\TaskStatus;
use Illuminate\Http\JsonResponse;

class TaskStatusController extends Controller
{
    public function index(): JsonResponse
    {
        $statuses = TaskStatus::orderBy('order')->get();

        return response()->json($statuses);
    }

    public function store(StoreTaskStatusRequest $request): JsonResponse
    {
        $status = TaskStatus::create($request->validated());

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
}
