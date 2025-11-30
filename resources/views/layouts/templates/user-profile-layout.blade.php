<!DOCTYPE html>
<html lang="en">

@include('layouts.common.head')

<body class="g-sidenav-show bg-gray-100">
<div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
    @include('layouts.common.user-profile-layout.navbar')

    @yield('content-user-layout')
</div>

@include('layouts.common.config-button')

@include('layouts.common.scripts')

@php
    use App\Models\Business\Production\ProductionOrder;
    use Carbon\Carbon;

    $lastUpdate = ProductionOrder::max('updated_at');
    $lastUpdateTs = $lastUpdate ? Carbon::parse($lastUpdate)->timestamp : 0;
@endphp

<script>
    (function () {
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
