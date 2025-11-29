@extends('layouts.templates.app-layout')

@section('content')
    @php
        // Labels de status para usar na view
        $statusLabels = [
            'not_started'   => 'Não iniciada',
            'separated'     => 'Separado',
            'in_production' => 'Em produção',
            'finished'      => 'Finalizado',
        ];

        // garante que existam arrays, mesmo se o controller não mandar
        $statusData = $statusData ?? [];
        $icons      = $icons ?? [];
    @endphp

    {{-- CARDS DE STATUS (topo) --}}
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

    {{-- TABELA DE OFs --}}
    <div class="card border shadow-xs mb-4" style="height: calc(100vh - 37.5vh) !important;">
        <x-card-header title="Ordens de Produção" count="{{ $orders->count() }}" action="novo"/>

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

                        {{-- STATUS (badge clicável que muda o status) --}}
                        <td>
                            @php
                                $status = $order->status;

                                $statusClass = [
                                    'not_started'   => 'border-secondary text-secondary bg-light',
                                    'separated'     => 'border-info text-info bg-info',
                                    'in_production' => 'border-warning text-warning bg-warning',
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
                                        class="btn btn-link p-0 border-0 bg-transparent text-decoration-none">
                                    <span class="badge badge-sm {{ $statusClass[$status] ?? 'border-secondary text-secondary bg-light' }}">
                                        <i class="fa {{ $statusIcon[$status] ?? 'fa-info-circle' }}" aria-hidden="true"></i>
                                        {{ $statusLabel[$status] ?? ucfirst($status) }}
                                    </span>
                                </button>
                            </form>
                        </td>

                        {{-- AÇÕES padrão (editar / excluir etc via componente) --}}
                        <td>
                            <x-table-button route="manager" :id="$order->id"></x-table-button>
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-table>
    </div>
@endsection
