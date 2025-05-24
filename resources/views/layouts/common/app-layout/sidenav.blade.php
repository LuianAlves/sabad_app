@php
  $currentRoute = Route::currentRouteName();

  $current = explode('.', $currentRoute)[0];
@endphp

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 fixed-start bg-white" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand d-flex align-items-center m-0"
            href=" https://demos.creative-tim.com/corporate-ui-dashboard/pages/dashboard.html " target="_blank">
            <span class="font-weight-bold text-lg">Sistema Sabad</span>
        </a>
    </div>
    <div class="collapse navbar-collapse px-4  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link {{ $current == 'dashboard' ? 'active' : '' }}" href="{{ route('dashboard.index') }}">
                    <div class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-table-columns fs-5"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ $current == 'user' ? 'active' : '' }}" href="{{ route('user.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-users text-white fs-5"></i>
                    </div>
                    <span class="nav-link-text ms-1">Usuários</span>
                </a>
            </li>

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
                <a class="nav-link {{ $current == 'department' ? 'active' : '' }}" href="{{ route('department.index') }}">
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
                <a class="nav-link {{ $current == 'servicecontrol' ? 'active' : '' }}" href="{{ route('servicecontrol.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-tasks text-white fs-5"></i>
                    </div>
                    <span class="nav-link-text ms-1">Controle de Serviços</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ $current == 'certificate' ? 'active' : '' }}" href="{{ route('certificate.index') }}">
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

            <li class="nav-item">
                <a class="nav-link {{ $current == 'device_control' ? 'active' : '' }}" href="{{ route('device_control.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-sliders-h text-white fs-5"></i>
                    </div>
                    <span class="nav-link-text ms-1">Controle de Dispositivos</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ $current == 'ticket' ? 'active' : '' }}" href="{{ route('ticket.index') }}">
                    <div class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-sliders-h text-white fs-5"></i>
                    </div>
                    <span class="nav-link-text ms-1">Chamados</span>
                </a>
            </li>

            <li class="nav-item mt-2">
                <div class="d-flex align-items-center nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="ms-2"
                        viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd"
                            d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="font-weight-normal text-md ms-2">Configuração da conta</span>
                </div>
            </li>

            <li class="nav-item border-start my-0 pt-2">
                <a class="nav-link position-relative ms-0 ps-2 py-2 " href="../pages/profile.html">
                    <span class="nav-link-text ms-1">Minha conta</span>
                </a>
            </li>

            <li class="nav-item border-start my-0 pt-2">
                <a class="nav-link position-relative ms-0 ps-2 py-2 " href="{{ route('logout') }}">
                    <span class="nav-link-text ms-1">Deslogar</span>
                </a>
            </li>

        </ul>
    </div>

    <div class="sidenav-footer mx-4 ">
        <div class="card border-radius-md" id="sidenavCard">
            <div class="card-body  text-start  p-3 w-100">
                <div class="mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="text-primary"
                        viewBox="0 0 24 24" fill="currentColor" id="sidenavCardIcon">
                        <path
                            d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0016.5 9h-1.875a1.875 1.875 0 01-1.875-1.875V5.25A3.75 3.75 0 009 1.5H5.625z" />
                        <path
                            d="M12.971 1.816A5.23 5.23 0 0114.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 013.434 1.279 9.768 9.768 0 00-6.963-6.963z" />
                    </svg>
                </div>
                <div class="docs-info">
                    <h6 class="font-weight-bold up mb-2">Need help?</h6>
                    <p class="text-sm font-weight-normal">Please check our docs.</p>
                    <a href="https://www.creative-tim.com/learning-lab/bootstrap/license/corporate-ui-dashboard"
                        target="_blank" class="font-weight-bold text-sm mb-0 icon-move-right mt-auto w-100 mb-0">
                        Documentation
                        <i class="fas fa-arrow-right-long text-sm ms-1" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</aside>
