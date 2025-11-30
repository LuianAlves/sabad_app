@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">
                <x-card-header
                    title="Permissões cadastradas"
                    count="{{ $permissions->count() }}"
                    action="novo"
                ></x-card-header>

                <div class="row m-3">
                    @foreach($groupedPermissions as $entity => $group)
                        <div class="col-4 mb-3">
                            <div class="card bg-gradient-default" style="border: 1px solid rgba(206,206,206,0.36);">
                                <div class="card-body">
                                    <h6 class="card-title text-info text-gradient">
                                        {{ strtoupper($entity) }}
                                    </h6>

                                    <blockquote class="blockquote text-white mb-0">
                                        <p class="text-dark ms-3" style="font-size: 13.5px;">
                                            Existe(m) <b>{{ $group->count() }}</b> permissão(ões) para este recurso.
                                        </p>

                                        <div class="mt-3 ms-3" style="font-size: 13px;">
                                            @foreach($group as $permission)
                                                <div class="mb-2 pb-2" style="border-bottom: 1px solid rgba(0,0,0,0.05);">
                                                    <span class="d-block text-uppercase text-muted">
                                                        {{ $permission->name }}
                                                    </span>

                                                    @if($permission->roles)
                                                        <small class="text-muted">
                                                            Usada em <b>{{ $permission->roles->count() }}</b> perfil(is).
                                                        </small>
                                                    @endif

                                                    <div class="mt-1 d-flex justify-content-start align-items-center">
                                                        <a href="{{ route('permissions.edit', $permission) }}" class="text-gradient text-info mx-2">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>

                                                        <button type="submit"
                                                                form="delete-permission-{{ $permission->id }}"
                                                                class="btn btn-link text-danger p-0 m-0"
                                                                onclick="return confirm('Tem certeza que deseja excluir esta permissão?')">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </blockquote>
                                </div>
                            </div>
                        </div>

                        {{-- forms de delete das permissões desse grupo --}}
                        @foreach($group as $permission)
                            <form id="delete-permission-{{ $permission->id }}"
                                  action="{{ route('permissions.destroy', $permission) }}"
                                  method="POST"
                                  style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        @endforeach
                    @endforeach
                </div>

            </div>
        </div>
    </div>
@endsection
