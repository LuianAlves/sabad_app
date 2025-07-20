@extends('layouts.templates.app-layout')
@section('content')
    <h1>Tiers – {{ $hierarchicalLevel->name }}</h1>
    <a href="{{ route('hierarchical_levels.tier_levels.create', $hierarchicalLevel) }}">
        + Novo Tier
    </a>
    <table>
        <tr><th>Ordem</th><th>Nome</th><th>Ações</th></tr>
        @foreach($tiers as $t)
            <tr>
                <td>{{ $t->order }}</td>
                <td>{{ $t->name }}</td>
                <td>
                    <a href="{{ route('tier_levels.edit',$t) }}">Editar</a>
                    <form action="{{ route('tier_levels.destroy',$t) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button>Excluir</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
