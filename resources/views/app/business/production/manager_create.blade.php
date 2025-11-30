@extends('layouts.templates.production-order-layout')

@section('content')
    @can('create production_order')
        <div class="row">
            <div class="col-12">
                <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                    @can('create production_order')
                        @php
                            $canCreate = 'cadastrar';
                        @endphp
                    @endcan

                    <x-card-header title="Nova Ordem de Produção" :action="$canCreate ?? ''"/>

                    <x-form route="store">
                        <div class="row">
                            <x-input col="6" set="" type="date" title="Data da OF" id="order_date" name="order_date" value="{{ old('order_date', now()->format('Y-m-d')) }}"/>
                            <x-input col="6" set="" type="text" title="Nº da OF" id="order_number" name="order_number" value="{{ old('order_number') }}" placeholder="Informe o número da OF"/>
                        </div>
                        <div class="row">
                            <x-input col="6" set="" type="text" title="Cliente" id="client_name" name="client_name" value="{{ old('client_name') }}" placeholder="Nome do cliente"/>
                            <x-input col="6" set="" type="date" title="Data de expedição" id="expedition_date" name="expedition_date" value="{{ old('expedition_date') }}"/>
                        </div>
                    </x-form>
                </div>
            </div>
        </div>
    @endcan
@endsection
