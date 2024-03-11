@csrf
<div class="row d-grid gap-2 col-6 mx-auto">
    <div class="col-12">
        <div class="form-group">
            <label for="">Num. Empleado</label>
            <span type="text" class="form-control custom-span" name="num_empleado">{{(isset($Empleado))?$Empleado->num_empleado:old('num_empleado')}}</span>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="">Nombre </label>
            <span type="text" class="form-control custom-span" name="nombre">{{(isset($Empleado))?$Empleado->nombre:old('nombre')}}</span>

        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="">Apellido Paterno</label>
            <span type="text" class="form-control custom-span" name="apellido_paterno">{{(isset($Empleado))?$Empleado->apellido_paterno:old('apellido_paterno')}}</span>

        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="">Apellido Materno</label>
            <span type="text" class="form-control custom-span" name="apellido_materno">{{(isset($Empleado))?$Empleado->apellido_materno:old('apellido_materno')}}</span>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="">Cargo</label>
            <span type="text" class="form-control custom-span" name="cargo_id">{{(isset($Empleado))?$Empleado->Cargos->nombre_cargo:old('cargo_id')}}</span>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="">Dependencia</label>
            <span type="text" class="form-control custom-span" name="dependencia_id">{{ $Empleado->Dependencias->nombre_dependencia }}</span>
        </div>
    </div>

</div>
