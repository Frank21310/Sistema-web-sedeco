@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Nueva Bitácora</h3>

    <form action="{{ route('bitacoras.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Departamento</label>
            <select name="departamento_id" class="form-control">
                @foreach($departamentos as $d)
                    <option value="{{ $d->id_departamento }}">{{ $d->nombre_departamento }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Municipio</label>
            <select name="municipio_id" class="form-control">
                @foreach($municipios as $m)
                    <option value="{{ $m->id_municipio }}">{{ $m->nombre_municipio }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Vehículo</label>
            <select name="vehiculo_id" class="form-control">
                @foreach($vehiculos as $v)
                    <option value="{{ $v->id_vehiculo }}">{{ $v->marca }} - {{ $v->modelo }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Fecha de elaboración</label>
            <input type="date" name="fecha_elaboracion" class="form-control">
        </div>

        <div class="mb-3">
            <label>Número de control</label>
            <input type="text" name="num_control" class="form-control">
        </div>

        <div class="mb-3">
            <label>Elaboró</label>
            <input type="text" name="elaboro" class="form-control">
        </div>

        <div class="mb-3">
            <label>Revisó</label>
            <input type="text" name="reviso" class="form-control">
        </div>

        <div class="mb-3">
            <label>Autorizó</label>
            <input type="text" name="autorizo" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
    </form>

</div>
@endsection