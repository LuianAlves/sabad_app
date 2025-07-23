@extends('layouts.templates.app-layout')

@section('content')
    <div class="container">
        <h1 class="mb-4">Relatório de Custos por Funcionário</h1>

        {{-- Filtros --}}
        <form method="GET" action="{{ route('cost.report') }}" class="row g-3 mb-4">
            <div class="col-md-4">
                <label for="company_id" class="form-label">Empresa</label>
                <select name="company_id" id="company_id" class="form-select" onchange="this.form.submit()">
                    <option value="">-- selecione --</option>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}" {{ $selectedCompany == $company->id ? 'selected' : '' }}>
                            {{ $company->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="department_id" class="form-label">Departamento</label>
                <select name="department_id" id="department_id" class="form-select" onchange="this.form.submit()">
                    <option value="">-- selecione --</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" {{ $selectedDepartment == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        {{-- Tabela de Resultados --}}
        @if($employees->count())
            <table class="table table-bordered table-striped mt-4">
                <thead class="table-dark">
                <tr>
                    <th>Funcionário</th>
                    <th>Dispositivo</th>
                    <th>Patrimônio</th>
                    <th>Salário</th>
{{--                    <th>Serviços</th>--}}
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($employees as $emp)
                    @php
                        $employee = $emp->employeeUser?->employee;
                        $department = $employee?->department;

                        $device = $employee?->deviceControl?->estimated_price ?? 0;

                        // Total de patrimônios do departamento
                        $heritageTotal = $department?->heritageControls?->sum('estimated_price') ?? 0;

                        // Total de funcionários do departamento (evitando divisão por zero)
                        $employeeCount = $department?->employees?->count() ?: 1;

                        // Média por funcionário
                        $heritage = $heritageTotal / $employeeCount;

                        $salary = $employee->salaryBand?->salary ?? 0;
                    //                        $services = $department?->services?->sum('price')                   ?? 0;

                        $total = $device + $heritage + $salary;
                    //                         + $services
                    @endphp

                    <tr>
                        <td>{{ $emp->name }}</td>
                        <td>R$ {{ number_format($device, 2, ',', '.') }}</td>
                        <td>R$ {{ number_format($heritage, 2, ',', '.') }}</td>
                        <td>R$ {{ number_format($salary, 2, ',', '.') }}</td>
{{--                        <td>R$ {{ number_format($services, 2, ',', '.') }}</td>--}}
                        <td><strong>R$ {{ number_format($total, 2, ',', '.') }}</strong></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @elseif($selectedCompany && $selectedDepartment)
            <div class="alert alert-info mt-4">
                Nenhum funcionário encontrado para a empresa e departamento selecionados.
            </div>
        @endif
    </div>
@endsection
