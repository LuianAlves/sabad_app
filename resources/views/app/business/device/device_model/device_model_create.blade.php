@extends('layouts.templates.app-layout')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border shadow-xs mb-4">

            <x-card-header title="Novo modelo de dispositivo" action="Cadastrar" />

            <x-form route="store">
                <div class="row">
                    <x-input col="4" set="" type="text" title="Modelo" id="name" name="name" value="{{ old('name') }}" placeholder="Inspirion 15 3520" />
                </div>
            </x-form>
        </div>
    </div>
</div>
@endsection
