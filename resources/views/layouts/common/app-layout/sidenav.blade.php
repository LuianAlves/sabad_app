@php
    $currentRoute = Route::currentRouteName();

    $current = explode('.', $currentRoute)[0];
@endphp

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 fixed-start bg-white" id="sidenav-main">
    <div class="sidenav-header pt-2">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
           aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand d-flex align-items-center m-0"
           href=" https://demos.creative-tim.com/corporate-ui-dashboard/pages/dashboard.html " target="_blank">
            <span class="font-weight-bold text-lg"
                  style="font-size: 36px !important; letter-spacing: 1px !important;"><span class="text-info">D</span>ry<span
                    class="text-info">L</span>u</span>
        </a>
    </div>
    <div class="collapse navbar-collapse px-4 w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ $current == 'dashboard' ? 'active' : '' }}" href="{{ route('dashboard.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-table-columns fs-5"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <!-------- Entidades -------->
            @can('view entities')
                <li class="nav-item">
                    <div
                        class="d-flex align-items-center nav-link {{ in_array($current, ['company', 'user', 'union', 'department', 'employee']) ? 'active' : '' }}">
                        <div
                            class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-circle-notch fi-1"></i>
                        </div>
                        <span class="nav-link-text font-weight-bold ms-1">Entidades</span>
                    </div>
                </li>
            @endcan

            @can('view users')
                <!--Users-->
                <li class="nav-item border-start">
                    <a class="nav-link p-0 {{ $current == 'user' ? 'active' : '' }}" href="{{ route('user.index') }}">
                        <div
                            class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <i class="fas fa-users text-white fi-1"></i>
                        </div>
                        <span class="nav-link-text ms-1">Usuários</span>
                    </a>
                </li>
            @endcan

            <!--Unions-->
            @can('view unions')
                <li class="nav-item border-start my-0 pt-2">
                    <a class="nav-link p-0 {{ $current == 'union' ? 'active' : '' }}" href="{{ route('union.index') }}">
                        <div
                            class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-scale-balanced fi-1"></i>
                        </div>
                        <span class="nav-link-text ms-1">Sindicatos</span>
                    </a>
                </li>
            @endcan

            <!--Companies-->
            @can('view companies')
                <li class="nav-item border-start my-0 pt-2">
                    <a class="nav-link p-0 {{ $current == 'company' ? 'active' : '' }}"
                       href="{{ route('company.index') }}">
                        <div
                            class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <i class="fas fa-building text-white fi-1"></i>
                        </div>
                        <span class="nav-link-text ms-1">Empresas</span>
                    </a>
                </li>
            @endcan

            <!--Departments-->
            @can('view departments')
                <li class="nav-item border-start my-0 pt-2">
                    <a class="nav-link p-0 {{ $current == 'department' ? 'active' : '' }}"
                       href="{{ route('department.index') }}">
                        <div
                            class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <i class="fas fa-sitemap text-white fi-1"></i>
                        </div>
                        <span class="nav-link-text ms-1">Departamentos</span>
                    </a>
                </li>
            @endcan

            <!--Employees-->
            @can('view employees')
                <li class="nav-item border-start my-0 pt-2">
                    <a class="nav-link p-0 {{ $current == 'employee' ? 'active' : '' }}"
                       href="{{ route('employee.index') }}">
                        <div
                            class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <i class="fas fa-id-badge text-white fi-1"></i>
                        </div>
                        <span class="nav-link-text ms-1">Funcionários</span>
                    </a>
                </li>
            @endcan
            <!-------- END: Entidades -------->

            <!-------- Infraestrutura -------->
            <li class="nav-item mt-2">
                <div
                    class="d-flex align-items-center nav-link {{ in_array($current, ['room', 'heritage', 'service', 'device', 'license', 'email', 'extension']) ? 'active' : '' }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-circle-notch fi-1"></i>
                    </div>
                    <span class="nav-link-text font-weight-bold ms-1">Infraestrutura</span>
                </div>
            </li>

            <!--Rooms-->
            <li class="nav-item border-start my-0 pt-2">
                <a class="nav-link p-0 {{ $current == 'room' ? 'active' : '' }}" href="{{ route('room.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-house fi-1"></i>
                    </div>
                    <span class="nav-link-text ms-1">Salas</span>
                </a>
            </li>

            <!--Heritages-->
            <li class="nav-item border-start my-0 pt-2">
                <a class="nav-link p-0 {{ $current == 'heritage' ? 'active' : '' }}"
                   href="{{ route('heritage.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-industry fi-1"></i>
                    </div>
                    <span class="nav-link-text ms-1">Patrimônios</span>
                </a>
            </li>

            <!--Services-->
            <li class="nav-item border-start my-0 pt-2">
                <a class="nav-link p-0 {{ $current == 'service' ? 'active' : '' }}" href="{{ route('service.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-concierge-bell text-white fi-1"></i>
                    </div>
                    <span class="nav-link-text ms-1">Serviços</span>
                </a>
            </li>

            <li class="nav-item border-start my-0 pt-2">
                <a class="nav-link p-0 {{ $current == 'license' ? 'active' : '' }}" href="{{ route('license.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-key text-white fi-1"></i>
                    </div>
                    <span class="nav-link-text ms-1">Licenças</span>
                </a>
            </li>

            <!--Devices-->
            <li class="nav-item border-start my-0 pt-2">
                <a class="nav-link p-0 {{ $current == 'device' ? 'active' : '' }}" href="{{ route('device.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-desktop text-white fi-1"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dispositivos</span>
                </a>
            </li>

            <!--E-mails-->
            <li class="nav-item border-start my-0 pt-2">
                <a class="nav-link p-0 {{ $current == 'email' ? 'active' : '' }}" href="{{ route('email.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-envelope text-white fi-1"></i>
                    </div>
                    <span class="nav-link-text ms-1">E-mails</span>
                </a>
            </li>

            <!--Ramais-->
            <li class="nav-item border-start my-0 pt-2">
                <a class="nav-link p-0 {{ $current == 'extension' ? 'active' : '' }}"
                   href="{{ route('extension.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-phone fi-1"></i>
                    </div>
                    <span class="nav-link-text ms-1">Ramais</span>
                </a>
            </li>
            <!-------- END: Infraestrutura -------->

            <!-------- Operacional -------->
            <li class="nav-item mt-2">
                <div
                    class="d-flex align-items-center nav-link {{ in_array($current, ['tasks', 'tickets', 'bookings']) ? 'active' : '' }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-circle-notch fi-1"></i>
                    </div>
                    <span class="nav-link-text font-weight-bold ms-1">Operacional</span>
                </div>
            </li>

            <!--Tickets-->
            <li class="nav-item border-start my-0 pt-2">
                <a class="nav-link p-0 {{ $current == 'ticket' ? 'active' : '' }}" href="{{ route('ticket.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-clipboard-list fs-5 fi-1"></i>
                    </div>
                    <span class="nav-link-text ms-1">Chamados</span>
                </a>
            </li>

            <!--Tasks-->
            <li class="nav-item border-start my-0 pt-2">
                <a class="nav-link p-0 {{ $current == 'tasks' ? 'active' : '' }}"
                   href="{{ route('tasks.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-tasks fi-1"></i>
                    </div>
                    <span class="nav-link-text ms-1">Tarefas</span>
                </a>
            </li>

            <!--Bookings-->
            <li class="nav-item border-start my-0 pt-2">
                <a class="nav-link p-0 {{ $current == 'bookings' ? 'active' : '' }}"
                   href="{{ route('bookings.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-house-laptop fi-1"></i>
                    </div>
                    <span class="nav-link-text ms-1">Agendamento de Sala</span>
                </a>
            </li>
            <!-------- END: Operacional -------->

            <!-------- Controles -------->
            <li class="nav-item mt-2">
                <div
                    class="d-flex align-items-center nav-link {{ in_array($current, ['certificate', 'domain', 'maintenance', 'servicecontrol', 'device_control', 'chipcontrol', 'heritage_control', 'record_controls']) ? 'active' : '' }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-circle-notch fi-1"></i>
                    </div>
                    <span class="nav-link-text font-weight-bold ms-1">Controles</span>
                </div>
            </li>

            <!--Domains-->
            <li class="nav-item border-start my-0 pt-2">
                <a class="nav-link p-0 {{ $current == 'domain' ? 'active' : '' }}" href="{{ route('domain.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-globe text-white fi-1"></i>
                    </div>
                    <span class="nav-link-text ms-1">Domínios</span>
                </a>
            </li>

            <!--Certificates-->
            <li class="nav-item border-start my-0 pt-2">
                <a class="nav-link p-0 {{ $current == 'certificate' ? 'active' : '' }}"
                   href="{{ route('certificate.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-certificate text-white fi-1"></i>
                    </div>
                    <span class="nav-link-text ms-1">Certificados</span>
                </a>
            </li>

            <!--Maintenance-->
            <li class="nav-item border-start my-0 pt-2">
                <a class="nav-link p-0 {{ $current == 'maintenance' ? 'active' : '' }}"
                   href="{{ route('maintenance.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-screwdriver-wrench fi-1"></i>
                    </div>
                    <span class="nav-link-text ms-1">Manutenção</span>
                </a>
            </li>

            <!--ServiceControl-->
            <li class="nav-item border-start my-0 pt-2">
                <a class="nav-link p-0 {{ $current == 'servicecontrol' ? 'active' : '' }}"
                   href="{{ route('servicecontrol.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-tasks text-white fi-1"></i>
                    </div>
                    <span class="nav-link-text ms-1">Serviços</span>
                </a>
            </li>

            <!--DeviceControl-->
            <li class="nav-item border-start my-o pt-2">
                <a class="nav-link p-0 {{ $current == 'device_control' ? 'active' : '' }}"
                   href="{{ route('device_control.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-sliders-h text-white fi-1"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dispositivos</span>
                </a>
            </li>

            <!--ChipControl-->
            <li class="nav-item border-start my-o pt-2">
                <a class="nav-link p-0 {{ $current == 'chipcontrol' ? 'active' : '' }}"
                   href="{{ route('chipcontrol.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-microchip fi-1"></i>
                    </div>
                    <span class="nav-link-text ms-1">Chips</span>
                </a>
            </li>

            <!--HeritageControl-->
            <li class="nav-item border-start my-o pt-2">
                <a class="nav-link p-0 {{ $current == 'heritage_control' ? 'active' : '' }}"
                   href="{{ route('heritage_control.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-screwdriver-wrench fi-1"></i>
                    </div>
                    <span class="nav-link-text ms-1">Patrimônios</span>
                </a>
            </li>

            <!--RecordControl-->
            <li class="nav-item border-start my-o pt-2">
                <a class="nav-link p-0 {{ $current == 'record_controls' ? 'active' : '' }}"
                   href="{{ route('record_controls.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-file fi-1"></i>
                    </div>
                    <span class="nav-link-text ms-1">Documentos</span>
                </a>
            </li>
            <!-------- END: Controles -------->

            <!-------- Sistema -------->
            <li class="nav-item mt-2">
                <div
                    class="d-flex align-items-center nav-link {{ in_array($current, ['notifications', 'activity-log', 'roles', 'permissions']) ? 'active' : '' }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-circle-notch fi-1"></i>
                    </div>
                    <span class="nav-link-text font-weight-bold ms-1">Sistema</span>
                </div>
            </li>

            <li class="nav-item border-start my-0 pt-2">
                <a class="nav-link p-0 {{ $current == 'notifications' ? 'active' : '' }}"
                   href="{{ route('notifications.create') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-bell fi-1"></i>
                    </div>
                    <span class="nav-link-text ms-1">Notificações</span>
                </a>
            </li>

            <li class="nav-item border-start my-0 pt-2">
                <a class="nav-link p-0 {{ $current == 'roles' ? 'active' : '' }}" href="{{ route('roles.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-shield-halved fi-1"></i>
                    </div>
                    <span class="nav-link-text ms-1">Permissões</span>
                </a>
            </li>

            <li class="nav-item border-start my-0 pt-2">
                <a class="nav-link p-0 {{ $current == 'activity-log' ? 'active' : '' }}"
                   href="{{ route('activity-log.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fa-brands fa-slack fi-1"></i>
                    </div>
                    <span class="nav-link-text ms-1">Logs do sistema</span>
                </a>
            </li>
            <!-------- END: Sistema -------->
        </ul>
    </div>

    <hr class="pt-3">

    <div class="sidenav-footer pt-2 mx-4 ">
        <div class="card border-radius-md" id="sidenavCard">
            <div class="card-body  text-start  p-3 w-100">
                <div class="mb-3">
                    <i class="fa-solid fa-user-gear text-warning fs-5"></i>
                </div>
                <div class="">
                    <a href="{{ route('user.show', auth()->user()->id) }}"
                       class="font-weight-bold up mb-2 h6 icon-move-right mt-auto w-100">
                        Minha conta <i class="fas fa-arrow-right-long text-sm ms-1 text-warning"
                                       aria-hidden="true"></i>
                    </a>
                    <br><br>
                    <a href="{{ route('logout') }}"
                       class="font-weight-bold text-sm mb-0 icon-move-right pt-2 w-100 mb-0 text-info">
                        Deslogar
                    </a>
                </div>
            </div>
        </div>
    </div>
</aside>
