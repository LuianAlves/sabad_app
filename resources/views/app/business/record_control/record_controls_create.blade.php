@php
    $isAdmin = auth()->user()->hasRole('admin');
    $layout = $isAdmin
        ? 'layouts.templates.app-layout'
        : 'layouts.templates.user-profile-layout';

    $section = $isAdmin ? 'content' : 'content-user-layout';
    $user = auth()->user();
@endphp

@extends($layout)

@section($section)

    @unless($isAdmin)
        {{-- Cabeçalho do perfil para usuários com role "user" --}}
        <div class="pt-7 pb-6 bg-cover bg-info"></div>

        <div class="container">
            <div class="card card-body py-2 bg-transparent shadow-none">
                <div class="row">
                    <div class="col-auto">
                        <div class="avatar avatar-2xl rounded-circle position-relative mt-n7 border border-gray-100 border-4">
                            @if ($user->image)
                                <img src="{{ 'data:image/png;base64,' . $user->image }}" alt="profile_image" class="w-100">
                            @else
                                <img src="{{ asset('img/profile/image_profile.webp') }}" alt="profile_image" class="w-100">
                            @endif
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h3 class="mb-0 font-weight-bold">{{ $user->name }}</h3>
                            <p class="mb-0">
                                {{-- {{ $user->email }} --}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endunless
    <form method="POST" action="{{ route('record_controls.store', $department) }}">
        @csrf


        @php
            $user = auth()->user();
            $employee = $user->employeeUser->employee ?? null;
            $department = $employee->department ?? null;
            $company = $department->company ?? null;
        @endphp

        <p><strong>Funcionário:</strong> {{ $user->name }}</p>
        <p><strong>Departamento:</strong>
            {{ $department->name ?? 'Não definido' }} /
            {{ $company->name ?? 'Não definido' }}
        </p>

        <input type="hidden" name="employee_id" value="{{ $employee->id ?? '' }}">
        <input type="hidden" name="department_id" value="{{ $department->id ?? '' }}">


        <input name="identificacao" class="form-control mb-2" placeholder="Identificação do Registro" required>
        <input name="forma_armazenamento" class="form-control mb-2" placeholder="Forma de Armazenamento" required>
        <input name="local_armazenamento" class="form-control mb-2" placeholder="Local de Armazenamento" required>
        <input name="acesso_permitido" class="form-control mb-2" placeholder="Acesso Permitido" required>
        <input name="tempo_retencao" class="form-control mb-2" placeholder="Tempo de Retenção" required>
        <input name="metodo_manutencao" class="form-control mb-2" placeholder="Método de Manutenção" required>

        <button class="btn btn-success">Salvar</button>
    </form>

@endsection
