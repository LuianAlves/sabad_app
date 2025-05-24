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
    @include('layouts.common.config-button')

    <!-- Include:Scripts -->
    @include('layouts.common.scripts')
</body>

</html>
