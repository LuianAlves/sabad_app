@extends('layouts.templates.app-layout')

@section('content')
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
