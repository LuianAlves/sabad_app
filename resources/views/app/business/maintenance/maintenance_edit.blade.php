@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                <x-card-header title="Editar Manutenção" action="Atualizar"></x-card-header>

                 <x-form route="update" :id="$maintenance->id">
                  <div class="row">
                      <div class="col-6">
                            {{-- Funcionario --}}
                            <label for="device_control_id" class="form-control-label">Dispositivo</label>
                            <select name="device_control_id" id="device_control_id" class="form-control">
                                @foreach ($device_controls as $device_control)
                                    @php
                                        $employee = $device_control->employee;
                                    @endphp
                                    
                                        @if ($employee)
                                            <option value="{{ $device_control->id }}"
                                                {{ old('device_control_id', $maintenance->device_control_id) == $device_control->id ? 'selected' : '' }}>
                                                {{ $device_control->device->deviceType->name . ' - ' .
                                                $device_control->device->deviceBrand->name . ' - ' .
                                                $device_control->employee->name }}
                                            </option>
                                        @endif
                                    
                                @endforeach

                            </select>
                        </div>
                        {{-- Entregue em --}}
                        <x-input col="6" set="" type="date" title="Entregue em" id="delivered_in" name="delivered_in" value="{{ old('delivered_in', $maintenance->delivered_in ?? '') }}" placeholder="" disabled=""></x-input>
                        {{-- Ultima Manutenção --}}
                        <x-input col="6" set="" type="date" title="Ultima Manutenção" id="last_maintenance" name="last_maintenance" value="{{ old('delivered_in', $maintenance->last_maintenance ?? '') }}" placeholder="" disabled=""></x-input>
                        {{-- Proxima Manutenção --}}
                        <x-input col="6" set="" type="date" title="Proxima Manutenção" id="next_maintenance" name="next_maintenance" value="{{ old('delivered_in', $maintenance->next_maintenance ?? '') }}" placeholder="" disabled=""></x-input>
                      
                  </div>
                </x-form>

            </div>
        </div>
    </div>
@endsection
