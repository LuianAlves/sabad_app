@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">
                {{-- Cabeçalho com título, contador e botão “novo” --}}
                <x-card-header
                    title="Sindicatos cadastrados"
                    count="{{ $unions->count() }}"
                    action="novo"
                    route="union.create"
                />

                {{-- Tabela --}}
                <x-table>
                    <x-slot name="thead">
                        <tr class="text-center">
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Nome</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Reajuste %</th>
                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Ações</th>
                        </tr>
                    </x-slot>

                    <x-slot name="tbody">
                        @foreach($unions as $u)
                            <tr class="text-center">
                                <td>
                                    <p class="text-dark fw-bold text-sm mb-0">
                                        {{ $u->name }}
                                    </p>
                                </td>
                                <td>
                                    <p class="text-dark text-sm mb-0">
                                        {{ $u->current_adjustment_percent }}%
                                    </p>
                                </td>
                                <td>
                                    {{-- Componente que já renderiza Editar e Excluir --}}
                                    <x-table-button
                                        route="union"
                                        :id="$u->id"
                                    />
                                </td>
                            </tr>
                        @endforeach
                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
@endsection
