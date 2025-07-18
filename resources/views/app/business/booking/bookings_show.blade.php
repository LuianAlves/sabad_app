@php
    $isAdmin = auth()->user()->hasRole('admin');
    $layout = $isAdmin
        ? 'layouts.templates.app-layout'
        : 'layouts.templates.user-profile-layout';

    $section = $isAdmin ? 'content' : 'content-user-layout';
    $user = auth()->user();
@endphp

@extends($layout)

@section($section)

    @unless($isAdmin)
        {{-- Cabeçalho do perfil para usuários com role "user" --}}
        <div class="pt-7 pb-6 bg-cover bg-info"></div>

        <div class="container">
            <div class="card card-body py-2 bg-transparent shadow-none">
                <div class="row">
                    <div class="col-auto">
                        <div
                            class="avatar avatar-2xl rounded-circle position-relative mt-n7 border border-gray-100 border-4">
                            @if ($user->image)
                                <img src="{{ 'data:image/png;base64,' . $user->image }}" alt="profile_image"
                                     class="w-100">
                            @else
                                <img src="{{ asset('img/profile/image_profile.webp') }}" alt="profile_image"
                                     class="w-100">
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
    @endunless

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
                                {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}
                                - {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}
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
