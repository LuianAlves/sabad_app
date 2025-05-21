@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                <x-card-header title="Editar Certificado" action="Atualizar"></x-card-header>

                <x-form route="update" :id="$device->id">
                    <div class="row">

                        {{-- Empresa --}}
                        <div class="col-6">
                        <label for="company_id" class="form-control-label">Empresa</label>
                            <select name="company_id" id="company_id" class="form-control" required>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}" 
                                        {{ old('company_id', $employee->company_id ?? '') == $company->id ? 'selected' : '' }}>
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Responsável --}}
                        <div class="col-6">
                            <label for="employee_id" class="form-control-label">Responsável</label>
                            <select name="employee_id" id="employee_id" class="form-control">
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}" 
                                        {{ (old('employee_id', $device->employee_id ?? '') == $employee->id) ? 'selected' : '' }}>
                                        {{ $employee->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-6">
                        <div class="form-group">
                            <label for="device_type" class="form-control-label">Status</label>
                                <select class="form-control" id="device_type" name="device_type">
                                    <option value="0" {{ old('device_type', 0) == 0 ? 'selected' : '' }}>Notebook</option>
                                    <option value="1" {{ old('device_type', 1) == 1 ? 'selected' : '' }}>Desktop</option>
                                    <option value="2" {{ old('device_type', 2) == 2 ? 'selected' : '' }}>Servidor</option>
                                    <option value="3" {{ old('device_type', 3) == 3 ? 'selected' : '' }}>Impressora</option>
                                </select>
                            </div>
                        </div>

                        {{-- Marca --}}
                        <x-input col="6" set="" type="string" title="Marca" id="brand"
                            name="brand" value="{{ old('brand', $device->brand ?? '') }}" placeholder="" />

                        {{-- Modelo --}}
                        <x-input col="6" set="" type="string" title="Modelo" id="model"
                            name="model" value="{{ old('model', $device->model ?? '') }}" placeholder="" />

                        {{-- Celular --}}
                        <div class="col-6">
                        <div class="form-group">
                            <label for="phone_type" class="form-control-label">Status</label>
                                <select class="form-control" id="phone_type" name="phone_type">
                                    <option value="0" {{ old('phone_type', 0) == 0 ? 'selected' : '' }}>Motorola</option>
                                    <option value="1" {{ old('phone_type', 1) == 1 ? 'selected' : '' }}>Samsung</option>
                                    <option value="2" {{ old('phone_type', 2) == 2 ? 'selected' : '' }}>Xiaomi</option>
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
