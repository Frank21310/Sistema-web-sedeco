@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h2 class="">Vehiculos</h2>
                </div>
                <div class="col g-col-6 d-flex justify-content-end">
                    <button type="button" class="btn btn-primary ml-auto BotonRojo" data-bs-toggle="modal"
                        data-bs-target="#modalnuevovehiculo">
                        <i class="fas fa-plus"></i>
                        Nuevo Vehiculo
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
                                <th class="col-2 custom-th">Marca</th>
                                <th class="col-2 custom-th">Modelo</th>
                                <th class="col-1 custom-th">Placas</th>
                                <th class="col-2 custom-th">Estado</th>
                                <th class="col-2 custom-th">Disponibilidad</th>
                                <th class="col-2 custom-th">Acciones</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehiculos as $vehiculo)
                                <tr>
                                    <td class="custom-td">{{ $vehiculo->id_vehiculo }}</td>
                                    <td class="custom-td">{{$vehiculo->marca }}                                    </td>
                                    <td class="custom-td">{{ $vehiculo->modelo }}</td>
                                    <td class="custom-td">{{$vehiculo->placas}}</td>
                                    <td class="custom-td">{{ $vehiculo->condicion }}</td>
                                    <td class="custom-td">
                                        @if ($vehiculo->disponibilidad)
                                            Disponible
                                        @else
                                            No disponible
                                        @endif
                                    </td>                                    
                                    <td class="custom-td">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('Vehiculos.edit', $vehiculo->id_vehiculo) }}" class="btn btn-primary"><i
                                                    class="fas fa-pencil-alt"></i></a>
                                            <form action="{{ route('Vehiculos.destroy', $vehiculo->id_vehiculo) }}"
                                                id="delete_{{ $vehiculo->id_vehiculo }}" method="POST">
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
            <!-- Modal de nuevo articulo -->
            <div class="modal fade" id="modalnuevovehiculo" tabindex="-3" aria-labelledby="agregarModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="agregarModalLabel">Agregar Nuevo Vehiculo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="createForm" action="{{ route('Vehiculos.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @include('Transportes.Vehiculos.formularios.form')
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary"
                                onclick="document.getElementById('createForm').submit()">Añadir</button>
                        </div>
                    </div>
                </div>
            </div>

        <div class="card-footer">
            @if ($vehiculos->count() > 0)
                {{ $vehiculos->links() }}
            @endif
        </div>
    </div>

    <Script type="text/javascript">
        $('#limit').on('change', function() {
            window.location.href = "{{ route('Vehiculos.index') }}?limit=" + $(this).val() + '&search=' + $('#search')
                .val()
        })

        $('#search').on('keyup', function(e) {
            if (e.keyCode == 13) {
                window.location.href = "{{ route('Vehiculos.index') }}?limit=" + $('#limit').val() + '&search=' + $(
                    this).val()
            }
        })
    </Script>
@endsection
