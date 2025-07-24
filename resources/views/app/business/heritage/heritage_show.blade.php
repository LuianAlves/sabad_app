@extends('layouts.templates.app-layout')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">
                <x-table>
                    <x-slot name="thead">
                        {{-- Cabeçalhos (opcional) --}}
                    </x-slot>

                    <x-slot name="tbody">
                        <tr class="text-center">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <strong>Tipo de Patrimônio:</strong>
                                        <p>{{ $heritage->heritageType->name ?? 'Sem tipo cadastrado' }}</p>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <strong>Marca:</strong>
                                        <p>{{ $heritage->heritageBrand->name ?? 'Sem marca cadastrada' }}</p>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <strong>Modelo:</strong>
                                        <p>{{ $heritage->heritageModel->name ?? 'Sem modelo cadastrado' }}</p>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <a href="{{ route('heritage.index') }}" class="btn btn-secondary">
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
