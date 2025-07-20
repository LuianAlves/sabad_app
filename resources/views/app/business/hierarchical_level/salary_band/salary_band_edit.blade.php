@extends('layouts.templates.app-layout')
@section('content')
    <h1>
        Editar Faixa –
        {{ $tierLevel->hierarchicalLevel->name }}
        / {{ $tierLevel->name }}
    </h1>

    <form action="{{ route('salary_bands.update', $salaryBand) }}" method="POST">
        @method('PUT')
        @include('app.business.hierarchical_level.salary_band.salary_band_form')
    </form>
@endsection
