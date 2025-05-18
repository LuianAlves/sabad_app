@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">
                <x-card-header title="Dominios cadastrados" count="{{ $domains->count() }}" action="novo"></x-card-header>

                <x-table>
                    <x-slot name="thead">
                        <tr class="text-center">
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Empresa</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Dominio</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Validade</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Ultimo Pagamento</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Próximo Pagamento</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Status</th>
                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7"></th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($domains as $domain)
                            <tr class="text-center">
                                {{-- Empresa --}}
                                @foreach ($domains as $domain)
                                    <td>
                                        <p class="text-dark fw-bold text-sm mb-0">
                                            {{ $domain->company?->name ?? 'Sem empresa vinculada' }}</p>
                                    </td>
                                @endforeach

                                {{-- Domínio --}}
                                <td>
                                    <p class="text-dark text-sm mb-0">{{ $domain->name }}</p>
                                </td>

                                {{-- Validade --}}
                                <td>
                                    <p class="text-secondary text-sm mb-0">{{ $domain->plan_validity }}</p>
                                </td>

                                {{-- Último Pagamento --}}
                                <td class="text-secondary text-sm mb-0">{{ $domain->last_payment }}</td>

                                {{-- Próximo Pagamento --}}
                                <td class="text-secondary text-sm mb-0">{{ $domain->next_payment }}</td>

                                {{-- Status --}}
                                <td>
                                        @if ($domain->is_active == 1)
                                            <span class="badge badge-sm border border-success text-success bg-success">
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                                Ativo
                                            </span>
                                        @else
                                            <span class="badge badge-sm border border-danger text-danger bg-danger">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                                Inativo
                                            </span>
                                        @endif
                                </td>


                                {{-- Botões de ações --}}
                                 <td>
                                    <x-table-button route="domain" :id="$domain->id"></x-table-button>
                                </td>
                            </tr>
                        @endforeach

                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
@endsection
