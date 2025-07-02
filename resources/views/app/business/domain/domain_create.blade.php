@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                <x-card-header title="Novo Dominio" action="Cadastrar"></x-card-header>

                <x-form route="store">
                  <div class="row">
                      <div class="col-6">
                            <label for="company_id" class="form-control-label">Empresa</label>
                            <select name="company_id" id="company_id" class="form-control">
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}" {{ ($domain->company_id ?? old('company_id')) == $company->id ? 'selected' : '' }}>
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                      <x-input col="6" set="" type="text" title="Nome do dominio" id="name" name="name" value="" placeholder="" disabled=""></x-input>
                      <x-input col="6" set="" type="date" title="Validade" id="plan_validity" name="plan_validity" value="" placeholder="" disabled=""></x-input>
                      <x-input col="6" set="" type="date" title="Ultimo pagamento" id="last_payment" name="last_payment" value="" placeholder="" disabled=""></x-input>
                      <x-input col="6" set="" type="date" title="Próximo pagamento" id="next_payment" name="next_payment" value="" placeholder="" disabled=""></x-input>
                      <div class="col-6">
                        <div class="form-group">
                            <label for="is_active" class="form-control-label">Status</label>
                            <select class="form-control" id="is_active" name="is_active">
                                <option value="1" {{ ($domain->is_active ?? 1) == 1 ? 'selected' : '' }}>Ativo</option>
                                <option value="0" {{ ($domain->is_active ?? 1) == 0 ? 'selected' : '' }}>Inativo</option>
                            </select>
                        </div>
                    </div>
                  </div>
                </x-form>
            </div>
        </div>
    </div>
@endsection
