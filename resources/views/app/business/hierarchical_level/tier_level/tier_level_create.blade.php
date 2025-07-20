@extends('layouts.templates.app-layout')
@section('content')
    <h1>Novo Tier – {{ $hierarchicalLevel->name }}</h1>
    <form action="{{ route('hierarchical_levels.tier_levels.store', $hierarchicalLevel) }}" method="POST">
        @include('app.business.hierarchical_level.tier_level.tier_level_form')
    </form>
@endsection
