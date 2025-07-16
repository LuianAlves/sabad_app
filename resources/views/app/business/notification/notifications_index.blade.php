@extends('layouts.templates.app-layout')

@section('content')
    <div class="container mt-4">
        <h3>Minhas Notificações</h3>

        <h5>Novas notificações</h5>
        @if($newNotifications->isEmpty())
            <p>Nenhuma nova notificação.</p>
        @else
            <ul class="list-group mb-4">
                @foreach($newNotifications as $not)
                    <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                        <div>
                            <strong>{{ $not->title }}</strong>
                            <p class="mb-1">{{ $not->message }}</p>
                            <small>{{ $not->created_at->format('d/m/Y H:i') }}</small>
                        </div>
{{--                        <button class="btn btn-sm btn-outline-primary mark-as-read" data-id="{{ $not->id }}">Marcar como lida</button>--}}
                    </li>
                @endforeach
            </ul>
        @endif

        <h5>Notificações antigas</h5>
        @if($oldNotifications->isEmpty())
            <p>Nenhuma notificação antiga.</p>
        @else
            <ul class="list-group">
                @foreach($oldNotifications as $not)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $not->title }}</strong>
                            <p class="mb-1">{{ $not->message }}</p>
                            <small>{{ $not->created_at->format('d/m/Y H:i') }}</small>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif

    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.mark-as-read').forEach(btn => {
                btn.addEventListener('click', function () {
                    const notificationId = this.dataset.id;
                    const li = this.closest('li');

                    fetch('{{ route('notifications.read') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ notification_id: notificationId })
                    })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                // Remove botão
                                this.remove();
                                // Remove destaque visual
                                li.classList.remove('fw-bold');
                                // Opcional: remove da lista para atualizar visual
                                // li.remove();
                            } else {
                                alert('Erro ao marcar como lida');
                            }
                        })
                        .catch(() => alert('Erro na comunicação'));
                });
            });
        });
    </script>
@endsection
