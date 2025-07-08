<x-user-profile-layout>
    @section('content-user-layout')
        <div class="pt-7 pb-6 bg-info"></div>
            
        <div class="container">
            <div class="card card-body py-2 bg-transparent shadow-none">
                <div class="row">
                    <div class="col-auto">
                        {{-- <div class="avatar avatar-2xl rounded-circle position-relative mt-n7 border border-gray-100 border-4">
                            
                            @if (isset($user) && $user->image)
                            <img src="{{ 'data:image/png;base64,' . $user->image }}" alt="profile_image" class="w-100">
                            @else
                            <img src="{{ asset('img/profile/image_profile.webp') }}" alt="profile_image" class="w-100">
                            @endif

                        </div> --}}
                        <div
                            class="avatar avatar-2xl rounded-circle position-relative mt-n7 border border-gray-100 border-4">
                            @if (isset($user))
                                {{-- {{ dd($user) }} <!-- Adicione esta linha para depuração --> --}}
                                @if ($user->image)
                                    <img src="{{ 'data:image/png;base64,' . $user->image }}" alt="profile_image"
                                        class="w-100">
                                @else
                                    <img src="{{ asset('img/profile/image_profile.webp') }}" alt="profile_image"
                                        class="w-100">
                                @endif
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
        <div class="container">
            <div class="container">
                <h4 class="mb-4">Todos os Contatos</h4>

                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @forelse($users as $contact)
                        <div class="col">
                            <div class="card h-100 position-relative">

                                {{-- Indicador de nova mensagem --}}
                                <span class="position-absolute top-0 end-0 translate-middle badge rounded-pill"
                                    id="count-message-{{ $contact->id }}"
                                    style="z-index: 10; font-size: 1rem; min-width: 20px; height: 20px; 
             display: flex; align-items: center; justify-content: center; 
             background-color: #dc3545 !important; /* vermelho bootstrap bg-danger */
             color: white;
             box-shadow: 0 0 6px rgba(220, 53, 69, 0.7); /* sombra vermelha */
             border: 2px solid white;">
                                    {{ $contact->unread_count }}
                                </span>

                                <span class="position-absolute top-0 start-0 translate-middle-y ms-3 mt-3"
                                    style="width: 16px; height: 16px; display: inline-block;">
                                    <span class="d-block rounded-circle border border-white"
                                        style="width: 16px; height: 16px; background: {{ $contact->isOnline() ? '#28a745' : '#6c757d' }};"
                                        title="{{ $contact->isOnline() ? 'Online' : 'Offline' }}">
                                    </span>
                                </span>


                                <div class="card-body d-flex align-items-center">
                                    <div class="me-3">
                                        @if ($contact->image)
                                            <img src="{{ 'data:image/png;base64,' . $contact->image }}"
                                                alt="{{ $contact->name }}" class="rounded-circle"
                                                style="width: 48px; height: 48px;">
                                        @else
                                            <img src="{{ asset('img/profile/image_profile.webp') }}"
                                                alt="{{ $contact->name }}" class="rounded-circle"
                                                style="width: 48px; height: 48px;">
                                        @endif
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $contact->name }}</h6>
                                        <small class="text-muted">{{ $contact->email }}</small>
                                    </div>
                                    <div class="ms-auto">
                                        <a href="#" class="btn btn-sm btn-primary openChatModal"
                                            data-bs-toggle="modal" data-bs-target="#chatModal"
                                            data-user="{{ $contact->id }}" data-name="{{ $contact->name }}">
                                            Chat
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">Nenhum contato encontrado.</p>
                    @endforelse
                </div>
            </div>

        </div>
        </div>
        <div class="col">
            <div class="card h-100 position-relative">
                @if ($contact->has_unread_messages)
                    <span
                        class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                        <span class="visually-hidden">Mensagem não lida</span>
                    </span>
                @endif


                <div class="card-body d-flex align-items-center">



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

                            function countMessages() {
                                fetch('/chat/check/message')
                                    .then(res => res.json())
                                    .then(data => {
                                        if (data.status === 'success') {
                                            data.count.forEach(contact => {
                                                // Monta o id do span referente ao contato
                                                const badge = document.getElementById('count-message-' + contact.id);
                                                if (badge) {
                                                    badge.textContent = contact.unread_count;
                                                    // Mostra ou esconde o badge conforme necessário
                                                    badge.style.display = contact.unread_count > 0 ? 'flex' : 'none';
                                                }
                                            });
                                        }
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

                            setInterval(() => {
                                if (currentChatUserId) loadMessages(currentChatUserId);
                                countMessages();
                            }, 3000);

                        });
                    </script>

                @endsection
</x-user-profile-layout>
