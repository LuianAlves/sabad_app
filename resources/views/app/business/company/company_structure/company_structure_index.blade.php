@extends('layouts.templates.app-layout')
@section('content')
    <h1>Estrutura Salarial – {{ $company->name }}</h1>
    <form method="POST" action="{{ route('companies.applyAdjustment', $company) }}">
        @csrf
        <button type="submit">
            Aplicar Dissídio ({{ $company->union->current_adjustment_percent ?? 0 }}%)
        </button>
    </form>

    <table>
        <thead>
        <tr>
            <th>Nível</th>
            <th>Tier</th>
            <th>Faixa</th>
            <th>Salário</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($company->hierarchicalLevels as $level)
            @foreach($level->tierLevels as $tier)
                @foreach($tier->salaryBands as $band)
                    <tr>
                        <td>{{ $level->name }}</td>
                        <td>{{ $tier->name }}</td>
                        <td>{{ $band->band }}</td>
                        <td>R$ {{ number_format($band->salary,2,',','.') }}</td>
                        <td>
                            <a href="{{ route('salary_bands.edit', $band) }}">Editar</a>
                        </td>
                    </tr>
                @endforeach
            @endforeach
        @endforeach
        </tbody>
    </table>
@endsection
