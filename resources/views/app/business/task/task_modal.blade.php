<div id="taskModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white p-6 rounded shadow-lg w-full max-w-lg">
        <h2 id="modalTitle" class="text-xl font-semibold mb-4">Nova Tarefa</h2>
        <form id="taskForm">
            @csrf
            <input type="hidden" id="task_id" name="task_id" />

            <div class="mb-4">
                <label for="order" class="block text-gray-700">Ordem</label>
                <input type="number" id="order" name="order" class="w-full border px-3 py-2 rounded" value="0" required>
            </div>

            <div class="mb-4">
                <label for="name" class="block text-gray-700">Nome</label>
                <input type="text" id="name" name="name" class="w-full border px-3 py-2 rounded" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700">Descrição</label>
                <textarea id="description" name="description" class="w-full border px-3 py-2 rounded"></textarea>
            </div>

            <div class="mb-4">
                <label for="due_date" class="block text-gray-700">Data de Venc.</label>
                <input type="date" id="due_date" name="due_date" class="w-full border px-3 py-2 rounded">
            </div>

            <div class="mb-4">
                <label for="priority" class="block text-gray-700">Prioridade</label>
                <select id="priority" name="priority" class="w-full border px-3 py-2 rounded">
                    <option value="low">Baixa</option>
                    <option value="medium" selected>Média</option>
                    <option value="high">Alta</option>
                    <option value="important">Urgente</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="task_status_id" class="block text-gray-700">Status</label>
                <select id="task_status_id" name="task_status_id" class="w-full border px-3 py-2 rounded" required></select>
            </div>

            <div class="mb-4">
                <label for="responsible" class="block text-gray-700">Responsáveis</label>
                <select id="responsible" name="responsible[]" class="w-full border px-3 py-2 rounded" multiple required></select>
            </div>

            <div id="subtasksSection" class="mb-4">
                <h3 class="text-gray-700 mb-2">Subtarefas</h3>
                <ul id="subtasksList" class="list-disc list-inside mb-2"></ul>

                <button type="button" id="btnNewSubtask" class="px-2 py-1 bg-blue-500 text-white rounded">+ Subtarefa</button>
            </div>

            <div class="mb-4">
                <h3 class="text-gray-700 mb-2">Anexos</h3>
                <ul id="docsList" class="list-disc list-inside mb-2"></ul>
                <input type="file" id="docFile" class="mb-2">
                <button type="button" id="btnUploadDoc" class="px-2 py-1 bg-blue-500 text-white rounded">Enviar Anexo</button>
            </div>

            <div class="mb-4">
                <h3>Compartilhar</h3>
                <select id="share_user" class="border px-2 py-1">
                    @foreach(\App\Models\User::all() as $u)
                        <option value="{{$u->id}}">{{$u->name}}</option>
                    @endforeach
                </select>
                <select id="share_role" class="border px-2 py-1">
                    <option value="reader">Leitor</option>
                    <option value="editor">Editor</option>
                    <option value="owner">Owner</option>
                </select>
                <button id="btnShare" class="px-3 py-1 bg-purple-600 text-white">Compartilhar</button>
            </div>

            <div class="flex justify-end">
                <button type="button" id="btnCancelTask" class="px-4 py-2 mr-2">Cancelar</button>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Salvar</button>
            </div>
        </form>
    </div>
</div>

@include('app.business.task.task_subtask_modal')
