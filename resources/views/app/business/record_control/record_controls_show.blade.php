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
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border shadow-xs mb-4">


                <div class="card-body p-4">
                    <p><strong>ID:</strong> {{ $recordcontrol->id }}</p>
                    <p><strong>Funcionário:</strong> {{ $recordcontrol->employee->name ?? 'N/A' }}</p>
                    <p><strong>Departamento:</strong> {{ $recordcontrol->employee->department->name ?? 'N/A' }}</p>
                    <p><strong>Empresa:</strong> {{ $recordcontrol->employee->department->company->name ?? 'N/A' }}</p>
                    <hr>

                    <p><strong>Identificação:</strong> {{ $recordcontrol->identificacao }}</p>
                    <p><strong>Forma de Armazenamento:</strong> {{ $recordcontrol->forma_armazenamento }}</p>
                    <p><strong>Local de Armazenamento:</strong> {{ $recordcontrol->local_armazenamento }}</p>
                    <p><strong>Acesso Permitido:</strong> {{ $recordcontrol->acesso_permitido }}</p>
                    <p><strong>Tempo de Retenção:</strong> {{ $recordcontrol->tempo_retencao }}</p>
                    <p><strong>Método de Manutenção:</strong> {{ $recordcontrol->metodo_manutencao }}</p>

                    <div class="mt-4">
                        <a href="{{ route('record_controls.index', $recordcontrol->department_id) }}" class="btn btn-secondary">
                            Voltar
                        </a>
                        <a href="{{ route('record_controls.edit', $recordcontrol->id) }}" class="btn btn-primary">
                            Editar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
