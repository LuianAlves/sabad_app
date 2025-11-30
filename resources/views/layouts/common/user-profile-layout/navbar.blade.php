<nav class="navbar navbar-expand-lg flex-wrap top-0 px-0 py-0">
    <div class="container py-2">
        <nav aria-label="breadcrumb">
            <div class="d-flex align-items-center">
                <span class="fs-2">
                    <span class="text-info">D</span>ry<span class="text-info">L</span>u
                </span>
            </div>

        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <ul class="navbar-nav ms-md-auto  justify-content-end">
                <li class="nav-item d-flex align-items-center ps-2">
                    <a href="javascript:;" class="nav-link text-white font-weight-bold px-0">
                        <li class="nav-item dropdown pe-2 d-flex align-items-center">
                            <div class="avatar avatar-sm position-relative">
                                @if (auth()->check() && auth()->user()->image)
                                    <img src="{{ 'data:image/png;base64,' . auth()->user()->image }}"
                                         alt="profile_image"
                                         class="w-100 border-radius-md">
                                @else
                                    <img src="{{ asset('img/profile/image_profile.webp') }}" class="avatar avatar-sm"
                                         alt="avatar"/>
                                @endif
                            </div>
                        </li>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <hr class="horizontal w-100 my-0 dark">
</nav>

<nav class="navbar bg-dark navbar-expand-lg flex-wrap top-0 px-0 py-0">
    <div class="container pb-3 pt-3">
        <ul class="navbar-nav d-none d-lg-flex">
            <li class="nav-item border-radius-sm px-3 py-3 me-2 bg-slate-800 d-flex align-items-center">
                <a href="{{ route('user.show', auth()->user()) }}" class="nav-link text-white p-0">
                    Ínicio
                </a>
            </li>

            @can('create tickets')
                <li class="nav-item border-radius-sm px-3 py-3 me-2 bg-slate-800 d-flex align-items-center">
                    <a href="{{ route('ticket.collaborator.index') }}" class="nav-link text-white p-0">
                        Abrir chamado
                    </a>
                </li>
            @endcan

            @can('view production_order')
                <li class="nav-item border-radius-sm px-3 py-3 me-2 bg-slate-800 d-flex align-items-center">
                    <a href="{{ route('manager.index') }}" class="nav-link text-white p-0">
                        Ordem de Produção
                    </a>
                </li>
            @endcan

            @can('view stock_order')
                <li class="nav-item border-radius-sm px-3 py-3 me-2 bg-slate-800 d-flex align-items-center">
                    <a href="{{ route('stock.index') }}" class="nav-link text-white p-0">
                        Fila de Separação
                    </a>
                </li>
            @endcan

            @can('view operator order_production')
                <li class="nav-item border-radius-sm px-3 py-3 me-2 bg-slate-800 d-flex align-items-center">
                    <a href="{{ route('operator.index') }}" class="nav-link text-white p-0">
                        Iniciar / Finalizar OFs
                    </a>
                </li>
            @endcan

        @can('view tv_index')
                <li class="nav-item border-radius-sm px-3 py-3 me-2 bg-slate-800 d-flex align-items-center">
                    <a href="{{ route('tv.index') }}" class="nav-link text-white p-0" target="_blank">
                        Visualizar OFs
                    </a>
                </li>
            @endcan
        </ul>

        <ul class="navbar-nav d-none d-lg-flex">
            <li class="nav-item border-radius-sm px-3 py-3 me-2  d-flex align-items-center text-end">
                <a href="{{ route('logout') }}" class="nav-link text-danger p-0">
                    Deslogar
                </a>
            </li>
        </ul>
    </div>
</nav>
