@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4">
                <x-card-header title="Manutenções" count="{{ $maintenances->count() }}" action="novo"></x-card-header>

                <x-table>
                    <x-slot name="thead">
                        <tr class="text-center">
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Funcionário</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Entregue em</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Ultima Manutenção</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Proxima Manutenção</th>
                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7"></th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($maintenances as $maintenance)
                            <tr class="text-center">

                                {{-- Funcionário --}}
                                <td>
                                    <p class="text-dark fw-bold text-sm mb-0">
                                        {{ $maintenance->deviceControl->employee->name }}
                                    </p>     
                                    <small class="text-muted mb-0">
                                        {{ Str::words($maintenance->deviceControl->device->deviceType->name , 3, ' ..') }}
                                    </small>                                   
                                </td>

                                {{-- Entregue em --}}
                                    <td>
                                        <p class="text-dark text-sm mb-0">{{ $maintenance->delivered_in }}</p>
                                    </td>
                                {{-- Ultima Manutenção --}}
                                    <td>
                                        <p class="text-dark text-sm mb-0">{{ $maintenance->last_maintenance }}</p>
                                    </td>
                                {{-- Proxima Manutenção --}}
                                    <td>
                                        <p class="text-dark text-sm mb-0">{{ $maintenance->next_maintenance }}</p>
                                    </td>

                                {{-- Botões de ações --}}
                                <td>
                                    <x-table-button route="maintenance" :id="$maintenance->id"></x-table-button>
                                </td>
                                {{-- E-mail --}}
                            </tr>
                        @endforeach

                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
@endsection

