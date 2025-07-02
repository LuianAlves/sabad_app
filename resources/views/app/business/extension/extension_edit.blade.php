@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                <x-card-header title="Editar Ramal" action="Atualizar"></x-card-header>

                 <x-form route="update" :id="$extension->id">

                    <div class="row">
                        {{-- Empresa --}}
                        <div class="col-md-6 mb-3">
                            <label for="employee_id" class="form-label">Funcionário</label>
                            <select name="employee_id" id="employee_id" class="form-control" required>
                                <option value="">Selecione um Funcionário</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}"
                                        {{ $extension->employee_id == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->name . ' - ' . $employee->department->company->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <x-input col="6" set="" type="number" title="Numero do Ramal" id="number"
                            name="number" value="{{ old('number', $extension->number) }}" placeholder="Ex: 0000" />
                            
                            <div class="col-md-6 mb-3">
                            <label for="email_id" class="form-label">E-mail</label>
                            <select name="email_id" id="email_id" class="form-control" required>
                                <option value="">Selecione um e-mail</option>
                            </select>
                        </div>

                        <x-input col="6" set="" type="text" title="Senha Ramal" id="string"
                            name="password" value="{{ old('number', $extension->password) }}" placeholder="" />

                        <x-input col="6" set="" type="text" title="Link Reunião" id="meet"
                            name="meet" value="{{ old('number', $extension->meet) }}" placeholder="" />
                    </div>                    
                              
                </x-form>
            </div>
        </div>
    </div>

    <script>
    const selectedEmployeeId = "{{ $extension->employee_id }}";
    const selectedEmailId = "{{ $extension->email_id }}";

    const employeeEmails = @json($employees->mapWithKeys(function ($employee) {
        return [$employee->id => $employee->emails->map(function($email){
            return ['id' => $email->id, 'email' => $email->email];
        })];
    }));

    const emailSelect = document.getElementById('email_id');
    const employeeSelect = document.getElementById('employee_id');

    function populateEmailSelect(employeeId) {
        const emails = employeeEmails[employeeId] || [];
        emailSelect.innerHTML = '<option value="">Selecione um e-mail</option>';

        emails.forEach(function(email) {
            const option = document.createElement('option');
            option.value = email.id;
            option.textContent = email.email;
            if (email.id == selectedEmailId) {
                option.selected = true;
            }
            emailSelect.appendChild(option);
        });
    }

    // Executa ao carregar a página
    if (selectedEmployeeId) {
        populateEmailSelect(selectedEmployeeId);
    }

    // Executa quando mudar o funcionário
    employeeSelect.addEventListener('change', function() {
        populateEmailSelect(this.value);
    });
</script>

@endsection
