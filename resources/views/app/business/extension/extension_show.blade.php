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

                                    <div class="col-md-6">
                                        <strong>Empresa:</strong>
                                        <p>{{ $extension->employee->department->company->name ?? 'Não informado' }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <strong>Nome do Funcionário:</strong>
                                        <p>{{ $extension->employee->name }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <strong>Ramal:</strong>
                                        <p>{{ $extension->number }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <strong>E-mail:</strong>
                                        <p>{{ $extension->email->email }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <strong>Senha:</strong>
                                        <p>{{ $extension->password }}</p>
                                    </div>

                                    <a href="{{ route('extension.index') }}" class="btn btn-secondary">← Voltar</a>
    


                                </div>
                            </tr>
                        

                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
@endsection