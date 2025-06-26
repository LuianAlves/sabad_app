@role('user')
@extends('layouts.templates.user-profile-layout') 

@section('content-user-layout')
<div class="container py-4">
    <h4 class="mb-4">Meus Tickets</h4>

    @if($tickets && $tickets->count())
        <ul class="list-group">
            @foreach ($tickets as $ticket)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $ticket->title }}
                    <span class="badge bg-primary rounded-pill">{{ $ticket->status }}</span>
                </li>
            @endforeach
        </ul>
    @else
        <p>Nenhum ticket encontrado.</p>
    @endif

    <a href="{{ route('ticket.collaborator.create') }}" class="btn btn-primary">
        Abrir Novo Chamado
    </a>
</div>
@endsection
@endrole