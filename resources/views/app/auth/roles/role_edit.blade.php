@extends('layouts.templates.app-layout')
@section('content')

    <h1>Editar Role</h1>

    <form action="{{ route('roles.update', $role) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Nome</label>
            <input type="text" name="name" value="{{ $role->name }}" required>
        </div>

        <div>
            <label>Permissões</label>
            @foreach($permissions as $permission)
                <div>
                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                        {{ $role->permissions->contains($permission) ? 'checked' : '' }}>
                    <span>{{ $permission->name }}</span>
                </div>
            @endforeach
        </div>

        <button type="submit">Atualizar</button>
    </form>

@endsection
