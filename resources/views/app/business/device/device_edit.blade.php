@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                <x-card-header title="Editar Certificado" action="Atualizar"></x-card-header>

                <x-form route="update" :id="$device->id">
                    <div class="row">

                        {{-- Departamento / Empresa --}}
                        <div class="col-6">
                            <label for="department_id" class="form-control-label">Departamento - Empresa</label>
                            <select name="department_id" id="department_id" class="form-control" required>
                                @foreach ( $companies as $company)
                                    <optgroup label="{{ $company->name }}">
                                        @foreach ($company->departments as $department)
                                        <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                            {{ $department->name }}
                                        </option>
                                        @endforeach
                                    </optgroup>
                            @endforeach
                            </select>
                        </div>

                        <div class="col-6">
                        <div class="form-group">
                            <label for="device_type" class="form-control-label">Dispositivo</label>
                                <select class="form-control" id="device_type" name="device_type">
                                    <option value="0" {{ old($device->device_type ?? 0) == 0 ? 'selected' : '' }}>Notebook</option>
                                    <option value="1" {{ old($device->device_type ?? 1) == 1 ? 'selected' : '' }}>Desktop</option>
                                    <option value="2" {{ old($device->device_type ?? 2) == 2 ? 'selected' : '' }}>Servidor</option>
                                    <option value="3" {{ old($device->device_type ?? 3) == 3 ? 'selected' : '' }}>Impressora</option>
                                    <option value="4" {{ old($device->device_type ?? 4) == 4 ? 'selected' : '' }}>Celular</option>
                                </select>
                            </div>
                        </div>

                        {{-- Marca --}}
                        <x-input col="6" set="" type="string" title="Marca" id="brand"
                            name="brand" value="{{ old('brand', $device->brand ?? '') }}" placeholder="" />

                        {{-- Modelo --}}
                        <x-input col="6" set="" type="string" title="Modelo" id="model"
                            name="model" value="{{ old('model', $device->model ?? '') }}" placeholder="" />

                    </div>
                </x-form>

            </div>
        </div>
    </div>
@endsection
