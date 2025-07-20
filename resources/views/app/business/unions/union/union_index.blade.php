@extends('layouts.templates.app-layout')
@section('content')
    <a href="{{ route('union.create') }}">+ Novo Sindicato</a>
    <table>
        <tr><th>Nome</th><th>Reajuste %</th><th>Ações</th></tr>
        @foreach($unions as $u)
            <tr>
                <td>{{ $u->name }}</td>
                <td>{{ $u->current_adjustment_percent }}%</td>
                <td>
                    <a href="{{ route('union.edit', $u) }}">Editar</a>

                    <form action="{{ route('union.destroy', $u) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button>Excluir</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
