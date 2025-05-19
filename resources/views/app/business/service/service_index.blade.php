@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">
                <x-card-header title="Serviços cadastrados" count="{{ $services->count() }}" action="novo"></x-card-header>

                <x-table>
                    <x-slot name="thead">
                        <tr class="text-center">
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Serviço</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Departamento</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Mensalidade</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Status</th>
                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7"></th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($services as $service)
                            <tr class="text-center">
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <div class="ms-2">
                                            <p class="text-dark fw-bold text-sm mb-0">{{ $service->name }}</p>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <p class="text-dark text-sm mb-0">{{ $service->department->name }}</p>
                                </td>

                                <td>
                                    <p class="text-dark text-sm mb-0">R$ {{ $service->price }} / {{ $service->recurrence }}</p>
                                </td>

                                <td>
                                    @if ($service->is_active == 1)
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
                                                                                     
                                <td>
                                    <x-table-button route="service" :id="$service->id"></x-table-button>
                                </td>
                            </tr>
                        @endforeach

                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
@endsection
