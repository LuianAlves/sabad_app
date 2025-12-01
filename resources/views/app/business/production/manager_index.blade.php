@extends('layouts.templates.production-order-layout')

@section('content')
    @can('view production_order')
        @php
            // Labels de status para usar na view
            $statusLabels = [
                'not_started'   => 'Não iniciada',
                'separated'     => 'Separado',
                'in_production' => 'Em produção',
                'finished'      => 'Finalizado',
            ];

            $statusData = $statusData ?? [];
            $icons      = $icons ?? [];
        @endphp

        <div class="row">
            @foreach ($statusData as $key => $data)
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div
                                    class="icon icon-shape bg-{{ $icons[$key]['bg'] ?? 'secondary' }} text-white rounded-circle d-flex justify-content-center align-items-center"
                                    style="width: 40px; height: 40px;">
                                    <i class="fas {{ $icons[$key]['icon'] ?? 'fa-info-circle' }}"
                                       style="margin-top: 3px !important; margin-bottom: auto !important;"></i>
                                </div>
                                <h6 class="ms-3 mb-0">
                                    {{ $data['label'] ?? ($statusLabels[$key] ?? ucfirst($key)) }}
                                </h6>
                            </div>

                            <p class="text-sm text-secondary mb-3">
                                @if ($key === 'finished')
                                    Foram finalizadas <b>{{ $data['count'] }}</b> OFs.
                                @elseif ($key === 'separated')
                                    Existem <b>{{ $data['count'] }}</b> OFs com material separado.
                                @elseif ($key === 'in_production')
                                    Atualmente há <b>{{ $data['count'] }}</b> OFs em produção.
                                @elseif ($key === 'not_started')
                                    Existem <b>{{ $data['count'] }}</b> OFs aguardando separação.
                                @else
                                    Total de <b>{{ $data['count'] }}</b> OFs neste status.
                                @endif
                            </p>

                            @if (!empty($data['latest']))
                                <span class="text-sm d-block">
                                Última OF: <b>{{ $data['latest']->order_number }}</b>
                                @if ($data['latest']->client_name)
                                        — {{ $data['latest']->client_name }}
                                    @endif
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="card border shadow-xs mb-4" style="height: calc(100vh - 37.5vh) !important;">
            @can('create production_order')
                @php
                    $canCreate = 'novo';
                @endphp
            @endcan

            <x-card-header title="Ordens de Produção" count="{{ $orders->count() }}" :action="$canCreate ?? ''"/>

            <x-table>
                <x-slot name="thead">
                    <tr class="text-center">
                        <th class="text-secondary text-xs font-weight-semibold opacity-7">
                            Nº OF
                        </th>
                        <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                            Cliente
                        </th>
                        <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                            Data OF
                        </th>
                        <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                            Expedição
                        </th>
                        <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                            Operador
                        </th>
                        <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                            Status
                        </th>
                        <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                            Ações
                        </th>
                    </tr>
                </x-slot>

                <x-slot name="tbody">
                    @foreach ($orders as $order)
                        <tr class="text-center">
                            <td>
                                <p class="text-secondary text-sm mb-0">
                                    {{ $order->order_number }}
                                </p>
                            </td>
                            <td>
                                <p class="text-secondary text-sm mb-0">
                                    {{ $order->client_name }}
                                </p>
                            </td>
                            <td>
                                <p class="text-secondary text-sm mb-0">
                                    {{ optional($order->order_date)->format('d/m/Y') }}
                                </p>
                            </td>
                            <td>
                                <p class="text-secondary text-sm mb-0">
                                    {{ optional($order->expedition_date)->format('d/m/Y') }}
                                </p>
                            </td>

                            {{-- OPERADOR --}}
                            <td>
                                <p class="text-secondary text-sm mb-0">
                                    {{ $order->production_operator_name ?? '-' }}
                                </p>
                            </td>

                            <td>
                                @php
                                    $status = $order->status;

                                    $statusClass = [
                                        'not_started'   => 'border-danger text-danger bg-danger',
                                        'separated'     => 'border-warning text-warning bg-warning',
                                        'in_production' => 'border-info text-info bg-info',
                                        'finished'      => 'border-success text-success bg-success',
                                    ];

                                    $statusIcon = [
                                        'not_started'   => 'fa-circle',
                                        'separated'     => 'fa-box-open',
                                        'in_production' => 'fa-industry',
                                        'finished'      => 'fa-check-circle',
                                    ];

                                    $statusLabel = [
                                        'not_started'   => 'Não iniciada',
                                        'separated'     => 'Separado',
                                        'in_production' => 'Em produção',
                                        'finished'      => 'Finalizado',
                                    ];
                                @endphp

                                <form action="{{ route('manager.update', $order) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="action" value="cycle_status">

                                    <button type="submit"
                                            class="btn btn-link m-0 p-0 border-0 bg-transparent text-decoration-none">
                                    <span
                                        class="badge badge-sm {{ $statusClass[$status] ?? 'border-secondary text-secondary bg-light' }}">
                                        <i class="fa {{ $statusIcon[$status] ?? 'fa-info-circle' }}"
                                           aria-hidden="true"></i>
                                        {{ $statusLabel[$status] ?? ucfirst($status) }}
                                    </span>
                                    </button>
                                </form>
                            </td>

                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-toggle text-dark" type="button" id="dropdown-table"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false" style="border: none; background: none;">
                                        <small style="font-weight: 500; letter-spacing: 0.25px;">Ações</small>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdown-table"
                                        style="font-size: 12px !important;">
                                        @can('view production_order')
                                            <li>
                                                <a class="dropdown-item" href="{{ route('manager.show', $order->id) }}">
                                                    <i class="fa-solid fa-expand text-primary"></i>
                                                    <span class="ms-2">Visualizar registro</span>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('edit production_order')

                                            <li class="my-1">
                                                <a class="dropdown-item" href="{{ route('manager.edit', $order->id) }}">
                                                    <i class="fa-solid fa-pen-to-square text-success"></i>
                                                    <span class="ms-2">Editar registro</span>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('delete production_order')

                                            <hr class="text-muted py-1 m-0">
                                            <li>
                                                <form id="delete-form-{{ $order->id }}"
                                                      action="{{ route('manager.destroy', $order->id) }}" method="POST"
                                                      style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>

                                                <a href="#" class="dropdown-item"
                                                   onclick="event.preventDefault(); if(confirm('Tem certeza que deseja remover esse registro?')) { document.getElementById('delete-form-{{ $order->id }}').submit(); }">
                                                    <i class="fa-solid fa-trash-can text-danger"></i>
                                                    <span class="ms-2">Excluir registro</span>
                                                </a>

                                            </li>
                                        @endcan
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-table>
        </div>
    @endcan
@endsection
