@extends('layouts.templates.app-layout')
@section('content')

    <h1>Permissions</h1>

    <a href="{{ route('permissions.create') }}">Nova Permission</a>

    <table>
        <thead>
        <tr>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($permissions as $permission)
            <tr>
                <td>{{ $permission->name }}</td>
                <td>
                    <a href="{{ route('permissions.edit', $permission) }}">Editar</a>
                    <form action="{{ route('permissions.destroy', $permission) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Tem certeza?')">Excluir</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
