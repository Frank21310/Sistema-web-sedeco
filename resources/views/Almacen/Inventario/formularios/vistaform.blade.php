@csrf
<div class="row d-grid gap-2 col-6 mx-auto">
    <div class="col-12">
        <div class="form-group">
            <label for="">Nombre del Rol</label>
            <span type="text" class="form-control custom-span" name="nombre_rol">
                {{ isset($rol) ? $rol->nombre_rol : old('nombre_rol') }}
            </span>
            
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="">Permisos</label>
            <span type="text" class="form-control custom-span" name="permiso_id">
                {{ isset($rol) ? $rol->Permisos->nombre_permiso : old('permiso_id') }}
            </span>
    </div>

</div>
