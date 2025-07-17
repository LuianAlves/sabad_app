@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Editar Treinamento</h1>
        <form action="{{ route('trainings.update',$training) }}" method="POST">
            @method('PUT')
            @include('trainings.form', ['buttonText' => 'Atualizar Treinamento'])
        </form>
    </div>
@endsection
