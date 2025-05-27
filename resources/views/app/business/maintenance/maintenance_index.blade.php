@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">
                <x-card-header title="Manutanção Preventiva" count="{{ $maintenances->count() }}" action="novo"></x-card-header>
                    @php
                    use Carbon\Carbon;
                    @endphp
                <x-table>
                    <x-slot name="thead">
                        <tr class="text-center">
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Usuário</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Entregue em</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Última Manutenção</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Próxima Manutenção</th>
                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7"></th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($device_controls as $device_control)
                            <tr class="text-center">
                                {{-- Usuario --}}                        
                                    <td>
                                        <p class="text-dark fw-bold text-sm mb-0">
                                            {{ $device_control->employee?->name ?? '-' }}</p>
                                    </td>
                        @endforeach
                            
                        @foreach($maintenances as $maintenance)
                                {{-- Entregue em --}}
                                <td>
                                    <p class="text-secondary text-sm mb-0">{{ \Carbon\Carbon::parse($maintenance->delivered_in)->format('d/m/Y') }}</p>
                                </td>

                                {{-- Última Manutenção  --}}
                                <td class="text-secondary text-sm mb-0">{{ \Carbon\Carbon::parse($maintenance->last_maintenance)->format('d/m/Y') }}</td>

                                {{-- Próxima Manutenção --}}
                                <td class="text-secondary text-sm mb-0">{{ \Carbon\Carbon::parse($domain->next_maintenance)->format('d/m/Y') }}</td>
                        

                                {{-- Botões de ações --}}
                                 <td>
                                    <x-table-button route="maintenance" :id="$maintenance->id"></x-table-button>
                                </td>
                            </tr>
                        @endforeach

                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
@endsection
