@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                <x-card-header title="Novo Funcionário" action="Cadastrar"></x-card-header>

                <x-form route="store">
                  <div class="row">
                      <div class="col-6">
                            <label for="department_id" class="form-control-label">Departamento</label>
                            <select name="department_id" id="department_id" class="form-control">
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}" {{ ($employee->department_id ?? old('department_id')) == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                      <x-input col="6" set="" type="text" title="Nome do Funcionário" id="name" name="name" value="" placeholder="" disabled=""></x-input>
                      <div class="col-6">
                        <div class="form-group">
                            <label for="hierarchical_level" class="form-control-label">Nível Hierárquico</label>
                                <select class="form-control" id="hierarchical_level" name="hierarchical_level">
                                    <option value="Estagiário" {{ ($employee->hierarchical_level ?? '') == 'Estagiário' ? 'selected' : '' }}>Estagiário</option>
                                    <option value="Assistente" {{ ($employee->hierarchical_level ?? '') == 'Assistente' ? 'selected' : '' }}>Assistente</option>
                                    <option value="Analista" {{ ($employee->hierarchical_level ?? '') == 'Analista' ? 'selected' : '' }}>Analista</option>
                                    <option value="Supervisor" {{ ($employee->hierarchical_level ?? '') == 'Supervisor' ? 'selected' : '' }}>Supervisor</option>
                                    <option value="Coordenador" {{ ($employee->hierarchical_level ?? '') == 'Coordenador' ? 'selected' : '' }}>Coordenador</option>
                                    <option value="Gerente" {{ ($employee->hierarchical_level ?? '') == 'Gerente' ? 'selected' : '' }}>Gerente</option>
                                    <option value="Diretor" {{ ($employee->hierarchical_level ?? '') == 'Diretor' ? 'selected' : '' }}>Diretor</option>
                                </select>
                        </div>

                    </div>
                      <x-input col="6" set="" type="date" title="Contratado em" id="hired_in" name="hired_in" value="" placeholder="" disabled=""></x-input>
                      <x-input col="6" set="" type="date" title="Dispensado em" id="fired_in" name="fired_in" value="" placeholder="" disabled=""></x-input>
                      <div class="col-6">
                        <div class="form-group">
                            <label for="is_active" class="form-control-label">Status</label>
                            <select class="form-control" id="is_active" name="is_active">
                                <option value="1" {{ ($employee->is_active ?? 1) == 1 ? 'selected' : '' }}>Ativo</option>
                                <option value="0" {{ ($employee->is_active ?? 1) == 0 ? 'selected' : '' }}>Inativo</option>
                            </select>
                        </div>
                    </div>
                  </div>
                </x-form>
            </div>
        </div>
    </div>
@endsection
