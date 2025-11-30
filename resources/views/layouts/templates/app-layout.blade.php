<!DOCTYPE html>
<html lang="en">

<!-- Include:Head -->
@include('layouts.common.head')

<body class="g-sidenav-show  bg-gray-100">

@include('layouts.common.app-layout.sidenav')

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('layouts.common.app-layout.navbar')

    <div class="container-fluid py-4 px-5">

        @yield('content')

        @include('layouts.common.footer')
    </div>
</main>

<!-- Include:Scripts -->
@include('layouts.common.scripts')

</body>


</html>
