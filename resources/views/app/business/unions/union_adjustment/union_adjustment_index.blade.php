@extends('layouts.templates.app-layout')
@section('content')
    <h1>Reajustes de {{ $union->name }}</h1>
    <a href="{{ route('union.adjustment.create', $union) }}">+ Novo Reajuste</a>

    @if(session('success')) <p>{{ session('success') }}</p> @endif

    <table>
        <tr><th>Ano</th><th>%</th><th>Ações</th></tr>
        @foreach($adjustments as $a)
            <tr>
                <td>{{ $a->year }}</td>
                <td>{{ $a->percent }}%</td>
                <td>
                    <a href="{{ route('adjustment.edit', $a) }}">Editar</a>

                    <form action="{{ route('adjustment.destroy', $a) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button>Excluir</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
