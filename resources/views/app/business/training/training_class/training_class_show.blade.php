@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Turma #{{ $turma->id }}</h1>
        <p><strong>Treinamento:</strong> {{ $turma->training->title }}</p>
        <p><strong>Instrutor:</strong> {{ $turma->instructor->name }}</p>
        <p><strong>Sala:</strong> {{ $turma->meetClass->name }}</p>
        <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($turma->start_date)->format('d/m/Y') }} até {{ $turma->end_date ? \Carbon\Carbon::parse($turma->end_date)->format('d/m/Y') : '-' }}</p>
        <p><strong>Capacidade:</strong> {{ $turma->capacity }}</p>
        <p><strong>Ocupação:</strong> {{ $turma->participants->count() }}</p>

        <h3>Participantes</h3>
        <ul>
            @forelse($turma->participants as $p)
                <li>{{ $p->name }} ({{ $p->department->name }})</li>
            @empty
                <li>Sem participantes</li>
            @endforelse
        </ul>

        <form action="{{ route('turmas.participants.random',$turma) }}" method="POST" style="display:inline">
            @csrf
            <button class="btn btn-secondary">Sortear Participantes</button>
        </form>
        <button class="btn btn-primary btn-open-email" data-id="{{ $turma->id }}" data-template="Olá {COLABORADOR}, você foi selecionado para participar do {TREINAMENTO} em {DATA_TREINAMENTO}.">Enviar E-mail</button>
    </div>

    @include('business.training.training_class.training_class_modal')
@endsection
