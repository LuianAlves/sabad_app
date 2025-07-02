<x-user-profile-layout>
    @section('content-user-layout')
        <div class="pt-7 pb-6 bg-cover" 
     style="background-image: url('{{ asset('img/header-orange-purple.jpg') }}'); 
            background-position: bottom;">
            
</div>


        <div class="container">
            <div class="card card-body py-2 bg-transparent shadow-none">
                <div class="row">
                    <div class="col-auto">
                        <div
                            class="avatar avatar-2xl rounded-circle position-relative mt-n7 border border-gray-100 border-4">
                            @if (isset($user) && $user->image)
                            <img src="{{ 'data:image/png;base64,' . $user->image }}" alt="profile_image" class="w-100">
                            @else
                            <img src="{{ asset('img/profile/image_profile.webp') }}" alt="profile_image" class="w-100">
                            @endif
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h3 class="mb-0 font-weight-bold">
                                {{ auth()->user()->name }}
                            </h3>
                            <p class="mb-0">
                                {{-- {{ $user->email }} --}}
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    <div class="container py-4">
    <h4 class="mb-4">Meus Tickets</h4>

    @php
        $userId = auth()->id();

        $userTickets = $tickets->where('user_id', $userId)
            ->where('status', '!=', 'completed')
            ->sortByDesc('created_at')
            ->take(5);

        $completedTickets = $tickets->where('user_id', $userId)
            ->where('status', 'completed')
            ->sortByDesc('created_at');

        $statusClasses = [
            'open' => 'border-info text-info bg-info',
            'in progress' => 'border-warning text-warning bg-warning',
            'completed' => 'border-success text-success bg-success',
            'canceled' => 'border-danger text-danger bg-danger',
        ];

        $statusIcons = [
            'open' => 'fa-envelope-open-text',
            'in progress' => 'fa-spinner',
            'completed' => 'fa-check-circle',
            'canceled' => 'fa-times-circle',
        ];

        $statusLabels = [
            'open' => 'Aberto',
            'in progress' => 'Em andamento',
            'completed' => 'Concluído',
            'canceled' => 'Cancelado',
        ];
    @endphp

    {{-- Chamados em andamento (limite de 5) --}}
    @if($userTickets->count())
        <ul class="list-group small mb-4">
            @foreach ($userTickets as $ticket)
                @php
                    $status = $ticket->status;
                    $classes = $statusClasses[$status] ?? 'border-secondary text-secondary bg-secondary';
                    $icon = $statusIcons[$status] ?? 'fa-question-circle';
                    $label = $statusLabels[$status] ?? ucfirst($status);
                @endphp
                <li class="list-group-item py-1 px-2 d-flex justify-content-between align-items-center">
                    {{ $ticket->ticketCategory->name .' / '. $ticket->title }}
                    <span class="badge rounded-pill {{ $classes }}" style="opacity: 1 !important; filter: none !important;">
                        <i class="fas {{ $icon }} me-1"></i> {{ $label }}
                    </span>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-muted">Nenhum ticket em andamento.</p>
    @endif

    {{-- Chamados concluídos --}}
    @if($completedTickets->count())
        <h6 class="mt-4 mb-2">Chamados Concluídos</h6>
        <ul class="list-group small">
            @foreach ($completedTickets as $ticket)
                @php
                    $status = $ticket->status;
                    $classes = $statusClasses[$status] ?? 'border-secondary text-secondary bg-secondary';
                    $icon = $statusIcons[$status] ?? 'fa-question-circle';
                    $label = $statusLabels[$status] ?? ucfirst($status);
                @endphp
                <li class="list-group-item py-1 px-2 d-flex justify-content-between align-items-center">
                    {{ $ticket->ticketCategory->name .' / '. $ticket->title }}
                    <span class="badge rounded-pill {{ $classes }}" style="opacity: 1 !important; filter: none !important;">
                        <i class="fas {{ $icon }} me-1"></i> {{ $label }}
                    </span>
                </li>
            @endforeach
        </ul>
    @endif

    <div class="mt-4">
        <a href="{{ route('ticket.collaborator.create') }}" class="btn btn-primary" style="background-color: #0A0F1F;">
            Abrir Novo Chamado
        </a>
    </div>
    </div>
@endsection

</x-user-profile-layout>
