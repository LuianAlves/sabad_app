@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4">
                <x-card-header title="Funcionários cadastrados" count="{{ $emails->count() }}" action="novo"></x-card-header>

                <x-table>
                    <x-slot name="thead">
                        <tr class="text-center">
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Funcionário</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">E-mail</th>
                            
                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7"></th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($emails as $email)
                            <tr class="text-center">
                                {{-- Funcionário --}}
                                <td>
                                    <p class="text-dark fw-bold text-sm mb-0">
                                        {{ $email->employee->name ?? 'Sem funcionário vinculado' }}
                                    </p>                                        
                                </td>
                    
                                {{-- E-mail --}}
                                    <td>
                                        <p class="text-dark text-sm mb-0">{{ $email->email }}</p>
                                    </td>

                                {{-- Botões de ações --}}
                                <td>
                                    <x-table-button route="email" :id="$email->id"></x-table-button>
                                </td>
                                {{-- E-mail --}}
                            </tr>
                        @endforeach

                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
@endsection
