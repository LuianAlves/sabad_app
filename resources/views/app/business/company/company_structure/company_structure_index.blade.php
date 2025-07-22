

@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                <div class="card-header border-bottom pb-0">
                    <div class="d-sm-flex align-items-center mb-3">
                        <div class="d-flex align-items-center">
                            <div class="mx-3">
                                <h6 class="font-weight-semibold text-lg mb-0">Estrutura Salarial – {{ $company->name }}</h6>
                                <p class="text-sm mb-sm-0">Última modificação foi realizada há 15 minutos</p>
                            </div>
                        </div>
                        <div class="ms-auto d-flex">
                            <div class="input-group input-group-sm ms-auto me-2">
                                 <span class="input-group-text text-body">
                                     <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="none"
                                          viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                         <path stroke-linecap="round" stroke-linejoin="round"
                                               d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
                                     </svg>
                                 </span>
                                <input type="text" class="form-control form-control-sm" id="inputPesquisarTabela"
                                       placeholder="Pesquisar ..">
                            </div>

                            <a href="{{route('companies.applyAdjustment', $company)}}" type="button" class="btn btn-sm btn-warning btn-icon d-flex align-items-center mb-0">
                                <span class="btn-inner--text">Dissídio {{ $company->union->current_adjustment_percent ?? 0 }}%</span>
                            </a>

                        </div>
                    </div>
                </div>

                <x-table>
                    <x-slot name="thead">
                        <tr class="text-center">
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Cargo</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Nível</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Faixa</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Salário</th>
                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7"></th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach($company->hierarchicalLevels as $level)
                            @foreach($level->tierLevels as $tier)
                                @foreach($tier->salaryBands as $band)
                                    <tr class="text-center">
                                        <td>
                                            <p class="text-dark fw-bold text-sm mb-0">{{ $level->name }}</p>
                                        </td>
                                        <td><p class="text-dark text-sm mb-0">{{ $tier->name }}</p></td>
                                        <td><p class="text-dark text-sm mb-0">{{ $band->band }}</p></td>
                                        <td>R$ {{ number_format($band->salary,2,',','.') }}</td>
                                        <td>
                                            <a href="{{ route('salary_bands.edit', $band) }}">Editar</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @endforeach
                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
@endsection
