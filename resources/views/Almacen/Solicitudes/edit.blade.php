@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3 class="">Editar solicitud de {{$solicitud->Vale->Departamento->nombre_departamento}} </h2>
                </div>
                <div class="col g-col-6 d-flex justify-content-end ">
                    <a id="BtnAgregar" href="{{ route('solicitud.index') }}" class="btn btn-primary ml-auto BotonRojo">
                        <i class="fas fa-arrow-left"></i>
                        Volver
                    </a>
                </div>
            </div>
        </div>
        <hr>
        <div class="card-body">
            <form action="{{ route('solicitud.update', $solicitud->id_solicitud) }}" method="POST" enctype="multipart/form-data" id="create">
                @method('PUT')
                @include('Almacen.solicitudes.formularios.editable')
            </form>
        </div>
        <hr>
        <div class="card-footer">
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-primary ml-auto BotonGris" form="create">
                    <i class="fas fa-plus"></i>
                    Editar
                </button>
            </div>
            

        </div>
    </div>
@endsection