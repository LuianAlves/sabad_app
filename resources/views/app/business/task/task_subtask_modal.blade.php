<div id="subtaskModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white p-6 rounded shadow-lg w-full max-w-md">
        <h2 id="subtaskModalTitle" class="text-xl font-semibold mb-4">Nova Subtarefa</h2>
        <form id="subtaskForm">
            @csrf

            <input type="hidden" id="subtask_id" name="subtask_id" />

            <div class="mb-4">
                <label for="sub_name" class="block text-gray-700">Nome</label>
                <input type="text" id="sub_name" name="name" class="w-full border px-3 py-2 rounded" required>
            </div>

            <div class="mb-4">
                <label for="sub_responsible" class="block text-gray-700">Responsável</label>
                <select id="sub_responsible" name="responsible" class="w-full border px-3 py-2 rounded">
                    <option value="">Selecione</option>
                    @foreach($users as $u)
                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="sub_due_date" class="block text-gray-700">Data de Venc.</label>
                <input type="date" id="sub_due_date" name="due_date" class="w-full border px-3 py-2 rounded">
            </div>

            <div class="mb-4">
                <label for="sub_task_status_id" class="block text-gray-700">Status</label>
                <select id="sub_task_status_id" name="task_status_id" class="w-full border px-3 py-2 rounded">
                    <option value="">Selecione</option>
                    @foreach($statuses as $s)
                        <option value="{{ $s->task_status_id }}">{{ $s->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end">
                <button type="button" id="btnCancelSubtask" class="px-4 py-2 mr-2">Cancelar</button>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Salvar</button>
            </div>
        </form>
    </div>
</div>
