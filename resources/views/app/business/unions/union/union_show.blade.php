@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                <x-table>
                    <x-slot name="thead">

                    </x-slot>
                    <x-slot name="tbody">

                        <tr class="text-center">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <strong>Sindicato:</strong>
                                        <p>{{ $union->name ?? '' }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>% de ajuste atual:</strong>
                                        <p>{{ $union->current_adjustment_percent ?? '' }}</p>
                                    </div>

                                </div>

                                <div class="mt-4">
                                    <a href="{{ route('union.index') }}" class="btn btn-secondary">
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
