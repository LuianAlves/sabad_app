@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                <x-card-header title="Novo usuário" action="cadastrar"></x-card-header>

                <x-form route="store">
                    <div class="row">
                        <x-input col="6" set="" type="text" title="Nome do usuário" id="name"
                                 name="name" value="" placeholder="John Doe" disabled=""></x-input>
                        <x-input col="6" set="" type="email" title="E-mail" id="email" name="email"
                                 value="" placeholder="john@email.com" disabled=""></x-input>
                    </div>
                    <div class="row">
                        <x-input col="6" set="" type="password" title="Senha" id="password" name="password"
                                 value="" placeholder="*******" disabled=""></x-input>
                        <x-input col="6" set="" type="password" title="Confirmar senha" id="password"
                                 name="password" value="" placeholder="*******" disabled=""></x-input>
                    </div>
                    <div class="row">
                        <x-input-check col="6" set="" title="Usuário é administrador?" id="is_admin"
                                       name="is_admin" checked="" disabled=""></x-input-check>
                        <x-input-check col="6" set="" title="Iniciar ativo?" id="is_active"
                                       name="is_active" checked="" disabled=""></x-input-check>
                    </div>

                    <div class="row my-3" id="permissions-container">
                        @foreach($groupedPermissions as $entity => $group)
                            <div class="col-4 mb-3">
                                <div class="card h-100" style="border: 1px solid rgba(206,206,206,0.36);">
                                    <div class="card-header">
                                        <div class="form-check form-switch p-0"
                                             style="display: flex !important; justify-content: space-between !important; width: 100% !important;">
                                            <label class="form-check-label" for="checkAll-{{ $entity }}">
                                                <b>{{ ucfirst($entity) }}</b>
                                            </label>
                                            <input type="checkbox" class="form-check-input checkAllGroup"
                                                   data-group="{{ $entity }}" id="checkAll-{{ $entity }}">
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        @foreach($group as $permission)
                                            <div class="form-check form-switch">
                                                <input class="form-check-input check-permission {{ $entity }}"
                                                       type="checkbox" name="permissions[]"
                                                       value="{{ $permission->id }}"
                                                       id="perm-{{ $permission->id }}">
                                                <label class="form-check-label" for="perm-{{ $permission->id }}">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-form>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
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
                allCheckbox.addEventListener('change', function () {
                    const entity = this.dataset.entity;
                    document.querySelectorAll('.perm-' + entity).forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                });
            });
        });
    </script>
@endsection
