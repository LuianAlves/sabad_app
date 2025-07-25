<?php

namespace App\Http\Controllers\Api\Task;
use App\Http\Controllers\Controller;

use App\Http\Requests\UploadDocumentRequest;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

use App\Models\TaskDocument;
use Illuminate\Http\Request;

use Carbon\Carbon;

class TaskDocumentController extends Controller
{
    public function storeForTask(UploadDocumentRequest $request, string $taskId): JsonResponse
    {
        $file = $request->file('file');
        $path = $file->store("tasks/{$taskId}", 'public');

        $doc = TaskDocument::create([
            'file_name' => $file->getClientOriginalName(),
            'url'          => Storage::url($path),
            'uploaded_by'  => auth()->id(),
            'uploaded_at'  => Carbon::now(),
            'task_id'      => $taskId,
        ]);

        return response()->json($doc,201);
    }

    public function storeForSubtask(UploadDocumentRequest $request, string $taskId, string $subtaskId): JsonResponse
    {
        $file = $request->file('file');

        $path = $file->store("tasks/{$taskId}/subtasks/{$subtaskId}", 'public');

        $doc = TaskDocument::create([
            'file_name' => $file->getClientOriginalName(),
            'url'          => Storage::url($path),
            'uploaded_by'  => auth()->id(),
            'uploaded_at'  => Carbon::now(),
            'task_id'      => $taskId,
            'sub_task_id'   => $subtaskId,
        ]);

        return response()->json($doc,201);
    }

    public function listForTask(string $taskId): JsonResponse
    {
        $docs = TaskDocument::where('task_id',$taskId)->get();

        return response()->json($docs);
    }

    public function listForSubtask(string $taskId, string $subtaskId): JsonResponse
    {
        $docs = TaskDocument::where('subtask_id',$subtaskId)->get();

        return response()->json($docs);
    }

    public function destroy(string $id): JsonResponse
    {
        $doc = TaskDocument::findOrFail($id);

        Storage::delete(str_replace('/storage/','',$doc->url));

        $doc->delete();

        return response()->json(null,204);
    }
}
