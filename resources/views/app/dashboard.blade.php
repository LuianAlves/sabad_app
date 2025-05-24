@extends('layouts.templates.app-layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="d-md-flex align-items-center mb-3 mx-2">
                <div class="mb-md-0 mb-3">
                    <h3 class="font-weight-bold mb-0">Olá, {{ auth()->user()->name }}</h3>
                    <p class="mb-0">Clique <a href="#" class="text-warning">aqui</a> para visualizar suas <b>(7)</b>
                        notificações novas.</p>
                </div>
                <button type="button"
                    class="btn btn-sm btn-white btn-icon d-flex align-items-center mb-0 ms-md-auto mb-sm-0 mb-2 me-2">
                    <span class="btn-inner--icon">
                        <span class="p-1 bg-success rounded-circle d-flex ms-auto me-2">
                            <span class="visually-hidden">New</span>
                        </span>
                    </span>
                    <span class="btn-inner--text">(41) Online</span>
                </button>
                <button type="button" class="btn btn-sm btn-warning btn-icon d-flex align-items-center mb-0">
                    <span class="btn-inner--icon">
                        <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="d-block me-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                    </span>
                    <span class="btn-inner--text">Atualizar dados</span>
                </button>
            </div>
        </div>
    </div>

    <hr class="my-0 mb-4">

    <!-- Contratações recentes -->
    <div class="row mb-4" style="padding-right: 10px;">
        <div class="col-6">
            <div class="row h-100">
                <div class="col-12">
                    <div class="card border shadow-xs">
                        <div class="card-body text-start p-3 w-100">
                            <div
                                class="icon icon-shape icon-sm bg-warning text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-desktop text-white" style="font-size: 18px;"></i>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100">
                                        <h6 class="mb-2 font-weight-bold">Dispositivos</h6>
                                        <p class="text-sm text-secondary mb-3">Total de 97/<b>103</b> operando normalmente
                                        </p>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="">
                                                <span class="text-sm text-success font-weight-bolder">
                                                    <i class="fa fa-chevron-up text-xs me-1"></i>3%
                                                </span>
                                                <span class="text-sm">de 100 dispositivos</span>
                                            </div>

                                            <a href="{{ route('device.index') }}"><small class="font-weight-bold text-warning">Ver todos</small></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 my-3">
                    <div class="card border shadow-xs">
                        <div class="card-body text-start p-3 w-100">
                            <div
                                class="icon icon-shape icon-sm bg-warning text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-id-badge text-white" style="font-size: 18px;"></i>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100">
                                        <h6 class="mb-2 font-weight-bold">Funcionários</h6>
                                        <p class="text-sm text-secondary mb-3">Total de <b>150</b> trabalhando normalmente
                                        </p>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="">
                                                <span class="text-sm text-success font-weight-bolder">
                                                    <i class="fa fa-chevron-up text-xs me-1"></i>10%
                                                </span>
                                                <span class="text-sm">de 135 funcionários</span>
                                            </div>

                                            <a href="{{ route('employee.index') }}"><small class="font-weight-bold text-warning">Ver todos</small></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card border shadow-xs">
                        <div class="card-body text-start p-3 w-100">
                            <div
                                class="icon icon-shape icon-sm bg-warning text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                            <i class="fas fa-concierge-bell text-white" style="font-size: 18px;"></i>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100">
                                        <h6 class="mb-2 font-weight-bold">Serviços</h6>
                                        <p class="text-sm text-secondary mb-3">Total de 21/<b>27</b> serviços ativos
                                        </p>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="">
                                                <span class="text-sm text-info font-weight-bolder">
                                                    0%
                                                </span>
                                                <span class="text-sm">de 27 serviços</span>
                                            </div>

                                            <a href="{{ route('service.index') }}"><small class="font-weight-bold text-warning">Ver todos</small></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6" style="max-height: 700px;">
            <div class="row h-100">
                <div class="card shadow-xs border">
                    <div class="card-header border-bottom pb-0">
                        <div class="d-sm-flex align-items-center mb-3">
                            <div>
                                <h6 class="font-weight-semibold text-lg mb-0">Contratações recentes</h6>
                                <p class="text-sm mb-sm-0 mb-2">Funcionários admitidos nos últimos 90 dias.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 py-0">
                        <div class="table-responsive p-0" style="max-height: 425px; overflow-y: auto;">
                            <table class="table align-items-center justify-content-center mb-0">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                            Funcionário</th>
                                        <th class="text-center text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                            Admitido em</th>
                                        <th class="text-center text-secondary text-xs font-weight-semibold opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentEmployees as $employee)
                                        <tr class="text-center">
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <div class="ms-2">
                                                        <p class="text-dark fw-bold text-sm mb-0">{{ $employee->name }}</p>
                                                        <p class="text-secondary text-sm mb-0">
                                                            {{ $employee->department->name }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-normal mb-0">{{ $employee->hired_in }}</p>
                                            </td>
                                            <td>
                                                <a href="{{ route('employee.show', $employee->id) }}"
                                                    class="text-warning font-weight-bold text-xs" data-bs-toggle="tooltip"
                                                    data-bs-title="Ver mais">Ler mais
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
    <!-- Gráfico de departamentos/funcionários -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-xs border h-100 p-3">
                <h6 class="mb-3">Relação de departamentos por empresa</h6>

                @php
                    $companies = \App\Models\Business\Company\Company::all();
                @endphp

                <div class="btn-group" role="group" aria-label="Filtro por empresa">
                    <input type="radio" class="btn-check" name="companyFilter" id="company_all" value="all"
                        autocomplete="off" checked>
                    <label class="btn btn-white px-3 mb-0" for="company_all">Todos</label>

                    @foreach ($companies as $company)
                        <input type="radio" class="btn-check" name="companyFilter" id="company_{{ $company->id }}"
                            value="{{ $company->id }}" autocomplete="off">
                        <label class="btn btn-white px-3 mb-0" for="company_{{ $company->id }}"
                            title="{{ $company->name }}">{{ Str::words($company->name, 1, '...') }}</label>
                    @endforeach
                </div>

                <div class="card-body py-3">
                    <div id="employeeChartLoader" class="text-center py-5">
                        <div class="spinner-border text-warning" role="status">
                            <span class="visually-hidden">Carregando...</span>
                        </div>
                        <p class="mt-2 mb-0">Carregando gráfico...</p>
                    </div>

                    <div id="employeeChartWrapper" style="display: none;">
                        <canvas id="employeeChart"></canvas>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-end">
                    <a href="{{ route('employee.index') }}" class="btn btn-white mb-0 ms-auto">Ver todos</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/common/charts/chart.js') }}"></script>
@endsection
