@extends('layouts.templates.production-order-layout')

@section('content')
    @push('styles')
        <style>
            /* ZEBRA PARA A FILA DE SEPARAÇÃO */
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

    @can('view stock_order')
        <div class="card border shadow-xs mb-4">
            <x-card-header title="Fila de Separação" count="{{ $orders->count() }}" action=""/>

            <x-table>
                <x-slot name="thead">
                    <tr class="text-center">
                        <th>Nº OF</th>
                        <th>Cliente</th>
                        <th>Data OF</th>
                        <th>Expedição</th>
                        @can('separate stock_order')
                            <th>Ações</th>
                        @endcan
                    </tr>
                </x-slot>

                <x-slot name="tbody">
                    @forelse ($orders as $order)
                        <tr class="text-center">
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->client_name }}</td>
                            <td>{{ optional($order->order_date)->format('d/m/Y') }}</td>
                            <td>{{ optional($order->expedition_date)->format('d/m/Y') }}</td>
                            @can('separate stock_order')
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary btn-mark-separated m-0"
                                            data-url="{{ route('stock.separate', $order) }}">
                                        Marcar como separado
                                    </button>
                                </td>
                            @endcan
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                Nenhuma OF aguardando separação.
                            </td>
                        </tr>
                    @endforelse
                </x-slot>
            </x-table>
        </div>

        {{-- script mantém igual --}}
        <script>
            (function () {
                const CSRF = '{{ csrf_token() }}';

                document.querySelectorAll('.btn-mark-separated').forEach(btn => {
                    btn.addEventListener('click', async () => {
                        const url = btn.dataset.url;
                        if (!url) return;

                        if (!confirm('Confirmar separação do material desta OF?')) {
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
                                alert(data.error || 'Erro ao separar material.');
                                return;
                            }

                            const row = btn.closest('tr');
                            if (row) row.remove();

                        } catch (e) {
                            console.error(e);
                            alert('Erro na comunicação com o servidor.');
                        }
                    });
                });
            })();
        </script>
    @endcan
@endsection
