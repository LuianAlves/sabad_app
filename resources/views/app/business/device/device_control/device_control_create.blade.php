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

                    <div class="row">
                        <x-input col="4" set="" type="date" title="Entregue em" id="delivered_in"
                            name="delivered_in" value="" placeholder="" />
                        <x-input col="4" set="" type="date" title="Devolvido em" id="returned_in" name="returned_in"
                            value="" placeholder="" />
                            <x-input col="4" set="" type="date" title="Comprado em" id="purchased_in" name="purchased_in"
                            value="" placeholder="" />
                    </div>

                    <div class="row">
                        <x-input col="3" set="" type="text" title="Preço aproximado" id="estimated_price"
                            name="estimated_price" value="{{ old('estimated_price') }}" placeholder="R$ 0.00" />
                    </div>
                </x-form>
            </div>
        </div>
    </div>
@endsection
