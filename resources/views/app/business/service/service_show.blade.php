@extends('layouts.templates.app-layout')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">
                <x-table>
                    <x-slot name="thead">
                        {{-- Cabeçalhos (opcional) --}}
                    </x-slot>

                    <x-slot name="tbody">
                        <tr class="text-center">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <strong>Departamento:</strong>
                                        <p>{{ $service->department->name ?? 'Sem departamento' }}</p>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <strong>Nome:</strong>
                                        <p>{{ $service->name }}</p>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <strong>Descrição:</strong>
                                        <p>{{ $service->description }}</p>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <strong>URL:</strong>
                                        <p>
                                            <a href="{{ $service->url }}" target="_blank">{{ $service->url }}</a>
                                        </p>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <strong>Usuário:</strong>
                                        <p>{{ $service->user }}</p>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <strong>E-mail:</strong>
                                        <p>{{ $service->email }}</p>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <strong>Senha:</strong>
                                        <p>{{ $service->password }}</p>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <strong>Contratado em:</strong>
                                        <p>{{ \Carbon\Carbon::parse($service->contracted_in)->format('d/m/Y') }}</p>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <strong>Valor:</strong>
                                        <p>R$ {{ number_format($service->price, 2, ',', '.') }}</p>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <strong>Recorrência:</strong>
                                        <p>
                                            @php
                                                switch ($service->recurrence) {
                                                    case 'daily':
                                                        $recurrence = 'Diária';
                                                        break;
                                                    case 'weekly':
                                                        $recurrence = 'Semanal';
                                                        break;
                                                    case 'monthly':
                                                        $recurrence = 'Mensal';
                                                        break;
                                                    case 'quarterly':
                                                        $recurrence = 'Trimestral';
                                                        break;
                                                    case 'yearly':
                                                        $recurrence = 'Anual';
                                                        break;
                                                    default:
                                                        $recurrence = ucfirst($service->recurrence);
                                                }
                                            @endphp
                                            {{ $recurrence }}
                                        </p>
                                    </div>


                                    <div class="col-md-4 mb-3">
                                        <strong>Dia de Pagamento:</strong>
                                        <p>{{ $service->payment_day }}</p>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <strong>Status:</strong>
                                        <p>
                                            <span class="badge {{ $service->is_active ? 'badge-status-info' : 'badge-status-danger' }}">
                                                {{ $service->is_active ? 'Ativo' : 'Inativo' }}
                                            </span>
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <a href="{{ route('service.index') }}" class="btn btn-secondary">
                                        ← Voltar
                                    </a>
                                </div>
                            </div>
                        </tr>
                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
@endsection
