@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                <x-card-header title="Novo Departamento" action="cadastrar"></x-card-header>

                <x-form route="store">

                    <div class="row">
                        {{-- Empresa --}}
                        <div class="col-md-6 mb-3">
                            <label for="company_id" class="form-label">Empresa</label>
                            <select name="company_id" id="company_id" class="form-control" required>
                                <option value="">Selecione uma empresa</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Nome do Departamento --}}
                        <x-input col="6" set="" type="text" title="Nome do Departamento" id="name"
                            name="name" value="{{ old('name') }}" placeholder="Ex: RH" />
                    </div>                    
                              
                </x-form>

            </div>
        </div>
    </div>
@endsection
