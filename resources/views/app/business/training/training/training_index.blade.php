<div class="container">
    <h1>Trainings</h1>
    <a href="{{ route('trainings.create') }}" class="btn btn-primary">Novo Treinamento</a>
    <table class="table mt-3">
        <thead>
        <tr>
            <th>ID</th><th>Título</th><th>Descrição</th><th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @forelse($trainings as $training)
            <tr>
                <td>{{ $training->id }}</td>
                <td>{{ $training->title }}</td>
                <td>{{ Str::limit($training->description,50) }}</td>
                <td>
                    <a href="{{ route('trainings.edit',$training) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('trainings.destroy',$training) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Confirma?')">Excluir</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="4">Nenhum treinamento cadastrado.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
