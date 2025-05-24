@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                {{-- 
                
                Esse componente aqui é o cabeçalho da página: <x-card-header></x-card-header>

                o "action" aceita os valores: 'cadastrar' e 'atualizar'
                
                Como essa view é a de create (usamos a rota de store) a gente usa o cadastrar.

                na view de edit a gente colocaria action="atualizar"

                OK

                vou fazer a view de user_edit agora
                Quer ver?

                sim sim vamos lá
                
                --}}
                <x-card-header title="Novo usuário" action="cadastrar"></x-card-header>

                <!-- como a route é STORE, não precisa do id -->
                <!-- Se a route for update, precisa enviar o :id junto -->
                <!-- view create: não precisa do id -->
                <!-- view edit:  precisa do id -->
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
                            name="is_admin" checked="" disabled=""></x-input>
                            <x-input-check col="6" set="" title="Iniciar ativo?" id="is_active"
                                name="is_active" checked="" disabled=""></x-input>
                    </div>

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
