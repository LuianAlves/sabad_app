@extends('layouts.templates.app-layout')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">
                <x-card-header title="Novo Dispositivo" action="Cadastrar" />
                <x-form route="store">
                    <div class="row">
                        <div class="col-4">
                            <div class="dropdown-wrapper" style="position: relative;">
                                <select id="device_type_id" name="device_type_id" style="display:none;"></select>
                                <input type="text" class="form-control" id="device_type_input"
                                    placeholder="Digite ou selecione um tipo...">
                                <div class="custom-dropdown"></div>
                            </div>
                        </div>


                        <div class="col-4">
                            <div class="dropdown-wrapper" style="position: relative;">
                                <select id="device_brand_id" name="device_brand_id" style="display:none;"></select>
                                <input type="text" class="form-control" id="device_brand_input"
                                    placeholder="Digite ou selecione uma marca...">
                                <div class="custom-dropdown"></div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="dropdown-wrapper" style="position: relative;">
                                <select id="device_model_id" name="device_model_id" style="display:none;" disabled></select>
                                <input type="text" class="form-control" id="device_model_input"
                                    placeholder="Digite ou selecione um modelo..." disabled>
                                <div class="custom-dropdown"></div>
                            </div>
                        </div>
                    </div>
                </x-form>
            </div>
        </div>
    </div>
@endsection

<script src="{{ asset('js/common/select/custom_select.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        createSmartSelect({
            selectId: 'device_type_id',
            inputId: 'device_type_input',
            searchUrl: '{{ route('device_type.search') }}',
            storeUrl: '{{ route('device_type.store') }}',
            fieldName: 'name'
        });

        createSmartSelect({
            selectId: 'device_brand_id',
            inputId: 'device_brand_input',
            searchUrl: '{{ route('device_brand.search') }}',
            storeUrl: '{{ route('device_brand.store') }}',
            fieldName: 'name',
            onSelect: (item) => {
    const select = document.getElementById('device_brand_id');
    select.value = item.id; // ou item.value, dependendo do seu dado
    // Habilita o input e select de modelo
    document.getElementById('device_model_input').disabled = false;
    document.getElementById('device_model_id').disabled = false;
},
onCreate: (item) => {
    const select = document.getElementById('device_brand_id');
    select.value = item.id; // Atualiza o select também ao criar
    document.getElementById('device_model_input').disabled = false;
    document.getElementById('device_model_id').disabled = false;
},


        });


        createSmartSelect({
            selectId: 'device_model_id',
            inputId: 'device_model_input',
            searchUrl: '{{ route('device_model.search') }}',
            storeUrl: '{{ route('device_model.store') }}',
            fieldName: 'name',
            getExtraParams: () => {
    const brandSelect = document.getElementById('device_brand_id');
    console.log('Brand ID enviado:', brandSelect?.value);
    return {
        device_brand_id: brandSelect ? brandSelect.value : null
    };
}
        });

        // Também escuta mudanças diretas no select, caso criem ou selecionem manualmente
        document.getElementById('device_brand_id').addEventListener('change', function() {
            const modelInput = document.getElementById('device_model_input');
            if (this.value) {
                modelInput.disabled = false;
            } else {
                modelInput.disabled = true;
            }
        });
    });
</script>


<style>
    .dropdown-wrapper {
        position: relative;
        width: 100%;
    }

    .custom-dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        z-index: 1050;
        background-color: #fff;
        border: 1px solid #ced4da;
        border-top: none;
        border-radius: 0 0 0.375rem 0.375rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        max-height: 200px;
        overflow-y: auto;
        display: none;
        box-sizing: border-box;
        padding: 0;
        margin: 0;
    }

    .custom-dropdown .dropdown-item {
        padding: 0.375rem 0.75rem;
        cursor: pointer;
        font-size: 1rem;
    }

    .custom-dropdown .dropdown-item:hover {
        background-color: #f8f9fa;
    }
</style>
