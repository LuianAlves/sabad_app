@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-crud border shadow-xs mb-4">
                <x-card-header title="Funcionários cadastrados" count="{{ $employees->count() }}" action="novo"></x-card-header>

                <x-table>
                    <x-slot name="thead">
                        <tr class="text-center">
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Departamento/Empresa</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Nome</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Nivel Hierárquico</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Status</th>
                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7"></th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($employees as $employee)
                            <tr class="text-center">
                                {{-- Departamento / Empresa --}}
                                    <td>
                                        <p class="text-dark fw-bold text-sm mb-0">
                                            {{ $employee->department?->name ?? 'Sem departamento vinculado' }}
                                        </p>
                                        <p class="text-secondary text-xs mb-0">
                                            {{ $employee->department?->company?->name ?? 'Sem empresa vinculada' }}
                                        </p>
                                    </td>


                                {{-- Funcionario --}}
                                <td>
                                    <p class="text-dark text-sm mb-0">{{ $employee->name }}</p>
                                </td>

                                {{-- Nivel de hirarquia --}}
                                <td>
                                    <p class="text-secondary text-sm mb-0">{{ $employee->hierarchical_level }}</p>
                                </td>

                                {{-- Status --}}
                                <td>
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
