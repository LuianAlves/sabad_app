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
    @endunless

    {{-- Conteúdo comum para todos --}}
    <div class="container">
        <h1 class="mb-4">Salas disponíveis</h1>
        <div class="row">
            @foreach($rooms as $room)
                <div class="col-md-3 mb-4">
                    <a href="{{ route('bookings.show', $room) }}" class="text-decoration-none">
                        <div class="card text-center p-4 shadow-sm" style="cursor: pointer;">
                            <h3>{{ $room->name }}</h3>
                            <p>{{ $room->company->name ?? 'Nenhuma ainda' }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
