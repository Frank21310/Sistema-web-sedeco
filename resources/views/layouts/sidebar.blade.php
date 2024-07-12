<div id="sidebar" class="d-flex flex-column flex-shrink-0 p-3 bg-light active">

    <ul class="nav nav-pills flex-column mb-auto">
        @if (Auth::user()->rol_id == 1)
            <li class="nav-item">
                <a href="{{ url('/home') }}" class="nav-link  {{ 'home' == request()->path() ? 'active' : '' }}">
                    <i class="fas fa-home bi me-2 "></i>
                    Inicio
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('Roles.index') }}"
                    class="nav-link {{ 'Administrador/Roles' == request()->path() ? 'active' : '' }}">
                    <i class="fi fi-ss-employee-man bi me-2 "></i>
                    Roles
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('Empleados.index') }}"
                    class="nav-link {{ 'Administrador/Empleados' == request()->path() ? 'active' : '' }}">
                    <i class="fi fi-ss-employees"></i>
                    Empleados
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('Usuarios.index') }}"
                    class="nav-link {{ 'Administrador/Usuarios' == request()->path() ? 'active' : '' }}">
                    <i class="fi fi-sr-user-gear"></i>
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
                    <i class="fi fi-rs-inventory-alt me-2 "></i>
                    Inventario
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('Entradas.index') }}"
                    class="nav-link {{ 'Almancen/Entradas' == request()->path() ? 'active' : '' }}">
                    <i class="fi fi-rr-add-document me-2 "></i>
                    Entradas
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('Salidas.index') }}"
                    class="nav-link {{ 'Almancen/Salidas' == request()->path() ? 'active' : '' }}">
                    <i class="fi fi-bs-sign-out-alt me-2 "></i>
                    Salidas
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('Vales.index') }}"
                    class="nav-link {{ 'Almancen/Vales' == request()->path() ? 'active' : '' }}">
                    <i class="fi fi-rs-receipt me-2 "></i>
                    Vales
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('solicitud.index') }}"
                    class="nav-link {{ 'Almancen/solicitud' == request()->path() ? 'active' : '' }}">
                    <i class="fi fi-rr-apps-add"></i>
                    Solicitudes
                </a>
            </li>
        @endif
        @if (Auth::user()->rol_id == 3)
            <li class="nav-item">
                <a href="{{ url('/home') }}" class="nav-link {{ 'home' == request()->path() ? 'active' : '' }}">
                    <i class="fas fa-home bi me-2 "></i>
                    Inicio
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('Solicitudes.index') }}"
                    class="nav-link {{ 'Peticiones/Solicitudes' == request()->path() ? 'active' : '' }}">
                    <i class="fi fi-rr-apps-add"></i>
                    Solicitudes
                </a>
            </li>
        @endif
        @if (Auth::user()->rol_id == 4)
            <li class="nav-item">
                <a href="{{ url('/home') }}" class="nav-link {{ 'home' == request()->path() ? 'active' : '' }}">
                    <i class="fas fa-home bi me-2 "></i>
                    Inicio
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('Vehiculos.index') }}"
                    class="nav-link {{ 'Peticiones/Solicitudes' == request()->path() ? 'active' : '' }}">
                    <i class="fi fi-rr-apps-add"></i>
                    Vehiculos
                </a>
            </li>
            <li class="nav-item">
                <a href=""
                    class="nav-link {{ 'Peticiones/Solicitudes' == request()->path() ? 'active' : '' }}">
                    <i class="fi fi-rr-apps-add"></i>
                    Salidas
                </a>
            </li>
            <li class="nav-item">
                <a href=""
                    class="nav-link {{ 'Peticiones/Solicitudes' == request()->path() ? 'active' : '' }}">
                    <i class="fi fi-rr-apps-add"></i>
                    Entradas
                </a>
            </li>
        @endif
    </ul>
</div>
