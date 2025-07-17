@extends('layouts.templates.app-layout')
@section('content')
    <div class="container">
        <h1>Editar Treinamento</h1>
        <form action="{{ route('training.update',$training) }}" method="POST">
            @method('PUT')
            @include('app.business.training.training.training_form', ['buttonText' => 'Atualizar Treinamento'])
        </form>
    </div>
@endsection
