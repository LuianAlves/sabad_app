@csrf

<div class="mb-3">
    <label for="instructor_id">Instrutor</label>
    <select name="instructor_id" id="instructor_id" class="form-control" required>
        <option value="">-- selecione --</option>
        @foreach($instructors as $inst)
            <option value="{{ $inst->id }}" {{ old('instructor_id',$trainingClass->instructor_id ?? '') == $inst->id ? 'selected' : '' }}>
                {{ $inst->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="room_id">Sala</label>
    <select name="room_id" id="room_id" class="form-control" required>
        <option value="">-- selecione --</option>
        @foreach($rooms as $room)
            <option value="{{ $room->id }}" {{ old('room_id',$trainingClass->room_id ?? '') == $room->id ? 'selected' : '' }}>
                {{ $room->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3 row">
    <div class="col">
        <label for="start_date">Data Início</label>
        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date',$trainingClass->start_date ?? '') }}" required>
    </div>
    <div class="col">
        <label for="end_date">Data Fim</label>
        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date',$trainingClass->end_date ?? '') }}">
    </div>
    <div class="col">
        <label for="capacity">Capacidade</label>
        <input type="number" name="capacity" id="capacity" class="form-control" value="{{ old('capacity',$trainingClass->capacity ?? '') }}" min="1" required>
    </div>
</div>


<div class="mb-4">
    <h5>Participantes</h5>
    <div>
        <input type="checkbox" id="select_all" />
        <label for="select_all"><strong>Selecionar Todos</strong></label>
    </div>
    @foreach($companies as $company)
        <div>
            <input type="checkbox"
                   class="company-checkbox"
                   id="company_{{ $company->id }}"
                   data-company-id="{{ $company->id }}" />
            <label for="company_{{ $company->id }}"><strong>{{ $company->name }}</strong></label>
        </div>
        @foreach($company->departments as $department)
            <div style="margin-left:20px">
                <input type="checkbox"
                       class="department-checkbox"
                       id="department_{{ $department->id }}"
                       data-company-id="{{ $company->id }}"
                       data-department-id="{{ $department->id }}" />
                <label for="department_{{ $department->id }}">{{ $department->name }}</label>
            </div>
            @foreach($department->employees as $employee)
                <div style="margin-left:40px">
                    <input type="checkbox"
                           name="participant_ids[]"
                           class="employee-checkbox"
                           id="employee_{{ $employee->id }}"
                           value="{{ $employee->id }}"
                           data-company-id="{{ $company->id }}"
                           data-department-id="{{ $department->id }}" />
                    <label for="employee_{{ $employee->id }}">{{ $employee->name }}</label>
                </div>
            @endforeach
        @endforeach
    @endforeach
</div>


<button class="btn btn-primary mt-3">{{ $buttonText }}</button>

