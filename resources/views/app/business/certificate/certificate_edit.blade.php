@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                <x-card-header title="Editar Certificado" action="Atualizar"></x-card-header>

                <x-form route="update" :id="$certificate->id">
                    <div class="row">

                        {{-- Responsável --}}
                        <div class="col-6">
                            <label for="employee_id" class="form-control-label">Responsável</label>
                            <select name="employee_id" id="employee_id" class="form-control">
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}" 
                                        {{ (old('employee_id', $certificate->employee_id) == $employee->id) ? 'selected' : '' }}>
                                        {{ $employee->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Data de criação --}}
                        <x-input col="6" set="" type="date" title="Data de criação" id="creation_date" name="creation_date"
                            value="{{ old('creation_date', $certificate->creation_date ?? '') }}" placeholder="" />

                        {{-- Data de renovação --}}
                        <x-input col="6" set="" type="date" title="Data de renovação" id="renewal_date" name="renewal_date"
                            value="{{ old('renewal_date', $certificate->renewal_date ?? '') }}" placeholder="" />

                        {{-- Última renovação --}}
                        <x-input col="6" set="" type="date" title="Última renovação" id="last_renovation" name="last_renovation"
                            value="{{ old('last_renovation', $certificate->last_renovation ?? '') }}" placeholder="" />

                        {{-- Status --}}
                        <div class="col-6">
                            <label for="status" class="form-control-label">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="1" {{ old('status', $certificate->status ?? 1) == 1 ? 'selected' : '' }}>Ativo</option>
                                <option value="0" {{ old('status', $certificate->status ?? 1) == 0 ? 'selected' : '' }}>Inativo</option>
                            </select>
                        </div>
                    </div>
                </x-form>

            </div>
        </div>
    </div>
@endsection
