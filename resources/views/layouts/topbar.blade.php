<nav id="Topbar" class="navbar navbar-oax navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid justify-content-end">
        @guest
        @else
            <a class="navbar-brand text-black" class="nav-link" href="#" id="sidebarCollapse">
                <i class="fas fa-align-left"></i>
            </a>
            <!-- <img class="logo-nav" style="height: 40px" src="https://www.oaxaca.gob.mx/wp-content/themes/temaoax2023/images/logo-nav-principal.svg" alt="Logo Oaxaca">-->
        @endguest
            <div class="container-fluid">
                <ul class="nav justify-content-end">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link fw-bold text-white " aria-current="page" href="{{ route('login') }}">Iniciar
                                Sesión</a>
                        </li>
                        <li class="nav-item">

                            <a class="nav-link fw-bold text-white " aria-current="page"
                                href="{{ route('register') }}">Registrarse</a>
                        </li>
                    @else
                    @endguest
                    <ul class="navbar-nav ml-auto">
                        <ul class="navbar-nav ms-auto">
                            @guest
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                            </li>
                        </ul>
                    </ul>
                </ul>
            </div>
</nav>
