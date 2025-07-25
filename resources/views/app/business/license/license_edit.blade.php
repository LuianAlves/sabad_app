@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                <x-card-header title="Editar licença" action="atualizar"></x-card-header>

                <x-form route="update" :id="$license">
                    <div class="row">
                        <x-select col="6" set="" title="Serviço" id="service_id" name="service_id" disabled="">
                            @foreach($services as $service)
                                <option value="{{ $service->id }}" {{ old('service_id', $license->service_id) == $service->id ? 'selected' : '' }}>
                                    {{ $service->name .' - '. $service->department->company->name }}
                                </option>
                            @endforeach
                        </x-select>
                    </div>
                    <div class="row">
                        <x-input col="6" set="" type="text" title="Licença" id="name" name="name" value="{{ old('name', $license->name) }}" placeholder="Mercado livre"></x-input>
                        <x-input col="6" set="" type="text" title="Descrição do licença" id="description" name="description" value="{{ old('description', $license->description) }}" placeholder="Licença utilizada ..."></x-input>
                    </div>
                    <div class="row">
                        <x-input col="6" set="" type="number" title="Quantidade" id="quantity" name="quantity" value="{{ old('quantity', $license->quantity) }}" placeholder="000"></x-input>
                    </div>
                    <div class="row">
                        <x-input col="4" set="" type="text" title="Usuário" id="user" name="user" value="{{ old('user', $license->user) }}" placeholder="John Doe"></x-input>
                        <x-input col="4" set="" type="email" title="E-mail" id="email" name="email" value="{{ old('email', $license->email) }}" placeholder="john@email.com"></x-input>
                        <x-input col="4" set="" type="text" title="Senha" id="password" name="password" value="{{ old('password', Crypt::decrypt($license->password)) }}"></x-input>

                    </div>
                    <div class="row">
                        <x-input col="4" set="" type="text" title="Contratado em" id="contracted_in" name="contracted_in" value="{{ old('contracted_in', $license->contracted_in) }}"></x-input>
                        <x-input col="6" set="" type="text" title="Valor da licença" id="price_per_unit" name="price_per_unit" value="{{ old('price', $license->price_per_unit) }}" placeholder="R$ 0.00"></x-input>
                    </div>
                    <div class="row">
                        <label>Recorrência</label>
                        <div class="col-6 d-flex">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="recurrence" id="monthly" value="monthly" {{ old('recurrence', $license->recurrence) == 'monthly' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="monthly">Mensal</label>
                            </div>
                            <div class="form-check mx-3">
                                <input class="form-check-input" type="radio" name="recurrence" id="yearly" value="yearly" {{ old('recurrence', $license->recurrence) == 'yearly' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="yearly">Anual</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="recurrence" id="lifetime" value="lifetime" {{ old('recurrence', $license->recurrence) == 'lifetime' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="lifetime">Vitalício</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <x-input col="3" set="" type="number" title="Dia de pagamento" id="payment_day" name="payment_day" value="{{ old('payment_day', $license->payment_day) }}" placeholder="05, 10 ..."></x-input>
                    </div>
                    <div class="form-check col-6">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active"
                               value="1" {{ old('is_active', $license->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Iniciar ativo?</label>
                    </div>

                </x-form>

            </div>
        </div>
    </div>
@endsection
{{--

No campo da senha a gente precisa descriptografar
ali no componente <x-form> a gente poe a rota: sempre vai ser STORE OU UPDATE

sim
Sim já vi isso no curso

 --}}







