@extends('layouts.templates.app-layout')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

            <x-card-header title="Novo Dispositivo" action="Cadastrar" />

            <x-form route="store">
                <div class="row">
                    
                    {{-- Empresa --}}
                    <div class="col-6">
                        <label for="company_id" class="form-control-label">Empresa</label>
                        <select name="company_id" id="company_id" class="form-control" required>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}" 
                                    {{ old('company_id', $company_id ?? '') == $company->id ? 'selected' : '' }}>
                                    {{ $company->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Departamento --}}
                    <div class="col-6">
                        <label for="department_id" class="form-control-label">Departamento</label>
                        <select name="department_id" id="department_id" class="form-control" required>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- Dispositivo --}}
                    <div class="col-6">
                        <div class="form-group">
                            <label for="device_type" class="form-control-label">Dispositivo</label>
                            <select class="form-control" id="device_type" name="device_type">
                                <option value="0" {{ old('device_type', 0) == 0 ? 'selected' : '' }}>Notebook</option>
                                <option value="1" {{ old('device_type', 1) == 1 ? 'selected' : '' }}>Desktop</option>
                                <option value="2" {{ old('device_type', 2) == 2 ? 'selected' : '' }}>Servidor</option>
                                <option value="3" {{ old('device_type', 3) == 3 ? 'selected' : '' }}>Impressora</option>
                                <option value="4" {{ old('device_type', 4) == 4 ? 'selected' : '' }}>Celular</option>
                            </select>
                        </div>
                    </div>

                    {{-- Marca --}}
                    <x-input col="6" set="" type="string" title="Marca" id="brand"
                        name="brand" value="{{ old('brand') }}" placeholder="" />

                    {{-- Modelo --}}
                    <x-input col="6" set="" type="string" title="Modelo" id="model"
                        name="model" value="{{ old('model') }}" placeholder="" />


                    {{-- Celular --}}
                    <div class="col-6">
                        <div class="form-group">
                            <label for="phone_type" class="form-control-label">Celular</label>
                            <select class="form-control" id="phone_type" name="phone_type">
                                <option value="0" {{ old('phone_type', 0) == 0 ? 'selected' : '' }}>Motorola</option>
                                <option value="1" {{ old('phone_type', 1) == 1 ? 'selected' : '' }}>Samsung</option>
                                <option value="2" {{ old('phone_type', 2) == 2 ? 'selected' : '' }}>Xiamoi</option>
                            </select>
                        </div>
                    </div>
                   

                        {{-- Modelo --}}
                        <x-input col="6" set="" type="string" title="Modelo" id="phone_model"
                            name="phone_model" value="{{ old('phone_model', $device->phone_model ?? '') }}" placeholder="" />
                   
                    


                </div>
            </x-form>
        </div>
    </div>
</div>
@endsection
