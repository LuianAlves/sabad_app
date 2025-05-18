@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">
                <x-card-header title="Departamentos cadastrados" count="{{ $departments->count() }}"
                    action="novo"></x-card-header>

                <x-table>
                    <x-slot name="thead">
                        <tr class="text-center">
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Empresa</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Departamento</th>
                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7"></th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($departments as $department)
                            <tr class="text-center">
                                <td>
                                    <p class="text-dark fw-bold text-sm mb-0">{{ $department->company->name }}</p>
                                </td>

                                {{-- Departamento --}}
                                <td>
                                    <p class="text-dark text-sm mb-0">{{ $department->name }}</p>
                                </td>

                                {{-- Botões de ações --}}
                                <td>
                                    <x-table-button route="department" :id="$department->id"></x-table-button>
                                </td>
                            </tr>
                        @endforeach

                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
@endsection
