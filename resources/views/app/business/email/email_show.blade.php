@extends('layouts.templates.app-layout')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">
                <x-table>
                    <x-slot name="thead">
                        {{-- Cabeçalhos omitidos para visualização --}}
                    </x-slot>

                    <x-slot name="tbody">
                        <tr class="text-center">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <strong>Colaborador:</strong>
                                        <p>{{ $email->employee->name ?? 'Sem colaborador vinculado' }}</p>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <strong>Licença:</strong>
                                        <p>{{ $email->license->name ?? 'Sem licença vinculada' }}</p>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <strong>E-mail:</strong>
                                        <p>{{ $email->email ?? '-' }}</p>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <strong>Senha:</strong>
                                        <p>{{ $email->password ?? '-' }}</p>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <strong>Alias:</strong>
                                        <p>
                                        @if($email->alias)
                                            <ul class="list-unstyled mb-0">
                                                @foreach(json_decode($email->alias, true) as $item)
                                                    <li>{{ $item }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            Nenhum
                                            @endif
                                            </p>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <strong>Últimos usuários:</strong>
                                        <p>
                                        @if($email->last_user)
                                            <ul class="list-unstyled mb-0">
                                                @foreach(json_decode($email->last_user, true) as $item)
                                                    <li>- {{ $item }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            Nenhum
                                            @endif
                                            </p>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <strong>Status:</strong>
                                        <p>
                                            <span class="badge {{ $email->is_active ? 'badge-status-info' : 'badge-status-danger' }}">
                                                {{ $email->is_active ? 'Ativo' : 'Inativo' }}
                                            </span>
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <a href="{{ route('email.index') }}" class="btn btn-secondary">
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
