@extends('layouts.templates.app-layout')
@section('content')
    <h1>Editar Tier – {{ $hierarchicalLevel->name }}</h1>
    <form action="{{ route('tier_levels.update', $tierLevel) }}" method="POST">
        @method('PUT')
        @include('app.business.hierarchical_level.tier_level.tier_level_form')
    </form>
@endsection
