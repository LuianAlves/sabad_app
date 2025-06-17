@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                <x-card-header title="Novo Chip" action="cadastrar"></x-card-header>

                <x-form route="store">
                        <div class="col-md-6 mb-3">
                            <label for="chip_id" class="form-label">Empresa</label>
                            <select name="chip_id" id="chip_id" class="form-control" required>
                                <option value="">Selecione uma Empresa</option>
                                @foreach ($chips as $chip)
                                    <option value="{{ $chip->id }}">
                                        {{ $chip->company->name .' - '.
                                            $chip->phone_operator->name }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="employee_id" class="form-label">Funcionario</label>
                            <select name="employee_id" id="employee_id" class="form-control" required>
                                <option value="">Selecione um Funcionario</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}">
                                    {{ $employee->name .' - '. $employee->department->company->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        

                        


                        <x-input col="6" set="" type="number" title="DDD" id="ddd"
                            name="ddd" value="{{ 'ddd' }}" placeholder="Ex: 11" />

                        <x-input col="6" set="" type="number" title="Numero do telefone" id="number"
                            name="number" value="{{ 'number' }}" placeholder="Ex: 123456789" />


                </x-form>

            </div>
        </div>
    </div>
@endsection
