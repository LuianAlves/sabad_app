@csrf
<label>Nome:</label>
<input name="name" value="{{ old('name',$union->name??'') }}" required>
<label>Reajuste atual (%)</label>
<input name="current_adjustment_percent" type="number" step="0.01"
       value="{{ old('current_adjustment_percent',$union->current_adjustment_percent??0) }}" required>
<button type="submit">Salvar</button>
