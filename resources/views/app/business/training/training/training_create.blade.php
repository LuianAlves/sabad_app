@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Novo Treinamento</h1>
        <form action="{{ route('trainings.store') }}" method="POST">
            @include('trainings.form', ['buttonText' => 'Criar Treinamento'])
        </form>
    </div>
@endsection
