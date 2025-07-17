@extends('layouts.templates.app-layout')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-crud border shadow-xs mb-4">

                <x-card-header title="Registros de Controle" count="{{ $records->count() }}" action="novo"/>

                <x-table>
                    <x-slot name="thead">
                        <tr class="text-center">
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">ID</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Identificação</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Funcionário</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Forma</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Local</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Acesso</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Retenção</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Manutenção</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7"></th>
                        </tr>
                    </x-slot>

                    <x-slot name="tbody">
                        @forelse ($records as $rc)
                            <tr class="text-center">
                                <td><p class="text-dark text-sm mb-0">{{ $rc->id }}</p></td>
                                <td><p class="text-dark text-sm mb-0">{{ $rc->identificacao }}</p></td>
                                <td><p class="text-dark text-sm mb-0">{{ $rc->employee->name ?? 'N/A' }}</p></td>
                                <td><p class="text-dark text-sm mb-0">{{ $rc->forma_armazenamento }}</p></td>
                                <td><p class="text-dark text-sm mb-0">{{ $rc->local_armazenamento }}</p></td>
                                <td><p class="text-dark text-sm mb-0">{{ $rc->acesso_permitido }}</p></td>
                                <td><p class="text-dark text-sm mb-0">{{ $rc->tempo_retencao }}</p></td>
                                <td><p class="text-dark text-sm mb-0">{{ $rc->metodo_manutencao }}</p></td>
                                <td>
                                    <x-table-button route="record_controls" :id="$rc->id"/>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-sm">Nenhum registro encontrado.</td>
                            </tr>
                        @endforelse
                    </x-slot>
                </x-table>

            </div>
        </div>
    </div>
@endsection
