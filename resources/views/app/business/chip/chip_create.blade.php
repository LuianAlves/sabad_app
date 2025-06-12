@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                <x-card-header title="Nova Operadora" action="cadastrar"></x-card-header>

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

                        {{-- Operadora --}}
                        <div class="col-md-6 mb-3">
                            <label for="phone_operator_id" class="form-label">Operadora</label>
                            <select name="phone_operator_id" id="phone_operator_id" class="form-control" required>
                                <option value="">Selecione uma operadora</option>
                                @foreach ($operators as $operator)
                                    <option value="{{ $operator->id }}">{{ $operator->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </x-form>

            </div>
        </div>
    </div>
@endsection

