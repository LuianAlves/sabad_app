@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                <x-card-header title="Editar Empresa" action="Atualizar"></x-card-header>

                 <x-form route="update" :id="$company->id">

                    <div class="row">
                        {{-- Empresa --}}
                        <x-input col="6" set="" type="text" title="Nome do Departamento" id="name"
                            name="name" value="{{ old('name', $company->name ) }}" placeholder="" />


                        {{-- Nome do Departamento --}}
                        <x-input col="6" set="" type="text" title="Nome do Departamento" id="cnpj"
                            name="cnpj" value="{{ old('cnpj', $company->cnpj) }}" placeholder="" />
                    </div>                    
                              
                </x-form>

            </div>
        </div>
    </div>
@endsection
