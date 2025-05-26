@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-crud border shadow-xs mb-4">
                <x-card-header title="Usuários cadastrados" count="{{ $users->count() }}" action="novo"></x-card-header>

                <x-table>
                    <x-slot name="thead">
                        <tr>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7" style="padding-left: 35px;">Usuário</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Departamento</th>
                            <th class="text-secondary text-center text-xs font-weight-semibold opacity-7">Permissão</th>
                            <th class="text-secondary text-center text-xs font-weight-semibold opacity-7">Status</th>
                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7"></th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($users as $user)
                            <tr>
                                <td style="padding-left: 35px;">
                                    <div class="d-flex py-1">
                                        <div class="d-flex align-items-center">
                                            @if ($user->image)
                                                <img src="{{ 'data:image/png;base64,' . $user->image }}"
                                                    class="avatar avatar-sm rounded-circle me-2" alt="{{ $user->name }}">
                                            @else
                                                <img src="{{ asset('img/profile/image_profile.webp') }}"
                                                    class="avatar avatar-sm rounded-circle me-2" alt="Usuário sem imagem">
                                            @endif
                                        </div>
                                        <div class="d-flex flex-column justify-content-center ms-1">
                                            <h6 class="mb-0 text-sm font-weight-semibold">{{ $user->name }}</h6>
                                            <p class="text-sm text-secondary mb-0">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    @if (isset($user->employeeUser->employee))
                                        <p class="text-sm text-dark font-weight-semibold mb-0">
                                            {{ $user->employeeUser->employee->department->name }}
                                        </p>
                                        <p class="text-sm text-secondary mb-0">
                                            {{ Str::words($user->employeeUser->employee->department->company->name, 2, ' ..') }}
                                        </p>
                                    @else
                                        <p class="text-sm text-dark font-weight-semibold mb-0">
                                            Não informado
                                        </p>
                                        <p class="text-sm text-secondary mb-0">
                                            Não informado
                                        </p>
                                    @endif
                                </td>

                                <td class="align-middle text-center text-sm">
                                    @if ($user->is_active == 1)
                                        <span class="badge badge-sm border border-success text-success bg-success">
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                            Ativo
                                        </span>
                                    @else
                                        <span class="badge badge-sm border border-danger text-danger bg-danger">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                            Inativo
                                        </span>
                                    @endif
                                </td>
                                <td class="align-middle text-center">
                                    @if ($user->roles->count())
                                        <span
                                            class="badge badge-sm border border-info text-info bg-info">{{ $user->roles->pluck('name')->join(', ') }}</span>

                                        <!-- Botão para abrir o modal -->
                                        <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#permissionsModal{{ $user->id }}"
                                            class="ms-2 text-info text-sm" data-bs-toggle="tooltip"
                                            data-bs-title="Visualizar permissões">
                                            <span>
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </span>
                                        </a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="permissionsModal{{ $user->id }}" tabindex="-1"
                                            aria-labelledby="permissionsModalLabel{{ $user->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="permissionsModalLabel{{ $user->id }}">Permissões de
                                                            {{ $user->name }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Fechar"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <ul style="list-style: none;">
                                                            @forelse ($user->getAllPermissions() as $permission)
                                                                <li>{{ $permission->name }}</li>
                                                            @empty
                                                                <li>Nenhuma permissão atribuída.</li>
                                                            @endforelse
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-muted">Sem permissão</span>
                                    @endif
                                </td>
                                <td>
                                    <x-table-button route="user" :id="$user->id"></x-table-button>
                                </td>
                            </tr>
                        @endforeach

                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
@endsection
