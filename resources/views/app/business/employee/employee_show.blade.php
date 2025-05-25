@php
    $completeName = $employee->name;

    $array = explode(' ', $completeName);

    $name = array_shift($array);

    $lastName = implode(' ', $array);
@endphp

<x-user-profile-layout>
    @section('content-user-layout')
        <div class="pt-7 pb-6 bg-cover" style="background-image: url('../img/header-blue-purple.jpg'); background-position: bottom;"></div>

        <div class="container">
            <div class="card card-body py-2 bg-transparent shadow-none">
                <div class="row">
                    <div class="col-auto">
                        <div
                            class="avatar avatar-2xl rounded-circle position-relative mt-n7 border border-gray-100 border-4">
                            @if (isset($employee->employeeUser->user) && $employee->employeeUser->user->image)
                                <img src="{{ 'data:image/png;base64,' . $employee->employeeUser->user->image }}"
                                    alt="Imagem do funcionário" class="w-100">
                            @else
                                <img src="{{ asset('img/profile/image_profile.webp') }}" alt="Imagem do funcionário"
                                    class="w-100">
                            @endif
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h3 class="mb-0 font-weight-bold">
                                {{ $employee->name }}
                            </h3>
                            <p class="mb-0">
                                @if (isset($employee->employeeUser->user) && $employee->employeeUser->user->email)
                                    {{ $employee->employeeUser->user->email }}
                                @else
                                    Não cadastrado
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3 text-sm-end">
                        <a href="javascript:;" class="btn btn-sm btn-white">Voltar</a>
                        <a href="javascript:;" class="btn btn-sm btn-dark">Salvar alterações</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container my-3 py-3">
            <div class="row">

                <!-- Permissions -->
                <div class="col-12 col-xl-4 mb-4">
                    <div class="card border shadow-xs h-100" style="max-height: 450px; overflow-y: auto;">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0 font-weight-semibold text-lg">Permissões de acesso</h6>
                            <p class="text-sm mb-1">{{ $name }}, tem acesso às abas:</p>
                        </div>
                        <div class="card-body p-3">

                            @foreach ($permissions as $entity => $perms)
                                @php
                                    $translatedEntity = __('permissions.' . strtolower($entity));
                                @endphp

                                <h6 class="text-dark font-weight-semibold mb-1">{{ $translatedEntity }}</h6>
                                <ul class="list-group mb-3">
                                    @foreach ($perms as $permission)
                                        @php
                                            $user = optional($employee->employeeUser)->user;
                                            $hasPermission = $user && $user->hasPermissionTo($permission->name);
                                            $parts = explode(' ', strtolower($permission->name));
                                            $action = $parts[0]; // view, create, etc.
                                            $module = implode('_', array_slice($parts, 1)); // users, companies etc
                                        @endphp
                                        <li class="list-group-item border-0 px-0">
                                            <div class="form-check form-switch ps-0">
                                                <input class="form-check-input ms-auto" type="checkbox" name="permissions[]"
                                                    value="{{ $permission->name }}"
                                                    id="perm-{{ Str::slug($permission->name) }}"
                                                    @checked($hasPermission)>
                                                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                                                    for="perm-{{ Str::slug($permission->name) }}">
                                                    {{ __('permissions.' . $action) }} {{ __('permissions.' . $module) }}
                                                </label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endforeach

                        </div>
                    </div>
                </div>

                <!-- Profile -->
                <div class="col-12 col-xl-4 mb-4">
                    <div class="card border shadow-xs h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 col-9">
                                    <h6 class="mb-0 font-weight-semibold text-lg">Informações</h6>
                                    <p class="text-sm mb-1"><b>do funcionário</b></p>
                                </div>
                                <div class="col-md-4 col-3 text-end">
                                    <button type="button" class="btn btn-white btn-icon px-2 py-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <p class="text-sm mb-4">
                                {{ $employee->name }}, entrou em
                                {{ \Carbon\Carbon::parse($employee->hired_in)->format('d/m/Y') }}
                                ({{ \Carbon\Carbon::parse($employee->hired_in)->diffForHumans() }}) na equipe do (a)
                                {{ $employee->department->name }}
                                pela empresa {{ $employee->department->company->name }}.
                            </p>
                            <ul class="list-group">
                                <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pt-0 pb-1 text-sm">
                                    <span class="text-secondary">Primeiro nome:</span> &nbsp; {{ $name }}
                                </li>
                                <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                    <span class="text-secondary">Sobrenome:</span> &nbsp;
                                    {{ $lastName ? $lastName : 'Não informado' }}
                                </li>
                                <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                    <span class="text-secondary">Telefone:</span> &nbsp;
                                    {{ $employee->phoneNumber ? $employee->phoneNumber : 'Não informado' }}
                                </li>
                                <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                    <span class="text-secondary">Cargo:</span> &nbsp; {{ $employee->hierarchical_level }}
                                </li>
                                <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                    <span class="text-secondary">Empresa:</span> &nbsp;
                                    {{ $employee->department->company->name }}
                                </li>
                                <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                    <span class="text-secondary">E-mail (s):</span> &nbsp; <br>
                                    @if (isset($employee->employeeUser->user) && $employee->employeeUser->user->email)
                                        <a href="mailto::{{ $employee->employeeUser->user->email }}"
                                            class="text-info text-sm font-weight-bold">{{ $employee->employeeUser->user->email }}</a>
                                    @else
                                        <a href="#" class="text-muted text-sm font-weight-bold">Não informado</a>
                                    @endif
                                    <!-- Usar relacionamento com model Email e puxar todos -->
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Deparment -->
                <div class="col-12 col-xl-4 mb-4">
                    <div class="card border shadow-xs h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row mb-sm-0 mb-2">
                                <div class="col-md-8 col-9">
                                    <h6 class="mb-0 font-weight-semibold text-lg">Colegas de equipe</h6>
                                    <p class="text-sm mb-0">
                                        {{ '/ ' . $employee->department->name . ' - ' . Str::words($employee->department->company->name, 1, ' ..') }}
                                    </p>
                                </div>
                                <div class="col-md-4 col-3 text-end">
                                    <button type="button" class="btn btn-white btn-icon px-2 py-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10.5 6a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm0 6a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm0 6a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3 pt-0">
                            <ul class="list-group">
                                @foreach ($teammates as $teammate)
                                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-1">
                                        <div class="avatar avatar-sm rounded-circle me-2">
                                            @if (isset($teammate->employeeUser->user) && $teammate->employeeUser->user->image)
                                                <img src="{{ 'data:image/png;base64,' . $teammate->employeeUser->user->image }}"
                                                    alt="{{ $teammate->name }}" class="w-100">
                                            @else
                                                <img src="{{ asset('img/profile/image_profile.webp') }}"
                                                    alt="Não cadastrada" class="w-100">
                                            @endif
                                        </div>
                                        <div class="d-flex align-items-start flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm font-weight-semibold">{{ $teammate->name }}</h6>
                                            <p class="mb-0 text-sm text-secondary">{{ $teammate->hierarchical_level }}</p>
                                        </div>
                                        <span class="p-1 bg-success rounded-circle ms-auto me-3">
                                            <span class="visually-hidden">Online</span>
                                        </span>
                                    </li>
                                @endforeach
                                {{-- 
                                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-1">
                                    <div class="avatar avatar-sm rounded-circle me-2">
                                        <img src="../img/team-1.jpg" alt="kal" class="w-100">
                                    </div>
                                    <div class="d-flex align-items-start flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm font-weight-semibold">Sarah Lamalo</h6>
                                        <p class="mb-0 text-sm text-secondary">Hi! I need more information about ...
                                        </p>
                                    </div>
                                    <span class="p-1 bg-success rounded-circle ms-auto me-3">
                                        <span class="visually-hidden">Online</span>
                                    </span>
                                </li>

                                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-1">
                                    <div class="avatar avatar-sm rounded-circle me-2">
                                        <img src="../img/marie.jpg" alt="kal" class="w-100">
                                    </div>
                                    <div class="d-flex align-items-start flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm font-weight-semibold">Vicky Hladynets</h6>
                                        <p class="mb-0 text-sm text-secondary">Hello, Noah!</p>
                                    </div>
                                    <span class="p-1 bg-success rounded-circle ms-auto me-3">
                                        <span class="visually-hidden">Online</span>
                                    </span>
                                </li>

                                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-1">
                                    <div class="avatar avatar-sm rounded-circle me-2">
                                        <img src="../img/team-5.jpg" alt="kal" class="w-100">
                                    </div>
                                    <div class="d-flex align-items-start flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm font-weight-semibold">Charles Deluvio</h6>
                                        <p class="mb-0 text-sm text-secondary">Great, thank you!</p>
                                    </div>
                                    <span class="p-1 bg-success rounded-circle ms-auto me-3">
                                        <span class="visually-hidden">Online</span>
                                    </span>
                                </li>

                                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-1">
                                    <div class="avatar avatar-sm rounded-circle me-2">
                                        <img src="../img/team-4.jpg" alt="kal" class="w-100">
                                    </div>
                                    <div class="d-flex align-items-start flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm font-weight-semibold">Leio Mclaren</h6>
                                        <p class="mb-0 text-sm text-secondary">Don't worry! 🙏🏻</p>
                                    </div>
                                    <span class="p-1 bg-success rounded-circle ms-auto me-3">
                                        <span class="visually-hidden">Online</span>
                                    </span>
                                </li>

                                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-1">
                                    <div class="avatar avatar-sm rounded-circle me-2">
                                        <img src="../img/team-3.jpg" alt="kal" class="w-100">
                                    </div>
                                    <div class="d-flex align-items-start flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm font-weight-semibold">Mateus Campos</h6>
                                        <p class="mb-0 text-sm text-secondary">Call me, please.</p>
                                    </div>
                                    <span class="p-1 bg-success rounded-circle ms-auto me-3">
                                        <span class="visually-hidden">Online</span>
                                    </span>
                                </li>

                                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-1">
                                    <div class="avatar avatar-sm rounded-circle me-2">
                                        <img src="../img/team-2.jpg" alt="kal" class="w-100">
                                    </div>
                                    <div class="d-flex align-items-start flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm font-weight-semibold">Miriam Lore</h6>
                                        <p class="mb-0 text-sm text-secondary">Well done!</p>
                                    </div>
                                    <span class="p-1 bg-success rounded-circle ms-auto me-3">
                                        <span class="visually-hidden">Online</span>
                                    </span>
                                </li>

 --}}
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card shadow-xs border mb-4 pb-3">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0 font-weight-semibold text-lg">Chamados recentes</h6>
                            <p class="text-sm mb-1">Veja os problemas recentes que {{ $name }} teve:</p>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-3 my-3">
                                    <div class="card card-background border-radius-xl card-background-after-none align-items-start mb-4">
                                        <div class="full-background bg-cover bg-info"></div>
                                        <span class="mask bg-dark opacity-1 border-radius-sm"></span>
                                        <div class="card-body text-start p-3 w-100">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="blur shadow d-flex align-items-center w-100 border-radius-md border border-white p-3">
                                                        <div class="w-50">
                                                            <p class="text-dark text-sm font-weight-bold mb-1">Prioridade</p>
                                                            <p class="text-xs text-secondary mb-0">Baixa</p>
                                                        </div>
                                                        <p class="text-dark text-sm font-weight-bold ms-auto">20 de maio
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="javascript:;">
                                        <h6 class="font-weight-semibold">
                                           Problema com outlook
                                        </h6>
                                    </a>
                                    <p class="mb-4">
                                        Meu outlook não está recebendo mais os e-mails...
                                    </p>
                                    <a href="javascript:;" class="text-info font-weight-semibold text-sm icon-move-right mt-auto w-100 mb-5">
                                        Acompanhar
                                        <i class="fas fa-arrow-right-long text-sm ms-1" aria-hidden="true"></i>
                                    </a>
                                </div>

                                <div class="col-3 my-3">
                                    <div class="card card-background border-radius-xl card-background-after-none align-items-start mb-4">
                                        <div class="full-background bg-cover bg-danger"></div>
                                        <span class="mask bg-dark opacity-1 border-radius-sm"></span>
                                        <div class="card-body text-start p-3 w-100">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="blur shadow d-flex align-items-center w-100 border-radius-md border border-white p-3">
                                                        <div class="w-50">
                                                            <p class="text-dark text-sm font-weight-bold mb-1">Prioridade</p>
                                                            <p class="text-xs text-secondary mb-0">Baixa</p>
                                                        </div>
                                                        <p class="text-dark text-sm font-weight-bold ms-auto">17 de maio
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="javascript:;">
                                        <h6 class="font-weight-semibold">
                                           Notebook travou
                                        </h6>
                                    </a>
                                    <p class="mb-4">
                                        Meu notebook congelou a tela quando abri o navegador e ... 
                                    </p>
                                    <a href="javascript:;" class="text-info font-weight-semibold text-sm icon-move-right mt-auto w-100 mb-5">
                                        Acompanhar
                                        <i class="fas fa-arrow-right-long text-sm ms-1" aria-hidden="true"></i>
                                    </a>
                                </div>

                                <div class="col-3 my-3">
                                    <div class="card card-background border-radius-xl card-background-after-none align-items-start mb-4">
                                        <div class="full-background bg-cover bg-success"></div>
                                        <span class="mask bg-dark opacity-1 border-radius-sm"></span>
                                        <div class="card-body text-start p-3 w-100">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="blur shadow d-flex align-items-center w-100 border-radius-md border border-white p-3">
                                                        <div class="w-50">
                                                            <p class="text-dark text-sm font-weight-bold mb-1">Prioridade</p>
                                                            <p class="text-xs text-secondary mb-0">Alta</p>
                                                        </div>
                                                        <p class="text-dark text-sm font-weight-bold ms-auto">14 de maio
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="javascript:;">
                                        <h6 class="font-weight-semibold">
                                           Link de reunião
                                        </h6>
                                    </a>
                                    <p class="mb-4">
                                        Preciso de um link de reunião para as 15...
                                    </p>
                                    <a href="javascript:;" class="text-info font-weight-semibold text-sm icon-move-right mt-auto w-100 mb-5">
                                        Acompanhar
                                        <i class="fas fa-arrow-right-long text-sm ms-1" aria-hidden="true"></i>
                                    </a>
                                </div>

                                <div class="col-3 my-3">
                                    <div class="card card-background border-radius-xl card-background-after-none align-items-start mb-4">
                                        <div class="full-background bg-cover bg-warning"></div>
                                        <span class="mask bg-dark opacity-1 border-radius-sm"></span>
                                        <div class="card-body text-start p-3 w-100">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="blur shadow d-flex align-items-center w-100 border-radius-md border border-white p-3">
                                                        <div class="w-50">
                                                            <p class="text-dark text-sm font-weight-bold mb-1">Prioridade</p>
                                                            <p class="text-xs text-secondary mb-0">Baixa</p>
                                                        </div>
                                                        <p class="text-dark text-sm font-weight-bold ms-auto">10 de maio
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="javascript:;">
                                        <h6 class="font-weight-semibold">
                                           Solicitação de compra
                                        </h6>
                                    </a>
                                    <p class="mb-4">
                                        Estou precisando de um notebook novo com as conf...
                                    </p>
                                    <a href="javascript:;" class="text-info font-weight-semibold text-sm icon-move-right mt-auto w-100 mb-5">
                                        Acompanhar
                                        <i class="fas fa-arrow-right-long text-sm ms-1" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Include:Footer -->
            @include('layouts.common.footer')
        </div>
    @endsection
</x-user-profile-layout>
