@csrf
<div>
    <label>Ordem (1=Junior,2=Pleno,3=Senior)</label>
    <input name="order" type="number" min="1"
           value="{{ old('order',$tierLevel->order ?? '') }}" required>
</div>
<div>
    <label>Nome do Tier</label>
    <input name="name"
           value="{{ old('name',$tierLevel->name ?? '') }}" required>
</div>
<button type="submit">Salvar</button>
