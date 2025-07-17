@extends('layouts.templates.app-layout')
@section('content')
    <div class="container">
        <h1>Nova Turma para {{ $training->title }}</h1>
        <form action="{{ route('training-class.store') }}" method="POST">
            @csrf
            <input type="hidden" name="training_id" value="{{ $training->id }}">

            {{-- Capacidade por turma --}}
            <div class="mb-3">
                <label for="capacity">Capacidade por Turma</label>
                <input type="number" name="capacity" id="capacity"
                       class="form-control" value="{{ old('capacity',1) }}"
                       min="1" required>
            </div>

            {{-- Participantes --}}
            <div class="mb-4">
                <h5>Participantes</h5>
                <div class="mb-2">
                    <button type="button" id="generate-groups" class="btn btn-secondary btn-sm">Gerar Turmas</button>
                    <button type="button" id="random-generate-groups" class="btn btn-secondary btn-sm">Gerar Aleatório
                    </button>
                </div>

                <div class="mb-2">
                    <input type="checkbox" id="select_all"/>
                    <label for="select_all"><strong>Selecionar Todos</strong></label>

                    @foreach($companies as $company)
                        <div>
                            <input type="checkbox" class="company-checkbox"
                                   id="company_{{ $company->id }}"
                                   data-company-id="{{ $company->id }}"/>
                            <label for="company_{{ $company->id }}"><strong>{{ $company->name }}</strong></label>
                        </div>
                        @foreach($company->departments as $dept)
                            <div style="margin-left:20px">
                                <input type="checkbox" class="department-checkbox"
                                       id="dept_{{ $dept->id }}"
                                       data-company-id="{{ $company->id }}"
                                       data-department-id="{{ $dept->id }}"/>
                                <label for="dept_{{ $dept->id }}">{{ $dept->name }}</label>
                            </div>
                            @foreach($dept->employees as $emp)
                                <div style="margin-left:40px">
                                    <input type="checkbox" name="participant_ids[]"
                                           class="employee-checkbox"
                                           id="emp_{{ $emp->id }}"
                                           value="{{ $emp->id }}"
                                           data-company-id="{{ $company->id }}"
                                           data-department-id="{{ $dept->id }}"/>
                                    <label for="emp_{{ $emp->id }}">{{ $emp->name }}</label>
                                </div>
                            @endforeach
                        @endforeach
                    @endforeach
                </div>
            </div>

            {{-- Aqui virão os formulários de cada turma gerada --}}
            <div id="group-forms" class="mb-4"></div>

            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // checkboxes hierárquicos (igual antes)...
            const selectAll = document.getElementById('select_all');
            const companyCbs = document.querySelectorAll('.company-checkbox');
            const deptCbs = document.querySelectorAll('.department-checkbox');
            const empCbs = document.querySelectorAll('.employee-checkbox');

            selectAll.addEventListener('change', () => {
                const chk = selectAll.checked;
                [...companyCbs, ...deptCbs, ...empCbs].forEach(cb => cb.checked = chk);
            });
            companyCbs.forEach(cb => cb.addEventListener('change', () => {
                const cid = cb.dataset.companyId;
                document.querySelectorAll(
                    `.department-checkbox[data-company-id="${cid}"], .employee-checkbox[data-company-id="${cid}"]`
                ).forEach(el => el.checked = cb.checked);
            }));
            deptCbs.forEach(cb => cb.addEventListener('change', () => {
                const did = cb.dataset.departmentId;
                document.querySelectorAll(
                    `.employee-checkbox[data-department-id="${did}"]`
                ).forEach(el => el.checked = cb.checked);
            }));
            // mantém pais de acordo com filhos...
            companyCbs.forEach(cb => {
                const cid = cb.dataset.companyId;
                const deps = document.querySelectorAll(`.department-checkbox[data-company-id="${cid}"]`);
                const emps = document.querySelectorAll(`.employee-checkbox[data-company-id="${cid}"]`);
                const upd = () => cb.checked = [...deps].every(d => d.checked) && [...emps].every(e => e.checked);
                [...deps, ...emps].forEach(c => c.addEventListener('change', upd));
            });
            deptCbs.forEach(cb => {
                const did = cb.dataset.departmentId;
                const emps = document.querySelectorAll(`.employee-checkbox[data-department-id="${did}"]`);
                emps.forEach(e => e.addEventListener('change', () => {
                    cb.checked = [...emps].every(x => x.checked);
                }));
            });

            // Dados do back-end
            const rooms = @json($rooms);
            const instructors = @json($instructors);

            document.getElementById('generate-groups')
                .addEventListener('click', () => generateGroups(false));
            document.getElementById('random-generate-groups')
                .addEventListener('click', () => generateGroups(true));

            function generateGroups(randomize = false) {
                // captura participantes
                let parts = Array.from(document.querySelectorAll('.employee-checkbox:checked'))
                    .map(cb => ({
                        id: cb.value,
                        name: cb.nextElementSibling.innerText.trim()
                    }));
                if (randomize) parts = shuffle(parts);

                const cap = parseInt(document.getElementById('capacity').value) || 1;
                const cnt = Math.ceil(parts.length / cap);
                const out = document.getElementById('group-forms');
                out.innerHTML = '';

                for (let i = 0; i < cnt; i++) {
                    const grp = parts.slice(i * cap, (i + 1) * cap);
                    let html = `<fieldset class="border p-3 mb-3" data-original='${JSON.stringify(grp)}'><legend>Turma ${i + 1}</legend>`;

                    // DATETIME
                    html += `
  <div class="mb-2">
    <label>Data & Hora Início</label>
    <input type="datetime-local"
           name="groups[${i}][start_datetime]"
           class="form-control"
           required>
  </div>
  <div class="mb-2">
    <label>Data & Hora Fim</label>
    <input type="datetime-local"
           name="groups[${i}][end_datetime]"
           class="form-control"
           required>
  </div>`;

                    // SALA
                    html += `
        <div class="mb-2">
          <label>Sala</label>
          <select name="groups[${i}][room_id]" class="form-control" required>
            <option value="">-- selecione --</option>
            ${rooms.map(r => `<option value="${r.id}">${r.name}</option>`).join('')}
          </select>
        </div>`;

                    // INSTRUTOR
                    html += `
        <div class="mb-2">
          <label>Instrutor</label>
<select name="groups[${i}][instructor_id]" class="form-control instructor-select" required>
            <option value="">-- selecione --</option>
            ${instructors.map(ins => `<option value="${ins.id}">${ins.name}</option>`).join('')}
          </select>
        </div>`;

                    // PARTICIPANTES
                    html += `<ul class="list-group mb-2">`;
                    grp.forEach(p => {
                        html += `
          <li class="list-group-item d-flex justify-content-between align-items-center">
            ${p.name}
            <input type="hidden" name="groups[${i}][participant_ids][]" value="${p.id}">
          </li>`;
                    });
                    html += `</ul></fieldset>`;

                    out.insertAdjacentHTML('beforeend', html);
                }
            }

            // volta participante se trocar o instrutor
            // volta participante se trocar o instrutor
            document.getElementById('group-forms')
                .addEventListener('change', function (e) {
                    // só continua se for um select de instrutor
                    if (!e.target.name || !e.target.name.includes('[instructor_id]')) return;

                    const select = e.target;
                    const fieldset = select.closest('fieldset');
                    const idxMatch = select.name.match(/groups\[(\d+)\]/);
                    if (!idxMatch) return;
                    const idx = idxMatch[1];
                    const original = JSON.parse(fieldset.getAttribute('data-original'));
                    const selectedId = select.value;
                    const ul = fieldset.querySelector('ul.list-group');

                    // limpa lista atual
                    ul.innerHTML = '';

                    // repõe todos exceto o instrutor selecionado
                    original.forEach(p => {
                        if (p.id.toString() !== selectedId) {
                            const li = document.createElement('li');
                            li.className = 'list-group-item d-flex justify-content-between align-items-center';
                            li.innerHTML = `
          ${p.name}
          <input
            type="hidden"
            name="groups[${idx}][participant_ids][]"
            value="${p.id}"
          >`;
                            ul.appendChild(li);
                        }
                    });
                });


            function shuffle(a) {
                for (let i = a.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [a[i], a[j]] = [a[j], a[i]];
                }
                return a;
            }
        });
    </script>
@endsection
