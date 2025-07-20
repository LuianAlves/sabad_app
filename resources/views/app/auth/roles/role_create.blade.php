@extends('layouts.templates.app-layout')
@section('content')

    <h1>Criar Role</h1>

    <form action="{{ route('roles.store') }}" method="POST">
        @csrf

        <div>
            <label>Nome</label>
            <input type="text" name="name" required>
        </div>

        <div>
            <label>Permissões</label>
            @foreach($permissions as $permission)
                <div>
                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                    <span>{{ $permission->name }}</span>
                </div>
            @endforeach
        </div>

        <button type="submit">Salvar</button>
    </form>

@endsection
