<x-app-layout>
    @section('content')
        <x-table-header title="Status" current="Status tarefas"></x-table-header>

        <x-table tableId="tableTaskStatus">
            <x-slot name="slot">
                <tr>
                    <th class="text-center">Status</th>
                    <th class="text-center">Cadatrado</th>
                    <th class="text-center">Ações</th>
                </tr>
            </x-slot>
        </x-table>

        <script>
            var route = "{{ route('task-status-api.index') }}"
        </script>

        <script type="module" src="{{ asset('assets/js/views/projects/task_status.js') }}"></script>

        @include('app.projects.task_status.task_status_modal')
        @include('layouts.common.modal.modal_delete')
    @endsection
</x-app-layout>
