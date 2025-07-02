@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4">
                <x-card-header title="Modelo de dispositivos cadastrados" count="{{ $deviceModels->count() }}"
                    action="novo"></x-card-header>

                <x-table>
                    <x-slot name="thead">
                        <tr class="text-center">
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Modelo do dispositivo</th>
                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7"></th>
                        </tr>
                    </x-slot>

                    <x-slot name="tbody">
                        @foreach ($deviceModels as $deviceModel)
                            <tr class="text-center">
                                <td>
                                    <p class="text-dark fw-bold text-sm mb-0">
                                        {{ $deviceModel->name }}
                                    </p>
                                </td>

                                <td>
                                    <x-table-button route="deviceModel" :id="$deviceModel->id"></x-table-button>
                                </td>
                            </tr>
                        @endforeach
                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
@endsection
