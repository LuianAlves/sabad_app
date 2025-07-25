<x-app-layout>
    @section('content')
        <div class="row">
            <div class="col-12">
                <x-breadcrumb title="Quadro de tarefas" current="Tarefas"></x-breadcrumb>

                <div class="top-right-button-container d-flex align-items-center align-content-center">
                    <a href="{{route('task-status.index')}}" class="btn btn-primary mx-2">NOVO STATUS</a>
                </div>

                <div class="separator mb-4"></div>
            </div>
        </div>

        <div class="scroll" id="main-board">
            <div class="row sortable-statuses">
                @foreach($statuses as $status)
                    <div class="col-md-3" data-status-id="{{ $status->id }}">
                        <div class="card mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-header text-uppercase d-flex align-items-center">
                                    <div class="status-tag">
                                        <i class="bi bi-record-circle" style="color: {{$status->color}}"></i>
                                        <strong>{{ $status->task_status }}</strong>
                                    </div>
                                </h5>
                            </div>
                            <div class="card-body">
                                <ul class="sortable-tasks list-unstyled" data-status-id="{{ $status->id }}">
                                    @foreach($status->tasks as $task)
                                        @php
                                            $priority = $task->priority;
                                            $date = $task->date == "" ? '...' : $task->date;

                                            switch ($priority) {
                                                case 'high':
                                                    $priority = 'Alta';
                                                    $priorityColor = 'red';
                                                break;

                                                case 'medium':
                                                    $priority = 'Normal';
                                                    $priorityColor = 'green';
                                                break;

                                                case 'low':
                                                    $priority = 'Baixa';
                                                    $priorityColor = 'grey';
                                                break;
                                            }

                                        @endphp

                                        <li class="mb-2" data-task-id="{{ $task->id }}">
                                            <div class="card" style="box-shadow: 1px 1px 5px rgba(0,0,0,0.42);">
                                                <div class="card-header d-flex justify-content-between align-items-center">
                                                    <h6 class="card-title m-0">{{ $task->task }}</h6>

                                                    {{-- Dropdown Options Task --}}
                                                    <div class="btn-group float-right float-none-xs">
                                                        <a href="#" class="dropdown-toggle" type="button"
                                                           data-toggle="dropdown" aria-haspopup="true"
                                                           aria-expanded="false">
                                                            <i class="bi bi-three-dots" style="font-size: 18px;"></i>
                                                        </a>
                                                        <div class="dropdown-menu">
                                                            <button class="dropdown-item"
                                                                    data-task-id="{{ $task->id }}">
                                                                <i class="bi bi-pencil-square text-primary"></i>
                                                                <span class="mx-2">Renomear Tarefa</span>
                                                            </button>
                                                            <button class="dropdown-item deletebtn"
                                                                    data-task-id="{{ $task->id }}">
                                                                <i class="bi bi-trash3 text-secondary"></i>
                                                                <span class="mx-2">Excluir Tarefa</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body" style="padding: 5px 15px">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <ul>
                                                            <li class="list-status-task">
                                                                <i class="bi bi-record-circle-fill"
                                                                   style="color: {{$status->color}}"></i>
                                                                <strong>{{ $status->task_status }}</strong>
                                                            </li>
                                                            <li class="list-status-task">
                                                                <i class="bi bi-calendar-week"></i>
                                                                <strong>{{$date}}</strong>
                                                            </li>
                                                            <li class="list-status-task">
                                                                <i class="bi bi-flag-fill"
                                                                   style="color: {{$priorityColor}};"></i>
                                                                <strong>{{$priority}}</strong>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="d-flex align-items-center add-new-task">
                                    <input type="text" class="form-control order-1" id="inputAddTask"
                                           placeholder="Nova tarefa">
                                    <button class="add-task order-0">+</button>
                                </div>
                                <div class="card add-task-card" style="display: none;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="task-title">Título</label>
                                                <input type="text" id="task-title" class="form-control">
                                            </div>
                                            <div class="col-12 my-3">
                                                <label for="task-date">Vencimento</label>
                                                <input type="date" id="task-date" class="form-control">
                                            </div>
                                            <div class="col-12">
                                                <label for="task-priority">Prioridade</label>
                                                <select id="task-priority" class="form-control">
                                                    <option value="low">Baixa</option>
                                                    <option value="medium">Normal</option>
                                                    <option value="high">Alta</option>
                                                </select>
                                            </div>
                                            <div class="col-12 mt-3 d-flex flex-column">
                                                <button class="btn btn-primary save-task"
                                                        style="border-radius: 7.5px; padding: 5px 12.5px;">
                                                    <strong>Salvar</strong>
                                                    <i class="bi bi-save mx-2"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <script>
            var route = "{{ route('task-api.index') }}"
        </script>

        <script type="module" src="{{ asset('assets/js/common/task.js') }}"></script>
    @endsection
