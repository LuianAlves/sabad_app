@extends('layouts.templates.app-layout')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border shadow-xs mb-4">


                <div class="card-body p-4">
                    <p><strong>ID:</strong> {{ $recordcontrol->id }}</p>
                    <p><strong>Funcionário:</strong> {{ $recordcontrol->employee->name ?? 'N/A' }}</p>
                    <p><strong>Departamento:</strong> {{ $recordcontrol->employee->department->name ?? 'N/A' }}</p>
                    <p><strong>Empresa:</strong> {{ $recordcontrol->employee->department->company->name ?? 'N/A' }}</p>
                    <hr>

                    <p><strong>Identificação:</strong> {{ $recordcontrol->identificacao }}</p>
                    <p><strong>Forma de Armazenamento:</strong> {{ $recordcontrol->forma_armazenamento }}</p>
                    <p><strong>Local de Armazenamento:</strong> {{ $recordcontrol->local_armazenamento }}</p>
                    <p><strong>Acesso Permitido:</strong> {{ $recordcontrol->acesso_permitido }}</p>
                    <p><strong>Tempo de Retenção:</strong> {{ $recordcontrol->tempo_retencao }}</p>
                    <p><strong>Método de Manutenção:</strong> {{ $recordcontrol->metodo_manutencao }}</p>

                    <div class="mt-4">
                        <a href="{{ route('record_controls.index', $recordcontrol->department_id) }}" class="btn btn-secondary">
                            Voltar
                        </a>
                        <a href="{{ route('record_controls.edit', $recordcontrol->id) }}" class="btn btn-primary">
                            Editar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
