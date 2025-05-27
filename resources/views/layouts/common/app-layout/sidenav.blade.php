@php
    $currentRoute = Route::currentRouteName();

    $current = explode('.', $currentRoute)[0];
@endphp

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 fixed-start bg-white" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand d-flex align-items-center m-0"
            href=" https://demos.creative-tim.com/corporate-ui-dashboard/pages/dashboard.html " target="_blank">
            <span class="font-weight-bold text-lg">Sistema Sabad</span>
        </a>
    </div>
    <div class="collapse navbar-collapse px-4  w-auto " id="sidenav-collapse-main">
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

            @role('user')
                <li class="nav-item">
                    <a class="nav-link {{ $current == 'user' ? 'active' : '' }}" href="{{ route('user.index') }}">
                        <div
                            class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <i class="fas fa-users text-white fs-5"></i>
                        </div>
                        <span class="nav-link-text ms-1">Usuários</span>
                    </a>
                </li>
            @endrole

            <li class="nav-item">
                <a class="nav-link {{ $current == 'company' ? 'active' : '' }}" href="{{ route('company.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-building text-white fs-5"></i>
                    </div>
                    <span class="nav-link-text ms-1">Empresas</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ $current == 'domain' ? 'active' : '' }}" href="{{ route('domain.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-globe text-white fs-5"></i>
                    </div>
                    <span class="nav-link-text ms-1">Domínios</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ $current == 'department' ? 'active' : '' }}"
                    href="{{ route('department.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-sitemap text-white fs-5"></i>
                    </div>
                    <span class="nav-link-text ms-1">Departamentos</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ $current == 'employee' ? 'active' : '' }}" href="{{ route('employee.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-id-badge text-white fs-5"></i>
                    </div>
                    <span class="nav-link-text ms-1">Funcionários</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ $current == 'service' ? 'active' : '' }}" href="{{ route('service.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-concierge-bell text-white fs-5"></i>
                    </div>
                    <span class="nav-link-text ms-1">Serviços</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ $current == 'email' ? 'active' : '' }}" href="{{ route('email.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-envelope text-white fs-5"></i>
                    </div>
                    <span class="nav-link-text ms-1">E-mails</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ $current == 'servicecontrol' ? 'active' : '' }}"
                    href="{{ route('servicecontrol.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-tasks text-white fs-5"></i>
                    </div>
                    <span class="nav-link-text ms-1">Contr. de serviços</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ $current == 'certificate' ? 'active' : '' }}"
                    href="{{ route('certificate.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-certificate text-white fs-5"></i>
                    </div>
                    <span class="nav-link-text ms-1">Certificados</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ $current == 'device' ? 'active' : '' }}" href="{{ route('device.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-desktop text-white fs-5"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dispositivos</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ $current == 'license' ? 'active' : '' }}" href="{{ route('license.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-key text-white fs-5"></i>
                    </div>
                    <span class="nav-link-text ms-1">Licenças</span>
                </a>
            </li>

            @can('view device control')
                <li class="nav-item">
                    <a class="nav-link {{ $current == 'device_control' ? 'active' : '' }}"
                        href="{{ route('device_control.index') }}">
                        <div
                            class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <i class="fas fa-sliders-h text-white fs-5"></i>
                        </div>
                        <span class="nav-link-text ms-1">Contr. de dispositivos</span>
                    </a>
                </li>
            @endcan

            

            <li class="nav-item">
                <a class="nav-link {{ $current == 'ticket' ? 'active' : '' }}" href="{{ route('ticket.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-clipboard-list fs-5"></i>
                    </div>
                    <span class="nav-link-text ms-1">Chamados</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ $current == 'activity-log' ? 'active' : '' }}"
                    href="{{ route('activity-log.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fa-brands fa-slack fs-5"></i>
                    </div>
                    <span class="nav-link-text ms-1">Logs do sistema</span>
                </a>
            </li>
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
                    <a href="{{ route('logout') }}" target="_blank"
                        class="font-weight-bold text-sm mb-0 icon-move-right pt-2 w-100 mb-0 text-danger opacity-7">
                        Deslogar
                    </a>
                </div>
            </div>
        </div>
    </div>
</aside>
