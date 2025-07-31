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
            @canany(['view companies', 'view users', 'view unions', 'view departments', 'view employees'])
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between"
                       data-bs-toggle="collapse"
                       href="#collapseEntidades"
                       role="button"
                       aria-expanded="false"
                       aria-controls="collapseEntidades">
                        <div class="d-flex align-items-center">
                            <div
                                class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-circle-notch fi-1"></i>
                            </div>
                            <span class="nav-link-text font-weight-bold ms-1">Entidades</span>
                        </div>
                    </a>

                    <div class="collapse show ps-4" id="collapseEntidades">
                        @can('view users')
                            <a class="nav-link p-0 mt-2 {{ $current == 'user' ? 'active' : '' }}"
                               href="{{ route('user.index') }}">
                                <i class="fas fa-users  text-white"></i> Usuários
                            </a>
                        @endcan

                        @can('view unions')
                            <a class="nav-link p-0 mt-2 {{ $current == 'union' ? 'active' : '' }}"
                               href="{{ route('union.index') }}">
                                <i class="fa-solid fa-scale-balanced  text-white"></i> Sindicatos
                            </a>
                        @endcan

                        @can('view companies')
                            <a class="nav-link p-0 mt-2 {{ $current == 'company' ? 'active' : '' }}"
                               href="{{ route('company.index') }}">
                                <i class="fas fa-building  text-white"></i> Empresas
                            </a>
                        @endcan

                        @can('view departments')
                            <a class="nav-link p-0 mt-2 {{ $current == 'department' ? 'active' : '' }}"
                               href="{{ route('department.index') }}">
                                <i class="fas fa-sitemap  text-white"></i> Departamentos
                            </a>
                        @endcan

                        @can('view employees')
                            <a class="nav-link p-0 mt-2 {{ $current == 'employee' ? 'active' : '' }}"
                               href="{{ route('employee.index') }}">
                                <i class="fas fa-id-badge  text-white"></i> Funcionários
                            </a>
                        @endcan
                    </div>
                </li>
            @endcanany
            <!-------- END: Entidades -------->

            <!-------- Infraestrutura -------->
            @canany(['view rooms', 'view heritages', 'view services', 'view devices', 'view licenses', 'view emails', 'view extensions'])
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between"
                       data-bs-toggle="collapse"
                       href="#collapseInfra"
                       role="button"
                       aria-expanded="false"
                       aria-controls="collapseInfra">
                        <div class="d-flex align-items-center">
                            <div
                                class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-circle-notch fi-1"></i>
                            </div>
                            <span class="nav-link-text font-weight-bold ms-1">Infraestrutura</span>
                        </div>

                    </a>

                    <div class="collapse ps-4" id="collapseInfra">
                        @can('view rooms')
                            <a class="nav-link p-0 mt-2 {{ $current == 'room' ? 'active' : '' }}"
                               href="{{ route('room.index') }}">
                                <i class="fa-solid fa-house me-2 text-white"></i> Salas
                            </a>
                        @endcan

                        @can('view heritages')
                            <a class="nav-link p-0 mt-2 {{ $current == 'heritage' ? 'active' : '' }}"
                               href="{{ route('heritage.index') }}">
                                <i class="fa-solid fa-industry me-2 text-white"></i> Patrimônios
                            </a>
                        @endcan

                        @can('view services')
                            <a class="nav-link p-0 mt-2 {{ $current == 'service' ? 'active' : '' }}"
                               href="{{ route('service.index') }}">
                                <i class="fas fa-concierge-bell me-2 text-white"></i> Serviços
                            </a>
                        @endcan

                        @can('view licenses')
                            <a class="nav-link p-0 mt-2 {{ $current == 'license' ? 'active' : '' }}"
                               href="{{ route('license.index') }}">
                                <i class="fas fa-key me-2 text-white"></i> Licenças
                            </a>
                        @endcan

                        @can('view devices')
                            <a class="nav-link p-0 mt-2 {{ $current == 'device' ? 'active' : '' }}"
                               href="{{ route('device.index') }}">
                                <i class="fas fa-desktop me-2 text-white"></i> Dispositivos
                            </a>
                        @endcan

                        @can('view emails')
                            <a class="nav-link p-0 mt-2 {{ $current == 'email' ? 'active' : '' }}"
                               href="{{ route('email.index') }}">
                                <i class="fas fa-envelope me-2 text-white"></i> E-mails
                            </a>
                        @endcan

                        @can('view extensions')
                            <a class="nav-link p-0 mt-2 {{ $current == 'extension' ? 'active' : '' }}"
                               href="{{ route('extension.index') }}">
                                <i class="fa-solid fa-phone me-2 text-white"></i> Ramais
                            </a>
                        @endcan
                    </div>
                </li>
            @endcanany
            <!-------- END: Infraestrutura -------->

            <!-------- Operacional -------->
            @canany(['view tickets', 'view tasks', 'view booking'])
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between"
                       data-bs-toggle="collapse"
                       href="#collapseOperacional"
                       role="button"
                       aria-expanded="false"
                       aria-controls="collapseOperacional">
                        <div class="d-flex align-items-center">
                            <div
                                class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-circle-notch fi-1"></i>
                            </div>
                            <span class="nav-link-text font-weight-bold ms-1">Operacional</span>
                        </div>

                    </a>

                    <div class="collapse show ps-4" id="collapseOperacional">
                        @can('view tickets')
                            <a class="nav-link p-0 mt-2 {{ $current == 'ticket' ? 'active' : '' }}"
                               href="{{ route('ticket.index') }}">
                                <i class="fa-solid fa-clipboard-list me-2 text-white"></i> Chamados
                            </a>
                        @endcan
                        @can('view tasks')
                            <a class="nav-link p-0 mt-2 {{ $current == 'tasks' ? 'active' : '' }}"
                               href="{{ route('tasks.index') }}">
                                <i class="fa-solid fa-tasks me-2 text-white"></i> Tarefas
                            </a>
                        @endcan
                        @can('view booking')
                            <a class="nav-link p-0 mt-2 {{ $current == 'bookings' ? 'active' : '' }}"
                               href="{{ route('bookings.index') }}">
                                <i class="fa-solid fa-house-laptop me-2 text-white"></i> Agendamento de Sala
                            </a>
                        @endcan
                    </div>
                </li>
            @endcanany
            <!-------- END: Operacional -------->

            <!-------- Controles -------->
            @canany(['view certificates', 'view domains', 'view maintenances', 'view service_control', 'view device_control', 'view chip_control', 'view heritage_control', 'view record_controls'])
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between"
                       data-bs-toggle="collapse"
                       href="#collapseControles"
                       role="button"
                       aria-expanded="false"
                       aria-controls="collapseControles">
                        <div class="d-flex align-items-center">
                            <div
                                class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-circle-notch fi-1"></i>
                            </div>
                            <span class="nav-link-text font-weight-bold ms-1">Controles</span>
                        </div>

                    </a>

                    <div class="collapse ps-4" id="collapseControles">
                        @can('view domains')
                            <a class="nav-link p-0 mt-2 {{ $current == 'domain' ? 'active' : '' }}"
                               href="{{ route('domain.index') }}">
                                <i class="fas fa-globe me-2 text-white"></i> Domínios
                            </a>
                        @endcan
                        @can('view certificates')
                            <a class="nav-link p-0 mt-2 {{ $current == 'certificate' ? 'active' : '' }}"
                               href="{{ route('certificate.index') }}">
                                <i class="fas fa-certificate me-2 text-white"></i> Certificados
                            </a>
                        @endcan
                        @can('view maintenances')
                            <a class="nav-link p-0 mt-2 {{ $current == 'maintenance' ? 'active' : '' }}"
                               href="{{ route('maintenance.index') }}">
                                <i class="fa-solid fa-screwdriver-wrench me-2 text-white"></i> Manutenção
                            </a>
                        @endcan
                        @can('view service_control')
                            <a class="nav-link p-0 mt-2 {{ $current == 'service_control' ? 'active' : '' }}"
                               href="{{ route('service_controls.index') }}">
                                <i class="fas fa-tasks me-2 text-white"></i> Serviços
                            </a>
                        @endcan
                        @can('view device_control')
                            <a class="nav-link p-0 mt-2 {{ $current == 'device_control' ? 'active' : '' }}"
                               href="{{ route('device_control.index') }}">
                                <i class="fas fa-sliders-h me-2 text-white"></i> Dispositivos
                            </a>
                        @endcan
                        @can('view chip_control')
                            <a class="nav-link p-0 mt-2 {{ $current == 'chip_control' ? 'active' : '' }}"
                               href="{{ route('chip_controls.index') }}">
                                <i class="fa-solid fa-microchip me-2 text-white"></i> Chips
                            </a>
                        @endcan
                        @can('view heritage_control')
                            <a class="nav-link p-0 mt-2 {{ $current == 'heritage_control' ? 'active' : '' }}"
                               href="{{ route('heritage_control.index') }}">
                                <i class="fa-solid fa-screwdriver-wrench me-2 text-white"></i> Patrimônios
                            </a>
                        @endcan
                        @can('view record_controls')
                            <a class="nav-link p-0 mt-2 {{ $current == 'record_controls' ? 'active' : '' }}"
                               href="{{ route('record_controls.index') }}">
                                <i class="fa-solid fa-file me-2 text-white"></i> Documentos
                            </a>
                        @endcan
                    </div>
                </li>
            @endcanany
            <!-------- END: Controles -------->

            <!-------- Sistema -------->
            @canany(['view notifications', 'view activity-log', 'view roles', 'view permissions'])
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between"
                       data-bs-toggle="collapse"
                       href="#collapseSistema"
                       role="button"
                       aria-expanded="false"
                       aria-controls="collapseSistema">
                        <div class="d-flex align-items-center">
                            <div
                                class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-circle-notch fi-1"></i>
                            </div>
                            <span class="nav-link-text font-weight-bold ms-1">Sistema</span>
                        </div>

                    </a>

                    <div class="collapse ps-4" id="collapseSistema">
                        @can('view notifications')
                            <a class="nav-link p-0 mt-2 {{ $current == 'notifications' ? 'active' : '' }}"
                               href="{{ route('notifications.create') }}">
                                <i class="fa-solid fa-bell me-2 text-white"></i> Notificações
                            </a>
                        @endcan
                        @can('view roles')
                            <a class="nav-link p-0 mt-2 {{ $current == 'roles' ? 'active' : '' }}"
                               href="{{ route('roles.index') }}">
                                <i class="fa-solid fa-shield-halved me-2 text-white"></i> Permissões
                            </a>
                        @endcan
                        @can('view activity-log')
                            <a class="nav-link p-0 mt-2 {{ $current == 'activity-log' ? 'active' : '' }}"
                               href="{{ route('activity-log.index') }}">
                                <i class="fa-brands fa-slack me-2 text-white"></i> Logs do sistema
                            </a>
                        @endcan
                    </div>
                </li>
            @endcanany
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


<style>
    .active {
        background: rgba(219, 231, 255, 0) !important;
        color: #78B6E7 !important;
    }

    .nav-link i {
        font-size: 12px !important;
        color: #d2d2d2 !important;
    }

    .nav-link .active i {
        color: #78B6E7 !important;
    }


</style>
