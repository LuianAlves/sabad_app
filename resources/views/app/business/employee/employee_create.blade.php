@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                <x-card-header title="Novo Funcionário" action="Cadastrar"/>

                <x-form route="store">

                    <div class="row">
                        <div class="col-6">
                            <label for="department_id" class="form-control-label">Departamento</label>
                            <select name="department_id" id="department_id" class="form-control" required>
                                <option value="">Selecione um departamento</option>
                                @foreach ($companies as $company)
                                    <optgroup label="{{ $company->name }}">
                                        @foreach ($company->departments as $department)
                                            <option value="{{ $department->id }}"
                                                {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                                {{ $department->name }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <x-input col="4" set="" type="text" title="Funcionário" id="name"
                                 name="name" value="{{ old('name') }}" placeholder="João Silva"/>
                        <x-input col="4" set="" type="text" title="E-mail" id="email" name="email"
                                 value="{{ old('email') }}" placeholder="ti@bongas.com.br"/>
                        <x-select col="4" set="" title="Licença de e-mail" id="license_id" name="license_id">
                            @foreach ($licenses as $license)
                                <option value="{{ $license->id }}">{{ $license->name }}</option>
                            @endforeach
                        </x-select>
                    </div>

                    @php
                        $oldLevel = old('level_id', $employee->level_id ?? '');
                        $oldTier  = old('tier_id', $employee->tier_id ?? '');
                        $oldBand  = old('salary_band_id', $employee->salary_band_id ?? '');
                    @endphp

                    <div class="row">
                        <div class="col-4">
                            <label>Cargo</label>
                            <select name="level_id" id="level_id" class="form-control" required>
                                <option value="">Selecione nível</option>
                                @foreach($levels as $level)
                                    <option
                                        value="{{ $level->id }}" {{ old('level_id', $employee->level_id ?? '') == $level->id ? 'selected' : '' }}>
                                        {{ $level->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-4">
                            <label>Nível</label>
                            <select name="tier_id" id="tier_id" class="form-control" required>
                                <option value="">Selecione nível</option>
                            </select>
                        </div>

                        <div class="col-4">
                            <label>Faixa Salarial</label>
                            <select name="salary_band_id" id="salary_band_id" class="form-control" required>
                                <option value="">Selecione faixa</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <x-input col="6" set="" type="date" title="Contratado em" id="hired_in"
                                 name="hired_in" value="{{ old('hired_in') }}"/>
                        <x-input col="6" set="" type="date" title="Dispensado em" id="fired_in"
                                 name="fired_in" value="{{ old('fired_in') }}"/>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="status" class="form-control-label">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Ativo</option>
                                    <option value="0" {{ old('status', 1) == 0 ? 'selected' : '' }}>Inativo</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <x-input col="6" set="" type="file" title="Foto" id="image" name="image"
                             value=""></x-input>

                    <x-input-check col="6" set="" title="Usuário é administrador?" id="is_admin"
                                   name="is_admin" checked="" disabled=""></x-input-check>

                    <div class="row my-3" id="permissions-container">
                        <div class="col-6">
                            <div class="mb-3 border rounded p-3">
                                <strong>Perfis</strong>

                                @foreach ($roles as $role)
                                    <div class="form-check ms-3">
                                        <input class="form-check-input" type="checkbox" name="role"
                                               value="{{ $role->name }}" id="{{ $role->name }}">
                                        <label class="form-check-label"
                                               for="{{ $role->name }}">{{ ucfirst(explode(' ', $role->name)[0]) }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </x-form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const isAdminCheckbox = document.getElementById('is_admin');
            const permissionsContainer = document.getElementById('permissions-container');

            function togglePermissionsVisibility() {
                if (isAdminCheckbox.checked) {
                    permissionsContainer.style.display = 'none';
                    // Limpa todos os checkboxes de permissão
                    permissionsContainer.querySelectorAll('input[type="checkbox"]').forEach(cb => {
                        cb.checked = false;
                    });
                } else {
                    permissionsContainer.style.display = 'flex';
                }
            }

            // Executa na carga
            togglePermissionsVisibility();

            // Executa ao mudar o checkbox is_admin
            isAdminCheckbox.addEventListener('change', togglePermissionsVisibility);

            // Lógica dos checkboxes "All"
            document.querySelectorAll('.select-all').forEach(allCheckbox => {
                allCheckbox.addEventListener('change', function () {
                    const entity = this.dataset.entity;
                    document.querySelectorAll('.perm-' + entity).forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const levelSel = document.getElementById('level_id');
            const tierSel  = document.getElementById('tier_id');
            const bandSel  = document.getElementById('salary_band_id');

            const oldLevel = '{{ $oldLevel }}';
            const oldTier  = '{{ $oldTier }}';
            const oldBand  = '{{ $oldBand }}';

            // Função para popular um <select> com dados JSON
            function populate(selectEl, items, valueKey, textKey, selectedValue) {
                selectEl.innerHTML = `<option value="">Selecione</option>`;
                items.forEach(item => {
                    const opt = document.createElement('option');
                    opt.value    = item[valueKey];
                    opt.text     = item[textKey];
                    if (item[valueKey] == selectedValue) opt.selected = true;
                    selectEl.appendChild(opt);
                });
            }

            // Ao mudar o nível, carrega tiers
            levelSel.addEventListener('change', function() {
                const lvl = this.value;
                tierSel.innerHTML = `<option value="">Carregando...</option>`;
                bandSel.innerHTML = `<option value="">Selecione faixa</option>`;

                if (!lvl) {
                    tierSel.innerHTML = `<option value="">Selecione tier</option>`;
                    return;
                }

                fetch(`/levels/${lvl}/tiers`)
                    .then(res => res.json())
                    .then(data => populate(tierSel, data, 'id', 'name', oldTier))
                    .catch(()=> tierSel.innerHTML = `<option value="">Erro ao carregar</option>`);
            });

            // Ao mudar o tier, carrega faixas salariais
            tierSel.addEventListener('change', function() {
                const tr = this.value;
                bandSel.innerHTML = `<option value="">Carregando...</option>`;

                if (!tr) {
                    bandSel.innerHTML = `<option value="">Selecione faixa</option>`;
                    return;
                }

                fetch(`/tiers/${tr}/salary-bands`)
                    .then(res => res.json())
                    .then(data => populate(bandSel, data, 'id', 'band', oldBand))
                    .catch(()=> bandSel.innerHTML = `<option value="">Erro ao carregar</option>`);
            });

            if (oldLevel) {
                levelSel.value = oldLevel;
                levelSel.dispatchEvent(new Event('change'));
            }
        });
    </script>
@endsection
