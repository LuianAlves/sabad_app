@extends('layouts.templates.app-layout')

@section('content')
    <div class="container">
        <h1>Novo Agendamento para: {{ $room->name }}</h1>

        <form action="{{ route('bookings.store', $room) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input
                    type="text"
                    name="title"
                    id="title"
                    value="{{ old('title') }}"
                    required
                    class="form-control @error('title') is-invalid @enderror"
                >
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="start_time" class="form-label">Data e hora início</label>
                <input
                    type="datetime-local"
                    name="start_time"
                    id="start_time"
                    value="{{ old('start_time') }}"
                    required
                    class="form-control @error('start_time') is-invalid @enderror"
                >
                @error('start_time')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="end_time" class="form-label">Data e hora fim</label>
                <input
                    type="datetime-local"
                    name="end_time"
                    id="end_time"
                    value="{{ old('end_time') }}"
                    required
                    class="form-control @error('end_time') is-invalid @enderror"
                >
                @error('end_time')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrição</label>
                <textarea
                    name="description"
                    id="description"
                    class="form-control @error('description') is-invalid @enderror"
                >{{ old('description') }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Agendar</button>
            <a href="{{ route('bookings.show', $room) }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
