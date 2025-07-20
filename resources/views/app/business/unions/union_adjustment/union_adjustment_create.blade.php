@extends('layouts.templates.app-layout')
@section('content')
    <h1>Novo Reajuste para {{ $union->name }}</h1>
    <form action="{{ route('union.adjustment.store', $union) }}" method="POST">
        @include('app.business.unions.union_adjustment.union_adjustment_form')
    </form>
@endsection
