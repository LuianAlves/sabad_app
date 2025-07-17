@extends('layouts.templates.app-layout')

@section('content')
    <form method="POST" action="{{ route('record_controls.store', $department) }}">
        @csrf


        @php
            $user = auth()->user();
            $employee = $user->employeeUser->employee ?? null;
            $department = $employee->department ?? null;
            $company = $department->company ?? null;
        @endphp

        <p><strong>Funcionário:</strong> {{ $user->name }}</p>
        <p><strong>Departamento:</strong>
            {{ $department->name ?? 'Não definido' }} /
            {{ $company->name ?? 'Não definido' }}
        </p>

        <input type="hidden" name="employee_id" value="{{ $employee->id ?? '' }}">
        <input type="hidden" name="department_id" value="{{ $department->id ?? '' }}">


        <input name="identificacao" class="form-control mb-2" placeholder="Identificação do Registro" required>
        <input name="forma_armazenamento" class="form-control mb-2" placeholder="Forma de Armazenamento" required>
        <input name="local_armazenamento" class="form-control mb-2" placeholder="Local de Armazenamento" required>
        <input name="acesso_permitido" class="form-control mb-2" placeholder="Acesso Permitido" required>
        <input name="tempo_retencao" class="form-control mb-2" placeholder="Tempo de Retenção" required>
        <input name="metodo_manutencao" class="form-control mb-2" placeholder="Método de Manutenção" required>

        <button class="btn btn-success">Salvar</button>
    </form>

@endsection
