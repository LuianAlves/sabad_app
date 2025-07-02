@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                <x-card-header title="Novo controle de patrimônio" action="Cadastrar" />

                <x-form route="store">

                    <div class="row">
                        <x-select col="4" set="" title="Patrimônio" name="heritage_id" id="heritage_id">
                            <option value="">Selecione um patrimônio</option>
                            @foreach ($heritages->groupBy(fn($d) => $d->heritageBrand->name) as $brand => $brandHeritages)
                                <optgroup label="{{ $brand }}">
                                    @foreach ($brandHeritages as $heritage)
                                        <option value="{{ $heritage->id }}">
                                            {{ $heritage->heritageModel->name }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </x-select>

                        <x-select col="4" set="" title="Departamento" name="department_id" id="department_id">
                            <option value="">Selecione um departamento</option>

                            @foreach ($departments->groupBy(fn($e) => $e->company->name) as $company => $departmentsInCompany)
                                <optgroup label="{{ $company }}">
                                    @foreach ($departmentsInCompany as $company)
                                        <option value="{{ $company->id }}">
                                            {{ $company->name }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </x-select>

                    </div>

                    <div class="row">
                        <x-input col="4" set="" type="date" title="Entregue em" id="delivered_in"
                            name="delivered_in" value="" placeholder="" />
                        <x-input col="4" set="" type="date" title="Devolvido em" id="returned_in" name="returned_in"
                            value="" placeholder="" />
                            <x-input col="4" set="" type="date" title="Comprado em" id="purchased_in" name="purchased_in"
                            value="" placeholder="" />
                    </div>

                    <div class="row">
                        <x-input col="3" set="" type="text" title="Preço aproximado" id="estimated_price"
                            name="estimated_price" value="{{ old('estimated_price') }}" placeholder="R$ 0.00" />
                    </div>
                </x-form>
            </div>
        </div>
    </div>
@endsection
