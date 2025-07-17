@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Turmas</h1>
        <a href="{{ route('turmas.create') }}" class="btn btn-primary">Nova Turma</a>
        <table class="table mt-3">
            <thead>
            <tr>
                <th>ID</th>
                <th>Treinamento</th>
                <th>Instrutor</th>
                <th>Sala</th>
                <th>Data</th>
                <th>Ocupação</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @forelse($turmas as $t)
                <tr>
                    <td>{{ $t->id }}</td>
                    <td>{{ $t->training->title }}</td>
                    <td>{{ $t->instructor->name }}</td>
                    <td>{{ $t->meetClass->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($t->start_date)->format('d/m/Y') }}</td>
                    <td>{{ $t->participants->count() }}/{{ $t->capacity }}</td>
                    <td>
                        <a href="{{ route('turmas.edit',$t) }}" class="btn btn-sm btn-warning">Editar</a>
                        <a href="{{ route('turmas.show',$t) }}" class="btn btn-sm btn-info">Ver</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7">Nenhuma turma cadastrada.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
