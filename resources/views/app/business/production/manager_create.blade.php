@extends('layouts.templates.app-layout')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                {{-- Mesmo padrão do e-mail: título + action="Cadastrar" --}}
                <x-card-header title="Nova Ordem de Produção" action="Cadastrar" />

                {{-- IMPORTANTE: route="store" para seguir o padrão do x-form (manager.store) --}}
                <x-form route="store">
                    <div class="row">
                        <div class="col-6">

                            {{-- Data da OF --}}
                            <x-input
                                col="6"
                                set=""
                                type="date"
                                title="Data da OF"
                                id="order_date"
                                name="order_date"
                                value="{{ old('order_date', now()->format('Y-m-d')) }}"
                            />


                            <x-input
                                col="6"
                                set=""
                                type="text"
                                title="Nº da OF"
                                id="order_number"
                                name="order_number"
                                value="{{ old('order_number') }}"
                                placeholder="Informe o número da OF"
                            />

                        </div>

                        <div class="col-6">



                            <x-input
                                col="6"
                                set=""
                                type="text"
                                title="Cliente"
                                id="client_name"
                                name="client_name"
                                value="{{ old('client_name') }}"
                                placeholder="Nome do cliente"
                            />

                            {{-- Data de expedição --}}

                            <x-input
                                col="6"
                                set=""
                                type="date"
                                title="Data de expedição"
                                id="expedition_date"
                                name="expedition_date"
                                value="{{ old('expedition_date') }}"
                            />

                        </div>
                    </div>
                </x-form>
            </div>
        </div>
    </div>
@endsection
