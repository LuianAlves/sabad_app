@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                <x-table>
                    <x-slot name="thead">
                        {{-- Se quiser cabeçalho, pode colocar aqui --}}
                    </x-slot>
                    <x-slot name="tbody">

                        @php
                            $deviceTypes = [
                                0 => 'Notebook',
                                1 => 'Desktop',
                                2 => 'Servidor',
                                3 => 'Impressora',
                            ];

                            $phoneTypes = [
                                0 => 'Motorola',
                                1 => 'Samsung',
                                2 => 'Xiaomi',
                            ];
                        @endphp

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <strong>Empresa:</strong>
                                    <p>{{ $device->employee->department->company->name ?? '' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <strong>Responsável:</strong>
                                    <p>{{ $device->employee?->name ?? '' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <strong>Dispositivo:</strong>
                                    <p>{{ $deviceTypes[$device->device_type] ?? 'Desconhecido' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <strong>Marca:</strong>
                                    <p>{{ $device->brand }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <strong>Modelo:</strong>
                                    <p>{{ $device->model }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <strong>Dispositivo:</strong>
                                    <p>{{ $phoneTypes[$device->phone_type] ?? 'Desconhecido' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <strong>Modelo:</strong>
                                    <p>{{ $device->phone_model }}</p>
                                </div>
                            </div>
                            
                            



                            <div class="mt-4">
                                <a href="{{ route('device.index') }}" class="btn btn-secondary">
                                    ← Voltar
                                </a>
                            </div>
                        </div>

                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
@endsection
