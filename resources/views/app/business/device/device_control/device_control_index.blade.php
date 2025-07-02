@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">
                <x-card-header title="Controle de Dispositivos" count="{{ $deviceControls->count() }}" action="novo"></x-card-header>

                <x-table>
                    <x-slot name="thead">
                        <tr class="text-center">
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Dispositivo</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Funcionário</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Entregue em</th>
                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7"></th>
                        </tr>
                    </x-slot>

                    <x-slot name="tbody">
                        @foreach ($deviceControls as $control)
                            <tr class="text-center">
                                <td>
                                    <div class="d-flex justify-content-center py-1">
                                        <div class="d-flex flex-column justify-content-center ms-1">
                                            <h6 class="mb-0 text-sm font-weight-semibold">{{ $control->device_code }}</h6>
                                            <p class="text-sm text-secondary mb-0">
                                                {{ $control->device->deviceBrand->name .' '.  $control->device->deviceModel->name }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <p class="text-muted font-weight-semibold text-sm mb-0">{{ $control->employee->name }}</p>
                                </td>

                                <td>
                                    <p class="text-dark font-weight-bold text-sm mb-0">{{ \Carbon\Carbon::parse($control->delivered_in)->format('d/m/Y') .' ['. \Carbon\Carbon::parse($control->delivered_in)->diffForHumans().']' }}</p>
                                </td>

                                <td>
                                    <x-table-button route="device_control" :id="$control->id"></x-table-button>
                                </td>
                            </tr>
                        @endforeach
                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
@endsection
