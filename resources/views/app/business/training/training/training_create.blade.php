@extends('layouts.templates.app-layout')
@section('content')
    <div class="container">
        <h1>Novo Treinamento</h1>
        <form action="{{ route('training.store') }}" method="POST">
            @include('app.business.training.training.training_form', ['buttonText' => 'Criar Treinamento'])
        </form>
    </div>
@endsection
