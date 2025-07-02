@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                <x-card-header title="Novo Funcionário" action="Cadastrar" />

                <x-form route="store">

                    <div class="row">
                        <div class="col-6">
                            <label for="department_id" class="form-control-label">Departamento</label>
                            <select name="department_id" id="department_id" class="form-control" required>
                                <option value="">Selecione um departamento</option>
                                @foreach ($companies as $company)
                                    <optgroup label="{{ $company->name }}">
                                        @foreach ($company->departments as $department)
                                            <option value="{{ $department->id }}"
                                                {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                                {{ $department->name }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <x-input col="4" set="" type="text" title="Funcionário" id="name"
                            name="name" value="{{ old('name') }}" placeholder="João Silva" />
                        <x-input col="4" set="" type="text" title="E-mail" id="email" name="email"
                            value="{{ old('email') }}" placeholder="ti@bongas.com.br" />
                        <x-select col="4" set="" title="Licença de e-mail" id="license_id" name="license_id">
                            @foreach ($licenses as $license)
                                <option value="{{ $license->id }}">{{ $license->name }}</option>
                            @endforeach
                        </x-select>
                    </div>

                    <div class="row mt-2">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="hierarchical_level" class="form-control-label">Nível Hierárquico</label>
                                <select class="form-control" id="hierarchical_level" name="hierarchical_level" required>
                                    @foreach (['Estagiário', 'Assistente', 'Analista', 'Supervisor', 'Coordenador', 'Gerente', 'Diretor'] as $level)
                                        <option value="{{ $level }}"
                                            {{ old('hierarchical_level') == $level ? 'selected' : '' }}>{{ $level }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <x-input col="6" set="" type="date" title="Contratado em" id="hired_in"
                            name="hired_in" value="{{ old('hired_in') }}" />
                        <x-input col="6" set="" type="date" title="Dispensado em" id="fired_in"
                            name="fired_in" value="{{ old('fired_in') }}" />
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="status" class="form-control-label">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Ativo</option>
                                    <option value="0" {{ old('status', 1) == 0 ? 'selected' : '' }}>Inativo</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <x-input col="6" set="" type="file" title="Foto" id="image" name="image"
                        value=""></x-input>

                    <x-input-check col="6" set="" title="Usuário é administrador?" id="is_admin"
                        name="is_admin" checked="" disabled=""></x-input>

                        <div class="row my-3" id="permissions-container">
                            @foreach ($permissions as $entity => $perms)
                                <div class="col-4">
                                    <div class="mb-3 border rounded p-3">
                                        <strong>Permissões de {{ ucfirst($entity) }}</strong>
                                        <div class="form-check">
                                            <input class="form-check-input select-all" type="checkbox"
                                                data-entity="{{ $entity }}" id="all-{{ $entity }}">
                                            <label class="form-check-label" for="all-{{ $entity }}">All</label>
                                        </div>

                                        @foreach ($perms as $permission)
                                            <div class="form-check ms-3">
                                                <input class="form-check-input perm-{{ $entity }}" type="checkbox"
                                                    name="permissions[]" value="{{ $permission->name }}"
                                                    id="{{ $permission->name }}">
                                                <label class="form-check-label"
                                                    for="{{ $permission->name }}">{{ ucfirst(explode(' ', $permission->name)[0]) }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                </x-form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const isAdminCheckbox = document.getElementById('is_admin');
            const permissionsContainer = document.getElementById('permissions-container');

            function togglePermissionsVisibility() {
                if (isAdminCheckbox.checked) {
                    permissionsContainer.style.display = 'none';
                    // Limpa todos os checkboxes de permissão
                    permissionsContainer.querySelectorAll('input[type="checkbox"]').forEach(cb => {
                        cb.checked = false;
                    });
                } else {
                    permissionsContainer.style.display = 'flex';
                }
            }

            // Executa na carga
            togglePermissionsVisibility();

            // Executa ao mudar o checkbox is_admin
            isAdminCheckbox.addEventListener('change', togglePermissionsVisibility);

            // Lógica dos checkboxes "All"
            document.querySelectorAll('.select-all').forEach(allCheckbox => {
                allCheckbox.addEventListener('change', function() {
                    const entity = this.dataset.entity;
                    document.querySelectorAll('.perm-' + entity).forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                });
            });
        });
    </script>
@endsection
