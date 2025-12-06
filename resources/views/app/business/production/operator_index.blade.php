@extends('layouts.templates.production-order-layout')

@section('content')
    @push('styles')
        <style>
            /* ZEBRA PARA A TABELA DE PRODUÇÃO */
            .card tbody tr:nth-child(odd) {
                background-color: #ffffff; /* linha mais clara */
            }

            .card tbody tr:nth-child(even) {
                background-color: #f3f4f6; /* linha um pouco mais escura */
            }

            /* opcional: deixar as linhas mais “compactas” */
            .card tbody tr > td {
                padding-top: 0.4rem;
                padding-bottom: 0.4rem;
            }
        </style>
    @endpush

    {{--    Testei permissão de iniciar, resolvi bug do botão finaliza aparecer sem permissões. Próximo é testar permissão de finish --}}
    @can('view operator order_production')
        <div class="card border shadow-xs mb-4">
            <x-card-header title="Produção" count="{{ $orders->count() }}" action=""/>

            <x-table>
                <x-slot name="thead">
                    <tr class="text-center">
                        <th>Nº OF</th>
                        <th>Cliente</th>
                        <th>Data OF</th>
                        <th>Expedição</th>
                        <th>Status</th>
                        <th>Operador</th>
                        @canany(['start operator order_production', 'finish operator order_production'])
                            <th>Ações</th>
                        @endcanany
                    </tr>
                </x-slot>

                <x-slot name="tbody">
                    @forelse ($orders as $order)
                        @php
                            $status = $order->status;

                            $statusClass = [
                                'separated'     => 'border-info text-info bg-info',
                                'in_production' => 'border-warning text-warning bg-warning',
                            ];

                            $statusIcon = [
                                'separated'     => 'fa-box-open',
                                'in_production' => 'fa-industry',
                            ];

                            $statusLabel = [
                                'separated'     => 'Separado',
                                'in_production' => 'Em produção',
                            ];
                        @endphp

                        <tr class="text-center">
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->client_name }}</td>
                            <td>{{ optional($order->order_date)->format('d/m/Y') }}</td>
                            <td>{{ optional($order->expedition_date)->format('d/m/Y') }}</td>

                            {{-- STATUS --}}
                            <td>
                                <span
                                    class="badge badge-sm {{ $statusClass[$status] ?? 'border-secondary text-secondary bg-light' }}">
                                    <i class="fa {{ $statusIcon[$status] ?? 'fa-info-circle' }}" aria-hidden="true"></i>
                                    {{ $statusLabel[$status] ?? $status }}
                                </span>
                            </td>

                            {{-- OPERADOR --}}
                            <td>
                                {{ $order->production_operator_name ?? '-' }}
                            </td>

                            {{-- AÇÕES --}}
                            <td>
                                @if ($order->status === 'separated')
                                    @can('start operator order_production')
                                        <button type="button"
                                                class="btn btn-sm btn-warning btn-start-production m-0"
                                                data-url="{{ route('operator.start', $order->id) }}"
                                                data-finish-url="{{ route('operator.finish', $order->id) }}"
                                                data-id="{{ $order->id }}">
                                            Iniciar
                                        </button>
                                    @endcan
                                @elseif ($order->status === 'in_production')
                                    @can('finish operator order_production')
                                        <button type="button"
                                                class="btn btn-sm btn-success btn-finish-production m-0"
                                                data-url="{{ route('operator.finish', $order->id) }}"
                                                data-id="{{ $order->id }}">
                                            Finalizar
                                        </button>
                                    @endcan
                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                Nenhuma OF separada ou em produção.
                            </td>
                        </tr>
                    @endforelse
                </x-slot>
            </x-table>
        </div>

        <script>
            (function () {
                const CSRF = '{{ csrf_token() }}';

                // Flag de permissão vinda do backend
                const CAN_FINISH = @json(auth()->user()->can('finish operator order_production'));

                document.addEventListener('click', async (event) => {
                    const startBtn = event.target.closest('.btn-start-production');
                    const finishBtn = event.target.closest('.btn-finish-production');

                    // ===== INICIAR PRODUÇÃO =====
                    if (startBtn) {
                        const url = startBtn.dataset.url;
                        if (!url) return;

                        const operatorName = prompt('Nome do operador:');
                        if (!operatorName) return;

                        try {
                            const res = await fetch(url, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': CSRF,
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify({ operator_name: operatorName }),
                            });

                            const data = await res.json();

                            if (!res.ok || !data.ok) {
                                alert(data.error || 'Erro ao iniciar produção.');
                                return;
                            }

                            const order = data.order;
                            const row = startBtn.closest('tr');
                            if (!row) return;

                            // Atualiza status visual
                            const statusCell = row.querySelector('td:nth-child(5) span');
                            if (statusCell) {
                                statusCell.className = 'badge badge-sm border-warning text-warning bg-warning';
                                statusCell.innerHTML = '<i class="fa fa-industry" aria-hidden="true"></i> Em produção';
                            }

                            // Atualiza operador
                            const operatorCell = row.querySelector('td:nth-child(6)');
                            if (operatorCell) {
                                operatorCell.textContent = order.production_operator_name || operatorName;
                            }

                            // Cria botão de finalizar SOMENTE se tiver permissão
                            if (CAN_FINISH) {
                                const finishUrl = startBtn.dataset.finishUrl;
                                startBtn.outerHTML = `
                                    <button type="button"
                                            class="btn btn-sm btn-success btn-finish-production m-0"
                                            data-url="${finishUrl}"
                                            data-id="${order.id}">
                                        Finalizar
                                    </button>
                                `;
                            } else {
                                // Sem permissão pra finalizar, remove o botão de iniciar
                                startBtn.remove();
                            }

                        } catch (e) {
                            console.error(e);
                            alert('Erro na comunicação com o servidor.');
                        }

                        return;
                    }

                    // ===== FINALIZAR PRODUÇÃO =====
                    if (finishBtn) {
                        const url = finishBtn.dataset.url;
                        if (!url) return;

                        if (!confirm('Confirmar finalização desta OF?')) {
                            return;
                        }

                        try {
                            const res = await fetch(url, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': CSRF,
                                    'Accept': 'application/json',
                                },
                            });

                            const data = await res.json();

                            if (!res.ok || !data.ok) {
                                alert(data.error || 'Erro ao finalizar produção.');
                                return;
                            }

                            const row = finishBtn.closest('tr');
                            if (row) row.remove();

                        } catch (e) {
                            console.error(e);
                            alert('Erro na comunicação com o servidor.');
                        }
                    }
                });
            })();
        </script>
    @endcan
@endsection
