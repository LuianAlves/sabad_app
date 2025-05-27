<x-app-layout>
    @section('content1')
        <div class="container">
            <h1 class="mb-4">🧾 Logs de Auditoria</h1>

            <a href="{{ route('activity-log.index', array_merge(request()->all(), ['export' => true])) }}"
                class="btn btn-success mb-3">
                📤 Exportar Excel
            </a>

            <form method="GET" class="row g-3 mb-4">
                <div class="col-md-3">
                    <label>Usuário:</label>
                    <select name="user_id" class="form-select">
                        <option value="">Todos</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Model:</label>
                    <select name="model_type" class="form-select">
                        <option value="">Todos</option>
                        @foreach ($models as $model)
                            <option value="{{ $model }}" {{ request('model_type') == $model ? 'selected' : '' }}>
                                {{ class_basename($model) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <label>Ação:</label>
                    <select name="action" class="form-select">
                        <option value="">Todas</option>
                        <option value="created" {{ request('action') == 'created' ? 'selected' : '' }}>Criado</option>
                        <option value="updated" {{ request('action') == 'updated' ? 'selected' : '' }}>Editado</option>
                        <option value="deleted" {{ request('action') == 'deleted' ? 'selected' : '' }}>Removido</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label>De:</label>
                    <input type="date" name="from" class="form-control" value="{{ request('from') }}">
                </div>

                <div class="col-md-2">
                    <label>Até:</label>
                    <input type="date" name="to" class="form-control" value="{{ request('to') }}">
                </div>

                <div class="col-md-12 text-end">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </form>

            <table class="table table-striped">
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
                    @forelse($logs as $log)
                        <tr>
                            <td>{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                            <td>{{ $log->user?->name ?? 'Desconhecido' }}</td>
                            <td>{{ class_basename($log->model_type) }} (ID {{ $log->model_id }})</td>
                            <td>
                                @php
                                    $color =
                                        [
                                            'created' => 'success',
                                            'updated' => 'warning',
                                            'deleted' => 'danger',
                                        ][$log->action] ?? 'secondary';

                                    $icon =
                                        [
                                            'created' => '🟢',
                                            'updated' => '🟡',
                                            'deleted' => '🔴',
                                        ][$log->action] ?? '⚪️';
                                @endphp
                                <span class="badge bg-{{ $color }}">{{ $icon }}
                                    {{ ucfirst($log->action) }}</span>
                            </td>
                            <td>{{ $log->description }}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#diffModal{{ $log->id }}">
                                    🔍 Ver
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="diffModal{{ $log->id }}" tabindex="-1"
                                    aria-labelledby="diffLabel{{ $log->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Diferenças - {{ class_basename($log->model_type) }}
                                                    ID {{ $log->model_id }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                @php
                                                    $before = json_decode($log->before, true) ?? [];
                                                    $after = json_decode($log->after, true) ?? [];
                                                @endphp

                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Campo</th>
                                                            <th>Antes</th>
                                                            <th>Depois</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach (array_unique(array_merge(array_keys($before), array_keys($after))) as $field)
                                                            @php
                                                                $old = $before[$field] ?? '';
                                                                $new = $after[$field] ?? '';
                                                            @endphp
                                                            <tr class="{{ $old != $new ? 'table-warning' : '' }}">
                                                                <td><strong>{{ $field }}</strong></td>
                                                                <td>{{ $old }}</td>
                                                                <td>{{ $new }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Nenhum log encontrado com os filtros aplicados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $logs->withQueryString()->links() }}
        </div>

    @endsection
    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card card-crud border shadow-xs mb-4">
                    <x-card-header title="Logs do sistema" count="" action=""></x-card-header>
<a href="{{ route('activity-log.index', array_merge(request()->all(), ['export' => true])) }}"
                class="btn btn-success mb-3">
                📤 Exportar Excel
            </a>
                    <x-table>
                        <x-slot name="thead">
                            <tr class="text-center">
                                <th class="text-secondary text-xs font-weight-semibold opacity-7">Usuário</th>
                                <th class="text-secondary text-xs font-weight-semibold opacity-7">Model</th>
                                <th class="text-secondary text-xs font-weight-semibold opacity-7">Ação</th>
                                <th class="text-secondary text-xs font-weight-semibold opacity-7 col-2">Registro</th>
                                <th class="text-secondary text-xs font-weight-semibold opacity-7">Data</th>
                                <th class="text-secondary text-xs font-weight-semibold opacity-7">Atualização</th>
                            </tr>
                        </x-slot>
                        <x-slot name="tbody">
                            @foreach ($logs as $log)
                                <tr class="text-center">
                                    <td>
                                        <p class="text-muted font-weight-semibold mb-0" style="font-size: 12px;">
                                            {{ $log->user?->name ?? 'Desconhecido' }}</p>
                                    </td>
                                    <td>
                                        <p class="text-muted font-weight-semibold mb-0" style="font-size: 12px;">
                                            {{ class_basename($log->model_type) }}
                                            (ID {{ $log->model_id }})
                                        </p>
                                    </td>
                                    <td>
                                        @php
                                            $color =
                                                [
                                                    'created' => 'success',
                                                    'updated' => 'warning',
                                                    'deleted' => 'danger',
                                                ][$log->action] ?? 'secondary';

                                            $icon =
                                                [
                                                    'created' => '🟢',
                                                    'updated' => '🟡',
                                                    'deleted' => '🔴',
                                                ][$log->action] ?? '⚪️';

                                            $title =
                                                [
                                                    'created' => 'Cadastro',
                                                    'updated' => 'Atualização',
                                                    'deleted' => 'Remoção',
                                                ][$log->action] ?? 'N/A';
                                        @endphp
                                        <span
                                            class="badge badge-sm border border-{{ $color }} text-{{ $color }} bg-{{ $color }}">{{ $icon }}
                                            {{ ucfirst($title) }}</span>
                                    </td>
                                    <td style="max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
    <p class="text-muted font-weight-semibold mb-0" style="font-size: 12px;" title="{{ $log->description }}">
        {{ $log->description }}
    </p>
</td>


                                    <td style="font-size: 12px;">
                                        <span class="text-muted font-weight-semibold mb-0">
                                            {{ $log->created_at->format('d/m/Y H:i:s') }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($log->action === 'updated' && $log->diff)
                                            <a href="#" class=" m-0 p-0 text-warning" data-bs-toggle="modal"
                                                data-bs-target="#diffModal{{ $log->id }}">
                                                <i class="fa-solid fa-magnifying-glass fs-5"></i>
                                            </a>

                                            <div class="modal fade" id="diffModal{{ $log->id }}" tabindex="-1"
                                                aria-labelledby="diffModalLabel{{ $log->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="diffModalLabel{{ $log->id }}">
                                                                Alterações em {{ $log->model_type }}</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Fechar"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Campo</th>
                                                                        <th>Antes</th>
                                                                        <th>Depois</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($log->diff as $field => $values)
                                                                        <tr>
                                                                            <td><strong>{{ $field }}</strong></td>
                                                                            <td class="text-danger">{{ $values['old'] }}
                                                                            </td>
                                                                            <td class="text-success">{{ $values['new'] }}
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Fechar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            —
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </x-slot>
                    </x-table>
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
