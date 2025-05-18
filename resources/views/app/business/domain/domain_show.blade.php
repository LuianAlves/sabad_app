@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                <x-table>
                    <x-slot name="thead">
                        
                    </x-slot>
                    <x-slot name="tbody">
                        
                            <tr class="text-center">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <strong>Empresa:</strong>
                                            <p>{{ $domain->company->name ?? 'Não informado' }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <strong>Nome do Domínio:</strong>
                                            <p>{{ $domain->name }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <strong>Validade:</strong>
                                            <p>{{ $domain->plan_validity }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <strong>Último pagamento:</strong>
                                            <p>{{ $domain->last_payment }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <strong>Próximo pagamento:</strong>
                                            <p>{{ $domain->next_payment }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <strong>Status:</strong><br>
                                            @if ($domain->is_active)
                                                <span class="badge badge-sm border border-success text-success bg-success">
                                                    <i class="fa fa-check" aria-hidden="true"></i> Ativo
                                                </span>
                                            @else
                                                <span class="badge badge-sm border border-danger text-danger bg-danger">
                                                    <i class="fa fa-times" aria-hidden="true"></i> Inativo
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <a href="{{ route('domain.index') }}" class="btn btn-secondary">
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
