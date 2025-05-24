@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                <x-card-header title="Novo E-mail" action="Cadastrar" />

                <x-form route="store">
                    <div class="row">
                        <div class="col-6">
                        {{-- Funcionario --}}
                            <label for="employee_id" class="form-control-label">Funcionário – Departamento</label>
                                <select name="employee_id" id="employee_id" class="form-control" required>
                                    <option value="">Selecione um Funcionário</option>
                                    @foreach($companies as $company)
                                        <optgroup label="{{ $company->name }}">
                                            @foreach($company->departments as $department)
                                                @foreach($department->employees as $employee)
                                                    <option value="{{ $employee->id }}"
                                                        {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                                        {{ $employee->name . ' - ' . $department->name }}
                                                    </option>
                                                @endforeach
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>

                                {{-- Licença --}}
                                <label for="license_id" class="form-control-label">Licença</label>
                                <select name="license_id" id="license_id" class="form-control" required>
                                    <option value="">Selecione uma Licença</option>
                                                @foreach($licenses as $license)
                                                    <option value="{{ $license->id }}"
                                                        {{ old('license_id') == $license->id ? 'selected' : '' }}>
                                                        {{ $license->name }}
                                                    </option>
                                                @endforeach
                                        </optgroup>
                                </select>

                        {{-- E-mail --}}
                        <x-input col="6" set="" type="text" title="E-mail" id="email"
                            name="email" value="{{ old('email') }}" placeholder="" />

                        {{-- Password --}}
                        <x-input col="6" set="" type="text" title="Password" id="password"
                            name="password" value="{{ old('password') }}" placeholder="" />

                        <label for="alias[]">Alias</label>
                        <input type="text" name="alias[]" class="form-control" placeholder="Ex: alias1@empresa.com">

                        <div class="col-6">
                        <div class="form-group">
                            <label for="is_active" class="form-control-label">Status</label>
                            <select class="form-control" id="is_active" name="is_active">
                                <option value="1" {{ ($domain->is_active ?? 1) == 1 ? 'selected' : '' }}>Ativo</option>
                                <option value="0" {{ ($domain->is_active ?? 1) == 0 ? 'selected' : '' }}>Inativo</option>
                            </select>
                        </div>
                        </div>
                    </div>
                </x-form>
            </div>
        </div>
    </div>
@endsection
