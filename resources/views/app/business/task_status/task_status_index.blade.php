<!-- resources/views/task-statuses/index.blade.php -->
@extends('layouts.templates.app-layout')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold mb-4">Gerenciar Status de Tarefas</h1>
        <button id="btnNewStatus" class="px-4 py-2 bg-blue-600 text-white rounded mb-4">Novo Status</button>

        <table class="min-w-full bg-white shadow rounded">
            <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">Ordem</th>
                <th class="px-4 py-2">Nome</th>
                <th class="px-4 py-2">Cor</th>
                <th class="px-4 py-2">Ações</th>
            </tr>
            </thead>
            <tbody id="statusesTableBody" class="cursor-move">
            </tbody>
        </table>
    </div>

    @include('app.business.task_status.task_status_modal')
@endsection

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    // Helper para requests usando Fetch API
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
        const apiUrl = '{{ url("/task-status-api") }}';
        const tableBody = document.getElementById('statusesTableBody');
        const modal      = document.getElementById('statusModal');
        const form       = document.getElementById('statusForm');

        // Carrega todos os status
        request(apiUrl).then(data => data.forEach(renderStatusRow));

        // Abrir modal para novo status
        document.getElementById('btnNewStatus').addEventListener('click', () => {
            form.reset();
            document.getElementById('task_status_id').value = '';
            document.getElementById('modalTitle').innerText = 'Novo Status';
            modal.classList.remove('hidden');
        });

        // Cancelar
        document.getElementById('btnCancel').addEventListener('click', () => {
            modal.classList.add('hidden');
        });

        // Salvar (criar ou atualizar)
        form.addEventListener('submit', async e => {
            e.preventDefault();
            const id = document.getElementById('task_status_id').value;
            const formData = new FormData(form);
            try {
                if (id) {
                    await request(`${apiUrl}/${id}`, { method: 'PUT', body: formData });
                } else {
                    await request(apiUrl, { method: 'POST', body: formData });
                }
                window.location.reload();
            } catch (err) {
                console.error('Erro na requisição:', err);
            }
        });
    });

    function renderStatusRow(status) {
        const tr = document.createElement('tr');
        tr.dataset.id = status.task_status_id; // <- NECESSÁRIO para drag
        tr.classList.add('draggable-row');     // opcional para visual
        tr.innerHTML = `
        <td class="border px-4 py-2">${status.order}</td>
        <td class="border px-4 py-2">${status.name}</td>
        <td class="border px-4 py-2">
            <span style="background:${status.color};" class="px-2 py-1 rounded text-white">${status.color}</span>
        </td>
        <td class="border px-4 py-2">
            <button onclick="editStatus('${status.task_status_id}')" class="text-blue-600 mr-2">Editar</button>
            <button onclick="deleteStatus('${status.task_status_id}')" class="text-red-600">Excluir</button>
        </td>
    `;
        document.getElementById('statusesTableBody').appendChild(tr);
    }

    async function editStatus(id) {
        try {
            const data = await request(`/task-status-api/${id}`);
            document.getElementById('task_status_id').value = data.task_status_id;
            document.getElementById('name').value      = data.name;
            document.getElementById('order').value     = data.order;
            document.getElementById('color').value     = data.color;
            document.getElementById('modalTitle').innerText = 'Editar Status';
            document.getElementById('statusModal').classList.remove('hidden');
        } catch (err) {
            console.error('Erro ao buscar status:', err);
        }
    }

    async function deleteStatus(id) {
        if (!confirm('Deseja mesmo excluir este status?')) return;
        try {
            await fetch(`/task-status-api/${id}`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') }});
            window.location.reload();
        } catch (err) {
            console.error('Erro ao excluir status:', err);
        }
    }

    function enviarNovaOrdemStatus(statusIds) {
        fetch('/task-status/reorder', {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ statuses: statusIds })
        })
            .then(res => res.json())
            .then(data => console.log('Ordem atualizada:', data.message))
            .catch(err => console.error('Erro ao reordenar:', err));
    }

    document.addEventListener('DOMContentLoaded', () => {
        new Sortable(document.getElementById('statusesTableBody'), {
            animation: 150,
            onEnd: () => {
                const novaOrdem = Array.from(document.querySelectorAll('#statusesTableBody tr')).map(el => el.dataset.id);
                enviarNovaOrdemStatus(novaOrdem);
            }
        });
    });
</script>
