<?php

namespace App\Http\Controllers\Business\Task\Kanban;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Http\Request;

class KanbanController extends Controller
{
    public function index()
    {
        $statuses = TaskStatus::orderBy('order')->get();
        $users = User::orderBy('name')->get(['id', 'name']);

        $tasksToday = Task::where('responsible', auth()->id())->where('due_date', today())->count();

        return view('app.business.task.kanban.kanban_index', compact('statuses', 'users', 'tasksToday'));
    }
}
