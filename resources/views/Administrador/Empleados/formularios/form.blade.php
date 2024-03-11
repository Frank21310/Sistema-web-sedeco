@csrf
<div class="row d-grid gap-2 col-6 mx-auto">
    <div class="col-12">
        <div class="form-group">
            <label for="">Num. Empleado</label>
            <input type="text" class="form-control custom-input" name="num_empleado" value="{{(isset($Empleado))?$Empleado->num_empleado:old('num_empleado')}}" required>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="">Nombre </label>
            <input type="text" class="form-control custom-input" name="nombre" value="{{(isset($Empleado))?$Empleado->nombre:old('nombre')}}" required>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="">Apellido Paterno</label>
            <input type="text" class="form-control custom-input" name="apellido_paterno" value="{{(isset($Empleado))?$Empleado->apellido_paterno:old('apellido_paterno')}}" required>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="">Apellido Materno</label>
            <input type="text" class="form-control custom-input" name="apellido_materno" value="{{(isset($Empleado))?$Empleado->apellido_materno:old('apellido_materno')}}" required>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="">RFC</label>
            <input type="text" class="form-control custom-input" name="rfc" value="{{(isset($Empleado))?$Empleado->rfc:old('rfc')}}" required>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="">Cargo</label>
            <select class="form-control custom-select" name="cargo_id" value="{{(isset($Empleado))?$Empleado->cargo_id:old('cargo_id')}}" required>
                <option value="">Seleccione un cargo</option>
                @foreach ($cargos as $cargo)
                    <option value="{{ $cargo->id_cargo}}" class="form-control">
                         {{ $cargo->nombre_cargo }}
                    </option>
                @endforeach

            </select>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="">Dependencia</label>
            <select class="form-control custom-select" name="dependencia_id" value="{{(isset($Empleado))?$Empleado->dependencia_id:old('dependencia_id')}}"  required>
                <option value="">Seleccione una dependencia</option>
                @foreach ($dependecias as $dependecia)
                    <option value="{{ $dependecia->id_dependencia}}" class="form-control">
                         {{ $dependecia->nombre_dependencia }}
                    </option>
                @endforeach

            </select>
        </div>
    </div>

</div>
