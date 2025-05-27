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
                        <div class="col-xl-4 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h3 class="font-weight-black text-dark display-6">Bem vindo</h3>
                                    <p class="mb-0">Bem vindo de volta! Acesso com suas credenciais.</p>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="row">
                                            <x-input col="12" set="" type="email" title="E-mail"
                                                id="email" name="email" value=""
                                                placeholder="john@email.com" disabled=""></x-input>
                                        </div>
                                        <div class="row">
                                            <x-input col="12" set="" type="password" title="Senha"
                                                id="password" name="password" value="" placeholder="*******"
                                                disabled=""></x-input>

                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-warning w-100 mt-4 mb-3">Acessar o sistema</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-xs mx-auto">
                                        Não tem uma conta?
                                        <a href="javascript:;" class="text-dark font-weight-bold">Cadastre-se</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-absolute w-40 top-0 end-0 h-100 d-md-block d-none">
                                <div class="oblique-image position-absolute fixed-top ms-auto h-100 z-index-0 bg-cover ms-n8"
                                    style="background-image:url('../img/image-sign-in.jpg')">
                                    <div
                                        class="blur mt-12 p-4 text-center border border-white border-radius-md position-absolute fixed-bottom m-4">
                                        <h2 class="mt-3 text-dark font-weight-bold">Sistema desenvolvimento pelo departamento de TI.</h2>
                                        <h6 class="text-dark text-sm mt-5">Copyright © 2025. Douglas Nordi & Luian Alves</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    
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
