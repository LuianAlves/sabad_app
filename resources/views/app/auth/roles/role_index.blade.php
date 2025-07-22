@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">
                <x-card-header title="Perfis cadastrados" count="{{ $roles->count() }}" action="novo"></x-card-header>

                <div class="row m-3">
                    @foreach($roles as $role)
                        <div class="col-4 mb-3">
                            <div class="card bg-gradient-default" style="border: 1px solid rgba(206,206,206,0.36);">
                                <div class="card-body">
                                    <h6 class="card-title text-info text-gradient">{{ strtoupper($role->name) }}</h6>
                                    <blockquote class="blockquote text-white mb-0">
                                        <p class="text-dark ms-3" style="font-size: 13.5px;">
                                            Existem <b>{{ $role->users ? $role->users->count() : 0 }}</b> usuários com esse perfil no
                                            sistema.
                                        </p>
                                        <footer class="blockquote-footer text-muted text-sm ms-3 mt-3">
                                            Visualizar permissões
                                            <a href="#" class="text-gradient text-info" data-bs-toggle="modal"
                                               data-bs-target="#modal-{{ $role->id }}">
                                                <i class="fa-solid fa-up-right-from-square mx-2"></i>
                                            </a>
                                        </footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @foreach($roles as $role)
                    <form action="{{ route('roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Modal -->
                        <div class="modal fade" id="modal-{{ $role->id }}" role="dialog" tabindex="-1" aria-labelledby="modalLabel-{{ $role->id }}" aria-hidden="true" style="z-index: 9999 !important;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel-{{ $role->id }}">Permissões
                                            de {{ strtoupper($role->name) }}</h5>
                                        <a href="#" type="button" class="" data-bs-dismiss="modal" aria-label="Fechar">
                                            <i class="fa-solid fa-xmark text-dark fs-5"></i>
                                        </a>
                                    </div>

                                    <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">

                                        <div class="row mb-3 mx-4">
                                            <div class="form-check form-switch d-flex justify-content-between p-0">
                                                <label class="form-check-label" for="checkAllGlobal">
                                                    <b>Selecionar todas as permissões</b>
                                                </label>
                                                <input class="form-check-input mx-1" type="checkbox"
                                                       id="checkAllGlobal" {{ $role->permissions->count() === $groupedPermissions->flatten()->count() ? 'checked' : '' }}>
                                            </div>
                                        </div>

                                        <div class="container-fluid">
                                            <div class="row">
                                                @foreach($groupedPermissions as $entity => $permissions)
                                                    <div class="col-6 mb-3">
                                                        <div class="card h-100"
                                                             style="border: 1px solid rgba(206,206,206,0.36);">
                                                            <div class="card-header">
                                                                <div
                                                                    class="form-check form-switch d-flex justify-content-between p-0">
                                                                    <label class="form-check-label"
                                                                           for="checkAll-{{ $entity }}"><b>{{ ucfirst($entity) }}</b></label>
                                                                    <input type="checkbox"
                                                                           class="form-check-input checkAllGroup"
                                                                           data-group="{{ $entity }}"
                                                                           id="checkAll-{{ $entity }}" {{ $role->permissions->pluck('id')->intersect($permissions->pluck('id'))->count() === $permissions->count() ? 'checked' : '' }}>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                @foreach($permissions as $permission)
                                                                    <div class="form-check form-switch">
                                                                        <input
                                                                            class="form-check-input check-permission {{ $entity }}"
                                                                            type="checkbox"
                                                                            name="permissions[]"
                                                                            value="{{ $permission->id }}"
                                                                            id="perm-{{ $permission->id }}"
                                                                            {{ $role->permissions->contains('id', $permission->id) ? 'checked' : '' }}>
                                                                        <label class="form-check-label"
                                                                               for="perm-{{ $permission->id }}">
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

                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-sm btn-warning">Salvar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                @endforeach

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

