<!DOCTYPE html>
<html lang="en">

<!-- Include:Head -->
@include('layouts.common.head')

<body class="bg-gray-100">

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @php
        $currentRoute = currentRouteName();

        $route = $currentRoute['route'];
     @endphp

    @if($route !== 'tv.index')
        @include('layouts.common.user-profile-layout.navbar')
    @endif

    <div class="container-fluid py-4 px-5">
        @yield('content')
    </div>
</main>

<!-- Include:Scripts -->
@include('layouts.common.scripts')

</body>
</html>
