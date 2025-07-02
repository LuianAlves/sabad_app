@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4">
                <x-card-header title="Manutenções" count="{{ $maintenances->count() }}" action="novo"></x-card-header>

                @php
                    use Carbon\Carbon;
                    
                    $nextMaintenance = $maintenances
                        ->filter(fn ($m) =>
                            Carbon::parse($m->next_maintenance)->greaterThanOrEqualTo(Carbon::today())
                        )
                        ->sortBy(fn ($m) =>
                            Carbon::parse($m->next_maintenance)->timestamp
                        )
                        ->values()
                        ->first();
                @endphp

                @if($nextMaintenance)
                    <div class="card mb-4 p-4 shadow-sm border rounded">
                        <div class="card-header bg-warning text-white fw-semibold d-flex justify-content-between align-items-center">
                            <span>🔧 Próxima Manutenção Agendada</span>
                            <a href="{{ route('maintenance.edit', $nextMaintenance->id) }}" class="btn btn-sm btn-secondary">
                                Atualizar Manutenção
                            </a>
                        </div>
                        <div class="card-body p-3">
                            <p class="mb-2"><strong>Funcionário:</strong> {{ $nextMaintenance->deviceControl->employee->name }}</p>
                            <p class="mb-2"><strong>Equipamento:</strong> {{ $nextMaintenance->deviceControl->device->deviceType->name }}</p>
                            <p class="mb-0"><strong>Data:</strong> {{ Carbon::parse($nextMaintenance->next_maintenance)->format('d/m/Y') }}</p>
                        </div>
                    </div>
                @endif

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
                                        <p class="text-dark text-sm mb-0">{{ Carbon::parse($maintenance->delivered_in)->format('d/m/Y') }}</p>
                                    </td>
                                {{-- Ultima Manutenção --}}
                                    <td>
                                        <p class="text-dark text-sm mb-0">{{ Carbon::parse($maintenance->last_maintenance)->format('d/m/Y') }}</p>
                                    </td>
                                {{-- Proxima Manutenção --}}
                                    <td>
                                        <p class="text-dark text-sm mb-0">{{ Carbon::parse($maintenance->next_maintenance)->format('d/m/Y') }}</p>
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

