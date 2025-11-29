<!DOCTYPE html>
<html lang="en">

{{--@role('admin')--}}
<!DOCTYPE html>
<html lang="en">


<!-- Include:Head -->
@include('layouts.common.head')

<body class="g-sidenav-show  bg-gray-100">
<!-- Include:Sidenav -->
@include('layouts.common.app-layout.sidenav')

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Include:Navbar -->
    @include('layouts.common.app-layout.navbar')


    <div class="container-fluid py-4 px-5">

        @yield('content')

        <!-- Include:Footer -->
        @include('layouts.common.footer')
    </div>
</main>

<!-- Include:Config Button -->
{{-- @include('layouts.common.config-button') --}}

<!-- Include:Scripts -->
@include('layouts.common.scripts')

{{-- Pusher CDN --}}
@php
    use App\Models\Business\Production\ProductionOrder;
    use Carbon\Carbon;

    $lastUpdate = ProductionOrder::max('updated_at');
    $lastUpdateTs = $lastUpdate ? Carbon::parse($lastUpdate)->timestamp : 0;
@endphp

<script>
    (function () {
        // SE ESTIVER NA ROTA /tv, NÃO USA ESSE AUTO-RELOAD
        const path = window.location.pathname;
        if (path === '/tv') {
            // a TV já se atualiza via AJAX na própria view (refreshTv),
            // então não precisamos recarregar a página aqui.
            return;
        }

        // timestamp da última alteração no momento em que a página foi carregada
        let last = {{ $lastUpdateTs }};

        // a cada 5 segundos, pergunta pro servidor se mudou algo
        setInterval(function () {
            fetch("{{ route('production.ping') }}")
                .then(response => response.json())
                .then(data => {
                    if (data.last > last) {
                        // teve mudança em alguma OF: recarrega a tela
                        window.location.reload();
                    }
                })
                .catch(() => {
                    // se der erro na requisição, simplesmente ignora
                });
        }, 5000); // 5000 ms = 5 segundos (ajusta se quiser mais rápido/lento)
    })();
</script>


</body>


</html>
