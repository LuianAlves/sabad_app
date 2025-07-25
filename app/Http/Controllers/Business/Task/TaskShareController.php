<?php

namespace App\Http\Controllers\Business\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskUserRole;
use Illuminate\Http\Request;

class TaskShareController extends Controller
{
    public function share(Request $req, string $id)
    {
        $this->authorize('update', Task::class);

        $data = $req->validate(['user_id'=>'required|exists:users,id','role'=>'required|in:owner,editor,reader']);

        TaskUserRole::updateOrCreate(
            ['task_id'=>$id,'user_id'=>$data['user_id']],
            ['role'=>$data['role']]
        );

        event(new TaskShared($id, $data['user_id'], $data['role']));

        return back()->with('success','Compartilhado!');
    }
}
