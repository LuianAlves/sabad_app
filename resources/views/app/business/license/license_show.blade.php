@extends('layouts.templates.app-layout')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">
                <x-table>
                    <x-slot name="thead">
                        {{-- Cabeçalhos podem ser omitidos para visualização --}}
                    </x-slot>

                    <x-slot name="tbody">
                        <tr class="text-center">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <strong>Serviço:</strong>
                                        <p>{{ $license->service->name ?? '-' }} - {{ $license->service->department->company->name ?? '-' }}</p>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <strong>Licença:</strong>
                                        <p>{{ $license->name }}</p>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <strong>Descrição:</strong>
                                        <p>{{ $license->description }}</p>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <strong>Quantidade:</strong>
                                        <p>{{ $license->quantity }}</p>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <strong>Usuário:</strong>
                                        <p>{{ $license->user }}</p>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <strong>E-mail:</strong>
                                        <p>{{ $license->email }}</p>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <strong>Senha:</strong>
                                        <p>{{ Crypt::decrypt($license->password) }}</p>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <strong>Contratado em:</strong>
                                        <p>{{ \Carbon\Carbon::parse($license->contracted_in)->format('d/m/Y') }}</p>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <strong>Valor:</strong>
                                        <p>R$ {{ number_format($license->price_per_unit, 2, ',', '.') }}</p>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <strong>Dia de pagamento:</strong>
                                        <p>{{ $license->payment_day }}</p>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <strong>Recorrência:</strong>
                                        <p>
                                            @switch($license->recurrence)
                                                @case('monthly') Mensal @break
                                                @case('yearly') Anual @break
                                                @case('lifetime') Vitalício @break
                                                @default -
                                            @endswitch
                                        </p>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <strong>Status:</strong>
                                        <p>
                                            <span class="badge {{ $license->is_active ? 'badge-status-info' : 'badge-status-danger' }}">
                                                {{ $license->is_active ? 'Ativo' : 'Inativo' }}
                                            </span>
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <a href="{{ route('license.index') }}" class="btn btn-secondary">
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
