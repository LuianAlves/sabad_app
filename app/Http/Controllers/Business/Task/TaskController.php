<?php

namespace App\Http\Controllers\Business\Task;

use App\Enums\TaskPriorityEnum;
use App\Http\Controllers\Business\User\UserController;
use App\Http\Requests\Projects\Tasks\StoreTaskRequest;
use App\Http\Requests\Projects\Tasks\UpdateTaskRequest;
use App\Models\Business\Task\Task;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Business\TaskStatus\TaskStatus;
use App\Traits\CrudResponse;
use App\Traits\RoleCheckTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function index()
    {
        return $this->indexMethod($this->task->get(), 'status');
    }

    public function store(StoreTaskRequest $request)
    {
        $request->validated();

        $dataTask = $this->task->create([
            'customer_sistapp_id' => $this->customerSistappID(),
            'user_id' => Auth::user()->id,
            'task' => $request->task,
            'task_status_id' => $request->task_status_id,
            'position' => Task::where('task_status_id', $request->task_status_id)->max('position') + 1,
            'priority' => $request->priority,
            'date' => Carbon::parse($request->date)->format('d m Y'),
        ]);

        $task = $this->task->with('status')->where('id', $dataTask->id)->first();

        $task->priority = TaskPriorityEnum::fromDatabaseValue($task->priority);

        switch ($task->priority) {
            case 'Baixa':
                $task->priority_color = "grey";
                break;

            case 'Normal':
                $task->priority_color = "green";
                break;

            case 'Alta':
                $task->priority_color = "red";
                break;
        }

        return $this->trait('store', $task);
    }

    public function show(Task $task)
    {
        //
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        //
    }

    public function destroy($id)
    {
        return $this->destroyMethod($this->task->find($id));
    }

    public function indexView()
    {
        $statuses = \App\Models\Projects\Tasks\TaskStatus::with('tasks')->orderBy('position')->get();

        return view('app.projects.task.task_index', compact('statuses'));
    }

    public function updateView(Request $request)
    {
        foreach ($request->tasks as $taskData) {
            \App\Models\Projects\Tasks\Task::where('id', $taskData['id'])->update([
                'position' => $taskData['position'],
                'task_status_id' => $taskData['task_status_id'],
            ]);
        }

        return response()->json('Positions updated');
    }
}
