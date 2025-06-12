@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4">
                <x-card-header title="Manutenções" count="{{ $tasks->count() }}" action="novo"></x-card-header>

                    <div class="container">
                        <h2 class="mb-4">Tarefas do Departamento: {{ auth()->user()->department->name ?? 'Não definido' }}</h2>

                        {{-- <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Nova Tarefa</a> --}}

                        @if ($tasks->isEmpty())
                            <div class="alert alert-info">Nenhuma tarefa encontrada.</div>
                        @else
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Título</th>
                                        <th>Status</th>
                                        <th>Data de Entrega</th>
                                        <th>Designados</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tasks as $task)
                                        <tr>
                                            <td>{{ $task->title }}</td>
                                            <td>
                                                @switch($task->status)
                                                    @case('pendente') <span class="badge bg-secondary">Pendente</span> @break
                                                    @case('em_andamento') <span class="badge bg-warning text-dark">Em Andamento</span> @break
                                                    @case('concluida') <span class="badge bg-success">Concluída</span> @break
                                                @endswitch
                                            </td>
                                            <td>{{ $task->due_date ? $task->due_date->format('d/m/Y') : '-' }}</td>
                                            <td>
                                                @foreach ($task->users as $user)
                                                    <span class="badge bg-info text-dark">{{ $user->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                {{-- <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-outline-primary">Editar</a>

                                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Deseja realmente excluir esta tarefa?')"> --}}
                                                        Excluir
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
            </div>
        </div>
    </div>
@endsection