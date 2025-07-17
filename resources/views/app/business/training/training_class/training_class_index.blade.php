{{-- resources/views/turmas/index.blade.php --}}
@extends('layouts.templates.app-layout')
@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="container">
        <h1>Turmas</h1>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Treinamento</th>
                <th>Instrutor</th>
                <th>Ocupação</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($trainingClasss as $t)
                <tr>
                    <td>{{ $t->id }}</td>
                    <td>{{ $t->training->title }}</td>
                    <td>{{ $t->instructor->name }}</td>
                    <td>{{ $t->participants->count() }}/{{ $t->capacity }}</td>
                    <td>
                        <!-- botão Lista de Participantes -->
                        <button class="btn btn-sm btn-info"
                                data-bs-toggle="modal"
                                data-bs-target="#participantsModal{{ $t->id }}">
                            Participantes
                        </button>

                        <!-- botão de Notificar por e‑mail -->
                        <button class="btn btn-sm btn-success"
                                data-bs-toggle="modal"
                                data-bs-target="#notifyModal{{ $t->id }}">
                            Notificar
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{-- Modal de Participantes --}}
        @foreach($trainingClasss as $t)
            <div class="modal fade" id="participantsModal{{ $t->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Participantes Turma #{{ $t->id }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <ul class="list-group">
                                @forelse($t->participants as $p)
                                    <li class="list-group-item">
                                        {{ $p->name }}
                                        <small class="text-muted">({{ $p->department->name ?? '—' }})</small>
                                    </li>
                                @empty
                                    <li class="list-group-item">Nenhum participante.</li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- Modal de Notificação por E‑mail --}}
        @foreach($trainingClasss as $t)
            <div class="modal fade" id="notifyModal{{ $t->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <form class="modal-content" method="POST" action="{{ route('training.send-email', $t) }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Notificar Turma #{{ $t->id }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p>Use as variáveis abaixo no texto:</p>
                            <small>
                                {COLABORADOR}, {TREINAMENTO}, {DATA_TREINAMENTO}
                            </small>
                            <textarea name="template"
                                      class="form-control mt-2"
                                      rows="4">Olá {COLABORADOR}, você foi selecionado para participar do {TREINAMENTO} que acontecerá em {DATA_TREINAMENTO}.</textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Enviar E‑mail</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
