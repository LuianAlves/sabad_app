@extends('layouts.templates.app-layout')
@section('content')
    <h1>Editar Sindicato - {{ $union->name }}</h1>

    <form action="{{ route('union.update', $union->id) }}" method="POST">
        @method('PUT')

        @include('app.business.unions.union.union_form')
    </form>
@endsection


