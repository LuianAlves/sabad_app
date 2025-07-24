@extends('layouts.templates.app-layout')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">
                <x-card-header title="Editar Serviço" action="Atualizar" />

                <x-form route="update" :id="$service->id">
                    <div class="row">

                        {{-- Departamento --}}
                        <div class="col-md-6 mb-3">
                            <label for="department_id" class="form-control-label">Departamento</label>
                            <select name="department_id" id="department_id" class="form-control" required>
                                <option value="">Selecione um departamento</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}"
                                        {{ old('department_id', $service->department_id) == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Nome --}}
                        <x-input col="6" set="" type="text" title="Nome" id="name" name="name"
                                 value="{{ old('name', $service->name) }}" required />

                        {{-- Descrição --}}
                        <div class="col-md-12 mb-3">
                            <label for="description" class="form-control-label">Descrição</label>
                            <textarea name="description" id="description" rows="3" class="form-control"
                                      placeholder="Descrição do serviço">{{ old('description', $service->description) }}</textarea>
                        </div>

                        {{-- URL --}}
                        <x-input col="6" set="" type="url" title="URL" id="url" name="url"
                                 value="{{ old('url', $service->url) }}" />

                        {{-- Usuário --}}
                        <x-input col="6" set="" type="text" title="Usuário" id="user" name="user"
                                 value="{{ old('user', $service->user) }}" />

                        {{-- E-mail --}}
                        <x-input col="6" set="" type="email" title="E-mail" id="email" name="email"
                                 value="{{ old('email', $service->email) }}" />

                        {{-- Senha --}}
                        <x-input col="6" set="" type="text" title="Senha" id="password" name="password"
                                 value="{{ old('password', $service->password) }}" />

                        {{-- Data de contratação --}}
                        <x-input col="4" set="" type="date" title="Contratado em" id="contracted_in" name="contracted_in"
                                 value="{{ old('contracted_in', $service->contracted_in) }}" />

                        {{-- Preço --}}
                        <x-input col="4" set="" type="number" title="Preço (R$)" id="price" name="price" step="0.01"
                                 value="{{ old('price', $service->price) }}" />

                        {{-- Recorrência --}}
                        <div class="row">
                            <label class="form-control-label">Recorrência</label>
                            <div class="col-6 d-flex">

                                <div class="form-check me-4">
                                    <input class="form-check-input" type="radio" name="recurrence" id="monthly" value="monthly"
                                        {{ old('recurrence', $service->recurrence) === 'monthly' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="monthly">Mensal</label>
                                </div>

                                <div class="form-check me-4">
                                    <input class="form-check-input" type="radio" name="recurrence" id="yearly" value="yearly"
                                        {{ old('recurrence', $service->recurrence) === 'yearly' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="yearly">Anual</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="recurrence" id="lifetime" value="lifetime"
                                        {{ old('recurrence', $service->recurrence) === 'lifetime' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="lifetime">Vitalício</label>
                                </div>

                            </div>
                        </div>


                        {{-- Dia de pagamento --}}
                        <x-input col="4" set="" type="number" title="Dia do pagamento" id="payment_day" name="payment_day"
                                 value="{{ old('payment_day', $service->payment_day) }}" />

                        {{-- Status --}}
                        <div class="col-md-4 mb-3">
                            <label for="is_active" class="form-control-label">Status</label>
                            <select name="is_active" id="is_active" class="form-control">
                                <option value="1" {{ old('is_active', $service->is_active) == 1 ? 'selected' : '' }}>Ativo</option>
                                <option value="0" {{ old('is_active', $service->is_active) == 0 ? 'selected' : '' }}>Inativo</option>
                            </select>
                        </div>

                    </div>
                </x-form>

            </div>
        </div>
    </div>
@endsection
