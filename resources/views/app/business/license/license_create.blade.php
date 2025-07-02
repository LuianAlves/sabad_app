@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                <x-card-header title="Nova licença" action="cadastrar"></x-card-header>
            
                <x-form route="store">
                    <div class="row">
                        <x-select col="6" set="" title="Serviço" id="service_id" name="service_id" disabled="">
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name .' - '. $service->department->company->name }}</option>
                            @endforeach
                        </x-select>
                    </div>
                    <div class="row">
                        <x-input col="6" set="" type="text" title="Licença" id="name" name="name" value="" placeholder="Mercado livre" disabled=""></x-input>
                        <x-input col="6" set="" type="text" title="Descrição do licença" id="description" name="description" value="" placeholder="Licença utilizada ..." disabled=""></x-input>
                    </div>
                    <div class="row">
                        <x-input col="6" set="" type="number" title="Quantidade" id="quantity" name="quantity" value="" placeholder="000" disabled=""></x-input>
                    </div>
                    <div class="row">
                        <x-input col="4" set="" type="text" title="Usuário" id="user" name="user" value="" placeholder="John Doe" disabled=""></x-input>
                        <x-input col="4" set="" type="email" title="E-mail" id="email" name="email" value="" placeholder="john@email.com" disabled=""></x-input>
                        <x-input col="4" set="" type="password" title="Senha" id="password" name="password" value="" placeholder="********" disabled=""></x-input>
                    </div>
                    <div class="row">
                        <x-input col="4" set="" type="date" title="Contratado em" id="contracted_in" name="contracted_in" value="" placeholder="" disabled=""></x-input>
                        <x-input col="6" set="" type="text" title="Valor da licença" id="price" name="price" value="" placeholder="R$ 0.00" disabled=""></x-input>
                    </div>
                    <div class="row">
                        <label>Recorrência</label>
                        <div class="col-6 d-flex">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="recurrence" id="monthly" value="monthly">
                                <label class="custom-control-label" for="monthly">Mensal</label>
                            </div>
                            <div class="form-check mx-3">
                                <input class="form-check-input" type="radio" name="recurrence" id="yearly" value="yearly">
                                <label class="custom-control-label" for="yearly">Anual</label>
                            </div>    
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="recurrence" id="lifetime" value="lifetime">
                                <label class="custom-control-label" for="lifetime">Vitalício</label>
                            </div>  
                        </div>                  
                    </div>
                    <div class="row">
                        <x-input col="3" set="" type="number" title="Dia de pagamento" id="payment_day" name="payment_day" value="" placeholder="05, 10 ..." disabled=""></x-input>
                    </div>
                    <div class="row">
                        <x-input-check col="6" set="" title="Iniciar ativo?" id="is_active" name="is_active" checked="" disabled=""></x-input>
                    </div>
                </x-form>

            </div>
        </div>
    </div>
@endsection