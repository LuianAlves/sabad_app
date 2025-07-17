@extends('layouts.templates.app-layout')
@section('content')
    <div class="container">
        <h1>Nova Turma para {{$training->title}}</h1>
        <form action="{{ route('training-class.store') }}" method="POST">

            <input type="hidden" name="training_id" id="training_id" value="{{$training->id}}" />

            @include('app.business.training.training_class.training_class_form', ['buttonText' => 'Criar Turma'])
        </form>
    </div>

    <script>
        // Seleção hierárquica de participantes
        const selectAll = document.getElementById('select_all');
        const companyCbs = document.querySelectorAll('.company-checkbox');
        const deptCbs = document.querySelectorAll('.department-checkbox');
        const empCbs = document.querySelectorAll('.employee-checkbox');

        // Selecionar tudo
        selectAll.addEventListener('change', () => {
            const checked = selectAll.checked;
            [...companyCbs, ...deptCbs, ...empCbs].forEach(cb => cb.checked = checked);
        });

        // Empresa marca departamentos e funcionários
        companyCbs.forEach(cb => {
            cb.addEventListener('change', () => {
                const cid = cb.dataset.companyId;
                document.querySelectorAll(
                    `.department-checkbox[data-company-id="${cid}"], .employee-checkbox[data-company-id="${cid}"]`
                ).forEach(el => el.checked = cb.checked);
            });
        });

        // Departamento marca funcionários
        deptCbs.forEach(cb => {
            cb.addEventListener('change', () => {
                const did = cb.dataset.departmentId;
                document.querySelectorAll(
                    `.employee-checkbox[data-department-id="${did}"]`
                ).forEach(el => el.checked = cb.checked);
            });
        });

        // Atualiza estado da empresa se todos filhos marcados
        companyCbs.forEach(cb => {
            const cid = cb.dataset.companyId;
            const relatedDeps = document.querySelectorAll(`.department-checkbox[data-company-id="${cid}"]`);
            const relatedEmps = document.querySelectorAll(`.employee-checkbox[data-company-id="${cid}"]`);
            const updateCompany = () => {
                const allDeps = [...relatedDeps].every(d => d.checked);
                const allEmps = [...relatedEmps].every(e => e.checked);
                cb.checked = allDeps && allEmps;
            };
            relatedDeps.forEach(d => d.addEventListener('change', updateCompany));
            relatedEmps.forEach(e => e.addEventListener('change', updateCompany));
        });

        // Atualiza estado do departamento se todos funcionários marcados
        deptCbs.forEach(cb => {
            const did = cb.dataset.departmentId;
            const relatedEmps = document.querySelectorAll(`.employee-checkbox[data-department-id="${did}"]`);
            relatedEmps.forEach(e => {
                e.addEventListener('change', () => {
                    cb.checked = [...relatedEmps].every(emp => emp.checked);
                });
            });
        });
    </script>
@endsection
