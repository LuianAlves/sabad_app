@extends('layouts.templates.app-layout')

@section('content')
    <div class="card border shadow-xs mb-4">
        <x-card-header title="Fila de Separação" count="{{ $orders->count() }}" action="" />

        <x-table>
            <x-slot name="thead">
                <tr class="text-center">
                    <th>Nº OF</th>
                    <th>Cliente</th>
                    <th>Data OF</th>
                    <th>Expedição</th>
                    <th>Ações</th>
                </tr>
            </x-slot>

            <x-slot name="tbody">
                @forelse ($orders as $order)
                    <tr class="text-center">
                        <td>{{ $order->order_number }}</td>
                        <td>{{ $order->client_name }}</td>
                        <td>{{ optional($order->order_date)->format('d/m/Y') }}</td>
                        <td>{{ optional($order->expedition_date)->format('d/m/Y') }}</td>
                        <td>
                            <button type="button"
                                    class="btn btn-sm btn-primary btn-mark-separated"
                                    data-url="{{ route('stock.separate', $order) }}">
                                Marcar como separado
                            </button>
                        </td>

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

                        // Remove a linha da tabela sem recarregar (mantém fullscreen)
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

@endsection
