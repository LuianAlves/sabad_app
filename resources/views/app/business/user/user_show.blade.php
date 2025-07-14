<x-user-profile-layout>
    @section('content-user-layout')
        <div class="pt-7
                pb-6 bg-cover bg-info"
            ></div>

        <div class="container">
            <div class="card card-body py-2 bg-transparent shadow-none">
                <div class="row">
                    <div class="col-auto">
                        <div
                            class="avatar avatar-2xl rounded-circle position-relative mt-n7 border border-gray-100 border-4">
                            @if (isset($user) && $user->image)
                                <img src="{{ 'data:image/png;base64,' . $user->image }}" alt="profile_image" class="w-100">
                            @else
                                <img src="{{ asset('img/profile/image_profile.webp') }}" alt="profile_image" class="w-100">
                            @endif
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h3 class="mb-0 font-weight-bold">
                                {{ auth()->user()->name }}
                            </h3>
                            <p class="mb-0">
                                {{-- {{ $user->email }} --}}
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="container my-3 py-3">
            <div class="row">


                <div class="col-12 col-xl-4 mb-4">
                    <div class="card border shadow-xs h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 col-9">
                                    <h6 class="mb-0 font-weight-semibold text-lg">Informações do Perfil</h6>
                                    {{-- <p class="text-sm mb-1">Edit the information about you.</p> --}}
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group">

                                <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pt-0 pb-1 text-sm">
                                    <span class="text-secondary">Nome:</span>
                                    {{ explode(' ', auth()->user()->name)[0] }}

                                </li>

                                <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                    <span class="text-secondary">Sobrenome:</span>
                                     {{ explode(' ', auth()->user()->name)[1] }}

                                </li>

                                <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                    <span class="text-secondary">Telefone:</span>
                                    @if (optional(auth()->user()->employeeUser->employee->chipControl)->number)
                                        {{ auth()->user()->employeeUser->employee->chipControl->ddd }}
                                        {{ auth()->user()->employeeUser->employee->chipControl->number }}
                                    @else
                                        <span class="text-muted">Não informado</span>
                                    @endif

                                </li>

                                <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                    <span class="text-secondary">Cargo:</span>
                                    {{ auth()->user()->employeeUser->employee->hierarchical_level }}

                                </li>

                                <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                    <span class="text-secondary">Empresa:</span>
                                    {{ auth()->user()->employeeUser->employee->department->company->name }}

                                </li>

                                <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                    <span class="text-secondary">Ramal:</span>
                                    {{ optional(optional(optional(auth()->user()->employeeUser)->employee)->extension)->number ?? 'Não informado' }}

                                </li>

                                <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                    <span class="text-secondary">E-mail:</span> {{ auth()->user()->email }}

                                </li>

                                <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                    <span class="text-secondary">Social:</span> &nbsp;
                                    <a class="btn btn-link text-dark mb-0 ps-1 pe-1 py-0" href="javascript:;">
                                        <i class="fab fa-linkedin fa-lg"></i>
                                    </a>
                                    <a class="btn btn-link text-dark mb-0 ps-1 pe-1 py-0" href="javascript:;">
                                        <i class="fab fa-github fa-lg"></i>
                                    </a>
                                    <a class="btn btn-link text-dark mb-0 ps-1 pe-1 py-0" href="javascript:;">
                                        <i class="fab fa-slack fa-lg"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-4 mb-4">
                    <div class="card border shadow-xs h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row mb-sm-0 mb-2">
                                <div class="col-md-8 col-9">

                                    {{-- TESTE CHAT --}}
                                    <h6 class="mb-0 font-weight-semibold text-lg">Colegas de equipe</h6>

                                </div>
                            </div>
                        </div>

                        @php
                            $departmentId = auth()->user()?->employeeUser?->employee?->department_id;
                            $teams = collect();
                            if ($departmentId) {
                                $teams = App\Models\Business\Employee\Employee::where('department_id', $departmentId)
                                    ->whereHas('employeeUser.user')
                                    ->whereHas('employeeUser', fn($q) => $q->where('user_id', '!=', auth()->id()))
                                    ->get();
                            }
                        @endphp

                        <ul class="list-group">
                            @foreach ($teams as $team)
                                @php
                                    $unreadCount = \App\Models\Message::where(
                                        'sender_id',
                                        $team->employeeUser->user->id,
                                    )
                                        ->where('receiver_id', auth()->id())
                                        ->where('is_read', false)
                                        ->count();
                                @endphp
                                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-1">
                                    <div class="avatar avatar-sm rounded-circle me-2">
                                        @if ($team->employeeUser?->user?->image)
                                            <img src="{{ 'data:image/png;base64,' . $team->employeeUser->user->image }}"
                                                alt="{{ $team->getDisplayName() }}" class="w-100">
                                        @else
                                            <img src="{{ asset('img/profile/image_profile.webp') }}"
                                                alt="{{ $team->getDisplayName() }}" class="w-100">
                                        @endif
                                    </div>
                                    <div class="d-flex align-items-start flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm font-weight-semibold d-flex align-items-center">
                                            <a href="#" class="text-dark openChatModal username me-1"
                                                data-bs-toggle="modal" data-bs-target="#chatModal"
                                                data-user="{{ $team->employeeUser->user->id }}"
                                                data-name="{{ $team->getDisplayName() }}"
                                                data-avatar="data:image/png;base64,{{ $team->employeeUser->user->image }}"
                                                data-user-id="{{ $team->employeeUser->user->id }}">
                                                {{ $team->getDisplayName() }}
                                            </a>

                                            @if ($unreadCount > 0)
                                                <span class="badge rounded-pill bg-danger notification-badge ms-2"
                                                    data-user-id="{{ $team->employeeUser->user->id }}"
                                                    style="
                                                        font-size: 0.75rem !important;
                                                        min-width: 24px !important;
                                                        height: 24px !important;
                                                        display: inline-flex !important;
                                                        align-items: center !important;
                                                        justify-content: center !important;
                                                        padding: 0 6px !important;
                                                        background-color: #dc3545 !important;
                                                        color: white !important;
                                                        border: 2px solid white !important;
                                                        line-height: 1 !important;
                                                        box-shadow: 0 0 6px rgba(220, 53, 69, 0.9) !important;
                                                        opacity: 1 !important;
                                                        visibility: visible !important;
                                                    ">
                                                    {{ $unreadCount }}
                                                </span>
                                            @endif



                                        </h6>


                                        <p class="mb-0 text-sm text-secondary">
                                            {{ $team->employeeUser?->user?->email ?? '' }}
                                        </p>
                                    </div>

                                    <span
                                        class="p-2 {{ $team->employeeUser->user->isOnline() ? 'bg-success' : 'bg-secondary' }} rounded-circle ms-auto me-3"
                                        style="width: 14px; height: 14px; display: inline-block; border: 2px solid white;">
                                        <span class="visually-hidden">
                                            {{ $team->employeeUser->user->isOnline() ? 'Online' : 'Offline' }}
                                        </span>
                                    </span>


                                </li>
                            @endforeach
                        </ul>
                        <div class="position-absolute bottom-0 end-0 p-3">
                            <a href="{{ route('contacts.index') }}" class="btn btn-sm btn-primary"
                                style="background-color: #0A0F1F;">
                                Ver todos os contatos
                            </a>
                        </div>

                        <!-- Modal único para o chat -->
                        <div class="modal fade" id="chatModal" tabindex="-1" aria-labelledby="chatModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <img id="chatModalAvatar" src="/img/profile/image_profile.webp" alt="Avatar"
                                            style="width:40px; height:40px; border-radius:50%; object-fit:cover; background:#eee;">
                                        <h5 class="modal-title" style="font-size: 16px; margin-left: 10px;"
                                            id="chatModalLabel"></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Fechar"><b>X</b></button>
                                    </div>
                                    <div class="modal-body p-0" id="chatMessages" style="background:#ece5dd;">
                                    </div>
                                    <div class="modal-footer">
                                        <form id="chatForm" class="w-100 d-flex align-items-center gap-2">
                                            <input type="hidden" id="chatUserId" name="receiver_id">
                                            <input type="text" id="chatInput" name="message" class="form-control"
                                                placeholder="Digite sua mensagem..." required>
                                            <button type="submit" class="btn btn-primary">Enviar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- JavaScript para abrir modal e preencher dados -->
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const chatForm = document.getElementById('chatForm');
                                const chatInput = document.getElementById('chatInput');
                                const chatMessages = document.getElementById('chatMessages');
                                const chatUserIdInput = document.getElementById('chatUserId');
                                const modal = document.getElementById('chatModal');

                                const currentUserId = {{ auth()->id() }}; // Passa o id do usuário logado para JS
                                let refreshInterval = null;
                                let currentChatUserId = null;

                                // Função para carregar mensagens do chat
                                function loadMessages(userId) {
                                    fetch(`/chat/messages/${userId}`)
                                        .then(res => res.json())
                                        .then(messages => {
                                            chatMessages.innerHTML = '';
                                            messages.forEach(msg => {
                                                const msgContainer = document.createElement('div');
                                                msgContainer.classList.add('d-flex', 'align-items-end', 'gap-2', 'mb-2');
                                                if (msg.sender_id == currentUserId) {
                                                    msgContainer.classList.add('justify-content-end');
                                                } else {
                                                    msgContainer.classList.add('justify-content-start');
                                                }

                                                const avatar = document.createElement('img');
                                                avatar.src = msg.avatar || '/img/profile/image_profile.webp';
                                                avatar.alt = 'Avatar';
                                                avatar.style.width = '32px';
                                                avatar.style.height = '32px';
                                                avatar.style.borderRadius = '50%';
                                                avatar.style.objectFit = 'cover';
                                                avatar.style.background = '#eee';

                                                const msgElem = document.createElement('div');
                                                msgElem.classList.add('msg');
                                                msgElem.innerHTML = `
                                                    <div>${msg.message}</div>
                                                    <div class="text-end text-muted" style="font-size:11px; margin-top:2px;">${formatHora(msg.created_at)}</div>
                                                `;
                                                if (msg.sender_id == currentUserId) {
                                                    msgElem.classList.add('msg-send');
                                                } else {
                                                    msgElem.classList.add('msg-receive');
                                                }

                                                if (msg.sender_id == currentUserId) {
                                                    msgContainer.appendChild(msgElem);
                                                    msgContainer.appendChild(avatar);
                                                } else {
                                                    msgContainer.appendChild(avatar);
                                                    msgContainer.appendChild(msgElem);
                                                }
                                                chatMessages.appendChild(msgContainer);
                                            });
                                            chatMessages.scrollTop = chatMessages.scrollHeight;
                                        });
                                }

                                function formatHora(dataString) {
                                    const d = new Date(dataString);
                                    let h = d.getHours();
                                    let m = d.getMinutes();
                                    if (h < 10) h = '0' + h;
                                    if (m < 10) m = '0' + m;
                                    return `${h}:${m}`;
                                }

                                // Remove badge de notificação para um usuário específico
                                function removeNotificationBadge(userId) {
                                    const badge = document.querySelector(`.notification-badge[data-user-id="${userId}"]`);
                                    if (badge) badge.remove();
                                }

                                // Atualiza notificações de mensagens não lidas para todos os usuários
                                function refreshNotifications() {
                                    fetch('/chat/check-messages')
                                        .then(res => res.json())
                                        .then(data => {
                                            data.count.forEach(user => {
                                                const badgeEl = document.querySelector(
                                                    `.notification-badge[data-user-id="${user.id}"]`);
                                                const usernameEl = document.querySelector(
                                                    `.username[data-user-id="${user.id}"]`);

                                                if (user.unread_count > 0) {
                                                    if (!badgeEl && usernameEl) {
                                                        const span = document.createElement('span');
                                                        span.className =
                                                            'badge rounded-pill bg-danger notification-badge ms-2';
                                                        span.dataset.userId = user.id;
                                                        span.style.cssText = `
                                                            font-size: 0.75rem;
                                                            min-width: 24px;
                                                            height: 24px;
                                                            display: inline-flex;
                                                            align-items: center;
                                                            justify-content: center;
                                                            padding: 0 6px;
                                                            background-color: #dc3545 !important;
                                                            color: white;
                                                            border: 2px solid white;
                                                            line-height: 1;
                                                            box-shadow: 0 0 6px rgba(220, 53, 69, 0.9);
                                `;
                                                        span.textContent = user.unread_count;
                                                        usernameEl.appendChild(span);
                                                    } else if (badgeEl) {
                                                        badgeEl.textContent = user.unread_count;
                                                    }
                                                } else {
                                                    if (badgeEl) badgeEl.remove();
                                                }
                                            });
                                        });
                                }

                                // Ao clicar para abrir o chat
                                document.querySelectorAll('.openChatModal').forEach(link => {
                                    link.addEventListener('click', function() {
                                        const userId = this.getAttribute('data-user');
                                        const userName = this.getAttribute('data-name');

                                        const avatarUrl = this.getAttribute('data-avatar') ||
                                            '/img/profile/image_profile.webp';

                                        currentChatUserId = userId;

                                        document.getElementById('chatModalLabel').textContent = `${userName}`;
                                        document.getElementById('chatModalAvatar').src = avatarUrl;

                                        chatUserIdInput.value = userId;
                                        chatInput.value = '';
                                        chatMessages.innerHTML = '<p class="text-muted spinner-chat"></p>';

                                        loadMessages(userId);

                                        // Remove badge ao abrir chat
                                        removeNotificationBadge(userId);

                                        // Inicia atualização periódica das mensagens do chat aberto
                                        if (refreshInterval) clearInterval(refreshInterval);
                                        refreshInterval = setInterval(() => {
                                            loadMessages(userId);
                                        }, 3000);
                                    });
                                });

                                // Para atualização quando modal for fechado
                                modal.addEventListener('hidden.bs.modal', function() {
                                    if (refreshInterval) {
                                        clearInterval(refreshInterval);
                                        refreshInterval = null;
                                    }
                                    currentChatUserId = null;
                                });

                                // Envio do formulário de mensagem
                                chatForm.addEventListener('submit', function(e) {
                                    e.preventDefault();

                                    const receiverId = chatUserIdInput.value;
                                    const message = chatInput.value.trim();
                                    if (!message) return;

                                    fetch('/chat/send', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                            },
                                            body: JSON.stringify({
                                                receiver_id: receiverId,
                                                message: message
                                            })
                                        }).then(res => res.json())
                                        .then(data => {
                                            if (data.success) {
                                                chatInput.value = '';
                                                loadMessages(receiverId);
                                            } else {
                                                alert('Erro ao enviar a mensagem.');
                                            }
                                        }).catch(err => {
                                            console.error(err);
                                            alert('Erro ao enviar a mensagem.');
                                        });
                                });



                                // Atualiza notificações a cada 3 segundos, uma única vez aqui
                                setInterval(refreshNotifications, 3000);

                                // Atualiza logo que a página carrega
                                refreshNotifications();
                            });
                        </script>


                    </div>
                </div>

                <div class="col-12 col-xl-4 mb-4">
                    <div class="card border shadow-xs h-100 position-relative">
                        <div class="card-header pb-0 p-3">
                            <div class="row mb-sm-0 mb-2">
                                <div class="col-md-8 col-9">
                                    <h6 class="mb-0 font-weight-semibold text-lg">Chamados Recentes</h6>
                                </div>
                            </div>
                        </div>

                        @php
                            $userId = auth()->id();
                            $userTickets = $tickets
                                ->where('user_id', $userId)
                                ->where('status', '!=', 'completed')
                                ->take(5);

                            $statusClasses = [
                                'open' => 'border-info text-info bg-info',
                                'in progress' => 'border-warning text-warning bg-warning',
                                'completed' => 'border-success text-success bg-success',
                                'canceled' => 'border-danger text-danger bg-danger',
                            ];

                            $statusIcons = [
                                'open' => 'fa-envelope-open-text',
                                'in progress' => 'fa-spinner',
                                'completed' => 'fa-check-circle',
                                'canceled' => 'fa-times-circle',
                            ];

                            $statusLabels = [
                                'open' => 'Aberto',
                                'in progress' => 'Em andamento',
                                'completed' => 'Concluído',
                                'canceled' => 'Cancelado',
                            ];
                        @endphp

                        @if ($userTickets->count())
                            <ul class="list-group small">
                                @foreach ($userTickets as $ticket)
                                    @php
                                        $status = $ticket->status;
                                        $classes =
                                            $statusClasses[$status] ?? 'border-secondary text-secondary bg-secondary';
                                        $icon = $statusIcons[$status] ?? 'fa-question-circle';
                                        $label = $statusLabels[$status] ?? ucfirst($status);
                                    @endphp
                                    <li
                                        class="list-group-item py-1 px-2 d-flex justify-content-between align-items-center">
                                        {{ $ticket->ticketCategory->name . ' / ' . $ticket->title }}
                                        <span class="badge rounded-pill {{ $classes }}"
                                            style="opacity: 1 !important; filter: none !important;">
                                            <i class="fas {{ $icon }} me-1"></i> {{ $label }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">Nenhum ticket encontrado.</p>
                        @endif

                        <div class="position-absolute bottom-0 end-0 p-3">
                            <a href="{{ route('ticket.collaborator.index') }}" class="btn btn-sm btn-primary"
                                style="background-color: #0A0F1F;">
                                Ver todos
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-4 mb-4">
                    <div class="card border shadow-xs h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row mb-sm-0 mb-2">
                                <div class="col-md-8 col-9">
                                    <h6 class="mb-0 font-weight-semibold text-lg">Informações do GoTo</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group">

                                <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                    <span class="text-secondary">E-mail GoTo:</span> {{ auth()->user()->email }}

                                </li>
                                <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                    <span class="text-secondary">Senha GoTo:</span>
                                    {{ optional(optional(optional(auth()->user()->employeeUser)->employee)->extension)->password ?? 'Não informado' }}

                                </li>
                                <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                    <span class="text-secondary">Download:</span>
                                    <a href="https://www.goto.com/pt/download" target="_blank">
                                        https://www.goto.com/pt/download
                                    </a>
                                </li>

                                <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                    <span class="text-secondary">Link Reunião:</span>
                                    <a href="{{ optional(optional(optional(auth()->user()->employeeUser)->employee)->extension)->meet ?? 'Não Informado' }}"
                                        target="_blank">
                                        {{ optional(optional(optional(auth()->user()->employeeUser)->employee)->extension)->meet ?? 'Não Informado' }}
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Include:Footer -->
                @include('layouts.common.footer')
            </div>

        @endsection
</x-user-profile-layout>
