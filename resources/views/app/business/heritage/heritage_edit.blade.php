@extends('layouts.templates.app-layout')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">
                <x-card-header title="Editar patrimônio" action="Atualizar" />

                <x-form route="update" :id="$heritage->id">
                    <div class="row">

                        {{-- Tipo de Patrimônio --}}
                        <div class="col-4">
                            <label for="heritage_type_id" class="form-control-label">Tipo de Patrimônio</label>
                            <select name="heritage_type_id" id="heritage_type_id" class="form-control" required>
                                <option value="">Selecione um tipo</option>
                                @foreach($heritageTypes as $type)
                                    <option value="{{ $type->id }}"
                                        {{ old('heritage_type_id', $heritage->heritage_type_id) == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Marca --}}
                        <div class="col-4">
                            <label for="heritage_brand_id" class="form-control-label">Marca</label>
                            <select name="heritage_brand_id" id="heritage_brand_id" class="form-control" required>
                                <option value="">Selecione uma marca</option>
                                @foreach($heritageBrands as $brand)
                                    <option value="{{ $brand->id }}"
                                        {{ old('heritage_brand_id', $heritage->heritage_brand_id) == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Modelo --}}
                        <div class="col-4">
                            <label for="heritage_model_id" class="form-control-label">Modelo</label>
                            <select name="heritage_model_id" id="heritage_model_id" class="form-control" required>
                                <option value="">Selecione um modelo</option>
                                @foreach($heritageModels as $model)
                                    <option value="{{ $model->id }}"
                                        {{ old('heritage_model_id', $heritage->heritage_model_id) == $model->id ? 'selected' : '' }}>
                                        {{ $model->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </x-form>
            </div>
        </div>
    </div>
@endsection
