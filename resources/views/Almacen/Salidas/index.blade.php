@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h2 class="">Salidas</h2>
                </div>
                <div class="col g-col-6 d-flex justify-content-end">
                    <button type="button" class="btn btn-primary ml-auto BotonRojo" data-bs-toggle="modal"
                        data-bs-target="#modalagregarentrada">
                        <i class="fas fa-plus"></i>
                        Agregar
                    </button>
                </div>
            </div>
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
        </div>
        <hr>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h3>Salidas realizadas</h3>
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
                                <th class="col-2 custom-th">Folio Salida</th>
                                <th class="col-2 custom-th">Folio Entrada</th>
                                <th class="col-3 custom-th">Entrega</th>
                                <th class="col-2 custom-th">Fecha Salida</th>
                                <th class="col-2 custom-th">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Salidas as $Salida)
                                <tr>
                                    <td class="custom-td">{{ $Salida->id_salida }}</td>
                                    <td class="custom-td">{{ $Salida->entrada_id }}</td>
                                    <td class="custom-td">{{ optional($Salida->Empleado)->nombre?? 'Sin empleado' }}</td>
                                    <td class="custom-td">{{ $Salida->fechasalida }}</td>
                                    <td class="custom-td">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('generarsalida.pdf', $Salida->id_salida) }}" class="btn btn-info">
                                                <i class="fa fa-print"></i>
                                            </a>
                                            <a href="{{ route('Salidas.edit', $Salida->id_salida) }}"
                                                class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                            <form action="{{ route('Salidas.destroy', $Salida->id_salida) }}"
                                                id="delete_{{ $Salida->id_salida }}" method="POST">
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
                            <h5 class="modal-title" id="agregarModalLabel">Nueva Salida</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="createForm" action="{{ route('Salidas.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @include('Almacen.Salidas.formularios.form')
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary"
                                onclick="document.getElementById('createForm').submit()">Generar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            @if ($Salidas->count() > 0)
                {{ $Salidas->links() }}
            @endif
        </div>
    </div>

    <Script type="text/javascript">
        $('#limit').on('change', function() {
            window.location.href = "{{ route('Salidas.index') }}?limit=" + $(this).val() + '&search=' + $(
                    '#search')
                .val()
        })

        $('#search').on('keyup', function(e) {
            if (e.keyCode == 13) {
                window.location.href = "{{ route('Salidas.index') }}?limit=" + $('#limit').val() + '&search=' + $(
                    this).val()
            }
        })
    </Script>
@endsection
