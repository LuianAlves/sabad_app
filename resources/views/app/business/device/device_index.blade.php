@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">
                <x-card-header title="Dispositivos cadastrados" count="{{ $devices->count() }}" action="novo"></x-card-header>

                <x-table>
                    <x-slot name="thead">
                        <tr class="text-center">
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Dispositivo</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Marca</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Modelo</th>
                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7"></th>
                        </tr>
                    </x-slot>

                    <x-slot name="tbody">
                        @foreach ($devices as $device)
                            <tr class="text-center">
                                <td>
                                    <p class="text-dark fw-bold text-sm mb-0">
                                        {{ $device->deviceType->name }}
                                    </p>
                                </td>

                                <td>
                                    <p class="text-dark text-sm mb-0">{{ $device->deviceBrand->name }}</p>
                                </td>

                                <td>
                                    <p class="text-dark text-sm mb-0">{{ $device->deviceModel->name }}</p>
                                </td>

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
