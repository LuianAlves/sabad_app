@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">
                <x-card-header title="Certificados cadastrados" count="{{ $certificates->count() }}" action="novo"></x-card-header>
                @php
                use Carbon\Carbon;
                @endphp    

                <x-table>
                    <x-slot name="thead">
                        <tr class="text-center">
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Responsável</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Data de criação</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Data de renovação</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Última renovação</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Status</th>
                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7"></th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($certificates as $certificate)
                            <tr class="text-center">
                                {{-- Empresa --}}
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <div class="ms-2">
                                            <p class="text-dark fw-bold text-sm mb-0">
                                                {{ $certificate->employee->name }}</p>
                                            <p class="text-secondary text-sm mb-0">{{ $certificate->employee->department->company->name }}</p>
                                        </div>
                                    </div>
                                </td>

                                {{-- Datas e status --}}
                                <td>
                                    <p class="text-secondary text-sm mb-0">{{ Carbon::parse($certificate->creation_date)->format('d/m/Y') }}</p>
                                </td>

                                <td class="text-secondary text-sm mb-0">{{ Carbon::parse($certificate->renewal_date)->format('d/m/Y') }}</td>
                                <td class="text-secondary text-sm mb-0">{{ Carbon::parse($certificate->last_renovation)->format('d/m/Y') }}</td>

                                <td>
                                    @if ($certificate->status == 1)
                                        <span class="badge badge-sm border border-success text-success bg-success">
                                            <i class="fa fa-check" aria-hidden="true"></i> Ativo
                                        </span>
                                    @else
                                        <span class="badge badge-sm border border-danger text-danger bg-danger">
                                            <i class="fa fa-times" aria-hidden="true"></i> Inativo
                                        </span>
                                    @endif
                                </td>

                                {{-- Ações --}}
                                <td>
                                    <x-table-button route="certificate" :id="$certificate->id"></x-table-button>
                                </td>
                            </tr>
                        @endforeach


                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
@endsection