</x-app-layout>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        function initializeTaskButtons() {
            document.querySelectorAll('.add-task').forEach(button => {
                button.addEventListener('click', function () {
                    const card = this.closest('.card-body').querySelector('.add-task-card');
                    card.style.display = 'block';
                    card.style.top = `${this.offsetTop + this.offsetHeight}px`;
                    card.style.left = `${this.offsetLeft}px`;

                    // Fecha o card ao clicar fora dele
                    document.addEventListener('click', function (event) {
                        if (!card.contains(event.target) && event.target !== button) {
                            card.style.display = 'none';
                        }
                    }, {once: true});

                    // Lógica para salvar a tarefa
                    card.querySelector('.save-task').addEventListener('click', function () {
                        const title = card.querySelector('#task-title').value;
                        const date = card.querySelector('#task-date').value;
                        const priority = card.querySelector('#task-priority').value;
                        const statusId = button.closest('[data-status-id]').dataset.statusId;

                        fetch('/projects/task-api', {
                            method: 'POST',
                            headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                            body: JSON.stringify({
                                task: title,
                                date: date,
                                priority: priority,
                                task_status_id: statusId
                            })
                        }).then(response => response.json()).then(task => {
                            var task = task.data;

                            let li = document.createElement('li');
                            li.className = 'mb-2';
                            li.dataset.taskId = task.id;
                            li.innerHTML = `
                            <li class="mb-2" data-task-id="${task.id}">
                                            <div class="card" style="box-shadow: 1px 1px 5px rgba(0,0,0,0.42);">
                                                <div
                                                    class="card-header d-flex justify-content-between align-items-center">
                                                    <h6 class="card-title m-0">${task.task}</h6>
                                                    <div class="btn-group float-right float-none-xs">
                                                        <a href="#" class="dropdown-toggle" type="button"
                                                           data-toggle="dropdown" aria-haspopup="true"
                                                           aria-expanded="false">
                                                            <i class="bi bi-three-dots" style="font-size: 18px;"></i>
                                                        </a>
                                                        <div class="dropdown-menu">
                                                            <button class="dropdown-item"
                                                                    data-task-id="${task.id}">
                                                                <i class="bi bi-pencil-square text-primary"></i>
                                                                <span class="mx-2">Renomear Tarefa</span>
                                                            </button>
                                                            <button class="dropdown-item deletebtn"
                                                                    data-task-id="${task.id}">
                                                                <i class="bi bi-trash3 text-secondary"></i>
                                                                <span class="mx-2">Excluir Tarefa</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body" style="padding: 5px 15px">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <ul>
                                                            <li class="list-status-task">
                                                                <i class="bi bi-record-circle-fill"
                                                                   style="color: ${task.status.color}"></i>
                                                                <strong>${task.status.task_status}</strong>
                                                            </li>
                                                            <li class="list-status-task">
                                                                <i class="bi bi-calendar-week"></i>
                                                                <strong>${task.date}</strong>
                                                            </li>
                                                            <li class="list-status-task">
                                                                <i class="bi bi-flag-fill"
                                                                   style="color: ${task.priority_color};"></i>
                                                                <strong>${task.priority}</strong>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                        `;
                            button.closest('.card-body').querySelector('.sortable-tasks').appendChild(li);
                            card.style.display = 'none';
                        });
                    });
                });
            });
        }

        // UPDATE TASK POSITION
        function initializeTaskSortable() {
            document.querySelectorAll('.sortable-tasks').forEach(sortable => {
                new Sortable(sortable, {
                    group: 'shared',
                    animation: 150,
                    onEnd: function (evt) {
                        let tasks = [];
                        evt.to.querySelectorAll('li').forEach((li, index) => {
                            tasks.push({
                                id: li.dataset.taskId,
                                position: index,
                                task_status_id: evt.to.dataset.statusId
                            });
                        });
                        fetch('/projects/task/update-position', {
                            method: 'POST',
                            headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                            body: JSON.stringify({tasks})
                        });
                    }
                });
            });
        }

        // UPDATE STATUS POSITION
        function initializeStatusSortable() {
            new Sortable(document.querySelector('.sortable-statuses'), {
                group: 'statuses',
                animation: 150,
                onEnd: function (evt) {
                    let statuses = [];
                    document.querySelectorAll('.sortable-statuses > [data-status-id]').forEach((col, index) => {
                        statuses.push({id: col.dataset.statusId, position: index});
                    });
                    fetch('/projects/task/task-status/update-position', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                        body: JSON.stringify({statuses})
                    });
                }
            });
        }

        initializeTaskButtons();
        initializeTaskSortable();
        initializeStatusSortable();
    });
</script>
