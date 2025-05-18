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
                                        <p>{{ $department->company->name ?? 'Não informado' }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Nome do Departamento:</strong>
                                        <p>{{ $department->name }}</p>
                                    </div>
                                    <a href="{{ route('department.index') }}" class="btn btn-secondary">← Voltar</a>
    


                                </div>
                            </tr>
                        

                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
@endsection
