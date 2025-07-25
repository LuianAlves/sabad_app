@extends('layouts.templates.app-layout')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold mb-4">Gerenciar Tarefas</h1>
        <button id="btnNewTask" class="px-4 py-2 bg-blue-600 text-white rounded mb-4">Nova Tarefa</button>

        <table class="min-w-full bg-white shadow rounded" id="tasksTable">
            <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">Ordem</th>
                <th class="px-4 py-2">name</th>
                <th class="px-4 py-2">Descrição</th>
                <th class="px-4 py-2">Vencimento</th>
                <th class="px-4 py-2">Prioridade</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Responsáveis</th>
                <th class="px-4 py-2">Ações</th>
            </tr>
            </thead>
            <tbody id="tasksTableBody"></tbody>
        </table>
    </div>

    @include('app.business.task.task_modal')
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
<script>
    async function request(url, options = {}) {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        options.headers = {
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json',
            ...options.headers
        };
        const response = await fetch(url, options);
        if (!response.ok) throw response;
        return response.json();
    }

    document.addEventListener('DOMContentLoaded', () => {
        const apiUrl = '{{ url("/tasks-api") }}';
        const statuses = @json($statuses);
        const users = @json($users);
        const tbody = document.getElementById('tasksTableBody');
        const modal = document.getElementById('taskModal');
        const form = document.getElementById('taskForm');

        // Drag & drop
        Sortable.create(tbody, {
            handle: '.drag-handle',
            onEnd: async () => {
                const orderData = Array.from(tbody.children).map((row, index) => ({
                    id: row.dataset.id,
                    order: index
                }));
                await request(`${apiUrl}/reorder`, {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({order: orderData})
                });
            }
        });

        function populate() {
            const statusSelect = document.getElementById('task_status_id');

            statusSelect.innerHTML = '<option value="">Selecione status</option>';
            statuses.forEach(s => statusSelect.insertAdjacentHTML('beforeend', `<option value="${s.task_status_id}">${s.name}</option>`));

            const usersSelect = document.getElementById('responsible');

            usersSelect.innerHTML = '';
            users.forEach(u => usersSelect.insertAdjacentHTML('beforeend', `<option value="${u.id}">${u.name}</option>`));
        }

        request(apiUrl).then(tasks => tasks.forEach(renderRow));

        document.getElementById('btnNewTask').onclick = () => {
            form.reset();
            document.getElementById('task_id').value = '';
            document.getElementById('order').value = 0;
            populate();
            document.getElementById('modalTitle').innerText = 'Nova Tarefa';

            loadSubtasks(taskId)

            modal.classList.remove('hidden');
        };
        document.getElementById('btnCancelTask').onclick = () => modal.classList.add('hidden');

        form.onsubmit = async e => {
            e.preventDefault();
            const id = document.getElementById('task_id').value;
            const data = new FormData(form);
            if (id) await request(`${apiUrl}/${id}`, {method: 'PUT', body: data});
            else await request(apiUrl, {method: 'POST', body: data});
            window.location.reload();
        };

        function renderRow(task) {
            const names = task.responsible.map(id => users.find(u => u.id === id)?.name || id).join(', ');
            const tr = document.createElement('tr');
            tr.dataset.id = task.task_id;
            tr.innerHTML = `
            <td class="border px-4 py-2 drag-handle cursor-move">${task.order}</td>
            <td class="border px-4 py-2">${task.name}</td>
            <td class="border px-4 py-2">${task.description || ''}</td>
            <td class="border px-4 py-2">${task.due_date || ''}</td>
            <td class="border px-4 py-2">${task.priority}</td>
            <td class="border px-4 py-2">${task.status.name}</td>
            <td class="border px-4 py-2">${names}</td>
            <td class="border px-4 py-2">
                <button onclick="editTask('${task.task_id}')" class="text-blue-600 mr-2">Editar</button>
                <button onclick="deleteTask('${task.task_id}')" class="text-red-600">Excluir</button>
            </td>
        `;
            tbody.appendChild(tr);
        }

        window.editTask = async id => {
            const t = await request(`${apiUrl}/${id}`);

            document.getElementById('task_id').value = t.task_id;
            document.getElementById('order').value = t.order;
            document.getElementById('name').value = t.name;
            document.getElementById('description').value = t.description;
            document.getElementById('due_date').value = t.due_date;
            document.getElementById('priority').value = t.priority;
            populate();
            document.getElementById('task_status_id').value = t.task_status_id;
            Array.from(document.getElementById('responsible').options).forEach(o => o.selected = t.responsible.includes(parseInt(o.value)));
            document.getElementById('modalTitle').innerText = 'Editar Tarefa';

            loadSubtasks(id);
            loadDocs(id);

            modal.classList.remove('hidden');
        };

        window.deleteTask = async id => {
            if (!confirm('Deseja excluir?')) return;
            await request(`${apiUrl}/${id}`, {method: 'DELETE'});
            window.location.reload();
        };

        let currentTaskId;
        const subtasksList = document.getElementById('subtasksList');
        const subtaskForm = document.getElementById('subtaskForm');
        const subtaskModal = document.getElementById('subtaskModal');
        const subtaskTitle = document.getElementById('subtaskModalTitle');

        btnNewSubtask.onclick = () => {
            subtaskForm.reset();
            subtaskTitle.innerText = 'Nova Subtarefa';
            subtaskModal.classList.remove('hidden');
        };
        btnCancelSubtask.onclick = () => subtaskModal.classList.add('hidden');

        async function loadSubtasks(taskId) {
            currentTaskId = taskId;
            subtasksList.innerHTML = '';
            const list = await request(`${apiUrl}/${taskId}/subtasks`);
            list.forEach(st => {
                const li = document.createElement('li');
                li.textContent = st.nome;
                const btnDel = document.createElement('button');
                btnDel.textContent = '✕';
                btnDel.className = 'ml-2 text-red-600';
                btnDel.onclick = async () => {
                    await request(`${apiUrl}/${taskId}/subtasks/${st.subtask_id}`, {method: 'DELETE'});
                    loadSubtasks(taskId);
                };
                li.appendChild(btnDel);
                subtasksList.appendChild(li);
            });
        }

        subtaskForm.onsubmit = async e => {
            e.preventDefault();
            const data = new FormData(subtaskForm);
            await request(`${apiUrl}/${currentTaskId}/subtasks`, {method: 'POST', body: data});
            subtaskModal.classList.add('hidden');
            loadSubtasks(currentTaskId);
        };

        const docsList     = document.getElementById('docsList');
        const docFileInput = document.getElementById('docFile');
        const btnUploadDoc = document.getElementById('btnUploadDoc');
        let activeTaskId;

        async function loadDocs(taskId) {
            docsList.innerHTML='';
            const docs = await request(`/tasks-api/${taskId}/documents`);
            docs.forEach(d => {
                const li = document.createElement('li');
                li.innerHTML = `<a href="${d.url}" target="_blank">${d.nome_arquivo}</a>
                        <button data-id="${d.documento_id}" class="ml-2 text-red-600 doc-delete">✕</button>`;
                docsList.appendChild(li);
            });
            document.querySelectorAll('.doc-delete').forEach(btn => btn.onclick = async () => {
                const id = btn.dataset.id;
                await request(`/documents/${id}`,{method:'DELETE'});
                loadDocs(activeTaskId);
            });
        }

        btnUploadDoc.onclick = async () => {
            if (!docFileInput.files.length) return;
            const form = new FormData();
            form.append('file', docFileInput.files[0]);
            await request(`/tasks-api/${activeTaskId}/documents`, { method: 'POST', body: form });
            docFileInput.value='';
            loadDocs(activeTaskId);
        };

        btnShare.onclick = async () => {
            const userId = document.getElementById('share_user').value;
            const role   = document.getElementById('share_role').value;
            await fetch(`/tasks/${activeTaskId}/share`,{
                method:'POST',
                headers:{'X-CSRF-TOKEN':CSRF,'Content-Type':'application/json'},
                body:JSON.stringify({user_id:userId,role})
            });

            alert('Compartilhado!');
        };

        populate();
    });
</script>
