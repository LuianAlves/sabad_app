@csrf
<div class="mb-3">
    <label for="title">Título</label>
    <input type="text" name="title" id="title" class="form-control" value="{{ old('title',$training->title ?? '') }}" required>
</div>
<div class="mb-3">
    <label for="description">Descrição</label>
    <textarea name="description" id="description" class="form-control">{{ old('description',$training->description ?? '') }}</textarea>
</div>
<button class="btn btn-primary">{{ $buttonText }}</button>
