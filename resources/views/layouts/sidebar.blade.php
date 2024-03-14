<div class="wrapper">

    <div id="sidebar" class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px; display: none;">
        <a class="d-flex align-items-center mb-3 link-body-emphasis text-decoration-none">
            <img class="fs-4" src="{{ asset('assets/img/sedeco.png') }}" alt="Logo" width="230"
                height="auto">
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            @if (Auth::user()->rol_id == 1)
                <li class="nav-item">
                    <a href="{{ url('/home') }}" class="nav-link  {{ 'home' == request()->path() ? 'active' : '' }}">
                        <i class="fas fa-user-tie"></i>
                        Inicio
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('Roles.index') }}"
                        class="nav-link {{ 'Administrador/Roles' == request()->path() ? 'active' : '' }}">
                        <i class="fas fa-user-tie"></i>
                        Roles
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('Empleados.index') }}"
                        class="nav-link {{ 'Administrador/Empleados' == request()->path() ? 'active' : '' }}">
                        <i class="fas fa-user-tie"></i>
                        Empleados
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('Usuarios.index') }}"
                        class="nav-link {{ 'Administrador/Usuarios' == request()->path() ? 'active' : '' }}">
                        <i class="fas fa-user"></i>
                        Usuarios
                    </a>
                </li>
            @endif
            @if (Auth::user()->rol_id == 2)
                <li class="nav-item">
                    <a href="{{ url('/home') }}" class="nav-link {{ 'home' == request()->path() ? 'active' : '' }}">
                        <i class="fas fa-home bi me-2 "></i>
                        Inicio
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('Inventario.index') }}"
                        class="nav-link {{ 'Almancen/Inventario' == request()->path() ? 'active' : '' }}">
                        <i class="fas fa-user"></i>
                        Inventario
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('Entradas.index') }}"
                        class="nav-link {{ 'Almancen/Entradas' == request()->path() ? 'active' : '' }}">
                        <i class="fas fa-user"></i>
                        Entradas
                    </a>
                </li>
                
            @endif
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle"
                data-bs-toggle="dropdown" aria-expanded="false">
                <strong>{{ Auth::user()->Empleados->nombre }}</strong>
            </a>
            <ul class="dropdown-menu text-small shadow">
                <li><a class="dropdown-item"
                        href="{{ route('Empleados.show', Auth::user()->Empleados->num_empleado) }}">Perfil</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                    {{ __('Cerrar Sesion') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </ul>
        </div>
    </div>
</div>
