@php
    $isAdmin = auth()->user()->hasRole('admin');
    $layout = $isAdmin
        ? 'layouts.templates.app-layout'
        : 'layouts.templates.user-profile-layout';

    $section = $isAdmin ? 'content' : 'content-user-layout';
    $user = auth()->user();
@endphp

@extends($layout)

@section($section)

    @unless($isAdmin)
        {{-- Cabeçalho do perfil para usuários com role "user" --}}
        <div class="pt-7 pb-6 bg-cover bg-info"></div>

        <div class="container">
            <div class="card card-body py-2 bg-transparent shadow-none">
                <div class="row">
                    <div class="col-auto">
                        <div class="avatar avatar-2xl rounded-circle position-relative mt-n7 border border-gray-100 border-4">
                            @if ($user->image)
                                <img src="{{ 'data:image/png;base64,' . $user->image }}" alt="profile_image" class="w-100">
                            @else
                                <img src="{{ asset('img/profile/image_profile.webp') }}" alt="profile_image" class="w-100">
                            @endif
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h3 class="mb-0 font-weight-bold">{{ $user->name }}</h3>
                            <p class="mb-0">
                                {{-- {{ $user->email }} --}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endunless

    <div class="container">
        <h1>Agendamentos para: {{ $room->name }}</h1>

        {{-- AÇÕES + FILTRO (ALINHADO) --}}
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">

            {{-- Esquerda --}}
            <div class="d-flex gap-2 align-items-center">
                <a href="{{ route('bookings.create', $room) }}" class="btn btn-drylu btn-h40">Novo Agendamento</a>
                <a href="{{ route('bookings.index') }}" class="btn btn-drylu btn-h40">← Voltar</a>
            </div>

            {{-- Direita --}}
            <div class="booking-group">
                <span class="booking-label">Ano</span>
                <select id="yearSelect" class="form-select booking-control" style="width: 92px;"></select>

                <span class="booking-label">Mês</span>
                <select id="monthSelect" class="form-select booking-control" style="width: 160px;">
                    <option value="01">Janeiro</option>
                    <option value="02">Fevereiro</option>
                    <option value="03">Março</option>
                    <option value="04">Abril</option>
                    <option value="05">Maio</option>
                    <option value="06">Junho</option>
                    <option value="07">Julho</option>
                    <option value="08">Agosto</option>
                    <option value="09">Setembro</option>
                    <option value="10">Outubro</option>
                    <option value="11">Novembro</option>
                    <option value="12">Dezembro</option>
                </select>

                <button id="btnGo" type="button" class="btn btn-drylu btn-h40">Ir</button>
                <button id="btnToday" type="button" class="btn btn-outline-drylu btn-h40">Hoje</button>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <div id="calendar"></div>
            </div>
        </div>
    </div>

    {{-- Modal: agendamentos do dia --}}
    <div class="modal fade" id="dayBookingsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Agendamentos do dia <span id="dayBookingsTitle"></span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>

                <div class="modal-body">
                    <div id="dayBookingsLoading" class="text-muted">Carregando...</div>
                    <div id="dayBookingsEmpty" class="text-muted d-none">Nenhum agendamento para este dia.</div>
                    <ul class="list-group d-none" id="dayBookingsList"></ul>
                </div>

                <div class="modal-footer">
                    <a href="#" id="btnCreateWithDate" class="btn btn-drylu">Novo agendamento neste dia</a>
                    <button type="button" class="btn btn-outline-drylu" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css">

        <style>
            /* ===== Alinhamento topo (Ano/Mês/Ir/Hoje) ===== */
            .booking-control{ height: 40px; }
            .btn-h40{
                height: 40px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                line-height: 1;
            }
            .booking-group{
                display: flex;
                align-items: center;
                gap: 10px;
                flex-wrap: wrap;
            }
            .booking-label{
                font-size: 12px;
                color: #6c757d;
                line-height: 40px; /* centraliza com select/botões */
                margin: 0;
                white-space: nowrap;
            }

            /* Capitaliza apenas a PRIMEIRA letra do título: "Abril de 2026" */
            .fc .fc-toolbar-title{ text-transform: none !important; }
            .fc .fc-toolbar-title::first-letter{ text-transform: uppercase; }

            /* ===== Botões padrão DryLu (usa a cor "info" do tema) ===== */
            .btn-drylu{
                --bs-btn-color: #fff;
                --bs-btn-bg: var(--bs-info);
                --bs-btn-border-color: var(--bs-info);
                --bs-btn-hover-bg: rgba(var(--bs-info-rgb), .88);
                --bs-btn-hover-border-color: rgba(var(--bs-info-rgb), .88);
                --bs-btn-active-bg: rgba(var(--bs-info-rgb), .75);
                --bs-btn-active-border-color: rgba(var(--bs-info-rgb), .75);
                --bs-btn-focus-shadow-rgb: var(--bs-info-rgb);
                border-radius: .5rem;
                padding: .45rem 1rem;
                font-weight: 600;
            }
            .btn-outline-drylu{
                --bs-btn-color: var(--bs-info);
                --bs-btn-border-color: var(--bs-info);
                --bs-btn-hover-bg: var(--bs-info);
                --bs-btn-hover-border-color: var(--bs-info);
                --bs-btn-hover-color: #fff;
                --bs-btn-active-bg: rgba(var(--bs-info-rgb), .85);
                --bs-btn-active-border-color: rgba(var(--bs-info-rgb), .85);
                --bs-btn-focus-shadow-rgb: var(--bs-info-rgb);
                border-radius: .5rem;
                padding: .45rem 1rem;
                font-weight: 600;
            }

            /* ===== FullCalendar: botões prev/next na cor DryLu ===== */
            .fc .fc-button{
                border-radius: .5rem !important;
                height: 40px !important;
                padding: .45rem .9rem !important;
                font-weight: 600 !important;
                box-shadow: none !important;
            }
            .fc .fc-button-primary{
                background-color: var(--bs-info) !important;
                border-color: var(--bs-info) !important;
            }
            .fc .fc-button-primary:hover{
                background-color: rgba(var(--bs-info-rgb), .88) !important;
                border-color: rgba(var(--bs-info-rgb), .88) !important;
            }
            .fc .fc-button-primary:active,
            .fc .fc-button-primary.fc-button-active{
                background-color: rgba(var(--bs-info-rgb), .75) !important;
                border-color: rgba(var(--bs-info-rgb), .75) !important;
            }

            /* =========================================================
               ✅ NÃO DEIXAR O DIA CRESCER (scroll nos eventos)
               ========================================================= */
            .fc .fc-daygrid-day-frame{
                height: 135px;              /* ajuste fino (120~150) */
                display: flex;
                flex-direction: column;
            }
            .fc .fc-daygrid-day-top{
                flex: 0 0 auto;
            }
            .fc .fc-daygrid-day-events{
                flex: 1 1 auto;
                min-height: 0;              /* ESSENCIAL */
                overflow-y: auto;
                overflow-x: hidden;
                padding-right: 4px;
            }
            .fc .fc-daygrid-event{
                margin: 2px 0;
                padding: 1px 6px;
                font-size: 13.5px;          /* letras maiores */
                line-height: 1.25;
            }
            .fc .fc-daygrid-day-events::-webkit-scrollbar{ width: 6px; }
            .fc .fc-daygrid-day-events::-webkit-scrollbar-thumb{
                border-radius: 10px;
                background: rgba(0,0,0,.20);
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/locales/pt-br.global.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const calendarEl = document.getElementById('calendar');
                const yearSelect = document.getElementById('yearSelect');
                const monthSelect = document.getElementById('monthSelect');
                const btnGo = document.getElementById('btnGo');
                const btnToday = document.getElementById('btnToday');

                const modalEl = document.getElementById('dayBookingsModal');
                const titleEl = document.getElementById('dayBookingsTitle');
                const loadingEl = document.getElementById('dayBookingsLoading');
                const emptyEl = document.getElementById('dayBookingsEmpty');
                const listEl = document.getElementById('dayBookingsList');
                const btnCreate = document.getElementById('btnCreateWithDate');

                function escapeHtml(str) {
                    if (!str) return '';
                    return String(str)
                        .replaceAll('&', '&amp;')
                        .replaceAll('<', '&lt;')
                        .replaceAll('>', '&gt;')
                        .replaceAll('"', '&quot;')
                        .replaceAll("'", '&#039;');
                }

                // ✅ BLOQUEIO: não abrir modal quando estiver rolando/arrastando no scroll do dia
                let ignoreDateClickUntil = 0;
                let pointerDownPos = null;

                calendarEl.addEventListener('scroll', function (e) {
                    if (e.target && e.target.closest('.fc-daygrid-day-events')) {
                        ignoreDateClickUntil = Date.now() + 400;
                    }
                }, true);

                calendarEl.addEventListener('pointerdown', function (e) {
                    pointerDownPos = { x: e.clientX, y: e.clientY };
                    if (e.target && e.target.closest('.fc-daygrid-day-events')) {
                        ignoreDateClickUntil = Date.now() + 450;
                    }
                }, true);

                calendarEl.addEventListener('pointermove', function (e) {
                    if (!pointerDownPos) return;

                    const dx = Math.abs(e.clientX - pointerDownPos.x);
                    const dy = Math.abs(e.clientY - pointerDownPos.y);

                    if (dx > 6 || dy > 6) {
                        ignoreDateClickUntil = Date.now() + 450;
                    }
                }, true);

                calendarEl.addEventListener('pointerup', function () {
                    pointerDownPos = null;
                }, true);

                // Preenche anos
                const now = new Date();
                const currentYear = now.getFullYear();
                const minYear = currentYear - 2;
                const maxYear = currentYear + 2;

                for (let y = minYear; y <= maxYear; y++) {
                    const opt = document.createElement('option');
                    opt.value = y;
                    opt.textContent = y;
                    yearSelect.appendChild(opt);
                }

                yearSelect.value = String(currentYear);
                monthSelect.value = String(now.getMonth() + 1).padStart(2, '0');

                const calendar = new FullCalendar.Calendar(calendarEl, {
                    locale: 'pt-br',
                    initialView: 'dayGridMonth',
                    height: 'auto',
                    selectable: true,

                    expandRows: true,
                    fixedWeekCount: false,

                    // não usar "+x more"
                    dayMaxEvents: false,
                    dayMaxEventRows: false,

                    // ✅ seta esquerda na esquerda e seta direita na direita
                    headerToolbar: {
                        left: 'prev',
                        center: 'title',
                        right: 'next'
                    },

                    events: {
                        url: "{{ route('bookings.events', $room) }}",
                        failure: function() {
                            alert('Não foi possível carregar os agendamentos.');
                        }
                    },

                    datesSet: function (info) {
                        const d = info.view.currentStart;
                        yearSelect.value = String(d.getFullYear());
                        monthSelect.value = String(d.getMonth() + 1).padStart(2, '0');
                    },

                    dateClick: function(info) {
                        if (Date.now() < ignoreDateClickUntil) return;

                        const t = info.jsEvent?.target;
                        if (t && (t.closest('.fc-daygrid-day-events') || t.closest('.fc-daygrid-event'))) {
                            return;
                        }

                        const dateStr = info.dateStr;

                        titleEl.textContent = '';
                        loadingEl.classList.remove('d-none');
                        emptyEl.classList.add('d-none');
                        listEl.classList.add('d-none');
                        listEl.innerHTML = '';

                        btnCreate.href = "{{ route('bookings.create', $room) }}" + "?date=" + encodeURIComponent(dateStr);

                        const modal = new bootstrap.Modal(modalEl);
                        modal.show();

                        fetch("{{ route('bookings.day', $room) }}" + "?date=" + encodeURIComponent(dateStr))
                            .then(res => res.json())
                            .then(data => {
                                loadingEl.classList.add('d-none');
                                titleEl.textContent = data.date ? data.date : '';

                                if (!data.bookings || data.bookings.length === 0) {
                                    emptyEl.classList.remove('d-none');
                                    return;
                                }

                                data.bookings.forEach(b => {
                                    const li = document.createElement('li');
                                    li.className = 'list-group-item';
                                    li.innerHTML = `
                                        <div>
                                            <strong>${escapeHtml(b.title)}</strong>
                                            <div class="text-muted small">${escapeHtml(b.start)} - ${escapeHtml(b.end)} • ${escapeHtml(b.user)}</div>
                                            ${b.description ? `<div class="mt-1">${escapeHtml(b.description)}</div>` : ''}
                                        </div>
                                    `;
                                    listEl.appendChild(li);
                                });

                                listEl.classList.remove('d-none');
                            })
                            .catch(() => {
                                loadingEl.classList.add('d-none');
                                emptyEl.classList.remove('d-none');
                                emptyEl.textContent = 'Erro ao carregar agendamentos deste dia.';
                            });
                    },

                    eventClick: function(info) {
                        const title = info.event.title;
                        const start = info.event.start ? info.event.start.toLocaleString() : '';
                        const end = info.event.end ? info.event.end.toLocaleString() : '';
                        const desc = info.event.extendedProps.description || '';
                        alert(`${title}\n${start} - ${end}\n\n${desc}`);
                    }
                });

                calendar.render();

                btnGo.addEventListener('click', function () {
                    const y = yearSelect.value;
                    const m = monthSelect.value;
                    calendar.gotoDate(`${y}-${m}-01`);
                });

                btnToday.addEventListener('click', function () {
                    calendar.today();
                });
            });
        </script>
    @endpush

@endsection
