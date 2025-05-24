@extends('layouts.templates.app-layout')

@section('content')
    <div class="row">
        <div class="col-3">
            <div class="card border shadow-xs">
                <div class="card-body text-start p-3 w-100">
                    <div
                        class="icon icon-shape icon-sm bg-info text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                        <i class="fas fa-envelope-open-text text-white" style="font-size: 18px;"></i>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="w-100">
                                <h6 class="mb-2 font-weight-bold">Em aberto</h6>
                                <p class="text-sm text-secondary mb-3">Atualmente há <b>17</b> chamados em aberto.
                                </p>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="">
                                        <span class="text-sm">O chamado de <b>Fábio Berges</b> é o mais recente.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card border shadow-xs">
                <div class="card-body text-start p-3 w-100">
                    <div
                        class="icon icon-shape icon-sm bg-warning text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                        <i class="fas fa-spinner text-white" style="font-size: 18px;"></i>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="w-100">
                                <h6 class="mb-2 font-weight-bold">Em andamento</h6>
                                <p class="text-sm text-secondary mb-3">Atualmente há <b>05</b> chamados em andamento.
                                </p>
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="text-sm">Última movimentação - <b>Alessandro Maucci</b></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card border shadow-xs">
                <div class="card-body text-start p-3 w-100">
                    <div
                        class="icon icon-shape icon-sm bg-success text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                        <i class="fas fa-check-circle text-white" style="font-size: 18px;"></i>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="w-100">
                                <h6 class="mb-2 font-weight-bold">Concluído</h6>
                                <p class="text-sm text-secondary mb-3">Foram concluídos <b>85</b> chamados no mês.
                                </p>
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="text-sm">Concluído recentemente - <b>Reginaldo Andrade</b></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card border shadow-xs">
                <div class="card-body text-start p-3 w-100">
                    <div
                        class="icon icon-shape icon-sm bg-danger text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                        <i class="fas fa-times-circle text-white" style="font-size: 18px;"></i>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="w-100">
                                <h6 class="mb-2 font-weight-bold">Cancelado</h6>
                                <p class="text-sm text-secondary mb-3">Total de <b>27</b> chamados cancelados
                                </p>
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="text-sm">Cancelado recentemente - <b>Elaine Cristina</b></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 37.5vh) !important;">
                <x-card-header title="Chamados" count="" action="novo"></x-card-header>

                <x-table>
                    <x-slot name="thead">
                        <tr class="text-center">
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Usuário</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Assunto</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Status</th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        <tr class="text-center">
                            <td>
                                <p class="text-secondary text-sm mb-0">Fábio Berges</p>
                            </td>
                            <td>
                                <p class="text-secondary text-sm mb-0">Problema com outlook</p>
                            </td>
                            <td>
                                <span class="badge badge-sm border border-info text-info bg-info">
                                    <i class="fa fa-envelope-open-text" aria-hidden="true"></i>
                                    Em aberto
                                </span>
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td>
                                <p class="text-secondary text-sm mb-0">Alessandro Maucci</p>
                            </td>
                            <td>
                                <p class="text-secondary text-sm mb-0">Notebook sem internet</p>
                            </td>
                            <td>
                                <span class="badge badge-sm border border-warning text-warning bg-warning">
                                    <i class="fa fa-spinner" aria-hidden="true"></i>
                                    Em andamento
                                </span>
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td>
                                <p class="text-secondary text-sm mb-0">Reginaldo Andrade</p>
                            </td>
                            <td>
                                <p class="text-secondary text-sm mb-0">Alguma coisa com site</p>
                            </td>
                            <td>
                                <span class="badge badge-sm border border-success text-success bg-success">
                                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                                    Concluído
                                </span>
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td>
                                <p class="text-secondary text-sm mb-0">Elaine Cristina</p>
                            </td>
                            <td>
                                <p class="text-secondary text-sm mb-0">Impressora sem imprimir</p>
                            </td>
                            <td>
                                <span class="badge badge-sm border border-danger text-danger bg-danger">
                                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    Cancelado
                                </span>
                            </td>
                        </tr>
                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
@endsection
