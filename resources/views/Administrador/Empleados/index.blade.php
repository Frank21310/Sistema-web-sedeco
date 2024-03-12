@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h2 class="">Empleados</h2>
                </div>
                <div class="col g-col-6 d-flex justify-content-end ">
                    <button type="button" class="btn btn-primary ml-auto BotonRojo" data-bs-toggle="modal"
                        data-bs-target="#modalagregarempleado">
                        <i class="fas fa-plus"></i>
                        Agregar
                    </button>
                </div>
            </div>
        </div>
        <hr>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h3>Lista de Empleados existentes</h3>
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
                                <th class="custom-th">N° Empleado</th>
                                <th class="custom-th">Nombre</th>
                                <th class="custom-th">Apellido Paterno</th>
                                <th class="custom-th">Apellido Materno</th>
                                <th class="custom-th">Cargo</th>
                                <th class="custom-th">Acciones</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Empleados as $Empleado)
                                <tr>
                                    <td class="custom-td">{{ $Empleado->num_empleado }}</td>
                                    <td class="custom-td">{{ $Empleado->nombre }}</td>
                                    <td class="custom-td">{{ $Empleado->apellido_paterno }}</td>
                                    <td class="custom-td">{{ $Empleado->apellido_materno }}</td>
                                    <td class="custom-td">{{ $Empleado->Cargos->nombre_cargo }}</td>
                                    <td class="custom-td">
                                        <div class="btn-group" role="group">
                                            <a href="#" class="btn btn-info" data-bs-toggle="modal"
                                                data-bs-target="#verempleadomodal"
                                                onclick="mostrarDetalles('{{ json_encode($Empleado) }}')">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <a href="{{ route('Empleados.edit', $Empleado->num_empleado) }}"
                                                class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>

                                            <form action="{{ route('Empleados.destroy', $Empleado->num_empleado) }}"
                                                id="delete_{{ $Empleado->num_empleado }}" method="POST">
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

        <div class="card-footer">
            @if ($Empleados->count() > 0)
                {{ $Empleados->links() }}
            @endif
        </div>
    </div>
    <!-- Modal para agregar un empleado -->
    <div class="modal fade" id="modalagregarempleado" tabindex="-1" aria-labelledby="agregarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarModalLabel">Agregar Empleado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="crearEmpleadoForm" action="{{ route('Empleados.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @include('Administrador.Empleados.formularios.vistaform')
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary"
                        onclick="document.getElementById('crearEmpleadoForm').submit()">Crear</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal para ver detalles del empleado -->
    <div class="modal fade" id="verempleadomodal" tabindex="-1" aria-labelledby="verEmpleadoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verEmpleadoModalLabel">Detalles del Empleado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Num. Empleado</label>
                            <span type="text" class="form-control custom-span" id="num_empleado_span"></span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Nombre </label>
                            <span type="text" class="form-control custom-span" id="nombre_span"></span>

                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Apellido Paterno</label>
                            <span type="text" class="form-control custom-span" id="apellido_paterno_span"></span>

                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Apellido Materno</label>
                            <span type="text" class="form-control custom-span" id="apellido_materno_span"></span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Cargo</label>
                            <span type="text" class="form-control custom-span" id="cargo_id_span"></span>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <Script type="text/javascript">
        $('#limit').on('change', function() {
            window.location.href = "{{ route('Empleados.index') }}?limit=" + $(this).val() + '&search=' + $(
                '#search').val()
        })

        $('#search').on('keyup', function(e) {
            if (e.keyCode == 13) {
                window.location.href = "{{ route('Empleados.index') }}?limit=" + $('#limit').val() + '&search=' +
                    $(this).val()
            }
        })
    </Script>
    <script>
        function mostrarDetalles(empleadoJson) {
            var empleado = JSON.parse(empleadoJson);
            document.getElementById('num_empleado_span').innerText = empleado.num_empleado;
            document.getElementById('nombre_span').innerText = empleado.nombre;
            document.getElementById('apellido_paterno_span').innerText = empleado.apellido_paterno;
            document.getElementById('apellido_materno_span').innerText = empleado.apellido_materno;
            document.getElementById('cargo_id_span').innerText = empleado.cargo_id;
        }
    </script>
@endsection
