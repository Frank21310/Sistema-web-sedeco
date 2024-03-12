@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h2 class="">Articulos</h2>
                </div>
                <div class="col g-col-6 d-flex justify-content-end">
                    <button type="button" class="btn btn-primary ml-auto BotonRojo" data-bs-toggle="modal"
                        data-bs-target="#modalagregarrol">
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
                    <h3>Lista de Articulos existentes</h3>
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
                                <th class="custom-th">ID</th>
                                <th class="custom-th">Descripción</th>
                                <th class="col-2 custom-th">Categoria</th>
                                <th class="col-2 custom-th">Estante</th>
                                <th class="col-2 custom-th">Unidad de Medida</th>
                                <th class="col-2 custom-th">Cantidad</th>
                                <th class="col-2 custom-th">Existencia</th>
                                <th class="col-2 custom-th">Fecha Elaboracion</th>
                                <th class="col-2 custom-th">Acciones</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Articulos as $Articulo)
                                <tr>
                                    <td class="custom-td">{{ $Articulo->id_articulo }}</td>
                                    <td class="custom-td">{{ $Articulo->descripcion }}</td>
                                    <td class="custom-td">{{ $Articulo->categoria_id }}</td>
                                    <td class="custom-td">{{ $Articulo->estante }}</td>
                                    <td class="custom-td">{{ $Articulo->unidad_id }}</td>
                                    <td class="custom-td">{{ $Articulo->cantidad }}</td>
                                    <td class="custom-td">{{ $Articulo->existencia }}</td>
                                    <td class="custom-td">{{ $Articulo->fecha_elaboracion }}</td>
                                    
                                    <td class="custom-td">
                                        <div class="btn-group" role="group">
                                            <a href="#" class="btn btn-info" data-bs-toggle="modal"
                                                data-bs-target="#verrolmodal"
                                                onclick="mostrarDetalles('{{ $Articulo->nombre_rol }}')">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('Inventario.edit', $Articulo->id_articulo) }}" class="btn btn-primary"><i
                                                    class="fas fa-pencil-alt"></i></a>
                                            <form action="{{ route('Inventario.destroy', $Articulo->id_articulo) }}"
                                                id="delete_{{ $Articulo->id_articulo }}" method="POST">
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
            <!-- Modal de nuevo rol -->
            <div class="modal fade" id="modalagregarrol" tabindex="-1" aria-labelledby="agregarModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="agregarModalLabel">Agregar Nuevo Rol</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="createForm" action="{{ route('Inventario.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @include('Almacen.Inventario.formularios.form')
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary"
                                onclick="document.getElementById('createForm').submit()">Crear</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal para ver detalles del rol -->
            <div class="modal fade" id="verrolmodal" tabindex="-1" aria-labelledby="verModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="verModalLabel">Detalles del Rol</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <!-- Aquí se mostrarán los detalles del rol -->
                            <div class="row">
                                <div class="col-12">
                                    <label for="nombre_rol">Nombre del Rol:</label>
                                    <span id="nombre_rol_span"></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            @if ($Articulos->count() > 0)
                {{ $Articulos->links() }}
            @endif
        </div>
    </div>

    <Script type="text/javascript">
        $('#limit').on('change', function() {
            window.location.href = "{{ route('Inventario.index') }}?limit=" + $(this).val() + '&search=' + $('#search')
                .val()
        })

        $('#search').on('keyup', function(e) {
            if (e.keyCode == 13) {
                window.location.href = "{{ route('Inventario.index') }}?limit=" + $('#limit').val() + '&search=' + $(
                    this).val()
            }
        })
    </Script>
    <script>
        function mostrarDetalles(nombreRol, permisos) {
          document.getElementById('nombre_rol_span').innerText = nombreRol;
          document.getElementById('permisos_span').innerText = permisos;
        }
      </script>
@endsection
