@extends('layouts.templates.app-layout')

@section('content')
    <div class="container">
        <h1>Agendamentos para: {{ $room->name }}</h1>

        {{-- Botão novo agendamento sempre visível --}}
        <a href="{{ route('bookings.create', $room) }}" class="btn btn-primary mb-3">Novo Agendamento</a>

        <a href="{{ route('bookings.index') }}" class="btn btn-secondary mb-3">← Voltar</a>

        {{-- Formulário filtro por data --}}
        <form action="{{ route('bookings.show', $room) }}" method="GET" class="mb-4 d-flex align-items-center gap-2">
            <label for="date" class="form-label mb-0">Filtrar por data:</label>
            <input
                type="date"
                name="date"
                id="date"
                value="{{ request('date') }}"
                class="form-control"
                style="max-width: 200px;"
            >
            <button type="submit" class="btn btn-primary">Buscar</button>
            <a href="{{ route('bookings.show', $room) }}" class="btn btn-secondary">Limpar</a>
        </form>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if($bookings->isEmpty())
            <p>Não há agendamentos futuros para esta sala.</p>
        @else
            <div class="list-group">
                @foreach($bookings->groupBy(function($item) {
                    return \Carbon\Carbon::parse($item->start_time)->format('d/m/Y');
                }) as $date => $items)
                    <h5 class="mt-3">{{ $date }}</h5>
                    <ul class="list-group mb-4">
                        @foreach($items as $booking)
                            <li class="list-group-item">
                                <strong>{{ $booking->title }}</strong><br>
                                {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}
                                <br>
                                {{ $booking->description }}<br>
                                <small>Agendado por: {{ $booking->user->name ?? 'Desconhecido' }}</small>
                            </li>
                        @endforeach

                    </ul>
                @endforeach
            </div>
        @endif
    </div>

@endsection
