@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h2 class="">Usuarios</h2>
                </div>
                <div class="col g-col-6 d-flex justify-content-end ">
                    <a id="BtnAgregar" href="#" class="btn btn-primary ml-auto BotonRojo" data-bs-toggle="modal"
                        data-bs-target="#agregarUsuarioModal">
                        <i class="fas fa-plus"></i>
                        Agregar
                    </a>
                </div>
            </div>
        </div>
        <hr>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h3>Lista de Usuarios existentes</h3>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col-2">
                            <a class="navbar-brand">Listar</a>
                        </div>
                        <div class="col-3">
                            <select name="limit" id="limit" class="form-control custom-select">
                                @foreach ([5, 10, 15, 20] as $limit)
                                    <option value="{{ $limit }}"
                                        @if (@isset($_GET['limit'])) {{ $_GET['limit'] == $limit ? 'selected' : '' }} @endif>
                                        {{ $limit }}
                                    </option>
                                @endforeach
                            </select>
                            <?php
                            if (isset($_GET['page'])) {
                                $pag = $_GET['page'];
                            } else {
                                $pag = 1;
                            }
                            if (isset($_GET['limit'])) {
                                $limit = $_GET['limit'];
                            } else {
                                $limit = 10;
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="row">
                        <div class="col-2">
                            <a class="navbar-brand">Buscar</a>
                        </div>
                        <div class="col-10">
                            <input class="form-control custom-input" type="search" id="search" placeholder="Search"
                                aria-label="Search" value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}">
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="table-responsive">
                <div class="table table-striped">
                    <table class="table custom-table">
                        <thead class="custom-thead">
                            <tr>
                                <th class="custom-th">Num. Empleado</th>
                                <th class="custom-th">Email</th>
                                <th class="custom-th">Rol</th>
                                <th class="col-2 custom-th">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Users as $User)
                                <tr>
                                    <td class="custom-td">{{ $User->empleado_num }}</td>
                                    <td class="custom-td">{{ $User->email }}</td>
                                    <td class="custom-td">{{ $User->Roles->nombre_rol }}</td>
                                    <td class="custom-td">
                                        <div class="btn-group" role="group">
                                            <a href="#" class="btn btn-info" data-bs-toggle="modal"
                                                data-bs-target="#verUsuarioModal"
                                                onclick="mostrarDetalles('{{ json_encode($User) }}')">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('Usuarios.edit', $User->id) }}" class="btn btn-primary"><i
                                                    class="fas fa-pencil-alt"></i></a>
                                            <form action="{{ route('Usuarios.destroy', $User->id) }}"
                                                id="delete_{{ $User->id }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('¿Estás seguro de eliminar el registro?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal para agregar usuario -->
        <div class="modal fade" id="agregarUsuarioModal" tabindex="-1" aria-labelledby="agregarUsuarioModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="agregarUsuarioModalLabel">Agregar Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Aquí se incluye el formulario de creación -->
                        <form action="{{ route('Usuarios.store') }}" method="POST" enctype="multipart/form-data"
                            id="create">
                            @csrf
                            @include('Administrador.Usuarios.formularios.form')
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary"
                            onclick="document.getElementById('create').submit()">Crear</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal para mostrar detalles del usuario -->
        <div class="modal fade" id="verUsuarioModal" tabindex="-1" aria-labelledby="verUsuarioModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="verUsuarioModalLabel">Detalles del Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row mb-3">
                            <label for="empleado_num"
                                class="col-md-4 col-form-label text-md-end">{{ __('Empleado') }}</label>
                            <div class="col-md-6">
                                <span id="empleado_num_span" class="form-control custom-span">
                                </span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="id_rol" class="col-md-4 col-form-label text-md-end">{{ __('Rol') }}</label>
                            <div class="col-md-6">
                                <span  class="form-control custom-span" id="rol_id_span">
                                </span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo') }}</label>
                            <div class="col-md-6">
                                <span id="email_span" class="form-control custom-span" >
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            @if ($Users->count() > 0)
                {{ $Users->links() }}
            @endif
        </div>
    </div>

    <Script type="text/javascript">
        $('#limit').on('change', function() {
            window.location.href = "{{ route('Usuarios.index') }}?limit=" + $(this).val() + '&search=' + $(
                '#search').val()
        })

        $('#search').on('keyup', function(e) {
            if (e.keyCode == 13) {
                window.location.href = "{{ route('Usuarios.index') }}?limit=" + $('#limit').val() +
                    '&search=' +
                    $(this).val()
            }
        })
    </Script>

    <script>
        function mostrarDetalles(userJson) {
            var user = JSON.parse(userJson);
            document.getElementById('empleado_num_span').innerText = user.empleado_num;
            document.getElementById('email_span').innerText = user.email;
            document.getElementById('rol_id_span').innerText = user.rol_id;

        }
    </script>
@endsection
