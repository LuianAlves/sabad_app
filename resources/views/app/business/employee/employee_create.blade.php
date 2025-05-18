@extends('layouts.templates.app-layout')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

            <x-card-header title="Novo Funcionário" action="Cadastrar" />

            <x-form route="store">
                <div class="row">
                    {{-- Departamento --}}
                    <div class="col-6">
                        <label for="department_id" class="form-control-label">Departamento</label>
                        <select name="department_id" id="department_id" class="form-control" required>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Nome --}}
                    <x-input col="6" set="" type="text" title="Nome do Funcionário" id="name"
                        name="name" value="{{ old('name') }}" placeholder="Ex: João Silva" />

                    {{-- Nível Hierárquico --}}
                    <div class="col-6">
                        <div class="form-group">
                            <label for="hierarchical_level" class="form-control-label">Nível Hierárquico</label>
                            <select class="form-control" id="hierarchical_level" name="hierarchical_level" required>
                                @foreach (['Estagiário', 'Assistente', 'Analista', 'Supervisor', 'Coordenador', 'Gerente', 'Diretor'] as $level)
                                    <option value="{{ $level }}" {{ old('hierarchical_level') == $level ? 'selected' : '' }}>{{ $level }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Datas --}}
                    <x-input col="6" set="" type="date" title="Contratado em" id="hired_in"
                        name="hired_in" value="{{ old('hired_in') }}" />

                    <x-input col="6" set="" type="date" title="Dispensado em" id="fired_in"
                        name="fired_in" value="{{ old('fired_in') }}" />

                    {{-- Status --}}
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
            </x-form>
        </div>
    </div>
</div>
@endsection
