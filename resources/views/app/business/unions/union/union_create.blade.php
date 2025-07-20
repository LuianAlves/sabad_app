@extends('layouts.templates.app-layout')
@section('content')
    <h1>Novo Sindicato</h1>

    <form action="{{ route('union.store') }}" method="POST">

        @include('app.business.unions.union.union_form')
    </form>
@endsection
