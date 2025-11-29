@extends('layouts.templates.app-layout')

@section('content')
    <div class="card border shadow-xs mb-4">
        <x-card-header title="Produção" count="{{ $orders->count() }}" action="" />

        <x-table>
            <x-slot name="thead">
                <tr class="text-center">
                    <th>Nº OF</th>
                    <th>Cliente</th>
                    <th>Data OF</th>
                    <th>Expedição</th>
                    <th>Status</th>
                    <th>Operador</th>
                    <th>Ações</th>
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
                            <span class="badge badge-sm {{ $statusClass[$status] ?? 'border-secondary text-secondary bg-light' }}">
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
                                <button type="button"
                                        class="btn btn-sm btn-warning btn-start-production"
                                        data-url="{{ route('operator.start', $order->id) }}"
                                        data-id="{{ $order->id }}">
                                    Iniciar
                                </button>
                            @elseif ($order->status === 'in_production')
                                <button type="button"
                                        class="btn btn-sm btn-success btn-finish-production"
                                        data-url="{{ route('operator.finish', $order->id) }}"
                                        data-id="{{ $order->id }}">
                                    Finalizar
                                </button>
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

            // INICIAR PRODUÇÃO
            document.querySelectorAll('.btn-start-production').forEach(btn => {
                btn.addEventListener('click', async () => {
                    const url = btn.dataset.url;
                    if (!url) return;

                    const operatorName = prompt('Nome do operador:');
                    if (!operatorName) {
                        return;
                    }

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

                        // Atualiza a linha da tabela SEM recarregar
                        const row = btn.closest('tr');
                        if (!row) return;

                        // Status
                        const statusCell = row.querySelector('td:nth-child(5) span');
                        if (statusCell) {
                            statusCell.className = 'badge badge-sm border-warning text-warning bg-warning';
                            statusCell.innerHTML = '<i class="fa fa-industry" aria-hidden="true"></i> Em produção';
                        }

                        // Operador
                        const operatorCell = row.querySelector('td:nth-child(6)');
                        if (operatorCell) {
                            operatorCell.textContent = order.production_operator_name || operatorName;
                        }

                        // Troca botão "Iniciar" por "Finalizar"
                        btn.outerHTML =
                            `<button type="button"
                                 class="btn btn-sm btn-success btn-finish-production"
                                 data-url="{{ route('operator.finish', ':id') }}".replace(':id', order.id)>
                            Finalizar
                         </button>`;

                    } catch (e) {
                        console.error(e);
                        alert('Erro na comunicação com o servidor.');
                    }
                });
            });

            // FINALIZAR PRODUÇÃO
            function bindFinishButtons() {
                document.querySelectorAll('.btn-finish-production').forEach(btn => {
                    if (btn._bound) return; // evita bind duplicado
                    btn._bound = true;

                    btn.addEventListener('click', async () => {
                        const url = btn.dataset.url;
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

                            // Remove a linha da tabela (OF saiu da produção)
                            const row = btn.closest('tr');
                            if (row) row.remove();

                        } catch (e) {
                            console.error(e);
                            alert('Erro na comunicação com o servidor.');
                        }
                    });
                });
            }

            bindFinishButtons();
        })();
    </script>

@endsection
