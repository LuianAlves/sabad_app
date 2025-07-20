@extends('layouts.templates.app-layout')
@section('content')
    <h1>Nova Faixa – {{ $hierarchicalLevel->name }}</h1>
    <form action="{{ route('hierarchical_levels.salary_bands.store', $hierarchicalLevel) }}"
          method="POST">
        @include('app.business.hierarchical_level.salary_band.salary_band_form')
    </form>
@endsection
