@csrf
<div class="mb-3">
    <label for="training_id">Treinamento</label>
    <select name="training_id" id="training_id" class="form-control" required>
        <option value="">-- selecione --</option>
        @foreach($trainings as $train)
            <option value="{{ $train->id }}" {{ old('training_id',$turma->training_id ?? '') == $train->id ? 'selected' : '' }}>
                {{ $train->title }}
            </option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label for="instructor_id">Instrutor</label>
    <select name="instructor_id" id="instructor_id" class="form-control" required>
        <option value="">-- selecione --</option>
        @foreach($instructors as $inst)
            <option value="{{ $inst->id }}" {{ old('instructor_id',$turma->instructor_id ?? '') == $inst->id ? 'selected' : '' }}>
                {{ $inst->name }}
            </option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label for="meet_class_id">Sala</label>
    <select name="meet_class_id" id="meet_class_id" class="form-control" required>
        <option value="">-- selecione --</option>
        @foreach($meetClasses as $room)
            <option value="{{ $room->id }}" {{ old('meet_class_id',$turma->meet_class_id ?? '') == $room->id ? 'selected' : '' }}>
                {{ $room->name }}
            </option>
        @endforeach
    </select>
</div>
<div class="mb-3 row">
    <div class="col">
        <label for="start_date">Data Início</label>
        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date',$turma->start_date ?? '') }}" required>
    </div>
    <div class="col">
        <label for="end_date">Data Fim</label>
        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date',$turma->end_date ?? '') }}">
    </div>
    <div class="col">
        <label for="capacity">Capacidade</label>
        <input type="number" name="capacity" id="capacity" class="form-control" value="{{ old('capacity',$turma->capacity ?? '') }}" min="1" required>
    </div>
</div>
<button class="btn btn-primary mt-3">{{ $buttonText }}</button>
