@extends('layouts.templates.app-layout')
@section('content')

    <div class="container">
        <h1>Detalhes do Treinamento</h1>
        <p><strong>ID:</strong> {{ $training->id }}</p>
        <p><strong>Título:</strong> {{ $training->title }}</p>
        <p><strong>Descrição:</strong></p>
        <p>{{ $training->description }}</p>
        <hr>
        <a href="{{ route('training.index') }}" class="btn btn-secondary">Voltar</a>
        <a href="{{ route('training.edit',$training) }}" class="btn btn-primary">Editar</a>
    </div>
@endsection
