@php

    $user = auth()->user();
@endphp

@extends('layouts.templates.user-profile-layout')
@section('content-user-layout')

        {{-- Cabeçalho do perfil para usuários com role "user" --}}
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
                            <p class="mb-0">
                                {{-- {{ $user->email }} --}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
