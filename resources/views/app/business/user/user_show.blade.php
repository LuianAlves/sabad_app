<x-user-profile-layout>
    @section('content-user-layout')
        <div class="pt-7 pb-6 bg-cover"
            style="background-image: url('../img/header-orange-purple.jpg'); background-position: bottom;"></div>

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
                                    <span class="text-secondary">Nome:</span> {{ explode(' ', auth()->user()->name)[0] }}

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
                                        <h6 class="mb-0 text-sm font-weight-semibold">
                                            <a href="#" class="text-dark openChatModal" data-bs-toggle="modal"
                                                data-bs-target="#chatModal" data-user="{{ $team->employeeUser->user->id }}"
                                                data-name="{{ $team->getDisplayName() }}">
                                                {{ $team->getDisplayName() }}
                                            </a>
                                        </h6>
                                        <p class="mb-0 text-sm text-secondary">
                                            {{ $team->employeeUser?->user?->email ?? '' }}</p>
                                    </div>
                                    <span class="p-1 bg-success rounded-circle ms-auto me-3">
                                        <span class="visually-hidden">Online</span>
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
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="chatModalLabel">Chat</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Fechar"></button>
                                    </div>
                                    <div class="modal-body" id="chatMessages" style="max-height: 300px; overflow-y: auto;">
                                        <p class="text-muted">Selecione um colega para iniciar uma conversa.</p>
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

                                let refreshInterval = null;
                                let currentChatUserId = null;

                                function loadMessages(userId) {
                                    fetch(`/chat/messages/${userId}`)
                                        .then(res => res.json())
                                        .then(messages => {
                                            chatMessages.innerHTML = '';
                                            messages.forEach(msg => {
                                                const msgElem = document.createElement('div');
                                                msgElem.classList.add('mb-1', 'text-sm', 'p-1', 'rounded');
                                                msgElem.textContent = msg.message;

                                                if (msg.sender_id == {{ auth()->id() }}) {
                                                    msgElem.classList.add('text-end', 'bg-light');
                                                } else {
                                                    msgElem.classList.add('text-start', 'bg-secondary', 'text-white');
                                                }

                                                chatMessages.appendChild(msgElem);
                                            });

                                            chatMessages.scrollTop = chatMessages.scrollHeight;
                                        });
                                }

                                document.querySelectorAll('.openChatModal').forEach(link => {
                                    link.addEventListener('click', function() {
                                        const userId = this.getAttribute('data-user');
                                        const userName = this.getAttribute('data-name');

                                        currentChatUserId = userId;

                                        document.getElementById('chatModalLabel').textContent = `Chat com ${userName}`;
                                        chatUserIdInput.value = userId;
                                        chatInput.value = '';
                                        chatMessages.innerHTML = '<p class="text-muted">Carregando mensagens...</p>';

                                        // Carrega mensagens imediatamente
                                        loadMessages(userId);

                                        // Inicia atualização automática a cada 3 segundos
                                        if (refreshInterval) clearInterval(refreshInterval);
                                        refreshInterval = setInterval(() => {
                                            loadMessages(userId);
                                        }, 3000);
                                    });
                                });

                                // Quando o modal for fechado, interrompe a atualização
                                const modal = document.getElementById('chatModal');
                                modal.addEventListener('hidden.bs.modal', function() {
                                    if (refreshInterval) {
                                        clearInterval(refreshInterval);
                                        refreshInterval = null;
                                    }
                                    currentChatUserId = null;
                                });

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
                                                // Recarrega mensagens após envio
                                                loadMessages(receiverId);
                                            } else {
                                                alert('Erro ao enviar a mensagem.');
                                            }
                                        }).catch(err => {
                                            console.error(err);
                                            alert('Erro ao enviar a mensagem.');
                                        });
                                });
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
