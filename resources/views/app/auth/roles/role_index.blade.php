@extends('layouts.templates.app-layout')
@section('content')

    <h1>Roles</h1>

    <a href="{{ route('roles.create') }}">Nova Role</a>

    <table>
        <thead>
        <tr>
            <th>Nome</th>
            <th>Permissões</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($roles as $role)
            <tr>
                <td>{{ $role->name }}</td>
                <td>
                    @foreach($role->permissions as $permission)
                        <span>{{ $permission->name }}</span>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('roles.edit', $role) }}">Editar</a>
                    <form action="{{ route('roles.destroy', $role) }}" method="POST" style="display:inline">
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
