{{--@extends('layouts.templates.app-layout')--}}

{{--@section('content')--}}
{{--    <div class="row">--}}
{{--        <div class="col-12">--}}
{{--            <div class="card border">--}}
{{--                <div class="card-header border-bottom pb-0">--}}
{{--                    <div class="d-sm-flex align-items-center mb-3">--}}
{{--                        <div class="d-flex align-items-center">--}}
{{--                            @if (currentRoute()[1] != 'index')--}}
{{--                                <a href="{{ route(currentRoute()[0] . '.index') }}">--}}
{{--                                    <i class="fa fa-arrow-left" aria-hidden="true"></i>--}}
{{--                                </a>--}}
{{--                            @endif--}}
{{--                            <div class="mx-3">--}}
{{--                                <h6 class="font-weight-semibold text-lg mb-0">Quadro de tarefas</h6>--}}
{{--                                <p class="text-sm mb-sm-0">Atualmente há {{ $tasksToday }} com vencimento para hoje.</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="ms-auto d-flex float-end">--}}

{{--                            <a href="{{route('task_status.index')}}" type="button"--}}
{{--                               class="btn btn-sm btn-warning btn-icon d-flex align-items-center mb-0">--}}
{{--                              <span class="btn-inner--icon">--}}
{{--                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" fill="none"--}}
{{--                                     viewBox="0 0 24 24" stroke="currentColor"--}}
{{--                                     stroke-width="1.5" class="d-block me-2">--}}
{{--                                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>--}}
{{--                                </svg>--}}
{{--                              </span>--}}
{{--                                <span class="btn-inner--text">Novo</span>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <hr>--}}

{{--    <div class="row">--}}
{{--        <x-select col="2" set="" title="Prioridade" name="filterPriority" id="filterPriority">--}}
{{--            <option value="">Todas</option>--}}
{{--            <option value="low">Baixa</option>--}}
{{--            <option value="medium">Média</option>--}}
{{--            <option value="high">Alta</option>--}}
{{--            <option value="important">Urgente</option>--}}
{{--        </x-select>--}}

{{--        <x-input col="3" set="" type="date" name="filterDateFrom" id="filterDateFrom"--}}
{{--                 title="Vencimento de"></x-input>--}}
{{--        <x-input col="3" set="" type="date" name="filterDateTo" id="filterDateTo" title="Até"></x-input>--}}

{{--        <div class="col-4">--}}
{{--            <div class="flex items-center">--}}
{{--                <input type="checkbox" id="filterAttachments"--}}
{{--                       class="h-4 w-4 text-blue-600 border-gray-300 rounded"/>--}}
{{--                <label for="filterAttachments" class="ml-2 block text-sm text-gray-700">Com anexos</label>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="row">--}}
{{--        <div class="col-6">--}}
{{--            <div class="form-group">--}}
{{--                <label for="filterResponsible">Responsável</label>--}}
{{--                <select class="form-control" id="filterResponsible" name="filterResponsible" multiple>--}}
{{--                    @foreach($users as $u)--}}
{{--                        <option value="{{ $u->id }}">{{ $u->name }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="row">--}}
{{--        <div class="col-4">--}}
{{--            <button id="btnClearFilters" class="btn btn-sm btn-outline-danger">Limpar</button>--}}
{{--            <button id="btnApplyFilters" class="btn btn-sm btn-warning">Filtrar</button>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <hr>--}}

{{--    <div class="container-fluid py-3">--}}
{{--        <div class="d-flex overflow-auto pb-4">--}}
{{--            @foreach($statuses as $status)--}}
{{--                <div class="tasks flex-shrink-0 me-4" style="width:22rem;">--}}
{{--                    <div class="card mb-0" style="border-top:4px solid {{ $status->cor_hex ?? $status->color }};">--}}
{{--                        <div class="card-header bg-white d-flex justify-content-between align-items-center">--}}
{{--                            <h6 class="mb-0">--}}
{{--                                {{ $status->name }}--}}
{{--                                <small class="text-muted ms-1">{{ $status->tasks_count ?? 0 }}</small>--}}
{{--                            </h6>--}}
{{--                        </div>--}}
{{--                        <div id="col-{{ $status->task_status_id }}"--}}
{{--                             class="list-group list-group-flush p-3 kanban-cards">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}

{{--<style>--}}
{{--    .kanban-card {--}}
{{--        background: #fff;--}}
{{--        border: 1px solid #e0e0e0;--}}
{{--        border-radius: 8px;--}}
{{--        padding: 12px;--}}
{{--        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);--}}
{{--        display: flex;--}}
{{--        flex-direction: column;--}}
{{--        justify-content: space-between;--}}
{{--        margin-bottom: 12px;--}}
{{--    }--}}

{{--    .kanban-cards {--}}
{{--        max-height: 60vh;--}}
{{--        overflow-y: auto;--}}
{{--    }--}}

{{--    .kanban-cards::-webkit-scrollbar {--}}
{{--        width: 4px;--}}
{{--    }--}}

{{--    .kanban-cards::-webkit-scrollbar-thumb {--}}
{{--        background: rgba(0, 0, 0, 0.2);--}}
{{--        border-radius: 2px;--}}
{{--    }--}}

{{--    .kanban-card .card-body {--}}
{{--        display: flex;--}}
{{--        flex-direction: column;--}}
{{--    }--}}

{{--    .kanban-card .card-title {--}}
{{--        white-space: nowrap;--}}
{{--        overflow: hidden;--}}
{{--        text-overflow: ellipsis;--}}
{{--    }--}}

{{--    .tasks .card-header {--}}
{{--        display: flex;--}}
{{--        justify-content: space-between;--}}
{{--        align-items: flex-start;--}}
{{--        margin-bottom: 8px;--}}
{{--    }--}}

{{--    .title {--}}
{{--        font-size: 14px;--}}
{{--        font-weight: 500;--}}
{{--        color: #333;--}}
{{--        line-height: 1.2;--}}
{{--        margin: 0;--}}
{{--    }--}}

{{--    .notification {--}}
{{--        position: relative;--}}
{{--    }--}}

{{--    .notification i {--}}
{{--        font-size: 18px;--}}
{{--        color: #666;--}}
{{--    }--}}

{{--    .badge {--}}
{{--        position: absolute;--}}
{{--        top: -6px;--}}
{{--        right: -6px;--}}
{{--        background: #ff3b30;--}}
{{--        color: #fff;--}}
{{--        border-radius: 50%;--}}
{{--        padding: 2px 6px;--}}
{{--        font-size: 10px;--}}
{{--        font-weight: bold;--}}
{{--    }--}}

{{--    .card-meta {--}}
{{--        display: flex;--}}
{{--        justify-content: space-between;--}}
{{--        align-items: center;--}}
{{--    }--}}

{{--    .meta-left {--}}
{{--        display: flex;--}}
{{--        align-items: center;--}}
{{--    }--}}

{{--    .status {--}}
{{--        background: #ffdd57;--}}
{{--        color: #333;--}}
{{--        font-size: 12px;--}}
{{--        padding: 2px 6px;--}}
{{--        border-radius: 4px;--}}
{{--        margin-right: 8px;--}}
{{--        text-transform: uppercase;--}}
{{--    }--}}

{{--    .date {--}}
{{--        display: flex;--}}
{{--        align-items: center;--}}
{{--        font-size: 12px;--}}
{{--        color: #666;--}}
{{--    }--}}

{{--    .date i {--}}
{{--        margin-right: 4px;--}}
{{--    }--}}

{{--    .user {--}}
{{--        font-size: 12px;--}}
{{--        color: #666;--}}
{{--    }--}}
{{--</style>--}}

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>--}}
{{--<script>--}}
{{--    const apiUrl = '{{ url("/tasks-api") }}';--}}
{{--    const statuses = @json($statuses);--}}

{{--    async function request(url, options = {}) {--}}
{{--        const token = document.querySelector('meta[name="csrf-token"]').content;--}}
{{--        options.headers = {'X-CSRF-TOKEN': token, 'Accept': 'application/json', ...options.headers};--}}
{{--        const res = await fetch(url, options);--}}
{{--        if (!res.ok) throw res;--}}
{{--        return res.json();--}}
{{--    }--}}

{{--    async function loadTasks() {--}}
{{--        // coleta filtros--}}
{{--        const respOpts = Array.from(document.getElementById('filterResponsible').selectedOptions).map(o => o.value);--}}
{{--        const priority = document.getElementById('filterPriority').value;--}}
{{--        const dateFrom = document.getElementById('filterDateFrom').value;--}}
{{--        const dateTo = document.getElementById('filterDateTo').value;--}}
{{--        const hasAtt = document.getElementById('filterAttachments').checked;--}}

{{--        // constrói query string--}}
{{--        const params = new URLSearchParams();--}}
{{--        respOpts.forEach(r => params.append('responsible[]', r));--}}
{{--        if (priority) params.append('priority', priority);--}}
{{--        if (dateFrom) params.append('date_from', dateFrom);--}}
{{--        if (dateTo) params.append('date_to', dateTo);--}}
{{--        if (hasAtt) params.append('has_attachments', '1');--}}

{{--        // fetch e render--}}
{{--        const tasks = await request(`${apiUrl}?${params.toString()}`);--}}
{{--        // limpa colunas e contadores--}}
{{--        statuses.forEach(s => {--}}
{{--            const col = document.getElementById(`col-${s.task_status_id}`);--}}
{{--            col.innerHTML = '';--}}
{{--            const cnt = document.getElementById(`count-${s.task_status_id}`);--}}
{{--            if (cnt) cnt.innerText = 0;--}}
{{--        });--}}
{{--        // adiciona cards--}}
{{--        tasks.forEach(task => {--}}
{{--            const col = document.getElementById(`col-${task.task_status_id}`);--}}
{{--            if (!col) return;--}}
{{--            col.insertAdjacentHTML('beforeend', `--}}
{{--  <div class="card mb-3 kanban-card">--}}
{{--    <div class="card-body p-2" style="border-left:4px solid ${task.status_color}; display:flex; flex-direction:column; justify-content:space-between;">--}}

{{--      <!-- header -->--}}
{{--      <div class="d-flex justify-content-between align-items-start mb-2">--}}
{{--        <h6 class="card-title mb-0">${task.name}</h6>--}}
{{--        <div class="position-relative">--}}
{{--          <i class="fa fa-comment-dots"></i>--}}
{{--          ${task.attachments_count > 0--}}
{{--                ? `<span class="badge bg-danger position-absolute top-0 start-100 translate-middle">${task.attachments_count}</span>`--}}
{{--                : ``}--}}
{{--        </div>--}}
{{--      </div>--}}

{{--      <!-- footer -->--}}
{{--      <div class="mt-auto d-flex justify-content-between align-items-center small text-muted">--}}
{{--        <div>--}}
{{--          <span class="badge text-uppercase"--}}
{{--                style="background-color:${task.status_color}33; color:${task.status_color};">--}}
{{--            ${task.status_label}--}}
{{--          </span>--}}
{{--          <i class="fa fa-calendar ms-2"></i> ${task.due_date || '--'}--}}
{{--        </div>--}}
{{--        <div>${task.assignees[0]?.name || ''}</div>--}}
{{--      </div>--}}
{{--    </div>--}}
{{--  </div>--}}
{{--`);--}}


{{--            // atualiza contador--}}
{{--            const cnt = document.getElementById(`count-${task.task_status_id}`);--}}
{{--            if (cnt) cnt.innerText = parseInt(cnt.innerText || '0') + 1;--}}
{{--        });--}}
{{--        attachCardHandlers();--}}
{{--    }--}}

{{--    function attachCardHandlers() {--}}
{{--        document.querySelectorAll('.kanban-card').forEach(el => {--}}
{{--            el.onclick = () => editTask(el.dataset.taskId);--}}
{{--        });--}}
{{--    }--}}

{{--    document.addEventListener('DOMContentLoaded', () => {--}}
{{--        // inicializa drag&drop--}}
{{--        statuses.forEach(s => {--}}
{{--            Sortable.create(document.getElementById(`col-${s.task_status_id}`), {--}}
{{--                group: 'kanban', animation: 150,--}}
{{--                onEnd: async ({item, to}) => {--}}
{{--                    const id = item.dataset.taskId;--}}
{{--                    const newStatus = to.closest('.kanban-column').dataset.statusId;--}}
{{--                    await request(`${apiUrl}/${id}`, {--}}
{{--                        method: 'PUT', headers: {'Content-Type': 'application/json'},--}}
{{--                        body: JSON.stringify({task_status_id: newStatus})--}}
{{--                    });--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--        // botões de filtro--}}
{{--        document.getElementById('btnApplyFilters').onclick = loadTasks;--}}
{{--        document.getElementById('btnClearFilters').onclick = () => {--}}
{{--            document.getElementById('filterResponsible').value = null;--}}
{{--            document.getElementById('filterPriority').value = '';--}}
{{--            document.getElementById('filterDateFrom').value = '';--}}
{{--            document.getElementById('filterDateTo').value = '';--}}
{{--            document.getElementById('filterAttachments').checked = false;--}}
{{--            loadTasks();--}}
{{--        };--}}
{{--        // carrega inicialmente--}}
{{--        loadTasks();--}}
{{--    });--}}
{{--</script>--}}

{{--    <!DOCTYPE html>--}}
{{--<html lang="pt-br">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <title>Card com Formulário</title>--}}
{{--    <style>--}}
{{--        body {--}}
{{--            font-family: Arial, sans-serif;--}}
{{--            background: #f7f7f7;--}}
{{--            padding: 20px;--}}
{{--        }--}}

{{--        .kanban-column {--}}
{{--            width: 260px;--}}
{{--            background-color: #f1f8ff;--}}
{{--            border-radius: 8px;--}}
{{--            padding: 12px;--}}
{{--            box-shadow: 0 0 4px rgba(0, 0, 0, 0.05);--}}
{{--        }--}}

{{--        .kanban-header {--}}
{{--            display: flex;--}}
{{--            justify-content: space-between;--}}
{{--            align-items: center;--}}
{{--            margin-bottom: 8px;--}}
{{--        }--}}

{{--        .kanban-title {--}}
{{--            display: flex;--}}
{{--            align-items: center;--}}
{{--            font-size: 12px;--}}
{{--            font-weight: bold;--}}
{{--            color: white;--}}
{{--            background-color: #0182d0;--}}
{{--            border-radius: 12px;--}}
{{--            padding: 2px 8px;--}}
{{--            gap: 4px;--}}
{{--        }--}}

{{--        .task-form {--}}
{{--            background: white;--}}
{{--            border: 1px solid #ccc;--}}
{{--            border-left: 4px solid #8d75e6;--}}
{{--            border-radius: 8px;--}}
{{--            padding: 10px;--}}
{{--            margin-bottom: 10px;--}}
{{--            display: none;--}}
{{--            flex-direction: column;--}}
{{--            gap: 10px;--}}
{{--        }--}}

{{--        .task-form input {--}}
{{--            border: none;--}}
{{--            border-bottom: 1px solid #ccc;--}}
{{--            outline: none;--}}
{{--            font-size: 14px;--}}
{{--        }--}}

{{--        .save-btn {--}}
{{--            background: #d1c2f1;--}}
{{--            border: none;--}}
{{--            border-radius: 8px;--}}
{{--            padding: 4px 12px;--}}
{{--            color: white;--}}
{{--            font-size: 12px;--}}
{{--            float: right;--}}
{{--            cursor: pointer;--}}
{{--        }--}}

{{--        .form-line {--}}
{{--            display: flex;--}}
{{--            align-items: center;--}}
{{--            gap: 8px;--}}
{{--            font-size: 13px;--}}
{{--            color: #444;--}}
{{--        }--}}

{{--        .kanban-footer {--}}
{{--            font-size: 13px;--}}
{{--            color: #777;--}}
{{--            margin-top: 12px;--}}
{{--            cursor: pointer;--}}
{{--        }--}}

{{--        .kanban-footer:hover {--}}
{{--            text-decoration: underline;--}}
{{--        }--}}
{{--    </style>--}}
{{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">--}}
{{--</head>--}}
{{--<body>--}}

{{--<div class="kanban-column">--}}
{{--    <div class="kanban-header">--}}
{{--        <div class="kanban-title">--}}
{{--            <i class="fa-regular fa-clock"></i> EM ANDAMENTO--}}
{{--        </div>--}}
{{--        <div>0</div>--}}
{{--        <div>⋯</div>--}}
{{--        <div>+</div>--}}
{{--    </div>--}}

{{--    <div id="taskForm" class="task-form">--}}
{{--        <div style="display: flex; justify-content: space-between; align-items: center;">--}}
{{--            <input type="text" placeholder="Nome da tarefa..." style="flex: 1;">--}}
{{--            <button class="save-btn">Salvar <i class="fa-solid fa-arrow-up-right-from-square"></i></button>--}}
{{--        </div>--}}
{{--        <div class="form-line"><i class="fa-regular fa-user"></i> Adicionar responsável</div>--}}
{{--        <div class="form-line"><i class="fa-regular fa-calendar-days"></i> Adicionar datas</div>--}}
{{--        <div class="form-line"><i class="fa-regular fa-flag"></i> Adicionar prioridade</div>--}}
{{--    </div>--}}

{{--    <div class="kanban-footer" onclick="toggleForm()">+ Adicionar Tarefa</div>--}}
{{--</div>--}}

{{--<script>--}}
{{--    function toggleForm() {--}}
{{--        const form = document.getElementById('taskForm');--}}
{{--        form.style.display = form.style.display === 'flex' ? 'none' : 'flex';--}}
{{--    }--}}
{{--</script>--}}

{{--</body>--}}
{{--</html>--}}


{{--<!DOCTYPE html>--}}
{{--<html lang="pt-br">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <title>Dropdown Interativos</title>--}}
{{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">--}}
{{--    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">--}}
{{--    <style>--}}
{{--        body {--}}
{{--            font-family: Arial, sans-serif;--}}
{{--            padding: 40px;--}}
{{--            background: #f7f7f7;--}}
{{--        }--}}

{{--        .task-form {--}}
{{--            background: white;--}}
{{--            border: 1px solid #ccc;--}}
{{--            border-left: 4px solid #8d75e6;--}}
{{--            border-radius: 8px;--}}
{{--            padding: 12px;--}}
{{--            width: 300px;--}}
{{--        }--}}

{{--        .form-line {--}}
{{--            display: flex;--}}
{{--            align-items: center;--}}
{{--            gap: 8px;--}}
{{--            font-size: 14px;--}}
{{--            color: #555;--}}
{{--            margin: 10px 0;--}}
{{--            cursor: pointer;--}}
{{--        }--}}

{{--        .dropdown, .priority-menu {--}}
{{--            border: 1px solid #ccc;--}}
{{--            border-radius: 8px;--}}
{{--            background: #fff;--}}
{{--            box-shadow: 0 4px 8px rgba(0,0,0,0.1);--}}
{{--            margin-top: 5px;--}}
{{--            padding: 8px;--}}
{{--            display: none;--}}
{{--            position: absolute;--}}
{{--            z-index: 10;--}}
{{--            width: 280px;--}}
{{--        }--}}

{{--        .dropdown input {--}}
{{--            width: 100%;--}}
{{--            padding: 6px;--}}
{{--            margin-bottom: 6px;--}}
{{--        }--}}

{{--        .dropdown-item {--}}
{{--            padding: 6px;--}}
{{--            display: flex;--}}
{{--            align-items: center;--}}
{{--            gap: 8px;--}}
{{--            border-radius: 5px;--}}
{{--            cursor: pointer;--}}
{{--        }--}}

{{--        .dropdown-item:hover {--}}
{{--            background-color: #eee;--}}
{{--        }--}}

{{--        .avatar {--}}
{{--            background: #8d75e6;--}}
{{--            color: white;--}}
{{--            width: 24px;--}}
{{--            height: 24px;--}}
{{--            font-size: 12px;--}}
{{--            border-radius: 50%;--}}
{{--            display: flex;--}}
{{--            align-items: center;--}}
{{--            justify-content: center;--}}
{{--        }--}}

{{--        .priority-item {--}}
{{--            display: flex;--}}
{{--            align-items: center;--}}
{{--            gap: 8px;--}}
{{--            padding: 5px;--}}
{{--            cursor: pointer;--}}
{{--        }--}}

{{--        .priority-item:hover {--}}
{{--            background-color: #eee;--}}
{{--            border-radius: 5px;--}}
{{--        }--}}
{{--    </style>--}}
{{--</head>--}}
{{--<body>--}}

{{--<div class="task-form">--}}
{{--    <div class="form-line" onclick="toggleDropdown('responsavelDropdown')">--}}
{{--        <i class="fa-regular fa-user"></i> Adicionar responsável--}}
{{--    </div>--}}
{{--    <div id="responsavelDropdown" class="dropdown">--}}
{{--        <input type="text" placeholder="Busque ou insira o e-mail...">--}}
{{--        <div class="dropdown-item"><div class="avatar">S</div> Eu</div>--}}
{{--        <div class="dropdown-item"><div class="avatar">DN</div> Douglas Nordi</div>--}}
{{--    </div>--}}

{{--    <div class="form-line" onclick="toggleDropdown('dataDropdown')">--}}
{{--        <i class="fa-regular fa-calendar-days"></i> Adicionar datas--}}
{{--    </div>--}}
{{--    <div id="dataDropdown" class="dropdown">--}}
{{--        <input id="datepicker" placeholder="Data de vencimento" readonly>--}}
{{--    </div>--}}

{{--    <div class="form-line" onclick="toggleDropdown('prioridadeDropdown')">--}}
{{--        <i class="fa-regular fa-flag"></i> Adicionar prioridade--}}
{{--    </div>--}}
{{--    <div id="prioridadeDropdown" class="dropdown priority-menu">--}}
{{--        <div class="priority-item"><i class="fa-solid fa-flag" style="color:#e74c3c;"></i> Urgente</div>--}}
{{--        <div class="priority-item"><i class="fa-solid fa-flag" style="color:#f39c12;"></i> Alta</div>--}}
{{--        <div class="priority-item"><i class="fa-solid fa-flag" style="color:#3498db;"></i> Normal</div>--}}
{{--        <div class="priority-item"><i class="fa-solid fa-flag" style="color:#bdc3c7;"></i> Baixa</div>--}}
{{--        <hr>--}}
{{--        <div class="priority-item"><i class="fa-solid fa-ban"></i> Limpar</div>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>--}}
{{--<script>--}}
{{--    flatpickr("#datepicker", {--}}
{{--        locale: 'pt'--}}
{{--    });--}}

{{--    function toggleDropdown(id) {--}}
{{--        document.querySelectorAll('.dropdown').forEach(el => {--}}
{{--            if (el.id !== id) el.style.display = 'none';--}}
{{--        });--}}
{{--        const el = document.getElementById(id);--}}
{{--        el.style.display = el.style.display === 'block' ? 'none' : 'block';--}}
{{--    }--}}

{{--    // Fecha os dropdowns ao clicar fora--}}
{{--    document.addEventListener('click', function (e) {--}}
{{--        const isClickInside = e.target.closest('.form-line') || e.target.closest('.dropdown');--}}
{{--        if (!isClickInside) {--}}
{{--            document.querySelectorAll('.dropdown').forEach(el => el.style.display = 'none');--}}
{{--        }--}}
{{--    });--}}
{{--</script>--}}

{{--</body>--}}
{{--</html>--}}

@extends('layouts.templates.app-layout')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">

    <style>
        body {
            font-family: -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background: #f7f7f7;
            padding: 20px;
        }

        .kanban-board {
            display: flex;
            align-items: self-start;
            height: calc(100vh - 225px) !important;
            gap: 30px;
            overflow-x: auto;
            padding: 16px;
            scroll-behavior: smooth;
            cursor: grab;
            user-select: none;
            scrollbar-width: thin;
            scrollbar-color: #ccc transparent;
        }

        .kanban-board::-webkit-scrollbar {
            height: 6px;
        }

        .kanban-board::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 4px;
        }

        .kanban-board.grabbing {
            cursor: grabbing;
        }

        .kanban-board:active {
            cursor: grabbing;
        }

        .kanban-column {
            min-width: 260px;
            max-width: 280px;
            flex-shrink: 0;
            background-color: #f1f8ff;
            border-radius: 8px;
            padding: 12px;
            box-shadow: 0 0 4px rgba(0, 0, 0, 0.05);
        }

        .drag-shadow {
            opacity: 0.6;
            border: 2px dashed #aaa;
        }

        .kanban-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .kanban-title {
            display: flex;
            align-items: center;
            font-size: 10px;
            font-weight: 600;
            text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.2);
            color: white;
            background-color: #0182d0;
            border-radius: 3.5px;
            padding: 3.5px 8px;
            gap: 4px;
        }

        .task-form {
            background: white;
            border: 1px solid #ccc;
            border-left: 4px solid #8d75e6;
            border-radius: 8px;
            padding: 12px;
            display: none;
            flex-direction: column;
            gap: 10px;
        }

        .task-form input {
            border: none;
            border-bottom: 1px solid #ccc;
            outline: none;
            font-size: 14px;
        }

        .kanban-task-card {
            background: white;
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            font-size: 14px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 6px;
        }

        .card-title {
            font-weight: 500;
            max-width: 180px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .card-actions {
            display: flex;
            gap: 4px;
        }

        .btn-icon {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 13px;
            color: #777;
        }

        .card-footer {
            display: flex;
            gap: 6px;
            margin-top: 8px;
            align-items: center;
            flex-wrap: wrap;
        }

        .card-item {
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 2px 8px;
            background: #f1f1f1;
            border-radius: 16px;
            font-size: 12px;
            cursor: pointer;
        }

        .card-item-responsavel {
            background: rgba(241, 241, 241, 0) !important;
        }

        .card-item.disabled {
            background: #f0f0f0;
            color: #aaa;
        }

        .avatar {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #8d75e6;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
        }

        .badge-date {
            background: #f0f0f0;
            color: #555;
        }

        .badge-priority {
            color: white;
            font-weight: 500;
        }

        .badge-urgente {
            background: #e74c3c;
        }

        .badge-alta {
            background: #f39c12;
        }

        .badge-normal {
            background: #3498db;
        }

        .badge-baixa {
            background: #95a5a6;
        }

        .save-btn {
            background: #d1c2f1;
            border: none;
            border-radius: 8px;
            padding: 4px 12px;
            color: white;
            font-size: 12px;
            float: right;
            cursor: pointer;
        }

        .form-line {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #555;
            margin: 10px 0;
            cursor: pointer;
        }

        .kanban-footer {
            font-size: 13px;
            color: #777;
            margin-top: 12px;
            cursor: pointer;
        }

        .kanban-footer:hover {
            text-decoration: underline;
        }

        .dropdown-kanban, .priority-menu {
            position: absolute;
            border: 1px solid #ccc;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 5px;
            padding: 8px;
            display: none;
            position: absolute;
            z-index: 10;
            width: 280px;
        }

        .dropdown input {
            width: 100%;
            padding: 6px;
            margin-bottom: 6px;
        }

        .dropdown-item {
            padding: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
            border-radius: 5px;
            cursor: pointer;
        }

        .dropdown-item:hover {
            background-color: #eee;
        }

        .avatar {
            background: #8d75e6;
            color: white;
            width: 24px;
            height: 24px;
            font-size: 12px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .priority-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 5px;
            cursor: pointer;
        }

        .priority-item:hover {
            background-color: #eee;
            border-radius: 5px;
        }
    </style>

    <div class="row d-none">
        <x-select col="2" set="" title="Prioridade" name="filterPriority" id="filterPriority">
            <option value="">Todas</option>
            <option value="low">Baixa</option>
            <option value="medium">Média</option>
            <option value="high">Alta</option>
            <option value="important">Urgente</option>
        </x-select>

        <x-input col="3" set="" type="date" name="filterDateFrom" id="filterDateFrom"
                 title="Vencimento de"></x-input>
        <x-input col="3" set="" type="date" name="filterDateTo" id="filterDateTo" title="Até"></x-input>

        <div class="col-4">
            <div class="flex items-center">
                <input type="checkbox" id="filterAttachments"
                       class="h-4 w-4 text-blue-600 border-gray-300 rounded"/>
                <label for="filterAttachments" class="ml-2 block text-sm text-gray-700">Com anexos</label>
            </div>
        </div>
    </div>

    <div class="row d-none">
        <div class="col-6">
            <div class="form-group">
                <label for="filterResponsible">Responsável</label>
                <select class="form-control" id="filterResponsible" name="filterResponsible" multiple>
                    @foreach($users as $u)
                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row d-none">
        <div class="col-4">
            <button id="btnClearFilters" class="btn btn-sm btn-outline-danger">Limpar</button>
            <button id="btnApplyFilters" class="btn btn-sm btn-warning">Filtrar</button>
        </div>
    </div>

    <hr>

    <div class="kanban-board">
            @foreach ($statuses as $status)
                <div class="kanban-column" id="col-{{ $status->task_status_id }}"
                     data-status-id="{{ $status->task_status_id }}"
                     style="background: {{ $status->cor_hex ?? $status->color }}05" ;>
                    <div class="kanban-header">
                        <div class="kanban-title" style="background-color: {{ $status->cor_hex ?? $status->color }};">
                            <i class="fa-regular fa-clock"></i> {{ strtoupper($status->name) }}
                        </div>
                        <div style="font-size: 12px; font-weight: 500; color: #cecece;"
                             id="count-{{ $status->task_status_id }}">{{$status->tasks_count ?? 0}}</div>
                        <div>⋯</div>
                        <div>+</div>
                    </div>

                    <div class="kanban-tasks" id="tasks-{{ $status->task_status_id }}">
                        <!-- Aqui vão ser inseridos os cards via JS -->
                    </div>

                    <div class="task-form" id="taskForm-{{ $status->task_status_id }}">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <input type="text" placeholder="Nome da tarefa..." style="flex: 1;">
                            <button class="save-btn create-task-btn" data-status-id="{{ $status->task_status_id }}">
                                Salvar <i class="fa-solid fa-arrow-up-right-from-square"></i>
                            </button>
                        </div>

                        <div class="form-line"
                             onclick="toggleDropdown('responsavelDropdown-{{ $status->task_status_id }}')">
                            <i class="fa-regular fa-user"></i> Adicionar responsável
                        </div>
                        <div id="responsavelDropdown-{{ $status->task_status_id }}" class="dropdown">
                            <input type="text" placeholder="Busque ou insira o e-mail...">
                            <div class="dropdown-item">
                                <div class="avatar">S</div>
                                Eu
                            </div>
                            <div class="dropdown-item">
                                <div class="avatar">DN</div>
                                Douglas Nordi
                            </div>
                        </div>

                        <div class="form-line" onclick="toggleDropdown('dataDropdown-{{ $status->task_status_id }}')">
                            <i class="fa-regular fa-calendar-days"></i> Adicionar datas
                        </div>
                        <div id="dataDropdown-{{ $status->task_status_id }}" class="dropdown">
                            <input id="datepicker-{{ $status->task_status_id }}" placeholder="Data de vencimento"
                                   readonly>
                        </div>

                        <div class="form-line"
                             onclick="toggleDropdown('prioridadeDropdown-{{ $status->task_status_id }}')">
                            <i class="fa-regular fa-flag"></i> Adicionar prioridade
                        </div>
                        <div id="prioridadeDropdown-{{ $status->task_status_id }}" class="dropdown priority-menu">
                            <div class="priority-item"><i class="fa-solid fa-flag" style="color:#e74c3c;"></i> Urgente
                            </div>
                            <div class="priority-item"><i class="fa-solid fa-flag" style="color:#f39c12;"></i> Alta
                            </div>
                            <div class="priority-item"><i class="fa-solid fa-flag" style="color:#3498db;"></i> Normal
                            </div>
                            <div class="priority-item"><i class="fa-solid fa-flag" style="color:#bdc3c7;"></i> Baixa
                            </div>
                            <hr>
                            <div class="priority-item"><i class="fa-solid fa-ban"></i> Limpar</div>
                        </div>
                    </div>

                    <div class="kanban-footer" onclick="toggleForm('taskForm-{{ $status->task_status_id }}')">+
                        Adicionar
                        Tarefa
                    </div>
                </div>
            @endforeach
        </div>

    <!-- Dropdown: Responsável -->
    <div id="dropdown-global-responsavel" class="dropdown-kanban" style="display:none; position:absolute;">
        <input type="text" placeholder="Buscar responsável..." class="form-control mb-1">
        <div class="dropdown-item" onclick="selectResponsible('eu')">
            <div class="avatar">S</div>
            Eu
        </div>
        <div class="dropdown-item" onclick="selectResponsible('andresantos')">
            <div class="avatar">AS</div>
            Andre Santos
        </div>
    </div>

    <!-- Dropdown: Data -->
    <div id="dropdown-date" class="dropdown-kanban" style="display:none; position:absolute;">
        <input type="text" id="dropdown-datepicker" class="form-control" placeholder="Selecionar data">
    </div>

    <!-- Dropdown: Prioridade -->
    <div id="dropdown-priority" class="dropdown-kanban priority-menu" style="display:none; position:absolute;">
        <div class="priority-item" onclick="selectPriority('Urgente')"><i class="fa-solid fa-flag"
                                                                          style="color:#e74c3c;"></i> Urgente
        </div>
        <div class="priority-item" onclick="selectPriority('Alta')"><i class="fa-solid fa-flag"
                                                                       style="color:#f39c12;"></i>
            Alta
        </div>
        <div class="priority-item" onclick="selectPriority('Normal')"><i class="fa-solid fa-flag"
                                                                         style="color:#3498db;"></i> Normal
        </div>
        <div class="priority-item" onclick="selectPriority('Baixa')"><i class="fa-solid fa-flag"
                                                                        style="color:#95a5a6;"></i>
            Baixa
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/pt.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>

    <script>
        document.querySelectorAll('input[id^="datepicker-"]').forEach(el => {
            flatpickr(el, {locale: flatpickr.l10ns.pt});
        });

        function toggleForm(id) {
            const form = document.getElementById(id);
            if (!form) return;
            form.style.display = form.style.display === 'flex' ? 'none' : 'flex';
        }

        function toggleDropdown(id) {
            console.log('Abrindo dropdown:', id);
            document.querySelectorAll('.dropdown').forEach(el => {
                if (el.id !== id) el.style.display = 'none';
            });
            const el = document.getElementById(id);
            if (el) {
                el.style.display = el.style.display === 'block' ? 'none' : 'block';
            } else {
                console.warn('Dropdown não encontrado para ID:', id);
            }
        }

        let activeTaskId = null;
        const apiUrl = '{{ url("/tasks-api") }}';
        const statuses = @json($statuses);

        async function request(url, options = {}) {
            const token = document.querySelector('meta[name="csrf-token"]').content;
            options.headers = {'X-CSRF-TOKEN': token, 'Accept': 'application/json', ...options.headers};
            const res = await fetch(url, options);
            if (!res.ok) throw res;
            return res.json();
        }

        document.addEventListener('click', async function (e) {
            if (e.target.closest('.create-task-btn')) {
                e.preventDefault();
                const button = e.target.closest('.create-task-btn');
                const statusId = button.dataset.statusId;
                await createTask(button, statusId);
            }
        });

        async function createTask(button, statusId) {
            const form = document.getElementById(`taskForm-${statusId}`);
            const nameInput = form.querySelector('input[type="text"]');
            const dueInput = form.querySelector(`#datepicker-${statusId}`);
            const name = nameInput.value.trim();
            const dueDate = dueInput.value || null;
            if (!name) return alert("Nome da tarefa é obrigatório.");

            const payload = {
                task_status_id: statusId,
                name: name,
                due_date: dueDate,
                responsible: [{{ auth()->id() }}],
                priority: "medium"
            };

            try {
                await request(`${apiUrl}`, {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify(payload)
                });
                nameInput.value = '';
                dueInput.value = '';
                form.style.display = 'none';
                await loadTasks();
            } catch (err) {
                alert("Erro ao criar tarefa.");
                console.error(err);
            }
        }

        async function loadTasks() {
            const respOpts = Array.from(document.getElementById('filterResponsible').selectedOptions).map(o => o.value);
            const priority = document.getElementById('filterPriority').value;
            const dateFrom = document.getElementById('filterDateFrom').value;
            const dateTo = document.getElementById('filterDateTo').value;
            const hasAtt = document.getElementById('filterAttachments').checked;
            const params = new URLSearchParams();
            respOpts.forEach(r => params.append('responsible[]', r));
            if (priority) params.append('priority', priority);
            if (dateFrom) params.append('date_from', dateFrom);
            if (dateTo) params.append('date_to', dateTo);
            if (hasAtt) params.append('has_attachments', '1');

            const tasks = await request(`${apiUrl}?${params.toString()}`);

            statuses.forEach(s => {
                const taskContainer = document.getElementById(`tasks-${s.task_status_id}`);
                if (taskContainer) taskContainer.innerHTML = '';
                const cnt = document.getElementById(`count-${s.task_status_id}`);
                if (cnt) cnt.innerText = 0;
            });

            function getInitials(name) {
                if (!name) return '?';
                const parts = name.trim().split(' ');
                return parts.length >= 2
                    ? parts[0][0].toUpperCase() + parts[1][0].toUpperCase()
                    : parts[0][0].toUpperCase();
            }

            function formatDate(dateStr) {
                const date = new Date(dateStr);
                return date.toLocaleDateString('pt-BR', {weekday: 'short'}).toLowerCase();
            }

            tasks.forEach(task => {
                const taskContainer = document.getElementById(`tasks-${task.task_status_id}`);
                if (!taskContainer) return;
                const cardHtml = `<div class="kanban-task-card" data-task-id="${task.task_id}">
            <div class="card-header">
                <div class="card-title" title="${task.name}">${task.name}</div>
                <div class="card-actions">
                    <button class="btn-icon"><i class="fa-solid fa-check"></i></button>
                    <button class="btn-icon"><i class="fa-solid fa-plus"></i></button>
                    <button class="btn-icon"><i class="fa-solid fa-pen"></i></button>
                </div>
            </div>
            <div class="card-footer">
                ${(task.assignees && task.assignees.length > 0) ? `
                    <div class="card-item card-item-responsavel" onclick="editResponsible('${task.task_id}')">
                        <div class="avatar">${getInitials(task.assignees[0]?.name)}</div>
                    </div>` :
                    `<div class="card-item disabled card-item-responsavel" onclick="editResponsible('${task.task_id}')">
                        <i class="fa-regular fa-user"></i>
                    </div>`}
                ${task.due_date ? `
                    <div class="card-item badge-date card-item-date" onclick="editDate('${task.task_id}')">
                        <i class="fa-regular fa-calendar-days"></i> ${formatDate(task.due_date)}
                    </div>` :
                    `<div class="card-item disabled card-item-date" onclick="editDate('${task.task_id}')">
                        <i class="fa-regular fa-calendar-days"></i>
                    </div>`}
                ${task.priority ? `
                    <div class="card-item badge-priority card-item-priority badge-${task.priority.toLowerCase()}" onclick="editPriority('${task.task_id}')">
                        <i class="fa-regular fa-flag"></i> ${task.priority}
                    </div>` :
                    `<div class="card-item disabled card-item-priority" onclick="editPriority('${task.task_id}')">
                        <i class="fa-regular fa-flag"></i>
                    </div>`}
            </div>
        </div>`;
                taskContainer.insertAdjacentHTML('beforeend', cardHtml);
                const cnt = document.getElementById(`count-${task.task_status_id}`);
                if (cnt) cnt.innerText = parseInt(cnt.innerText || '0') + 1;
            });

            attachCardHandlers();
        }

        // === AÇÕES NOS DROPDOWNS DE EDIÇÃO ===
        function editResponsible(taskId) {
            activeTaskId = taskId;
            const trigger = document.querySelector(`[data-task-id="${taskId}"] .card-item-responsavel`);
            const dropdown = document.getElementById('dropdown-global-responsavel');
            openDropdown(dropdown, trigger);
        }

        function editDate(taskId) {
            activeTaskId = taskId;
            const trigger = document.querySelector(`[data-task-id="${taskId}"] .card-item-date`);
            const dropdown = document.getElementById('dropdown-date');
            openDropdown(dropdown, trigger);
            flatpickr("#dropdown-datepicker", {
                locale: flatpickr.l10ns.pt,
                defaultDate: new Date(),
                onChange: (dates, val) => selectDueDate(val)
            });
        }

        function editPriority(taskId) {
            activeTaskId = taskId;
            const trigger = document.querySelector(`[data-task-id="${taskId}"] .card-item-priority`);
            const dropdown = document.getElementById('dropdown-priority');
            openDropdown(dropdown, trigger);
        }

        function openDropdown(dropdown, trigger) {
            if (!dropdown || !trigger) return;
            const rect = trigger.getBoundingClientRect();
            dropdown.style.top = `${rect.bottom + window.scrollY + 6}px`;
            dropdown.style.left = `${rect.left + window.scrollX}px`;
            dropdown.style.display = 'block';
            document.querySelectorAll('.dropdown').forEach(d => {
                if (d !== dropdown) d.style.display = 'none';
            });
        }

        function selectPriority(value) {
            if (!activeTaskId) return;
            request(`${apiUrl}/${activeTaskId}`, {
                method: 'PUT',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({priority: value})
            }).then(() => loadTasks());
            document.getElementById('dropdown-priority').style.display = 'none';
        }

        function selectResponsible(value) {
            if (!activeTaskId) return;
            const responsible = value === 'eu' ? [{{ auth()->id() }}] : [parseInt(value)];
            request(`${apiUrl}/${activeTaskId}`, {
                method: 'PUT',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({responsible})
            }).then(() => loadTasks());
            document.getElementById('dropdown-global-responsavel').style.display = 'none';
        }

        function selectDueDate(value) {
            if (!activeTaskId) return;
            request(`${apiUrl}/${activeTaskId}`, {
                method: 'PUT',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({due_date: value})
            }).then(() => loadTasks());
            document.getElementById('dropdown-date').style.display = 'none';
        }

        document.addEventListener('DOMContentLoaded', () => {
            // 1) SORTABLE DAS TASKS
            statuses.forEach(s => {
                const el = document.getElementById(`tasks-${s.task_status_id}`);
                if (!el) return;

                Sortable.create(el, {
                    group: 'tasks',
                    animation: 150,
                    onEnd: async ({item, to}) => {
                        const newStatus = to.closest('.kanban-column').dataset.statusId;
                        const taskId = item.dataset.taskId;

                        const taskIds = Array.from(to.querySelectorAll('.kanban-task-card')).map(t => t.dataset.taskId);

                        await request(`${apiUrl}/${taskId}`, {
                            method: 'PUT',
                            headers: {'Content-Type': 'application/json'},
                            body: JSON.stringify({
                                task_status_id: newStatus,
                                order: taskIds.indexOf(taskId)
                            })
                        });

                        for (let i = 0; i < taskIds.length; i++) {
                            if (taskIds[i] === taskId) continue;
                            await request(`${apiUrl}/${taskIds[i]}`, {
                                method: 'PUT',
                                headers: {'Content-Type': 'application/json'},
                                body: JSON.stringify({order: i})
                            });
                        }
                    }
                });
            });

            // 2) SORTABLE DOS STATUS
            new Sortable(document.querySelector('.kanban-board'), {
                animation: 150,
                ghostClass: 'drag-shadow',
                handle: '.kanban-column',
                draggable: '.kanban-column', // <- ESSENCIAL: só colunas são arrastáveis
                onEnd: function () {
                    const novaOrdem = Array.from(document.querySelectorAll('.kanban-column'))
                        .map(col => col.dataset.statusId);

                    fetch('/task-status/reorder', {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({statuses: novaOrdem})
                    })
                        .then(res => res.json())
                        .then(data => console.log('Ordem de status atualizada:', data.message))
                        .catch(err => console.error('Erro ao reordenar status:', err));
                }
            });

            document.getElementById('btnApplyFilters').onclick = loadTasks;
            document.getElementById('btnClearFilters').onclick = () => {
                document.getElementById('filterResponsible').value = null;
                document.getElementById('filterPriority').value = '';
                document.getElementById('filterDateFrom').value = '';
                document.getElementById('filterDateTo').value = '';
                document.getElementById('filterAttachments').checked = false;
                loadTasks();
            };

            loadTasks();
        });

        function attachCardHandlers() {
            document.querySelectorAll('.kanban-card').forEach(el => {
                el.onclick = () => editTask(el.dataset.taskId);
            });
        }

        document.addEventListener('click', function (e) {
            if (!e.target.closest('.dropdown') && !e.target.closest('.card-item')) {
                document.querySelectorAll('.dropdown').forEach(d => d.style.display = 'none');
            }
        });
    </script>

    <script>
        const board = document.querySelector('.kanban-board');
        let isMouseDown = false;
        let startX;
        let scrollLeft;

        // só ativa o scroll horizontal se clicar fora de uma coluna
        board.addEventListener('mousedown', (e) => {
            if (e.target.closest('.kanban-column')) return; // ⛔ ignora se clicou numa coluna
            isMouseDown = true;
            board.classList.add('grabbing');
            startX = e.pageX - board.offsetLeft;
            scrollLeft = board.scrollLeft;
        });

        board.addEventListener('mouseleave', () => {
            isMouseDown = false;
            board.classList.remove('grabbing');
        });

        board.addEventListener('mouseup', () => {
            isMouseDown = false;
            board.classList.remove('grabbing');
        });

        board.addEventListener('mousemove', (e) => {
            if (!isMouseDown) return;
            e.preventDefault();
            const x = e.pageX - board.offsetLeft;
            const walk = (x - startX) * 1.5;
            board.scrollLeft = scrollLeft - walk;
        });
    </script>
@endsection
