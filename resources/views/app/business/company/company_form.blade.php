@csrf
<div class="row">
    <x-input col="6" set="" type="text" title="Nome da empresa" id="name" name="name"
             value="{{ old('name', $company->name ?? '') }}" placeholder="Bongas Bra ..." disabled=""></x-input>
    <x-input col="6" set="" type="text" title="CNPJ" id="cpfCnpj" name="cpfCnpj"
             value="{{ old('cpfCnpj', $company->cnpj ?? '') }}" placeholder="00.000.000/0001-00" disabled=""></x-input>
</div>
<div class="row">
    <x-select col="6" set="" id="union_id" name="union_id" title="Sindicato">
        <option disabled selected>Selecione um sindicato</option>
        @foreach($unions as $union)
                <option value="{{$union->id}}" {{ (old('union_id', $company->union_id ?? '') == $union->id) ? 'selected' : '' }}>
                    {{$union->name}}
                </option>
        @endforeach
    </x-select>
</div>
