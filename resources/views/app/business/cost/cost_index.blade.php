@extends('layouts.templates.app-layout')

@section('content')
    <div class="container">
        <h1>Lista de Custos</h1>

        <a href="{{ route('cost.create') }}" class="btn btn-primary mb-3">Novo Custo</a>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Serviço</th>
                <th>Dispositivo</th>
                <th>Patrimônio</th>
                <th>Salário</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach($costs as $cost)
                <tr>
                    <td>{{ $cost->service?->price ?? '-' }}</td>
                    <td>{{ $cost->deviceControl?->estimated_price ?? '-' }}</td>
                    <td>{{ $cost->heritageControl?->estimated_price ?? '-' }}</td>
                    <td>{{ $cost->salaryBand?->salary ?? '-' }}</td>
                    <td><strong>{{ number_format($cost->total, 2, ',', '.') }}</strong></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
