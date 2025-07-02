@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                @php
                 use Carbon\Carbon;
                @endphp

                <x-table>
                    <x-slot name="thead">
                        
                    </x-slot>
                    <x-slot name="tbody">
                        
                            <tr class="text-center">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <strong>Funcioanrio:</strong>
                                            <p>{{ $maintenance->deviceControl->employee->name ?? 'Não informado' }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <strong>Disposito:</strong>
                                            <p>{{ $maintenance->deviceControl->device->deviceType->name ??'..' }}</p>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <strong>Data de recebimento:</strong>
                                            <p>{{ Carbon::parse($maintenance->delivered_in)->format('d/m/Y') }}</p>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <strong>Ultima manutenção:</strong>
                                            <p>{{ Carbon::parse($maintenance->last_maintenance)->format('d/m/Y') }}</p>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <strong>Proxima manutenção:</strong>
                                            <p>{{ Carbon::parse($maintenance->next_maintenance)->format('d/m/Y') }}</p>
                                        </div>

                                    </div>

                                    <div class="mt-4">
                                        <a href="{{ route('maintenance.index') }}" class="btn btn-secondary">
                                            ← Voltar
                                        </a>
                                    </div>
                                </div>

                            </tr>
                        

                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
@endsection
