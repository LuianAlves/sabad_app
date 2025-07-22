@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">
                <x-card-header title="Novo Sindicato" action="Cadastrar" />

                <x-form route="store">
                    <div class="row">
                        <x-input col="6" set="" type="text" id="name" name="name" title="Nome" :value="old('name', $union->name ?? '')" required />
                        <x-input col="6" set="" type="number" id="current_adjustment_percent" name="current_adjustment_percent" title="Reajuste atual (%)" :value="old('current_adjustment_percent', $union->current_adjustment_percent ?? 0)" step="0.01" required/>
                    </div>
                </x-form>
            </div>
        </div>
    </div>
@endsection
