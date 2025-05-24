@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">
                <x-card-header title="Dispositivos cadastrados" count="{{ $devices->count() }}" action="novo"></x-card-header>

                <x-table>
                    <x-slot name="thead">
                        <tr class="text-center">
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Empresa</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Departamento</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Dispositivo<br><small>Marca / Modelo</small></th>
                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7"></th>
                        </tr>
                    </x-slot>
                    
                    <x-slot name="tbody">
                        @foreach ($devices as $device)
                            <tr class="text-center">
                                {{-- Empresa --}}                                
                                <td>
                                    <p class="text-dark fw-bold text-sm mb-0">
                                        {{ $device->department->company->name ?? 'Sem empresa vinculada' }}
                                    </p>
                                </td>

                                {{-- Departamento --}}
                                <td>
                                    <p class="text-dark text-sm mb-0">
                                        {{ $device->department->name ?? 'Sem responsável' }}</p>
                                </td>

                                {{-- Dispositivo --}}
                                <td>
                                    @php
                                        $types = ['Notebook', 'Desktop', 'Servidor', 'Impressora', 'Celular'];
                                    @endphp
                                    <p class="text-dark text-sm mb-0">
                                        {{ $types[$device->device_type] ?? '-' }}
                                    </p><small class="text-secondary d-block">
                                        {{ $device->brand ?? '-' }} / {{ $device->model ?? '-' }}</small>
                                    
                                </td>

                                {{-- Ações --}}
                                <td>
                                    <x-table-button route="device" :id="$device->id"></x-table-button>
                                </td>
                            </tr>
                        @endforeach
                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
@endsection
