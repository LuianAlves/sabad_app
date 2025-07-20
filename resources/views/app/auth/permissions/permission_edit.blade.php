@extends('layouts.templates.app-layout')
@section('content')

    <h1>Editar Permission</h1>

    <form action="{{ route('permissions.update', $permission) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Nome</label>
            <input type="text" name="name" value="{{ $permission->name }}" required>
        </div>

        <button type="submit">Atualizar</button>
    </form>

@endsection
