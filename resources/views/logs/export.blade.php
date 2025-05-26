<table>
    <thead>
        <tr>
            <th>Data</th>
            <th>Usuário</th>
            <th>Model</th>
            <th>Ação</th>
            <th>Descrição</th>
        </tr>
    </thead>
    <tbody>
        @foreach($logs as $log)
            <tr>
                <td>{{ $log->created_at }}</td>
                <td>{{ $log->user?->name }}</td>
                <td>{{ class_basename($log->model_type) }}</td>
                <td>{{ $log->action }}</td>
                <td>{{ $log->description }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
