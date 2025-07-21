@extends('layouts.templates.app-layout')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4">
                <x-card-header title="Criar Novo Perfil" count="" action=""></x-card-header>

                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf

                    <div class="card-body">
                        <div class="row mb-3">
                            <x-input col="4" set="" type="text" title="Nome do perfil" id="name" name="name" placeholder="Ex.: ADMIN, USER, TI" require="1"></x-input>
                        </div>

                        <div class="row mb-3">
                            <div class="col-4">
                                <div class="form-check form-switch p-0">
                                    <label class="form-check-label" for="checkAllGlobal">
                                        <b>Selecionar todas as permissões</b>
                                    </label>
                                    <input class="form-check-input mx-1" type="checkbox" id="checkAllGlobal">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            @php
                                $groupedPermissions = $permissions->groupBy(function ($permission) {
                                    $parts = explode(' ', $permission->name);
                                    $knownActions = ['view', 'create', 'edit', 'delete'];
                                    return in_array($parts[0], $knownActions)
                                        ? implode(' ', array_slice($parts, 1))
                                        : $permission->name;
                                });
                            @endphp

                            @foreach($groupedPermissions as $entity => $group)
                                <div class="col-3 mb-3">
                                    <div class="card h-100" style="border: 1px solid rgba(206,206,206,0.36);">
                                        <div class="card-header">
                                            <div class="form-check form-switch d-flex justify-content-between p-0">
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
                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Salvar Perfil</button>
                        <a href="{{ route('roles.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const globalCheck = document.getElementById('checkAllGlobal');

        // Check all global
        globalCheck.addEventListener('change', function () {
            const isChecked = this.checked;
            document.querySelectorAll('.check-permission').forEach(c => c.checked = isChecked);
            document.querySelectorAll('.checkAllGroup').forEach(groupCheckbox => {
                groupCheckbox.checked = isChecked;
            });
        });

        // Check all per group
        document.querySelectorAll('.checkAllGroup').forEach(groupCheckbox => {
            groupCheckbox.addEventListener('change', function () {
                const group = this.dataset.group;
                const isChecked = this.checked;
                document.querySelectorAll('.' + group).forEach(c => c.checked = isChecked);

                // Atualiza o global check se todos os grupos estiverem marcados
                const allGroupsChecked = Array.from(document.querySelectorAll('.checkAllGroup')).every(c => c.checked);
                globalCheck.checked = allGroupsChecked;
            });
        });

        // Quando uma perm individual muda, atualiza check de grupo e global
        document.querySelectorAll('.check-permission').forEach(permissionCheckbox => {
            permissionCheckbox.addEventListener('change', function () {
                const group = Array.from(this.classList).find(cls =>
                    cls !== 'form-check-input' && cls !== 'check-permission'
                );

                // Atualiza checkAllGroup do grupo
                const groupChecks = document.querySelectorAll('.' + group);
                const groupAllChecked = Array.from(groupChecks).every(c => c.checked);
                document.querySelector('#checkAll-' + group).checked = groupAllChecked;

                // Atualiza checkAllGlobal
                const allChecks = document.querySelectorAll('.check-permission');
                const allChecked = Array.from(allChecks).every(c => c.checked);
                globalCheck.checked = allChecked;
            });
        });
    });

</script>

