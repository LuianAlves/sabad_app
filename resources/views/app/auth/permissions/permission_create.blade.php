@extends('layouts.templates.app-layout')
@section('content')

    <h1>Criar Permission</h1>

    <form action="{{ route('permissions.store') }}" method="POST">
        @csrf

        <div>
            <label>Nome</label>
            <input type="text" name="name" required>
        </div>

        <button type="submit">Salvar</button>
    </form>

@endsection
