@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">
                <x-card-header title="Controle de Chips" count="{{ $chipControls->count() }}"
                    action="novo"></x-card-header>

                <x-table>
                    <x-slot name="thead">
                        <tr class="text-center">
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Empresa</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Funcionário</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">DDD</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Número</th>
                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7"></th>
                        </tr>
                    </x-slot>

                    <x-slot name="tbody">
                        @foreach ($chipControls as $chipControl)
                            <tr class="text-center">
                            
                                {{-- Empresa --}}
                                <td>
                                    <p class="text-dark fw-bold text-sm mb-0">{{ $chipControl->chip->company->name ?? 'Sem empresa' }}</p>
                                </td>

                                {{-- Funcionario --}}
                                <td>
                                    <p class="text-dark fw-bold text-sm mb-0">{{ $chipControl->employee->name ?? 'Sem empresa' }}</p>
                                </td>

                                {{-- DDD --}}
                                <td>
                                    <p class="text-dark fw-bold text-sm mb-0">{{ $chipControl->ddd ?? 'Sem empresa' }}</p>
                                </td>

                                {{-- Numero --}}
                                <td>
                                    <p class="text-dark fw-bold text-sm mb-0">{{ $chipControl->number ?? 'Sem empresa' }}</p>
                                </td>

                                {{-- Botões de ações --}}

                            </tr>
                        @endforeach

                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
@endsection
