<!DOCTYPE html>
<html lang="en">

<!-- Include:Head -->
@include('layouts.common.head')

<body class="">
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="position-absolute w-40 top-0 start-0 h-100 d-md-block d-none">
                                <div class="oblique-image position-absolute d-flex fixed-top ms-auto h-100 z-index-0 bg-cover me-n8"
                                    style="background-image:url('../img/image-sign-up.jpg')">
                                    <div class="my-auto text-start max-width-350 ms-7">
                                        <h1 class="mt-3 text-white font-weight-bolder">Start your <br> new journey.</h1>
                                        <p class="text-white text-lg mt-4 mb-4">Use these awesome forms to login or
                                            create new account in your project for free.</p>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-group d-flex">
                                                <a href="javascript:;" class="avatar avatar-sm rounded-circle"
                                                    data-bs-toggle="tooltip" data-original-title="Jessica Rowland">
                                                    <img alt="Image placeholder" src="../img/team-3.jpg" class="">
                                                </a>
                                                <a href="javascript:;" class="avatar avatar-sm rounded-circle"
                                                    data-bs-toggle="tooltip" data-original-title="Audrey Love">
                                                    <img alt="Image placeholder" src="../img/team-4.jpg"
                                                        class="rounded-circle">
                                                </a>
                                                <a href="javascript:;" class="avatar avatar-sm rounded-circle"
                                                    data-bs-toggle="tooltip" data-original-title="Michael Lewis">
                                                    <img alt="Image placeholder" src="../img/marie.jpg"
                                                        class="rounded-circle">
                                                </a>
                                                <a href="javascript:;" class="avatar avatar-sm rounded-circle"
                                                    data-bs-toggle="tooltip" data-original-title="Audrey Love">
                                                    <img alt="Image placeholder" src="../img/team-1.jpg"
                                                        class="rounded-circle">
                                                </a>
                                            </div>
                                            <p class="font-weight-bold text-white text-sm mb-0 ms-2">Join 2.5M+ users
                                            </p>
                                        </div>
                                    </div>
                                    <div class="text-start position-absolute fixed-bottom ms-7">
                                        <h6 class="text-white text-sm mb-5">Copyright © 2025. Douglas Nordi & Luian Alves</h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h3 class="font-weight-black text-dark display-6">Sign up</h3>
                                    <p class="mb-0">Nice to meet you! Please enter your details.</p>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf

                                        <div class="row">
                                            <x-input col="12" set="" type="text" title="Nome do usuário"
                                                id="name" name="name" value=""
                                                placeholder="John Doe" disabled=""></x-input>
                                        </div>
                                        <div class="row">
                                            <x-input col="12" set="" type="email" title="Endereço de email"
                                                id="email" name="email" value=""
                                                placeholder="john@email.com" disabled=""></x-input>
                                        </div>
                                        <div class="row">
                                            <x-input col="12" set="" type="password" title="Senha"
                                                id="password" name="password" value="" placeholder="*******"
                                                disabled=""></x-input>
                                                <div class="row">
                                            <x-input col="12" set="" type="password" title="Confirmar senha"
                                                id="password_confirmation" name="password_confirmation" value="" placeholder="*******"
                                                disabled=""></x-input>

                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-warning w-100 mt-4 mb-3">Acessar o
                                                sistema</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-xs mx-auto">
                                        Já possui uma conta criada?
                                        <a href="{{ url('/') }}" class="text-dark font-weight-bold">Acesse</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!--   Core JS Files   -->
    <script src="../js/core/popper.min.js"></script>
    <script src="../js/core/bootstrap.min.js"></script>
    <script src="../js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Corporate UI Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../js/corporate-ui-dashboard.min.js?v=1.0.0"></script>
</body>

</html>
