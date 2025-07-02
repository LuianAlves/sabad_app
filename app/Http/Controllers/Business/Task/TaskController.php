<?php

namespace App\Http\Controllers\Business\Task;

use App\Http\Controllers\Business\User\UserController;
use App\Models\Business\Task\Task;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Business\TaskStatus\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        

        return redirect()->route('task.index')->with('success', 'Tarefa criada com sucesso.');
    }

    public function edit(Task $task)
    {
        
        return view('app.business.task.task_edit', compact('task', 'statuses'));
    }

    public function update(Request $request, Task $task)
    {
        

        return redirect()->route('tasks.index')->with('success', 'Tarefa atualizada.');
    }

    public function destroy(Task $task)
    {
        
    }

}
