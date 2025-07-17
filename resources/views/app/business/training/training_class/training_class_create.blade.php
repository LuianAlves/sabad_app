@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Nova Turma</h1>
        <form action="{{ route('turmas.store') }}" method="POST">
            @include('turmas.form', ['buttonText' => 'Criar Turma'])
        </form>
    </div>
@endsection
