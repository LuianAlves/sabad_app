<?php

namespace App\Http\Controllers\Business\Task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskStatusController extends Controller
{
    public function index()
    {
        return view('app.business.task_status.task_status_index');
    }
}
