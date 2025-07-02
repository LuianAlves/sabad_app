@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                <x-card-header title="Novo Ramal" action="cadastrar"></x-card-header>

                <x-form route="store">
                

                        <div class="col-md-6 mb-3">
                            <label for="employee_id" class="form-label">Funcionário</label>
                            <select name="employee_id" id="employee_id" class="form-control" required>
                                <option value="">Selecione um funcionário</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name .' - '. $employee->department->company->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email_id" class="form-label">E-mail</label>
                            <select name="email_id" id="email_id" class="form-control" required>
                                <option value="">Selecione um e-mail</option>
                            </select>
                        </div>

                        <x-input col="6" set="" type="text" title="Senha Ramal" id="string"
                            name="password" value="" placeholder="" />

                        <x-input col="6" set="" type="number" title="Numero do Ramal" id="number"
                            name="number" value="" placeholder="Ex: 0000" />

                        <x-input col="6" set="" type="text" title="Link Reunião" id="meet"
                            name="meet" value="" placeholder="" />
                </x-form>

            </div>
        </div>
    </div>

                            <script>
                            const employeeEmails = @json($employees->mapWithKeys(function ($employee) {
                                return [$employee->id => $employee->emails->map(function($email){ return ['id' => $email->id, 'email' => $email->email]; })];
                            }));

                            document.getElementById('employee_id').addEventListener('change', function() {
                                const emails = employeeEmails[this.value] || [];
                                const emailSelect = document.getElementById('email_id');
                                emailSelect.innerHTML = '<option value="">Selecione um e-mail</option>';
                                emails.forEach(function(email) {
                                    const option = document.createElement('option');
                                    option.value = email.id;
                                    option.textContent = email.email;
                                    emailSelect.appendChild(option);
                                });
                            });
                        </script>

@endsection
