@extends('layouts.templates.app-layout')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border">
                <div class="card-header border-bottom pb-0">
                    <div class="d-sm-flex align-items-center mb-3">
                        <div class="d-flex align-items-center">
                            @if (currentRoute()[1] != 'index')
                                <a href="{{ route(currentRoute()[0] . '.index') }}">
                                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                </a>
                            @endif
                            <div class="mx-3">
                                <h6 class="font-weight-semibold text-lg mb-0">Quadro de tarefas</h6>
                                <p class="text-sm mb-sm-0">Atualmente há {{ $tasksToday }} com vencimento para hoje.</p>
                            </div>
                        </div>
                        <div class="ms-auto d-flex float-end">

                            <a href="{{route('task_status.index')}}" type="button"
                               class="btn btn-sm btn-warning btn-icon d-flex align-items-center mb-0">
                              <span class="btn-inner--icon">
                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor"
                                     stroke-width="1.5" class="d-block me-2">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                </svg>
                              </span>
                                <span class="btn-inner--text">Novo</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
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

    <div class="row">
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

    <div class="row">
        <div class="col-4">
            <button id="btnClearFilters" class="btn btn-sm btn-outline-danger">Limpar</button>
            <button id="btnApplyFilters" class="btn btn-sm btn-warning">Filtrar</button>
        </div>
    </div>

    <hr>

    <div class="container-fluid py-3">
        <div class="d-flex overflow-auto pb-4">
            @foreach($statuses as $status)
                <div class="tasks flex-shrink-0 me-4" style="width:22rem;">
                    <div class="card mb-0" style="border-top:4px solid {{ $status->cor_hex ?? $status->color }};">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">
                                {{ $status->name }}
                                <small class="text-muted ms-1">{{ $status->tasks_count ?? 0 }}</small>
                            </h6>
                        </div>
                        <div id="col-{{ $status->task_status_id }}"
                             class="list-group list-group-flush p-3 kanban-cards">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

<style>
    .kanban-card {
        background: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 12px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        margin-bottom: 12px;
    }

    .kanban-cards {
        max-height: 60vh;
        overflow-y: auto;
    }

    .kanban-cards::-webkit-scrollbar {
        width: 4px;
    }

    .kanban-cards::-webkit-scrollbar-thumb {
        background: rgba(0, 0, 0, 0.2);
        border-radius: 2px;
    }

    .kanban-card .card-body {
        display: flex;
        flex-direction: column;
    }

    .kanban-card .card-title {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .tasks .card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 8px;
    }

    .title {
        font-size: 14px;
        font-weight: 500;
        color: #333;
        line-height: 1.2;
        margin: 0;
    }

    .notification {
        position: relative;
    }

    .notification i {
        font-size: 18px;
        color: #666;
    }

    .badge {
        position: absolute;
        top: -6px;
        right: -6px;
        background: #ff3b30;
        color: #fff;
        border-radius: 50%;
        padding: 2px 6px;
        font-size: 10px;
        font-weight: bold;
    }

    .card-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .meta-left {
        display: flex;
        align-items: center;
    }

    .status {
        background: #ffdd57;
        color: #333;
        font-size: 12px;
        padding: 2px 6px;
        border-radius: 4px;
        margin-right: 8px;
        text-transform: uppercase;
    }

    .date {
        display: flex;
        align-items: center;
        font-size: 12px;
        color: #666;
    }

    .date i {
        margin-right: 4px;
    }

    .user {
        font-size: 12px;
        color: #666;
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
<script>
    const apiUrl = '{{ url("/tasks-api") }}';
    const statuses = @json($statuses);

    async function request(url, options = {}) {
        const token = document.querySelector('meta[name="csrf-token"]').content;
        options.headers = {'X-CSRF-TOKEN': token, 'Accept': 'application/json', ...options.headers};
        const res = await fetch(url, options);
        if (!res.ok) throw res;
        return res.json();
    }

    async function loadTasks() {
        // coleta filtros
        const respOpts = Array.from(document.getElementById('filterResponsible').selectedOptions).map(o => o.value);
        const priority = document.getElementById('filterPriority').value;
        const dateFrom = document.getElementById('filterDateFrom').value;
        const dateTo = document.getElementById('filterDateTo').value;
        const hasAtt = document.getElementById('filterAttachments').checked;

        // constrói query string
        const params = new URLSearchParams();
        respOpts.forEach(r => params.append('responsible[]', r));
        if (priority) params.append('priority', priority);
        if (dateFrom) params.append('date_from', dateFrom);
        if (dateTo) params.append('date_to', dateTo);
        if (hasAtt) params.append('has_attachments', '1');

        // fetch e render
        const tasks = await request(`${apiUrl}?${params.toString()}`);
        // limpa colunas e contadores
        statuses.forEach(s => {
            const col = document.getElementById(`col-${s.task_status_id}`);
            col.innerHTML = '';
            const cnt = document.getElementById(`count-${s.task_status_id}`);
            if (cnt) cnt.innerText = 0;
        });
        // adiciona cards
        tasks.forEach(task => {
            const col = document.getElementById(`col-${task.task_status_id}`);
            if (!col) return;
            col.insertAdjacentHTML('beforeend', `
  <div class="card mb-3 kanban-card">
    <div class="card-body p-2" style="border-left:4px solid ${task.status_color}; display:flex; flex-direction:column; justify-content:space-between;">

      <!-- header -->
      <div class="d-flex justify-content-between align-items-start mb-2">
        <h6 class="card-title mb-0">${task.name}</h6>
        <div class="position-relative">
          <i class="fa fa-comment-dots"></i>
          ${task.attachments_count > 0
                ? `<span class="badge bg-danger position-absolute top-0 start-100 translate-middle">${task.attachments_count}</span>`
                : ``}
        </div>
      </div>

      <!-- footer -->
      <div class="mt-auto d-flex justify-content-between align-items-center small text-muted">
        <div>
          <span class="badge text-uppercase"
                style="background-color:${task.status_color}33; color:${task.status_color};">
            ${task.status_label}
          </span>
          <i class="fa fa-calendar ms-2"></i> ${task.due_date || '--'}
        </div>
        <div>${task.assignees[0]?.name || ''}</div>
      </div>
    </div>
  </div>
`);


            // atualiza contador
            const cnt = document.getElementById(`count-${task.task_status_id}`);
            if (cnt) cnt.innerText = parseInt(cnt.innerText || '0') + 1;
        });
        attachCardHandlers();
    }

    function attachCardHandlers() {
        document.querySelectorAll('.kanban-card').forEach(el => {
            el.onclick = () => editTask(el.dataset.taskId);
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        // inicializa drag&drop
        statuses.forEach(s => {
            Sortable.create(document.getElementById(`col-${s.task_status_id}`), {
                group: 'kanban', animation: 150,
                onEnd: async ({item, to}) => {
                    const id = item.dataset.taskId;
                    const newStatus = to.closest('.kanban-column').dataset.statusId;
                    await request(`${apiUrl}/${id}`, {
                        method: 'PUT', headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({task_status_id: newStatus})
                    });
                }
            });
        });
        // botões de filtro
        document.getElementById('btnApplyFilters').onclick = loadTasks;
        document.getElementById('btnClearFilters').onclick = () => {
            document.getElementById('filterResponsible').value = null;
            document.getElementById('filterPriority').value = '';
            document.getElementById('filterDateFrom').value = '';
            document.getElementById('filterDateTo').value = '';
            document.getElementById('filterAttachments').checked = false;
            loadTasks();
        };
        // carrega inicialmente
        loadTasks();
    });
</script>
