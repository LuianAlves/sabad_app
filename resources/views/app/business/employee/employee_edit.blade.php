@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                <x-card-header title="Editar Empresa" action="Atualizar"></x-card-header>

                 <x-form route="update" :id="$employee->id">
                  <div class="row">
                      <div class="col-6">
                            <label for="company_id" class="form-control-label">Departamento / Empresa</label>
                            <div class="col-6">
                                
                                <select name="department_id" id="department_id" class="form-control">
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}" 
                                            {{ (old('department_id', $employee->department_id) == $department->id) ? 'selected' : '' }}>
                                           {{ $department->name . ' - ' . $department->company->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <x-input col="6" set="" type="text" title="Nome do Funcionário" id="name" name="name" value="{{ old('name', $employee->name ?? '') }}" placeholder="" />
                      <div class="col-6">
                        <div class="form-group">
                            <label for="hierarchical_level" class="form-control-label">Nível Hierárquico</label>
                            <select class="form-control" id="hierarchical_level" name="hierarchical_level" required>
                                @foreach (['Estagiário', 'Assistente', 'Analista', 'Supervisor', 'Coordenador', 'Gerente', 'Diretor'] as $level)
                                    <option value="{{ $level }}" {{ old('hierarchical_level', $employee->hierarchical_level) == $level ? 'selected' : '' }}>
                                        {{ $level }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                      <x-input col="6" set="" type="date" title="Contratado em" id="hired_in" name="hired_in" value="{{ old('hired_in', $employee->hired_in ?? '') }}" placeholder="" disabled=""></x-input>
                      <x-input col="6" set="" type="date" title="Dispensado em" id="fired_in" name="fired_in" value="{{ old('fired_in', $employee->fired_in ?? '') }}" placeholder="" disabled=""></x-input>
                      <div class="col-6">
                        <div class="form-group">
                            <label for="status" class="form-control-label">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="1" {{ ($employee->status ?? 1) == 1 ? 'selected' : '' }}>Ativo</option>
                                <option value="0" {{ ($employee->status ?? 1) == 0 ? 'selected' : '' }}>Inativo</option>
                            </select>
                        </div>
                    </div>
                  </div>
                </x-form>

            </div>
        </div>
    </div>
@endsection
