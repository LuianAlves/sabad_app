@csrf
<div>
    <label>Ano</label>
    <input name="year" type="number"
           value="{{ old('year', $adjustment->year ?? '') }}"
           required>
</div>
<div>
    <label>Percentual (%)</label>
    <input name="percent" type="number" step="0.01"
           value="{{ old('percent', $adjustment->percent ?? $union->current_adjustment_percent) }}"
           required>
</div>
<button type="submit">Salvar</button>
