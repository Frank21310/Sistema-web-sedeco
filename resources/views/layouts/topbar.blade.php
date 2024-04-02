<nav id="Topbar" class="navbar navbar-oax navbar-expand-lg bg-body-tertiary">
    <div class=" container-fluid">
        @guest
        @else
            <div>
                <a class="navbar-brand " class="nav-link" href="#" id="sidebarCollapse">
                    <i class="fas fa-align-left"></i>
                </a>
                <a class="navbar-brand">
                    <img src="{{ asset('assets/img/sedeco.png') }}" alt="img" width="260" height="auto">
                </a>
            </div>
        @endguest

        @guest
        @else
           
            <a id="navbarDropdown" class="nav-link " href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fi fi-bs-angle-down"></i>
                <strong>{{ Auth::user()->Empleados->nombre }} {{ Auth::user()->Empleados->apellido_paterno }}</strong>

            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="">
                    {{ __('Perfil') }}
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>

            @endguest
    </div>

</nav>
