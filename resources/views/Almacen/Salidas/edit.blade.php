@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h2 class="">Editar entrada {{$Entrada->id_entrada}} </h2>
                </div>
                <div class="col g-col-6 d-flex justify-content-end ">
                    <a id="BtnAgregar" href="{{ route('Entradas.index') }}" class="btn btn-primary ml-auto BotonRojo">
                        <i class="fas fa-arrow-left"></i>
                        Volver
                    </a>
                </div>
            </div>
        </div>
        <hr>
        <div class="card-body">
            <form action="{{ route('Entradas.update', $Entrada->id_entrada) }}" method="POST" enctype="multipart/form-data" id="create">
                @method('PUT')
                @include('Almacen.Entradas.formularios.editable')
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