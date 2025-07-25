<?php

namespace App\Http\Controllers\Business\Task;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Business\TaskStatus\TaskStatus;

class TaskController extends Controller
{
    public function index()
    {
        $statuses = TaskStatus::orderBy('order')->get();

        $users = User::all();

        return view('app.business.task.task_index', compact('statuses', 'users'));
    }
}
