@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h2 class="">Entradas</h2>
                </div>
                <div class="col g-col-6 d-flex justify-content-end">
                    <button type="button" class="btn btn-primary ml-auto BotonRojo" data-bs-toggle="modal"
                        data-bs-target="#modalagregarentrada">
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
                    <h3>Entradas realizadas</h3>
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
                                <th class="col-1 custom-th">ID</th>
                                <th class="col-2 custom-th">Folio</th>
                                <th class="col-3 custom-th">Proveedor</th>
                                <th class="col-2 custom-th">Solicitante</th>
                                <th class="col-2 custom-th">Fecha Entrada</th>
                                <th class="col-2 custom-th">Acciones</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Entradas as $Entrada)
                                <tr>
                                    <td class="custom-td">{{ $Entrada->id_entrada }}</td>
                                    <td class="custom-td">{{ $Entrada->folio}}</td>
                                    <td class="custom-td">{{ $Entrada->Proveedor->nombre }}</td>
                                    <td class="custom-td">{{ $Entrada->departamento_id }}</td>
                                    <td class="custom-td">{{ $Entrada->fehcaentrada }}</td>
                                    
                                    <td class="custom-td">
                                        <div class="btn-group" role="group">
                                            <a href="#" class="btn btn-info" data-bs-toggle="modal"
                                                data-bs-target="#verarticulomodal"
                                                onclick="mostrarDetalles('{{ json_encode($Entrada) }}')">
                                                <i class="fa fa-print"></i>
                                            </a>
                                            <a href="{{ route('Entradas.edit', $Entrada->id_entrada) }}" class="btn btn-primary"><i
                                                    class="fas fa-pencil-alt"></i></a>
                                            <form action="{{ route('Entradas.destroy', $Entrada->id_entrada) }}"
                                                id="delete_{{ $Entrada->id_entrada }}" method="POST">
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
            <!-- Modal de nuva entrada -->
            <div class="modal fade modal-lg" id="modalagregarentrada" tabindex="-1" aria-labelledby="agregarModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="agregarModalLabel">Nueva Entrada</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="createForm" action="{{ route('Entradas.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @include('Almacen.Entradas.formularios.form')

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
            <!-- Modal para ver detalles del articulo -->
            <div class="modal fade" id="verarticulomodal" tabindex="-1" aria-labelledby="verModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="verModalLabel">Detalles del articulo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <!-- Aquí se mostrarán los detalles del rol -->
                            <div class="row">
                                <div class="col-12">
                                    <label for="nombre_rol">descripcion:</label>
                                    <span id="descripcion_span"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="nombre_rol">Categoria:</label>
                                    <span id="categoria_span"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="nombre_rol">Ubicacion:</label>
                                    <span id="estante_span"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="nombre_rol">Medida:</label>
                                    <span id="medida_span"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="nombre_rol">Cantidad:</label>
                                    <span id="cantidad_span"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="nombre_rol">Existencia:</label>
                                    <span id="existencia_span"></span>
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
            @if ($Entradas->count() > 0)
                {{ $Entradas->links() }}
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
        function mostrarDetalles(articuloJson) {
            var Articulo = JSON.parse(articuloJson);
            document.getElementById('descripcion_span').innerText = Entrada.descripcion;
            document.getElementById('categoria_span').innerText = Entrada.categoria_id;
            document.getElementById('estante_span').innerText = Entrada.estante;
            document.getElementById('medida_span').innerText = Entrada.unidad_id;
            document.getElementById('cantidad_span').innerText = Entrada.cantidad;
            document.getElementById('existencia_span').innerText = Entrada.existencia;
        }
    </script>
@endsection
