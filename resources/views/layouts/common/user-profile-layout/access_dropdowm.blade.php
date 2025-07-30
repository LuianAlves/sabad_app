

{{--<li>--}}
{{--    <a class="dropdown-item" href="javascript:;">--}}

{{--    </a>--}}
{{--</li>--}}
{{--<li>--}}
{{--    <a class="dropdown-item" href="javascript:;">--}}
{{--        <img src="https://demos.creative-tim.com/argon-dashboard-pro/assets/img/icons/flags/GB.png" /> English(UK)--}}
{{--    </a>--}}
{{--</li>--}}
{{--<li>--}}
{{--    <a class="dropdown-item" href="javascript:;">--}}
{{--        <img src="https://demos.creative-tim.com/argon-dashboard-pro/assets/img/icons/flags/FR.png" /> Français--}}
{{--    </a>--}}
{{--</li>--}}


@php
    $userPermissions = auth()->user()->getAllPermissions();

    // Mapeamento das permissões para as rotas
    $permissionRoutes = [
        'view users' => 'users.index',
        'view roles' => 'roles.index',
        'view products' => 'products.index',
        'view permissions' => 'permissions.index',
        'view employees' => 'employees.index',
        // Adicione aqui mais conforme suas permissões e rotas
    ];
@endphp


    <a href="javascript:;" class="btn bg-gradient-dark dropdown-toggle" data-bs-toggle="dropdown" id="permissionDropdown">
        <i class="fa fa-lock me-1"></i> Acessos disponíveis
    </a>
    <ul class="dropdown-menu" aria-labelledby="permissionDropdown">
        @forelse($userPermissions as $permission)
            @php
                $routeName = $permissionRoutes[$permission->name] ?? null;
            @endphp

            @if($routeName && Route::has($routeName))
                <li>
                    <a class="dropdown-item" href="{{ route($routeName) }}">
                        <i class="fa fa-link me-1 text-primary"></i> {{ ucfirst($permission->name) }}
                    </a>
                </li>
            @endif
        @empty
            <li>
                <a class="dropdown-item text-muted" href="javascript:;">Nenhuma permissão disponível</a>
            </li>
        @endforelse
    </ul>


