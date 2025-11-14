@extends('layouts.app')

@section('content')

    <div class="container">
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
                    <iframe src="https://calendar.google.com/calendar/embed?src=212e6358ac3e9610f6424ba04df55dfe3b7fa8d74a8fd460eecaba90feab68e6%40group.calendar.google.com&ctz=America%2FMexico_City" style="border: 0" width="1000" height="800" frameborder="0" scrolling="no"></iframe>
                <!--<div class="col-4">
                    <div class="row ">
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
                </div>-->
            </div>
        @endif
    </div>
@endsection
