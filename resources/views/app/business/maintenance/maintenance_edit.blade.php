@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                <x-card-header title="Editar Empresa" action="Atualizar"></x-card-header>

                 <x-form route="update" :id="$maintenance->id">
                  <div class="row">
                      <div class="col-6">
                            {{-- Funcionario --}}
                            <label for="employee_id" class="form-control-label">Funcionario</label>
                            <select name="employee_id" id="employee_id" class="form-control">
                                @foreach ($device_controls as $device_control)
                                    <option value="{{ $device_control->employee->id }}" {{ ($device_control->employee_id ?? old('employee_id')) == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- Entregue em --}}
                        <x-input col="6" set="" type="date" title="Entregue em" id="delivered_in" name="delivered_in" value="" placeholder="" disabled=""></x-input>
                        {{-- Ultima Manutenção --}}
                        <x-input col="6" set="" type="date" title="Ultima Manutenção" id="last_maintenance" name="last_maintenance" value="" placeholder="" disabled=""></x-input>
                        {{-- Proxima Manutenção --}}
                        <x-input col="6" set="" type="date" title="Proxima Manutenção" id="next_maintenance" name="next_maintenance" value="" placeholder="" disabled=""></x-input>
                      
                  </div>
                </x-form>

            </div>
        </div>
    </div>
@endsection
