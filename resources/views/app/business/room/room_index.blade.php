@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-crud border shadow-xs mb-4">
                <x-card-header title="Salas cadastradas" count="{{ $rooms->count() }}"
                    action="novo"></x-card-header>

                <x-table>
                    <x-slot name="thead">
                        <tr class="text-center">
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Empresa</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Sala</th>
                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7"></th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($rooms as $room)
                            <tr class="text-center">
                                <td>
                                    <p class="text-dark fw-bold text-sm mb-0">{{ $room->company->name }}</p>
                                </td>

                                {{-- Departamento --}}
                                <td>
                                    <p class="text-dark text-sm mb-0">{{ $room->name }}</p>
                                </td>

                                {{-- Botões de ações --}}
                                <td>
                                    <x-table-button route="room" :id="$room->id"></x-table-button>
                                </td>
                            </tr>
                        @endforeach

                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
@endsection
