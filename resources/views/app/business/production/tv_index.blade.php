@extends('layouts.templates.production-order-layout')

@section('content')
    @push('styles')
        <style>
            /* ======== TRAVAR SCROLL SEMPRE NESSA TELA ======== */
            html.tv-lock,
            body.tv-lock {
                overflow-x: hidden !important;
                overflow-y: hidden !important;
                height: 100%;
            }

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

            /* ======== FUNDO DA TV COM A IMAGEM (sempre nessa tela) ======== */
            body.tv-bg {
                background-color: #ffffff !important;
                background-image: url("{{ asset('img/tv-bg-bongas.png') }}") !important;
                background-position: center center !important;
                background-repeat: no-repeat !important;
                background-attachment: fixed !important;
                background-size: cover !important;
            }

            /* ======== LAYOUT GERAL DA TV ======== */
            #tv-root {
                padding: 0.5rem 1rem;
            }

            .tv-row-top {
                height: 55vh;        /* ocupa ~metade da tela */
                margin-bottom: .5rem;
            }

            .tv-row-bottom {
                height: 35vh;        /* parte de baixo */
            }

            .tv-row-top .card,
            .tv-row-bottom .card {
                height: 100%;
            }

            /* ======== AJUSTE DOS CARDS / TABELAS PRA FICAR MAIS BAIXO ======== */
            #tv-root .card {
                margin-bottom: .25rem;
            }

            #tv-root .card-header {
                padding: .35rem 1rem !important;
            }

            #tv-root .table-responsive,
            #tv-root table {
                margin-bottom: 0 !important;
            }

            #tv-root table thead th {
                padding-top: .20rem;
                padding-bottom: .20rem;
                font-size: .80rem;
            }

            #tv-root table tbody td {
                padding-top: .20rem;
                padding-bottom: .20rem;
                font-size: .90rem;
            }

            /* ======== ZEBRA NAS LINHAS ======== */
            #tv-root tbody tr:nth-child(odd) {
                background-color: #ffffff;
            }

            #tv-root tbody tr:nth-child(even) {
                background-color: #f3f4f6;
            }

            #tv-root tbody tr > td p {
                margin-bottom: 0;
            }

            /* ========= TAMANHO MAIOR SÓ NO CARD "EM PRODUÇÃO" ========= */
            .card-tv-emprod table thead th {
                font-size: 1.2rem !important;          /* cabeçalho um pouco maior */
            }

            .card-tv-emprod table tbody td {
                padding-top: 0.35rem !important;
                padding-bottom: 0.35rem !important;
                font-size: 1.2rem !important;        /* linhas grandes pra enxergar de longe */
            }

            .card-tv-emprod table tbody td p {
                font-size: 2.0rem !important;
                font-weight: 600;                    /* ref. número da OF bem destacado */
            }

            /* ====== TAMANHO LISTA – AGUARDANDO SEPARAÇÃO ====== */
            .card-tv-waiting table thead th {
                font-size: 0.90rem !important;      /* ajusta como quiser */
            }

            .card-tv-waiting table tbody td {
                padding-top: 0.30rem !important;
                padding-bottom: 0.30rem !important;
                font-size: 1.5rem !important;       /* tamanho das OFs */
            }

            .card-tv-waiting table tbody td p {
                font-size: 1.6rem !important;
                font-weight: 700;
            }

            /* ====== TAMANHO LISTA – MATERIAIS SEPARADOS ====== */
            .card-tv-separated table thead th {
                font-size: 0.90rem !important;      /* pode ser outro valor se quiser */
            }

            .card-tv-separated table tbody td {
                padding-top: 0.30rem !important;
                padding-bottom: 0.30rem !important;
                font-size: 1.5rem !important;
            }

            .card-tv-separated table tbody td p {
                font-size: 1.6rem !important;
                font-weight: 700;
            }

            /* Ícone do card "Em produção" – verde com gradiente e brilho */
            .tv-icon-production {
                background: linear-gradient(135deg, #16a34a, #22c55e); /* verde bonito */
                box-shadow: 0 0 12px rgba(34, 197, 94, 0.7);
            }

            .tv-icon-production i {
                font-size: 1.6rem;
            }
        </style>
    @endpush

    @can('view tv_index')
        <div id="tv-root" class="container-fluid p-0">

            {{-- LINHA DE CIMA – EM PRODUÇÃO (FULL) --}}
            <div class="row tv-row-top">
                <div class="col-12 h-100">
                    <div class="card border-0 shadow-lg card-tv-emprod">
                        <div class="card-header border-0 pb-2 d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <div
                                    class="rounded-circle d-flex align-items-center justify-content-center me-3 tv-icon-production"
                                    style="width: 48px; height: 48px;">
                                    <i class="fa fa-cogs text-white"></i>
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
                                    {{ min($inProduction->count(), 6) }} OF(s)
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
                                @forelse ($inProduction->take(6) as $order)
                                    <tr class="text-center">
                                        <td><p class="text-dark fw-bold text-sm mb-0">{{ $order->order_number }}</p></td>
                                        <td><p class="text-dark text-sm mb-0">{{ $order->client_name }}</p></td>
                                        <td><p class="text-dark text-sm mb-0">{{ $order->production_operator_name ?? '-' }}</p></td>
                                        <td><p class="text-dark text-sm mb-0">{{ optional($order->production_started_at)->format('H:i') ?? '-' }}</p></td>
                                        <td><p class="text-dark text-sm mb-0">{{ optional($order->expedition_date)->format('d/m/Y') }}</p></td>
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

            {{-- LINHA DE BAIXO – 2 COLUNAS: AGUARDANDO / MATERIAIS SEPARADOS --}}
            <div class="row tv-row-bottom">

                {{-- COLUNA 1 – AGUARDANDO SEPARAÇÃO --}}
                <div class="col-lg-6 h-100">
                    <div class="card border-0 shadow-lg card-tv-waiting">
                        <div class="card-header border-0 pb-2 d-flex justify-content-between">
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
                                    {{ min(($waiting ?? collect())->count(), 5) }} OF(s)
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
                                @forelse (($waiting ?? collect())->take(5) as $order)
                                    <tr class="text-center">
                                        <td><p class="text-dark fw-bold text-sm mb-0">{{ $order->order_number }}</p></td>
                                        <td><p class="text-dark text-sm mb-0">{{ $order->client_name }}</p></td>
                                        <td><p class="text-dark text-sm mb-0">{{ optional($order->expedition_date)->format('d/m/Y') }}</p></td>
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
                <div class="col-lg-6 h-100">
                    <div class="card border-0 shadow-lg card-tv-separated">
                        <div class="card-header border-0 pb-2 d-flex justify-content-between">
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
                                    {{ min($separated->count(), 5) }} OF(s)
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
                                @forelse ($separated->take(5) as $order)
                                    <tr class="text-center">
                                        <td><p class="text-dark fw-bold text-sm mb-0">{{ $order->order_number }}</p></td>
                                        <td><p class="text-dark text-sm mb-0">{{ $order->client_name }}</p></td>
                                        <td><p class="text-dark text-sm mb-0">{{ optional($order->expedition_date)->format('d/m/Y') }}</p></td>
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
            </div>
        </div>

        @push('scripts')
            <script>
                (function () {
                    // aplica o fundo desta tela e trava scroll
                    document.body.classList.add('tv-bg', 'tv-lock');
                    document.documentElement.classList.add('tv-lock');

                    /* ============================
                     *  FULLSCREEN + HIDE LAYOUT
                     * ============================ */
                    const btnFull = document.getElementById('btnToggleFullscreen');

                    function enterFullscreen() {
                        const elem = document.documentElement;
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
                        const html = document.documentElement;

                        if (document.fullscreenElement) {
                            document.body.classList.add('tv-fullscreen');
                            html.classList.add('tv-fullscreen');
                        } else {
                            document.body.classList.remove('tv-fullscreen');
                            html.classList.remove('tv-fullscreen');
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

                            // sempre limita a 5 itens antes de renderizar
                            const waiting       = (json.waiting       || []).slice(0, 5);
                            const separated     = (json.separated     || []).slice(0, 5);
                            const in_production = (json.in_production || []).slice(0, 6);

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
