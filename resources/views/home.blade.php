@extends('layouts.app')

@section('content')
    <section class="">
        <div class="row ">
            <div class="col-lg-6 mx-auto text-center">
                <p class="lead text-body-secondary">
                    ¡Hola, <strong>{{ Auth::user()->Empleados->nombre }} {{ Auth::user()->Empleados->apellido_paterno }}
                        {{ Auth::user()->Empleados->apellido_materno }}</strong>!
                </p>
                <p>
                    Actualmente estas asignado como {{ Auth::user()->Roles->nombre_rol }}
                </p>
            </div>
        </div>
        @if (Auth::user()->rol_id == 1)
        @endif
        @if (Auth::user()->rol_id == 2)
            <div class="row">
                <div class="col-8 px-2"></div>
                <div class="col-4 px-2">
                    <div class="row py-2">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">Total de Artículos en Inventario</div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $totalArticulos }}</h5>
                                    <p class="card-text">Este es el total de artículos en el inventario.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">Total de Artículos por Categoría</div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        @foreach ($categorias as $categoria)
                                            <li class="list-group-item">{{ $categoria->nombre_categoria }}:
                                                {{ $categoria->inventario_count }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">Artículo por Agotarse</div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        @foreach ($articuloPorAgotarse as $articulo)
                                            <li class="list-group-item">{{ $articulo->descripcion }} -
                                                {{ $articulo->existencia }} disponibles</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>
    <div class="container">

    </div>
@endsection
