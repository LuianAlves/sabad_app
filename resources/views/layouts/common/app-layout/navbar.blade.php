<nav
    class="navbar navbar-main navbar-expand-lg mx-5 px-0 shadow-none rounded position-sticky blur shadow-blur mt-4 left-auto top-1 z-index-sticky"
    id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-2">
        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav" style="margin-right: 25px;">
                <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                </div>
            </a>
        </li>

        <x-breadcrumb/>

        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center"></div>
            <ul class="navbar-nav  justify-content-end">
                @php
                    $unreadNotifications = auth()->user()->notifications()->wherePivot('is_read', false)->latest()->take(5)->get();
                    $unreadCount = $unreadNotifications->count();
                @endphp

                <li class="nav-item dropdown" id="notification-area">
                    <a class="nav-link" href="#" id="notificationDropdown" data-bs-toggle="dropdown"
                       aria-expanded="false" aria-label="Notificações">
                        <i class="fa fa-bell"></i>
                        @if($unreadCount > 0)
                            <span class="badge rounded-pill bg-danger notification-badge ms-2"
                                  id="notificationCountBadge">{{ $unreadCount }}</span>
                        @endif
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown"
                        id="notificationDropdownMenu">
                        @forelse($unreadNotifications as $not)
                            <li>
                                <a href="#" class="dropdown-item notification-item fw-bold" data-id="{{ $not->id }}">
                                    <strong>{{ $not->title }}</strong><br>
                                    {{ \Illuminate\Support\Str::limit($not->message, 50) }}
                                </a>
                            </li>
                        @empty
                            <li><span class="dropdown-item text-center">Nenhuma notificação</span></li>
                        @endforelse
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a href="{{ route('notifications.index') }}" class="dropdown-item text-center">Ver todas</a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item ps-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0">
                        @if (auth()->user()->image)
                            <img src="{{ 'data:image/png;base64,' . auth()->user()->image }}" class="avatar avatar-sm"
                                 alt="avatar"/>
                        @else
                            <img src="{{ asset('img/profile/image_profile.webp') }}" class="avatar avatar-sm"
                                 alt="avatar"/>
                        @endif
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

@push('scripts')
    <script>
        function loadNotifications() {
            fetch("{{ route('notifications.unread') }}")
                .then(res => res.json())
                .then(data => {
                    const badge = document.getElementById('notificationCountBadge');
                    const menu = document.getElementById('notificationDropdownMenu');

                    if (data.count > 0) {
                        if (!badge) {
                            // Cria badge se não existir
                            const badgeSpan = document.createElement('span');
                            badgeSpan.id = 'notificationCountBadge';
                            badgeSpan.className = 'badge bg-danger rounded-pill';
                            badgeSpan.textContent = data.count;
                            document.getElementById('notificationDropdown').appendChild(badgeSpan);
                        } else {
                            badge.textContent = data.count;
                            badge.style.display = 'inline-block';
                        }
                    } else {
                        if (badge) {

                            badge.remove();
                        }
                        ;
                    }

                    if (data.count === 0) {
                        menu.innerHTML = '<li><span class="dropdown-item text-center">Nenhuma notificação</span></li>';
                    } else {
                        menu.innerHTML = data.notifications.map(not => `
                        <li>
                            <a href="#" class="dropdown-item notification-item fw-bold" data-id="${not.id}">
                                <strong>${not.title}</strong><br>
                                ${not.message.length > 50 ? not.message.substring(0, 47) + '...' : not.message}
                            </a>
                        </li>
                    `).join('') + `
                    <li><hr class="dropdown-divider"></li>
                    <li><a href="{{ route('notifications.index') }}" class="dropdown-item text-center">Ver todas</a></li>`;
                    }
                })
                .catch(err => console.error('Erro ao carregar notificações:', err));
        }

        function marcarComoLida(notificationId, element) {
            fetch('{{ route('notifications.read') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({notification_id: notificationId})
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        element.classList.remove('fw-bold');
                        element.style.opacity = '0.6';

                        // Aguarda 300ms antes de atualizar lista/badge
                        setTimeout(() => {
                            loadNotifications();
                        }, 300);
                    } else {
                        alert('Erro ao marcar notificação como lida');
                    }
                })
                .catch(err => {
                    console.error('Erro na requisição:', err);
                    alert('Erro na comunicação com o servidor');
                });
        }

        document.addEventListener('DOMContentLoaded', function () {
            loadNotifications();
            setInterval(loadNotifications, 10000);

            document.getElementById('notificationDropdownMenu').addEventListener('click', function (e) {
                const item = e.target.closest('.notification-item');
                if (item) {
                    e.preventDefault();
                    const id = item.dataset.id;
                    marcarComoLida(id, item);
                }
            });
        });
    </script>
@endpush

