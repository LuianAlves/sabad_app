@extends('layouts.templates.app-layout')
@section('content')
    <div class="container">
        <h3>Criar Notificação</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('notifications.store') }}">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="mb-3">
                <label for="message" class="form-label">Mensagem</label>
                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="companies" class="form-label">Empresas</label>
                <select class="form-select" id="companies" name="companies[]" multiple>
                    <option value="all">-- Todas as Empresas --</option>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>


            <div class="mb-3">
                <label for="departments" class="form-label">Departamentos</label>
                <select class="form-select" id="departments" name="departments[]" multiple>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="users" class="form-label">Usuários</label>
                <select class="form-select" id="users" name="users[]" multiple>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Enviar Notificação</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const companiesSelect = document.getElementById('companies');

            companiesSelect.addEventListener('change', function () {
                const selected = Array.from(companiesSelect.selectedOptions).map(o => o.value);

                if (selected.includes('all')) {
                    // Seleciona todas as opções, exceto 'all' (se quiser)
                    Array.from(companiesSelect.options).forEach(option => {
                        if (option.value !== 'all') {
                            option.selected = true;
                        }
                    });
                    // Remove seleção de 'all'
                    companiesSelect.querySelector('option[value=\"all\"]').selected = false;
                }
            });
        });
    </script>

@endsection
