<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bienvenido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <script src="{{ asset('assets/js/app.jss') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/sass/app.scss') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>

<body>
    <!--Topbar -->
        @include('layouts.topbar')
    <!-- End of Topbar -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-lg my-5">
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col p-3">
                                <div class="text-center">
                                    <img src="{{ asset('assets/img/sedeco.png') }}" alt="Logo" width="400"
                                        height="auto" class="mb-5 ">
                                </div>
                            </div>
                            <div class="p-2">
                                <div class="text-center">
                                    <h1 class="h3 mb-3 fw-bold ">Bienvenido</h1>

                                </div>
                                <form class="py-5">
                                    @auth
                                        <div class="d-grid gap-2 col-6 mx-auto">
                                            <a href="{{ url('/home') }}" class="btn btn-outline-dark fw-bold BotonRojo"
                                                role="button" aria-disabled="true">Inicio</a>
                                            <br>
                                        </div>
                                    @else
                                        <div class="d-grid gap-4 col-6 mx-auto">
                                            <a href="{{ route('login') }}" class="btn btn-outline-dark fw-bold BotonRojo"
                                                role="button" aria-disabled="true">Iniciar
                                                Sesión</a>
                                            <a href="{{ route('register') }}" class="btn btn-outline-dark fw-bold BotonRojo"
                                                tabindex="-1" role="button" aria-disabled="true" hidden>Registrarse</a>
                                        </div>
                                    @endauth
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
