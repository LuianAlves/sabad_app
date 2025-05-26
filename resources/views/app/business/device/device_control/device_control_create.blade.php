@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                <x-card-header title="Novo Funcionário" action="Cadastrar" />

                <x-form route="store">

                    <div class="row">
                        <x-select col="4" set="" title="Dispositivo" name="device_id" id="device_id">
                            <option value="">Selecione um dispositivo</option>
                            @foreach ($devices->groupBy(fn($d) => $d->deviceBrand->name) as $brand => $brandDevices)
                                <optgroup label="{{ $brand }}">
                                    @foreach ($brandDevices as $device)
                                        <option value="{{ $device->id }}">
                                            {{ $device->deviceModel->name }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </x-select>

                        <x-select col="4" set="" title="Funcionário" name="employee_id" id="employee_id">
    <option value="">Selecione um funcionário</option>

    @foreach ($employees->groupBy(fn($e) => $e->department->name) as $department => $employeesInDept)
        <optgroup label="{{ $department }}">
            @foreach ($employeesInDept as $employee)
                <option value="{{ $employee->id }}">
                    {{ $employee->name }}
                </option>
            @endforeach
        </optgroup>
    @endforeach
</x-select>

                    </div>

                    <div class="row mt-3">
                        <x-input col="4" set="" type="text" title="Funcionário" id="name"
                            name="name" value="{{ old('name') }}" placeholder="João Silva" />
                        <x-input col="4" set="" type="text" title="E-mail" id="email" name="email"
                            value="{{ old('email') }}" placeholder="ti@bongas.com.br" />
                        <x-select col="4" set="" title="Licença de e-mail" id="license_id" name="license_id">

                        </x-select>
                    </div>

                    <div class="row mt-2">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="hierarchical_level" class="form-control-label">Nível Hierárquico</label>
                                <select class="form-control" id="hierarchical_level" name="hierarchical_level" required>

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <x-input col="6" set="" type="date" title="Contratado em" id="hired_in"
                            name="hired_in" value="{{ old('hired_in') }}" />
                        <x-input col="6" set="" type="date" title="Dispensado em" id="fired_in"
                            name="fired_in" value="{{ old('fired_in') }}" />
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="status" class="form-control-label">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Ativo</option>
                                    <option value="0" {{ old('status', 1) == 0 ? 'selected' : '' }}>Inativo</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <x-input col="6" set="" type="file" title="Foto" id="image" name="image"
                        value=""></x-input>

                    <x-input-check col="6" set="" title="Usuário é administrador?" id="is_admin"
                        name="is_admin" checked="" disabled=""></x-input>

                        <div class="row my-3" id="permissions-container">

                        </div>
                </x-form>
            </div>
        </div>
    </div>
@endsection
