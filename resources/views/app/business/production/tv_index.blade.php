@extends('layouts.templates.app-layout')

@section('content')
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

    <div id="tv-root" class="container-fluid py-4">

        {{-- Cabeçalho --}}
        <div class="d-flex align-items-center mb-4">
            <div>
                <h2 class="mb-1 fw-bold">Painel de Produção</h2>
                <p class="text-sm text-muted mb-0">
                    À esquerda, OFs com <strong>material separado</strong>.
                    À direita, OFs <strong>em produção</strong>.
                    Quando iniciar a produção, a OF sai da lista de separados.
                    Ao finalizar, some da coluna de produção.
                </p>
            </div>

            <div class="ms-auto d-flex align-items-center gap-3">
                <div class="d-flex align-items-center text-success text-sm me-3">
                    <i class="fa fa-check-circle me-1"></i>
                    Atualização automática
                </div>

                <button id="btnToggleFullscreen" class="btn btn-outline-secondary btn-sm me-2">
                    <i class="fa fa-desktop me-1"></i> Tela de exibição
                </button>
            </div>
        </div>

        <div class="row g-4">

            {{-- COLUNA ESQUERDA - MATERIAIS SEPARADOS --}}
            <div class="col-lg-6">
                <div class="card border-0 shadow-lg"
                     style="background: radial-gradient(circle at top left, #233044 0, #0b1220 40%, #020617 100%); color: #fff;">
                    <div class="card-header border-0 pb-0 d-flex align-items-center">
                        <div class="d-flex align-items-center">
                            <div
                                class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-3"
                                style="width: 40px; height: 40px;">
                                <i class="fa fa-box-open text-white"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 fw-semibold">Materiais separados</h5>
                                <small class="text-white-50">
                                    Próximas OFs aguardando início de produção
                                </small>
                            </div>
                        </div>
                        <div class="ms-auto text-end">
                            <small class="text-white-50 d-block">TOTAL</small>
                            <span class="fw-bold" id="tv-total-separated">{{ $separated->count() }} OF(s)</span>
                        </div>
                    </div>

                    <div class="card-body pt-3">
                        <div class="table-responsive">
                            <table class="table table-borderless align-items-center mb-0 text-center">
                                <thead>
                                <tr class="text-uppercase text-white-50 text-xxs text-center">
                                    <th class="fw-semibold text-center">Nº OF</th>
                                    <th class="fw-semibold text-center">Cliente</th>
                                    <th class="fw-semibold text-center">Expedição</th>
                                </tr>
                                </thead>
                                <tbody id="tv-separated-body">
                                @forelse ($separated as $order)
                                    <tr class="text-sm text-white align-middle text-center">
                                        <td class="fw-semibold text-center">{{ $order->order_number }}</td>
                                        <td class="text-center">{{ $order->client_name }}</td>
                                        <td class="fw-semibold text-center">
                                            {{ optional($order->expedition_date)->format('d/m/Y') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-white-50 py-4">
                                            Nenhuma OF com material separado no momento.
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- COLUNA DIREITA - EM PRODUÇÃO --}}
            <div class="col-lg-6">
                <div class="card border-0 shadow-lg"
                     style="background: radial-gradient(circle at top right, #1f2937 0, #020617 40%, #020617 100%); color: #fff;">
                    <div class="card-header border-0 pb-0 d-flex align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-warning d-flex align-items-center justify-content-center me-3"
                                style="width: 40px; height: 40px;">
                                <i class="fa fa-industry text-dark"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 fw-semibold">Em produção</h5>
                                <small class="text-white-50">
                                    OFs atualmente em processo de fabricação
                                </small>
                            </div>
                        </div>
                        <div class="ms-auto text-end">
                            <small class="text-white-50 d-block">TOTAL</small>
                            <span class="fw-bold" id="tv-total-inprod">{{ $inProduction->count() }} OF(s)</span>
                        </div>
                    </div>

                    <div class="card-body pt-3">
                        <div class="table-responsive">
                            <table class="table table-borderless align-items-center mb-0 text-center">
                                <thead>
                                <tr class="text-uppercase text-white-50 text-xxs text-center">
                                    <th class="fw-semibold text-center">Nº OF</th>
                                    <th class="fw-semibold text-center">Cliente</th>
                                    <th class="fw-semibold text-center">Operador</th>
                                    <th class="fw-semibold text-center">Início</th>
                                    <th class="fw-semibold text-center">Expedição</th>
                                </tr>
                                </thead>
                                <tbody id="tv-inprod-body">
                                @forelse ($inProduction as $order)
                                    <tr class="text-sm text-white align-middle text-center">
                                        <td class="fw-semibold text-center">{{ $order->order_number }}</td>
                                        <td class="text-center">{{ $order->client_name }}</td>
                                        <td class="text-center">{{ $order->production_operator_name ?? '-' }}</td>
                                        <td class="text-center">
                                            {{ optional($order->production_started_at)->format('H:i') ?? '-' }}
                                        </td>
                                        <td class="fw-semibold text-center">
                                            {{ optional($order->expedition_date)->format('d/m/Y') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-white-50 py-4">
                                            Nenhuma OF em produção no momento.
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div> {{-- row --}}

        {{-- SCRIPT DA TV --}}
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
                        renderList('tv-separated-body', json.separated, 'separated');
                        renderList('tv-inprod-body', json.in_production, 'in_production');

                        const totalSep  = document.getElementById('tv-total-separated');
                        const totalProd = document.getElementById('tv-total-inprod');
                        if (totalSep)  totalSep.textContent  = (json.separated?.length || 0)      + ' OF(s)';
                        if (totalProd) totalProd.textContent = (json.in_production?.length || 0) + ' OF(s)';
                    } catch (e) {
                        console.error(e);
                    }
                }

                function renderList(tbodyId, items, type) {
                    const tbody = document.getElementById(tbodyId);
                    if (!tbody) return;

                    const hasItems = items && items.length;

                    if (!hasItems) {
                        const colspan = type === 'separated' ? 3 : 5;
                        const msg = type === 'separated'
                            ? 'Nenhuma OF com material separado no momento.'
                            : 'Nenhuma OF em produção no momento.';

                        tbody.innerHTML =
                            `<tr>
                                <td colspan="${colspan}" class="text-center text-white-50 py-4">${msg}</td>
                             </tr>`;
                        return;
                    }

                    if (type === 'separated') {
                        // 3 colunas centralizadas: Nº OF, Cliente, Expedição
                        tbody.innerHTML = items.map(order => `
                            <tr class="text-sm text-white align-middle text-center">
                                <td class="fw-semibold text-center">${order.order_number}</td>
                                <td class="text-center">${order.client_name}</td>
                                <td class="fw-semibold text-center">${order.expedition_date}</td>
                            </tr>
                        `).join('');
                    } else {
                        // in_production: 5 colunas centralizadas
                        tbody.innerHTML = items.map(order => `
                            <tr class="text-sm text-white align-middle text-center">
                                <td class="fw-semibold text-center">${order.order_number}</td>
                                <td class="text-center">${order.client_name}</td>
                                <td class="text-center">${order.operator ?? '-'}</td>
                                <td class="text-center">${order.started_at ?? '-'}</td>
                                <td class="fw-semibold text-center">${order.expedition_date}</td>
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
    </div> {{-- /#tv-root --}}
@endsection
