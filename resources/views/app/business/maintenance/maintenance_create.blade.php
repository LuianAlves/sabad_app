@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                <x-card-header title="Nova Manutenção" action="Cadastrar"></x-card-header>

                <x-form route="store">
                  <div class="row">

                        <div class="col-6">
                            {{-- Dispositivo --}}
                            <label for="device_control_id" class="form-control-label">Tipo de Dispositivo</label>
                            <select name="device_control_id" id="device_control_id" class="form-control">
                                @foreach ($deviceControls as $control)
                                
                                    <option value="{{ $control->id }}"> 
                                        {{ $control->device->deviceType->name.' - '. $control->device->deviceBrand->name.' - '. $control->employee->name }}
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
