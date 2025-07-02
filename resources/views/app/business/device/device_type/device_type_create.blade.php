@extends('layouts.templates.app-layout')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border shadow-xs mb-4">

            <x-card-header title="Novo tipo de dispositivo" action="Cadastrar" />

            <x-form route="store">
                <div class="row">
                    <x-input col="6" set="" type="text" title="Tipo de dispositivo" id="name" name="name" value="{{ old('name') }}" placeholder="" />
                </div>
            </x-form>
        </div>
    </div>
</div>
@endsection
