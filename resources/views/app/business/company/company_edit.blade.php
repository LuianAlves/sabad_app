@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                <x-card-header title="Editar Empresa" action="Atualizar"></x-card-header>

                 <x-form route="update" :id="$company->id">
                     @include('app.business.company.company_form')
                </x-form>

            </div>
        </div>
    </div>
@endsection
