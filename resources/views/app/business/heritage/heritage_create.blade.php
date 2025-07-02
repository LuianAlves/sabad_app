@extends('layouts.templates.app-layout')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">
                <x-card-header title="Novo patrimônio" action="Cadastrar" />
                <x-form route="store">
                    <div class="row">
                        <div class="col-4">
                            <div class="dropdown-wrapper" style="position: relative;">
                                <select id="heritage_type_id" name="heritage_type_id" style="display:none;"></select>
                                <x-input col="" set="" type="text" id="heritage_type_input"
                                    name="heritage_type_input" title="Patrimônio"
                                    placeholder="Digite ou selecione um tipo..."></x-input>
                                <div class="custom-dropdown"></div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="dropdown-wrapper" style="position: relative;">
                                <select id="heritage_brand_id" name="heritage_brand_id" style="display:none;"></select>
                                <x-input col="" set="" type="text" id="heritage_brand_input"
                                    name="heritage_brand_input" title="Marca"
                                    placeholder="Digite ou selecione uma marca..."></x-input>
                                <div class="custom-dropdown"></div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="dropdown-wrapper" style="position: relative;">
                                <select id="heritage_model_id" name="heritage_model_id" style="display:none;" disabled></select>
                                <x-input col="" set="" type="text" id="heritage_model_input"
                                    name="heritage_model_input" title="Modelo" placeholder="Digite ou selecione um modelo..."
                                    disabled="1"></x-input>

                                <div class="custom-dropdown"></div>
                            </div>
                        </div>
                    </div>
                </x-form>
            </div>
        </div>
    </div>
@endsection

<script src="{{ asset('js/common/select/custom_select_heritage.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        createSmartSelect({
            selectId: 'heritage_type_id',
            inputId: 'heritage_type_input',
            searchUrl: '{{ route('heritage_type.search') }}',
            storeUrl: '{{ route('heritage_type.store') }}',
            fieldName: 'name',
            onSelect: (item) => {
                const select = document.getElementById('heritage_type_id');
                if (select) {
                    let option = select.querySelector(`option[value="${item.id}"]`);
                    if (!option) {
                        option = document.createElement('option');
                        option.value = item.id;
                        option.text = item.name;
                        select.appendChild(option);
                    }
                    select.value = item.id;
                }
            },
            onCreate: (item) => {
                const select = document.getElementById('heritage_type_id');
                if (select) {
                    let option = select.querySelector(`option[value="${item.id}"]`);
                    if (!option) {
                        option = document.createElement('option');
                        option.value = item.id;
                        option.text = item.name;
                        select.appendChild(option);
                    }
                    select.value = item.id;
                }
            }
        });

        createSmartSelect({
            selectId: 'heritage_brand_id',
            inputId: 'heritage_brand_input',
            searchUrl: '{{ route('heritage_brand.search') }}',
            storeUrl: '{{ route('heritage_brand.store') }}',
            fieldName: 'name',
            onSelect: (item) => {
                console.log('Marca selecionada:', item.id);
                const select = document.getElementById('heritage_brand_id');

                if (select) {
                    let option = select.querySelector(`option[value="${item.id}"]`);
                    if (!option) {
                        option = document.createElement('option');
                        option.value = item.id;
                        option.text = item.name;
                        select.appendChild(option);
                    }
                    select.value = item.id;
                }

                document.getElementById('heritage_model_input').disabled = false;
                document.getElementById('heritage_model_id').disabled = false;
            },

            onCreate: (item) => {
                const select = document.getElementById('heritage_brand_id');

                if (select) {
                    let option = select.querySelector(`option[value="${item.id}"]`);
                    if (!option) {
                        option = document.createElement('option');
                        option.value = item.id;
                        option.text = item.name;
                        select.appendChild(option);
                    }
                    select.value = item.id;
                }

                document.getElementById('heritage_model_input').disabled = false;
                document.getElementById('heritage_model_id').disabled = false;
            }
        });

        createSmartSelect({
            selectId: 'heritage_model_id',
            inputId: 'heritage_model_input',
            searchUrl: '{{ route('heritage_model.search') }}',
            storeUrl: '{{ route('heritage_model.store') }}',
            fieldName: 'name',
            getExtraParams: (item) => {
                const brandSelect = document.getElementById('heritage_brand_id');
                console.log('Brand Select:', brandSelect, item, 'Valor:', brandSelect?.value); // 👀
                return {
                    heritage_brand_id: brandSelect ? brandSelect.value : null
                };
            },
            onSelect: (item) => {
                const select = document.getElementById('heritage_model_id');
                if (select) {
                    let option = select.querySelector(`option[value="${item.id}"]`);
                    if (!option) {
                        option = document.createElement('option');
                        option.value = item.id;
                        option.text = item.name;
                        select.appendChild(option);
                    }
                    select.value = item.id;
                }
            },
            onCreate: (item) => {
                const select = document.getElementById('heritage_model_id');
                if (select) {
                    let option = select.querySelector(`option[value="${item.id}"]`);
                    if (!option) {
                        option = document.createElement('option');
                        option.value = item.id;
                        option.text = item.name;
                        select.appendChild(option);
                    }
                    select.value = item.id;
                }
                console.log('Novo modelo criado:', item);
            }

        });

        // Também escuta mudanças diretas no select, caso criem ou selecionem manualmente
        document.getElementById('heritage_brand_id').addEventListener('change', function() {
            const modelInput = document.getElementById('heritage_model_input');
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
