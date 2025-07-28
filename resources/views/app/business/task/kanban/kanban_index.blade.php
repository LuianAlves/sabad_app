@extends('layouts.templates.app-layout')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">

    <style>
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
                </div>

                <div id="floating-task-form" class="task-form" style="position:absolute; display:none; z-index:999;">
                    <input type="hidden" id="floating-status-id">

                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <input type="text" id="floating-task-name" placeholder="Nome da tarefa..." style="flex: 1;">
                        <button class="save-btn" onclick="submitFloatingForm()">
                            Salvar <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </button>
                    </div>

                    <div class="form-line" onclick="toggleDropdown('floating-responsavel')">
                        <i class="fa-regular fa-user"></i> Adicionar responsável
                    </div>
                    <div id="floating-responsavel" class="dropdown">
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

                    <div class="form-line" onclick="toggleDropdown('floating-data')">
                        <i class="fa-regular fa-calendar-days"></i> Adicionar datas
                    </div>
                    <div id="floating-data" class="dropdown">
                        <input id="floating-datepicker" placeholder="Data de vencimento" readonly>
                    </div>

                    <div class="form-line" onclick="toggleDropdown('floating-prioridade')">
                        <i class="fa-regular fa-flag"></i> Adicionar prioridade
                    </div>
                    <div id="floating-prioridade" class="dropdown priority-menu">
                        <div class="priority-item"><i class="fa-solid fa-flag" style="color:#e74c3c;"></i> Urgente</div>
                        <div class="priority-item"><i class="fa-solid fa-flag" style="color:#f39c12;"></i> Alta</div>
                        <div class="priority-item"><i class="fa-solid fa-flag" style="color:#3498db;"></i> Normal</div>
                        <div class="priority-item"><i class="fa-solid fa-flag" style="color:#bdc3c7;"></i> Baixa</div>
                    </div>
                </div>

                <div class="kanban-footer" onclick="openFloatingForm('{{ $status->task_status_id }}', this)">
                    + Adicionar Tarefa
                </div>
            </div>
        @endforeach
    </div>

    <!-- Dropdown: Responsável Task -->
    <div id="dropdown-global-responsavel" class="dropdown-kanban" style="display:none; position:absolute;">
        <input type="text" placeholder="Buscar responsável..." class="form-control mb-1">
        @foreach ($users as $user)
            <div class="dropdown-item" onclick="selectSubtaskResponsible('{{ $user->id }}', '{{ $user->name }}')">
                <div class="avatar">{{ strtoupper(substr($user->name, 0, 2)) }}</div>
                {{ $user->name }}
            </div>
        @endforeach
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

    <!-- Dropdown: Subtarefa -->
    <div id="dropdown-subtask" class="task-form" style="position:absolute; display:none; z-index:999;">
        <input type="hidden" id="subtask-status-id">
        <input type="hidden" id="subtask-responsible-id">

        <div style="display: flex; justify-content: space-between; align-items: center;">
            <input type="text" id="subtask-name" placeholder="Nome da subtarefa..." style="flex: 1;">
            <button class="save-btn" onclick="submitSubtask()">
                Salvar <i class="fa-solid fa-arrow-up-right-from-square"></i>
            </button>
        </div>

        <div class="form-line" onclick="toggleDropdown('dropdown-global-responsavel')">
            <div id="selected-subtask-users" class="selected-users">
                <div class="avatar dashed-icon" title="Adicionar responsável">+</div>
            </div>
        </div>

        <div class="form-line" onclick="toggleDropdown('subtask-data')">
            <i class="fa-regular fa-calendar-days"></i> Adicionar datas
        </div>
        <div id="subtask-data" class="dropdown">
            <input id="subtask-datepicker" placeholder="Data de vencimento" readonly>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/pt.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>

    <script>
        let activeTaskId = null;
        const apiUrl = '{{ url("/tasks-api") }}';
        const statuses = @json($statuses);
        const currentUserId = @json(auth()->id());

        document.querySelectorAll('input[id^="datepicker-"]').forEach(el => {
            flatpickr(el, {locale: flatpickr.l10ns.pt});
        });

        function toggleForm(id) {
            const form = document.getElementById(id);

            if (!form) return;
            form.style.display = form.style.display === 'flex' ? 'none' : 'flex';
        }

        function toggleDropdown(dropdownId, trigger) {
            closeAllDropdowns();

            const dropdown = document.getElementById(dropdownId);
            const dropdownResponsible = document.getElementById('dropdown-global-responsavel');

            if (!dropdown || !trigger) return;

            const rect = trigger.getBoundingClientRect();

            dropdown.style.top = `${rect.bottom + window.scrollY - 25}px`;
            dropdown.style.left = `${rect.left + window.scrollX - 75}px`;
            dropdown.style.display = 'block';

            dropdownResponsible.style.zIndex = '9999'; // com "I" maiúsculo
        }

        // Subtarefa - icon add on task
        function openSubtaskDropdown(taskId) {
            activeTaskId = taskId;

            const trigger = document.querySelector(`[data-task-id="${taskId}"] .fa-plus`).closest('button');
            const dropdown = document.getElementById('dropdown-subtask');

            const card = trigger.closest('.kanban-task-card');
            const rect = card.getBoundingClientRect();

            const top = rect.top + window.scrollY + 25;
            const left = rect.left + window.scrollX - 60;

            closeAllDropdowns();

            // seta o status atual no campo hidden
            document.getElementById('subtask-status-id').value = getTaskStatusId(taskId);
            document.getElementById('subtask-name').value = '';
            document.getElementById('subtask-datepicker').value = '';

            dropdown.style.top = `${top}px`;
            dropdown.style.left = `${left}px`;
            dropdown.style.display = 'flex';

            flatpickr("#subtask-datepicker", {
                locale: flatpickr.l10ns.pt
            });

            setTimeout(() => document.getElementById('subtask-name').focus(), 100);

            selectedResponsibles = [];
            document.getElementById('selected-subtask-users').innerHTML = '<div class="avatar dashed-icon" title="Adicionar responsável">+</div>';
            document.getElementById('subtask-responsible-id').value = '';
        }

        // Add subtasks
        async function submitSubtask() {
            const name = document.getElementById('subtask-name').value.trim();
            const dueDate = document.getElementById('subtask-datepicker').value;
            const responsible = document.getElementById('subtask-responsible-id').value;
            const statusId = document.getElementById('subtask-status-id').value;

            if (!name || !responsible) {
                alert('Preencha o nome da subtarefa e selecione o responsável.');
                return;
            }

            try {
                const res = await fetch(`/tasks-api/${activeTaskId}/subtasks`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        name,
                        due_date: dueDate,
                        responsible,
                        task_status_id: statusId
                    })
                });

                if (!res.ok) throw await res.json();

                closeAllDropdowns();
                console.log('Subtarefa criada com sucesso');
                // você pode chamar um loadSubtasks() ou exibir na interface
            } catch (err) {
                console.error('Erro ao salvar subtarefa:', err);
                alert('Erro ao salvar subtarefa.');
            }
        }

        // obter status da task atual
        function getTaskStatusId(taskId) {
            const taskCard = document.querySelector(`[data-task-id="${taskId}"]`);
            if (!taskCard) return null;

            const column = taskCard.closest('.kanban-column');
            return column?.dataset.statusId || null;
        }

        // get initials name
        function getInitials(name) {
            if (!name) return '?';
            const parts = name.trim().split(' ');
            return parts.length >= 2
                ? parts[0][0].toUpperCase() + parts[1][0].toUpperCase()
                : parts[0][0].toUpperCase();
        }

        let selectedResponsibles = [];


        // select responsible subtask dropdown
        function selectSubtaskResponsible(userId, userName) {
            if (selectedResponsibles.includes(userId)) return;

            selectedResponsibles.push(userId);

            const container = document.getElementById('selected-subtask-users');

            const avatar = document.createElement('div');
            avatar.className = 'avatar';
            avatar.innerText = getInitials(userName);
            avatar.setAttribute('data-user-id', userId);
            avatar.title = userName;

            container.insertBefore(avatar, container.querySelector('.dashed-icon'));

            // Armazena em campo hidden como JSON
            document.getElementById('subtask-responsible-id').value = JSON.stringify(selectedResponsibles);

            document.getElementById('dropdown-global-responsavel').style.display = 'none';
        }

        // select responsible task dropdown
        function selectResponsible(userId, userName) {
            if (selectedResponsibles.includes(userId)) return;

            selectedResponsibles.push(userId);

            const container = document.getElementById('selected-subtask-users');

            const avatar = document.createElement('div');

            avatar.className = 'avatar';
            avatar.innerText = getInitials(userName);
            avatar.setAttribute('data-user-id', userId);
            avatar.title = userName;

            container.insertBefore(avatar, container.querySelector('.dashed-icon'));

            // Atualiza o campo hidden com o primeiro responsável (ou com todos, se for array depois)
            document.getElementById('subtask-responsible-id').value = userId;

            // Fecha o dropdown após seleção
            document.getElementById('dropdown-global-responsavel').style.display = 'none';
        }

        // abrir dropdown responsible
        document.addEventListener('click', function (e) {
            const target = e.target.closest('.dashed-icon');
            if (target) {
                toggleDropdown('dropdown-global-responsavel', target);
            }
        });

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
                                            <button class="btn-icon" onclick="moveToNextStatus('${task.task_id}', '${task.task_status_id}')" data-bs-toggle="tooltip" data-bs-placement="top" title="Próximo status">
                                                <i class="fa-solid fa-arrow-right"></i>
                                            </button>
                                            <button class="btn-icon" onclick="openSubtaskDropdown('${task.task_id}', this)" data-bs-toggle="tooltip" data-bs-placement="top" title="Nova subtarefa">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                            <button class="btn-icon" onclick="editTask('${task.task_id}', this)" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar tarefa">
                                                <i class="fa-solid fa-pen"></i>
                                            </button>
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

        // Icon Chevron -> next status
        function moveToNextStatus(taskId, currentStatusId) {
            const index = statuses.findIndex(s => s.task_status_id === currentStatusId);
            if (index === -1 || index + 1 >= statuses.length) return;

            const nextStatusId = statuses[index + 1].task_status_id;

            const token = document.querySelector('meta[name="csrf-token"]').content;
            fetch(`/tasks-api/${taskId}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token },
                body: JSON.stringify({ task_status_id: nextStatusId })
            }).then(() => loadTasks());
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
            closeAllDropdowns();

            if (!dropdown || !trigger) return;

            const card = trigger.closest('.kanban-task-card'); // pega a tarefa

            if (!card) return;

            const cardRect = card.getBoundingClientRect();

            const top = cardRect.bottom + window.scrollY - 10;
            const left = cardRect.left + window.scrollX - 225;

            dropdown.style.top = `${top}px`;
            dropdown.style.left = `${left}px`;
            dropdown.style.display = 'block';
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

        function openFloatingForm(statusId, triggerElement) {
            closeAllDropdowns();

            const form = document.getElementById('floating-task-form');
            const statusInput = document.getElementById('floating-status-id');
            const taskInput = document.getElementById('floating-task-name');
            const dateInput = document.getElementById('floating-datepicker');

            // limpa campos
            taskInput.value = '';
            dateInput.value = '';
            statusInput.value = statusId;

            // encontrar a coluna onde o botão está
            const column = triggerElement.closest('.kanban-column');
            const columnRect = column.getBoundingClientRect();
            const formWidth = form.offsetWidth;

            // posiciona centralizado na coluna
            const top = columnRect.top + window.scrollY + 50;
            const left = columnRect.left + window.scrollX - 200;

            form.style.top = `${top}px`;
            form.style.left = `${left}px`;
            form.style.display = 'flex';

            // ativa flatpickr
            flatpickr("#floating-datepicker", {
                locale: flatpickr.l10ns.pt
            });
        }

        function submitFloatingForm() {
            const name = document.getElementById('floating-task-name').value.trim();
            const dueDate = document.getElementById('floating-datepicker').value || null;
            const statusId = document.getElementById('floating-status-id').value;

            if (!name) return alert("Nome da tarefa é obrigatório.");

            const payload = {
                task_status_id: statusId,
                name: name,
                due_date: dueDate,
                responsible: [{{ auth()->id() }}],
                priority: "medium"
            };

            request(`${apiUrl}`, {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(payload)
            }).then(() => {
                document.getElementById('floating-task-form').style.display = 'none';
                loadTasks();
            }).catch(err => {
                alert("Erro ao criar tarefa.");
                console.error(err);
            });
        }

        // Fecha o form se clicar fora
        document.addEventListener('click', function (e) {
            const form = document.getElementById('floating-task-form');
            if (!form.contains(e.target) && !e.target.closest('.kanban-footer')) {
                form.style.display = 'none';
            }
        });

        function closeAllDropdowns() {
            document.querySelectorAll('.dropdown').forEach(d => d.style.display = 'none');
            document.querySelectorAll('.dropdown-kanban').forEach(d => d.style.display = 'none');
            const floatingForm = document.getElementById('floating-task-form');
            if (floatingForm) floatingForm.style.display = 'none';
        }
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
