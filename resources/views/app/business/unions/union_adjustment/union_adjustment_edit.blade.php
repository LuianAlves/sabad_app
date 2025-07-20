@extends('layouts.templates.app-layout')
@section('content')
    <h1>Editar Reajuste {{ $adjustment->year }} - {{ $union->name }}</h1>

    <form action="{{ route('adjustment.update', $adjustment) }}" method="POST">
        @method('PUT')

        @include('app.business.unions.union_adjustment.union_adjustment_form')
    </form>
@endsection
