@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h2 class="">Solicitudes</h2>
                </div>
                <div class="col g-col-6 d-flex justify-content-end">
                    <button type="button" class="btn btn-primary ml-auto BotonRojo" data-bs-toggle="modal"
                        data-bs-target="#modalagregarentrada">
                        <i class="fas fa-plus"></i>
                        Solicitar
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
                    <h3>Solicitudes Realizadas</h3>
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
                                <th class="col-1 custom-th">Folio</th>
                                <th class="col-2 custom-th">Fecha de solicitud</th>
                                <th class="col-3 custom-th">Departamento</th>
                                <th class="col-3 custom-th">Solicitante</th>
                                <th class="col-2 custom-th">Estatus</th>
                                <th class="col-1 custom-th">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Solicitud as $Solicitudes)
                                <tr>
                                    <td class="custom-td">{{ $Solicitudes->id_solicitud }}</td>
                                    <td class="custom-td">{{ optional($Solicitudes->Vale)->fechasalida ?? 'Sin fecha' }}</td>
                                    <td class="custom-td">{{ $Solicitudes->Vale->Departamento->nombre_departamento }}</td>
                                    <td class="custom-td">{{ optional($Solicitudes->Vale)->Solicitante->nombre ?? 'Sin solicitante' }}</td>
                                    <td class="custom-td">{{ $Solicitudes->estatus->nombre_estatus }}</td>
                                    
                                    <td class="custom-td">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('generarsalida.pdf', $Solicitudes->id_solicitud) }}" class="btn btn-info" target="_blank">
                                                <i class="fa fa-print"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Modal de peticiones solicitudes -->
            <div class="modal fade modal-lg" id="modalagregarentrada" tabindex="-1" aria-labelledby="agregarModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="agregarModalLabel">Nueva Solicitud</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="createForm" action="{{ route('Solicitudes.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @include('Peticiones.Solicitudes.formularios.form')
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" onclick="validateForm()">Crear</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            @if ($Solicitud->count() > 0)
                {{ $Solicitud->links() }}
            @endif
        </div>
    </div>

    <Script type="text/javascript">
        $('#limit').on('change', function() {
            window.location.href = "{{ route('Solicitudes.index') }}?limit=" + $(this).val() + '&search=' + $('#search')
                .val()
        })

        $('#search').on('keyup', function(e) {
            if (e.keyCode == 13) {
                window.location.href = "{{ route('Solicitudes.index') }}?limit=" + $('#limit').val() + '&search=' + $(
                    this).val()
            }
        })
    </Script>
@endsection
