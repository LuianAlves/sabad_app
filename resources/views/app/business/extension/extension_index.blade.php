@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-crud border shadow-xs mb-4">
                <x-card-header title="Ramais" count="{{ $extensions->count() }}"
                    action="novo"></x-card-header>

                <x-table>
                    <x-slot name="thead">
                        <tr class="text-center">
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Empresa</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Funcionário</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Ramal</th>
                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7"></th>
                        </tr>
                    </x-slot>

                    <x-slot name="tbody">
                        @foreach ($extensions as $extension)
                            <tr class="text-center">

                                {{-- Empresa --}}
                                <td>
                                    <p class="text-dark fw-bold text-sm mb-0">
                                        {{ $extension->employee->department->company->name ?? 'Sem empresa' }}
                                    </p>
                                </td>

                                {{-- Funcionário --}}
                                <td>
                                    <p class="text-dark fw-bold text-sm mb-0">
                                        {{ $extension->employee->name ?? 'Sem funcionário' }}
                                    </p>
                                </td>

                                {{-- Ramal --}}
                                <td>
                                    <p class="text-dark fw-bold text-sm mb-0">
                                        {{ $extension->number ?? 'Sem número' }}
                                    </p>
                                </td>


                                {{-- Botões de ações --}}
                                <td>
                                    <x-table-button route="extension" :id="$extension->id"></x-table-button>
                                </td>
                            </tr>
                        @endforeach

                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
@endsection
