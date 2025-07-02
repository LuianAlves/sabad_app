@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                <x-card-header title="Nova Empresa" action="cadastrar"></x-card-header>

                <x-form route="store">
                  <div class="row">
                      <x-input col="6" set="" type="text" title="Nome da empresa" id="name" name="name" value="" placeholder="Bongas Bra ..." disabled=""></x-input>
                      <x-input col="6" set="" type="text" title="CNPJ" id="cnpj" name="cnpj" value="" placeholder="00.000.000/0001-00" disabled=""></x-input>
                  </div>
                </x-form>

            </div>
        </div>
    </div>
@endsection
