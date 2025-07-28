<div id="statusModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white p-6 rounded shadow-lg w-full max-w-md">
        <h2 id="modalTitle" class="text-xl font-semibold mb-4">Novo Status</h2>
        <form id="statusForm">
            @csrf
            <input type="hidden" id="task_status_id" name="task_status_id"/>
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Nome</label>
                <input type="text" id="name" name="name" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div class="mb-4">
                <label for="color" class="block text-gray-700">Cor (hex)</label>
                <input type="color" id="color" name="color" class="w-full border px-3 py-2 rounded" value="#CCCCCC"
                       required>
            </div>
            <div class="flex justify-end">
                <button type="button" id="btnCancel" class="px-4 py-2 mr-2">Cancelar</button>
                <button type="submit" id="btnSave" class="px-4 py-2 bg-green-600 text-white rounded">Salvar</button>
            </div>
        </form>
    </div>
</div>
