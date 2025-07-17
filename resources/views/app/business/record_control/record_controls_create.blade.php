<form method="POST" action="{{ route('record_controls.store', $department) }}">
    @csrf
    <label>Funcionário</label>
    <select name="employee_id" class="form-control mb-2">
        @foreach($employees as $e)
            <option value="{{ $e->id }}">{{ $e->name }}</option>
        @endforeach
    </select>

    <input name="identificacao" class="form-control mb-2" placeholder="Identificação do Registro" required>
    <input name="forma_armazenamento" class="form-control mb-2" placeholder="Forma de Armazenamento" required>
    <input name="local_armazenamento" class="form-control mb-2" placeholder="Local de Armazenamento" required>
    <input name="acesso_permitido" class="form-control mb-2" placeholder="Acesso Permitido" required>
    <input name="tempo_retencao" class="form-control mb-2" placeholder="Tempo de Retenção" required>
    <input name="metodo_manutencao" class="form-control mb-2" placeholder="Método de Manutenção" required>

    <button class="btn btn-success">Salvar</button>
</form>
