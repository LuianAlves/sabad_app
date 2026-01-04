@php
    $user = auth()->user();
@endphp

@extends('layouts.templates.user-profile-layout')
@section('content-user-layout')

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
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-wrap justify-content-between align-items-end gap-2 mt-3 mb-2">
            <h1 class="mb-0">Novo Agendamento para: {{ $room->name }}</h1>
            <a href="{{ route('bookings.show', $room) }}" class="btn btn-outline-secondary">← Voltar</a>
        </div>

        {{-- ✅ Mostra erros gerais (para não ficar "só piscando") --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Corrija os campos abaixo:</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
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

                    {{-- ✅ Data vem preenchida / horas começam vazias --}}
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="date" class="form-label">Data</label>
                            <input
                                type="date"
                                name="date"
                                id="date"
                                value="{{ old('date', $defaultDate ?? request('date') ?? '') }}"
                                required
                                class="form-control @error('date') is-invalid @enderror"
                            >
                            @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="start_hour" class="form-label">Hora início</label>
                            <input
                                type="time"
                                name="start_hour"
                                id="start_hour"
                                value="{{ old('start_hour') }}"
                                required
                                class="form-control @error('start_hour') is-invalid @enderror"
                            >
                            @error('start_hour')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="end_hour" class="form-label">Hora fim</label>
                            <input
                                type="time"
                                name="end_hour"
                                id="end_hour"
                                value="{{ old('end_hour') }}"
                                required
                                class="form-control @error('end_hour') is-invalid @enderror"
                            >
                            @error('end_hour')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="description" class="form-label">Descrição</label>
                        <textarea
                            name="description"
                            id="description"
                            rows="4"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="Opcional: pauta, participantes, observações..."
                        >{{ old('description') }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('bookings.show', $room) }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-success">Agendar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
