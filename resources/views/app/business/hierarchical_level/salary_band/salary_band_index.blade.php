@extends('layouts.templates.app-layout')
@section('content')
    <h1>
        Faixas de
        {{ $tierLevel->hierarchicalLevel->name }} – {{ $tierLevel->name }}
    </h1>

    <a href="{{ route(
        'tier_levels.salary_bands.create',
        $tierLevel
      ) }}">
        + Nova Faixa
    </a>

    <table>
        <tr><th>Faixa</th><th>Salário</th><th>Ações</th></tr>
        @foreach($bands as $b)
            <tr>
                <td>{{ $b->band }}</td>
                <td>R$ {{ number_format($b->salary,2,',','.') }}</td>
                <td>
                    <a href="{{ route('salary_bands.edit', $b) }}">Editar</a>
                    <form action="{{ route('salary_bands.destroy', $b) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button>Excluir</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
