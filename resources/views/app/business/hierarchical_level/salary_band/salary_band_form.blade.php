@csrf
<div>
    <label>Faixa (ex: I, II, III)</label>
    <input name="band"
           value="{{ old('band', $salaryBand->band ?? '') }}"
           required>
</div>
<div>
    <label>Salário</label>
    <input name="salary" type="number" step="0.01"
           value="{{ old('salary', $salaryBand->salary ?? '') }}"
           required>
</div>
<button type="submit">Salvar</button>
