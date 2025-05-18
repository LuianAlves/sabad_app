@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                <x-card-header title="Editar Empresa" action="Atualizar"></x-card-header>

                <x-form route="edit">
                  <div class="row">
                      <x-input col="6" set="" type="text" title="Nome da empresa" id="name" name="name" value="{{ $company->name }}" placeholder="" disabled=""></x-input>
                      <x-input col="6" set="" type="text" title="CNPJ" id="cnpj" name="cnpj" value="{{ $company->cnpj }}" placeholder="" disabled=""></x-input>
                  </div>
                </x-form>

            </div>
        </div>
    </div>
@endsection
