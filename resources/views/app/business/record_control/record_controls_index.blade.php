@extends('layouts.templates.app-layout')

@section('content')
<table class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>Identificação do Registro</th>
        <th>Funcionário</th>
        <th>Forma de Armazenamento</th>
        <th>Local</th>
        <th>Acesso Permitido</th>
        <th>Tempo de Retenção</th>
        <th>Método de Manutenção</th>
    </tr>
    </thead>
    <tbody>
    @foreach($records as $rc)
        <tr>
            <td>{{ $rc->id }}</td>
            <td>{{ $rc->identificacao }}</td>
            <td>{{ $rc->employee->name }}</td>
            <td>{{ $rc->forma_armazenamento }}</td>
            <td>{{ $rc->local_armazenamento }}</td>
            <td>{{ $rc->acesso_permitido }}</td>
            <td>{{ $rc->tempo_retencao }}</td>
            <td>{{ $rc->metodo_manutencao }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
