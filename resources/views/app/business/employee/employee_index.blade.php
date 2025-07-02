@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-crud border shadow-xs mb-4">
                <x-card-header title="Funcionários cadastrados" count="{{ $employees->count() }}"
                    action="novo"></x-card-header>

                <x-table>
                    <x-slot name="thead">
                        <tr>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7" style="padding-left: 35px;">
                                Funcionário</th>
                            <th class="text-secondary text-xs font-weight-bold opacity-7 text-center">Departamento</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 text-center">Nivel Hierárquico
                            </th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 text-center">Status</th>
                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7"></th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($employees as $employee)
                            <tr>
                                <td style="padding-left: 35px;">
                                    <div class="d-flex py-1">
                                        <div class="d-flex align-items-center">
                                            @if (isset($employee->employeeUser->user) && $employee->employeeUser->user->image)
                                                <img src="{{ 'data:image/png;base64,' . $employee->employeeUser->user->image }}"
                                                    class="avatar avatar-sm rounded-circle me-2"
                                                    alt="{{ $employee->name }}">
                                            @else
                                                <img src="{{ asset('img/profile/image_profile.webp') }}"
                                                    class="avatar avatar-sm rounded-circle me-2" alt="Usuário sem imagem">
                                            @endif
                                        </div>
                                        <div class="d-flex flex-column justify-content-center ms-1">
                                            <h6 class="mb-0 text-sm font-weight-semibold">{{ $employee->name }}</h6>
                                            <p class="text-sm text-secondary mb-0">
                                                @if (isset($employee->employeeUser->user))
                                                    {{ $employee->employeeUser->user->email }}
                                                @else
                                                    Não informado
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="text-center">
                                    <p class="text-sm text-dark font-weight-semibold mb-0">
                                        {{ $employee->department->name }}
                                    </p>
                                    <small class="text-muted mb-0">
                                        {{ Str::words($employee->department->company->name, 3, ' ..') }}
                                    </small>

                                </td>

                                <td class="text-center">
                                    <p class="text-secondary text-sm mb-0">{{ $employee->hierarchical_level }}</p>
                                </td>

                                <td class="text-center">
                                    @if ($employee->status == 1)
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


                                {{-- Botões de ações --}}
                                <td>
                                    <x-table-button route="employee" :id="$employee->id"></x-table-button>
                                </td>
                            </tr>
                        @endforeach

                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
@endsection
