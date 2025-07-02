@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                <x-card-header title="Nova Operadora" action="cadastrar"></x-card-header>

                <x-form route="store">
                  <div class="row">
                      <x-input col="6" set="" type="text" title="Nome da operadora" id="name" name="name" value="" placeholder="" disabled=""></x-input>
                  </div>
                </x-form>

            </div>
        </div>
    </div>
@endsection
