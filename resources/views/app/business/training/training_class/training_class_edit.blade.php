@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Editar Turma</h1>
        <form action="{{ route('turmas.update',$turma) }}" method="POST">
            @method('PUT')
            @include('turmas.form', ['buttonText' => 'Atualizar Turma'])
        </form>
    </div>
@endsection
