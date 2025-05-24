@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">
                <x-card-header title="Dispositivos cadastrados" count="" action="novo"></x-card-header>

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
                        
                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
@endsection
