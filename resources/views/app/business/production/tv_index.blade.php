@extends('layouts.templates.production-order-layout')

@section('content')
    @push('styles')
        <style>
            /* ======== MODO TV EM TELA CHEIA ======== */
            body.tv-fullscreen header,
            body.tv-fullscreen .navbar,
            body.tv-fullscreen .navbar-main,
            body.tv-fullscreen .sidenav,
            body.tv-fullscreen .aside,
            body.tv-fullscreen footer {
                display: none !important;
            }

            body.tv-fullscreen #tv-root {
                padding-top: 0 !important;
                padding-bottom: 0 !important;
                margin-top: 0 !important;
                min-height: 100vh;
            }
        </style>
    @endpush

    @can('view tv_index')
        <div id="tv-root" class="container-fluid p-0">
            {{-- Cabeçalho --}}
            <div class="row d-flex align-items-center justify-content-between mb-4">
                <div class="col-8">
                    <h2 class="mb-1 fw-bold">Painel de Produção Bongas Brasil</h2>
                </div>

                <div class="col-4 align-items-center text-end">
                    <span class="text-success text-sm me-3">
                        <i class="fa fa-check-circle me-1"></i>
                        Atualização automática
                    </span>

                    <button id="btnToggleFullscreen" class="btn btn-outline-secondary btn-sm m-0">
                        <i class="fa-solid fa-up-right-and-down-left-from-center fs-5"></i>
                    </button>
                </div>
            </div>

            {{-- 3 COLUNAS NA MESMA TELA --}}
            <div class="row">

                {{-- COLUNA 1 – AGUARDANDO SEPARAÇÃO --}}
                <div class="col-lg-4">
                    <div class="card border-0 shadow-lg">
                        <div class="card-header border-0 pb-3 d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <div
                                    class="rounded-circle bg-secondary d-flex align-items-center justify-content-center me-3"
                                    style="width: 40px; height: 40px;">
                                    <i class="fa fa-clock text-white"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0 fw-semibold">Aguardando separação</h5>
                                    <small class="text-muted-50">
                                        OFs ainda não separadas no estoque
                                    </small>
                                </div>
                            </div>
                            <div class="text-end">
                                <small class="text-muted-50 d-block">TOTAL</small>
                                <span class="fw-bold" id="tv-total-waiting">
                                    {{ min(($waiting ?? collect())->count(), 10) }} OF(s)
                                </span>
                            </div>
                        </div>

                        <x-table>
                            <x-slot name="thead">
                                <tr class="text-center">
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">N° OF</th>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">Cliente</th>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">Expedição</th>
                                </tr>
                            </x-slot>

                            <x-slot name="tbody">
                                <tbody id="tv-waiting-body">
                                @forelse (($waiting ?? collect())->take(10) as $order)
                                    <tr class="text-center">
                                        <td>
                                            <p class="text-dark fw-bold text-sm mb-0">
                                                {{ $order->order_number }}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-dark text-sm mb-0">
                                                {{ $order->client_name }}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-dark text-sm mb-0">
                                                {{ optional($order->expedition_date)->format('d/m/Y') }}
                                            </p>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-sm text-center mb-0">
                                            Nenhuma OF <b>aguardando separação</b> no momento.
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </x-slot>
                        </x-table>
                    </div>
                </div>

                {{-- COLUNA 2 – MATERIAIS SEPARADOS --}}
                <div class="col-lg-4">
                    <div class="card border-0 shadow-lg">
                        <div class="card-header border-0 pb-3 d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <div
                                    class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-3"
                                    style="width: 40px; height: 40px;">
                                    <i class="fa fa-box-open text-white"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0 fw-semibold">Materiais separados</h5>
                                    <small class="text-muted-50">
                                        Próximas OFs aguardando início de produção
                                    </small>
                                </div>
                            </div>
                            <div class="text-end">
                                <small class="text-muted-50 d-block">TOTAL</small>
                                <span class="fw-bold" id="tv-total-separated">
                                    {{ min($separated->count(), 10) }} OF(s)
                                </span>
                            </div>
                        </div>

                        <x-table>
                            <x-slot name="thead">
                                <tr class="text-center">
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">N° OF</th>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">Cliente</th>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">Expedição</th>
                                </tr>
                            </x-slot>

                            <x-slot name="tbody">
                                <tbody id="tv-separated-body">
                                @forelse ($separated->take(10) as $order)
                                    <tr class="text-center">
                                        <td>
                                            <p class="text-dark fw-bold text-sm mb-0">
                                                {{ $order->order_number }}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-dark text-sm mb-0">
                                                {{ $order->client_name }}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-dark text-sm mb-0">
                                                {{ optional($order->expedition_date)->format('d/m/Y') }}
                                            </p>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-sm text-center mb-0">
                                            Nenhuma OF com <b>material separado</b> no momento.
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </x-slot>
                        </x-table>
                    </div>
                </div>

                {{-- COLUNA 3 – EM PRODUÇÃO --}}
                <div class="col-lg-4">
                    <div class="card border-0 shadow-lg">
                        <div class="card-header border-0 pb-3 d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <div
                                    class="rounded-circle bg-warning d-flex align-items-center justify-content-center me-3"
                                    style="width: 40px; height: 40px;">
                                    <i class="fa fa-industry text-white"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0 fw-semibold">Em produção</h5>
                                    <small class="text-muted-50">
                                        OFs atualmente em processo de fabricação
                                    </small>
                                </div>
                            </div>
                            <div class="text-end">
                                <small class="text-muted-50 d-block">TOTAL</small>
                                <span class="fw-bold" id="tv-total-inprod">
                                    {{ min($inProduction->count(), 10) }} OF(s)
                                </span>
                            </div>
                        </div>

                        <x-table>
                            <x-slot name="thead">
                                <tr class="text-center">
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">N° OF</th>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">Cliente</th>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">Operador</th>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">Início</th>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">Expedição</th>
                                </tr>
                            </x-slot>

                            <x-slot name="tbody">
                                <tbody id="tv-inprod-body">
                                @forelse ($inProduction->take(10) as $order)
                                    <tr class="text-center">
                                        <td>
                                            <p class="text-dark fw-bold text-sm mb-0">
                                                {{ $order->order_number }}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-dark text-sm mb-0">
                                                {{ $order->client_name }}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-dark text-sm mb-0">
                                                {{ $order->production_operator_name ?? '-' }}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-dark text-sm mb-0">
                                                {{ optional($order->production_started_at)->format('H:i') ?? '-' }}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-dark text-sm mb-0">
                                                {{ optional($order->expedition_date)->format('d/m/Y') }}
                                            </p>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-sm text-center mb-0">
                                            Nenhuma OF em <b>produção</b> no momento.
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </x-slot>
                        </x-table>
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')
            <script>
                (function () {
                    /* ============================
                     *  FULLSCREEN + HIDE LAYOUT
                     * ============================ */
                    const btnFull = document.getElementById('btnToggleFullscreen');
                    const tvRoot  = document.getElementById('tv-root');

                    function enterFullscreen() {
                        const elem = tvRoot || document.documentElement;
                        if (elem.requestFullscreen) {
                            elem.requestFullscreen().catch(console.error);
                        }
                    }

                    function exitFullscreen() {
                        if (document.exitFullscreen) {
                            document.exitFullscreen().catch(console.error);
                        }
                    }

                    function toggleFullScreen() {
                        if (document.fullscreenElement) {
                            exitFullscreen();
                        } else {
                            enterFullscreen();
                        }
                    }

                    if (btnFull) {
                        btnFull.addEventListener('click', toggleFullScreen);
                    }

                    document.addEventListener('fullscreenchange', () => {
                        if (document.fullscreenElement) {
                            document.body.classList.add('tv-fullscreen');
                        } else {
                            document.body.classList.remove('tv-fullscreen');
                        }
                    });

                    /* ============================
                     *  AUTO ATUALIZAÇÃO VIA AJAX
                     * ============================ */
                    const DATA_URL = @json(route('tv.data'));

                    async function refreshTv() {
                        try {
                            const res = await fetch(DATA_URL, {
                                headers: { 'Accept': 'application/json' }
                            });

                            if (!res.ok) {
                                console.error('Falha ao buscar dados da TV');
                                return;
                            }

                            const json = await res.json();

                            // sempre limita a 10 itens antes de renderizar
                            const waiting       = (json.waiting       || []).slice(0, 10);
                            const separated     = (json.separated     || []).slice(0, 10);
                            const in_production = (json.in_production || []).slice(0, 10);

                            renderList('tv-waiting-body',   waiting,       'waiting');
                            renderList('tv-separated-body', separated,     'separated');
                            renderList('tv-inprod-body',    in_production, 'in_production');

                            const totalWait = document.getElementById('tv-total-waiting');
                            const totalSep  = document.getElementById('tv-total-separated');
                            const totalProd = document.getElementById('tv-total-inprod');

                            if (totalWait) totalWait.textContent = waiting.length       + ' OF(s)';
                            if (totalSep)  totalSep.textContent  = separated.length     + ' OF(s)';
                            if (totalProd) totalProd.textContent = in_production.length + ' OF(s)';
                        } catch (e) {
                            console.error(e);
                        }
                    }

                    function renderList(tbodyId, items, type) {
                        const tbody = document.getElementById(tbodyId);
                        if (!tbody) return;

                        const hasItems = items && items.length;

                        let colspan, emptyMsg;

                        if (type === 'in_production') {
                            colspan = 5;
                            emptyMsg = 'Nenhuma OF em produção no momento.';
                        } else if (type === 'waiting') {
                            colspan = 3;
                            emptyMsg = 'Nenhuma OF aguardando separação no momento.';
                        } else {
                            colspan = 3;
                            emptyMsg = 'Nenhuma OF com material separado no momento.';
                        }

                        if (!hasItems) {
                            tbody.innerHTML =
                                `<tr>
                                    <td colspan="${colspan}" class="text-sm text-center mb-0">${emptyMsg}</td>
                                 </tr>`;
                            return;
                        }

                        if (type === 'in_production') {
                            tbody.innerHTML = items.map(order => `
                                <tr class="text-center">
                                    <td><p class="text-dark fw-bold text-sm mb-0">${order.order_number}</p></td>
                                    <td><p class="text-dark text-sm mb-0">${order.client_name}</p></td>
                                    <td><p class="text-dark text-sm mb-0">${order.operator ?? '-'}</p></td>
                                    <td><p class="text-dark text-sm mb-0">${order.started_at ?? '-'}</p></td>
                                    <td><p class="text-dark text-sm mb-0">${order.expedition_date}</p></td>
                                </tr>
                            `).join('');
                        } else {
                            // waiting e separated
                            tbody.innerHTML = items.map(order => `
                                <tr class="text-center">
                                    <td><p class="text-dark fw-bold text-sm mb-0">${order.order_number}</p></td>
                                    <td><p class="text-dark text-sm mb-0">${order.client_name}</p></td>
                                    <td><p class="text-dark text-sm mb-0">${order.expedition_date}</p></td>
                                </tr>
                            `).join('');
                        }
                    }

                    // primeira carga
                    refreshTv();
                    // atualiza a cada 5s
                    setInterval(refreshTv, 5000);
                })();
            </script>
        @endpush
    @endcan
@endsection
