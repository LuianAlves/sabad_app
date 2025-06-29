@role('admin')
    @extends('layouts.templates.app-layout')
    @section('content')
        @php
            $open = $tickets->where('status', 'open')->count();
            $inProgress = $tickets->where('status', 'in progress')->count();
            $completed = $tickets->where('status', 'completed')->count();
            $canceled = $tickets->where('status', 'canceled')->count();
        @endphp

        <div class="row">
            @foreach ($statusData as $key => $data)
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon icon-shape bg-{{ $icons[$key]['bg'] }} text-white rounded-circle d-flex justify-content-center align-items-center"
                                    style="width: 40px; height: 40px;">
                                    <i class="fas {{ $icons[$key]['icon'] }}"
                                        style="margin-top: 3px !important; margin-bottom: auto !important;"></i>
                                </div>
                                <h6 class="ms-3 mb-0">{{ $data['label'] }}</h6>
                            </div>
                            <p class="text-sm text-secondary mb-3">
                                @if ($key == 'completed')
                                    Foram concluídos <b>{{ $data['count'] }}</b> chamados no mês.
                                @elseif($key == 'canceled')
                                    Total de <b>{{ $data['count'] }}</b> chamados cancelados.
                                @else
                                    Atualmente há <b>{{ $data['count'] }}</b> chamados
                                    {{ strtolower($data['label']) }}.
                                @endif
                            </p>
                            @if ($data['latest'])
                                <span class="text-sm d-block">
                                    Último: <b>{{ $data['latest']->user->name ?? 'Desconhecido' }}</b>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="card border shadow-xs mb-4" style="height: calc(100vh - 37.5vh) !important;">
            <x-card-header title="Chamados" count="" action="novo"></x-card-header>

            <x-table>
                <x-slot name="thead">
                    <tr class="text-center">
                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Usuário
                        </th>
                        <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                            Assunto</th>
                        <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                            Status</th>
                    </tr>
                </x-slot>
                <x-slot name="tbody">
                    @foreach ($tickets as $ticket)
                        <tr class="text-center">
                            <td>
                                <p class="text-secondary text-sm mb-0">
                                    {{ $ticket->user->name ?? 'Desconhecido' }}</p>
                            </td>
                            <td>
                                <p class="text-secondary text-sm mb-0">
                                    {{ $ticket->ticketCategory->name }}</p>
                            </td>
                            <td>
                                @php
                                    $statusClass = [
                                        'open' => 'border-info text-info bg-info',
                                        'in progress' => 'border-warning text-warning bg-warning',
                                        'completed' => 'border-success text-success bg-success',
                                        'canceled' => 'border-danger text-danger bg-danger',
                                    ];

                                    $statusIcon = [
                                        'open' => 'fa-envelope-open-text',
                                        'in progress' => 'fa-spinner',
                                        'completed' => 'fa-check-circle',
                                        'canceled' => 'fa-times-circle',
                                    ];

                                    $statusLabel = [
                                        'open' => 'Aberto',
                                        'in progress' => 'Em andamento',
                                        'completed' => 'Concluído',
                                        'canceled' => 'Cancelado',
                                    ];

                                    $status = $ticket->status;
                                @endphp
                                <form action="{{ route('update-ticket-status-open', $ticket->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" style="border: none !important; background: none !important;">
                                        <span
                                            class="badge badge-sm border {{ $statusClass[$status] ?? 'border-secondary' }} text {{ $statusClass[$status] ?? 'text-secondary' }} bg {{ $statusClass[$status] ?? 'bg-secondary' }}">
                                            <i class="fa {{ $statusIcon[$status] ?? 'fa-info-circle' }}"
                                                aria-hidden="true"></i>
                                            {{ $statusLabel[$status] ?? ucfirst($status) }}
                                        </span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-table>
        </div>
        </div>
   

    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                <x-card-header title="Novo Ticket" action="Cadastrar"></x-card-header>

                <x-form route="store">
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="user_id" class="form-control-label">Usuário</label>
                            <x-input col="6" set="" type="text" title="Usuário" id="user_id"
                                name="user_id" value="{{ auth()->user()->name }}" disabled="true"></x-input>
                        </div>

                        <div class="col-6">
                            <label for="ticket_category_id" class="form-control-label">Categoria</label>
                            <select name="ticket_category_id" id="ticket_category_id" class="form-control">
                                @foreach ($ticketCategories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <x-input col="6" set="" type="text" title="Titulo" id="title" name="title"
                            value="" placeholder=""></x-input>
                        <x-input col="6" set="" type="text" title="Descrição" id="descreption"
                            name="descreption" value="" placeholder=""></x-input>
                    </div>
                </x-form>
            </div>
        </div>
    </div>

 @endsection
@endrole
