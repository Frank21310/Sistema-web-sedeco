@csrf
<div class="row d-grid gap-2 col-6 mx-auto">
    <div class="col-12">
        <div class="form-group">
            <label for="">Nombre del Rol</label>
            <input type="text" class="form-control custom-input" name="nombre_rol"
                value="{{ isset($rol) ? $rol->nombre_rol : old('nombre_rol') }}" required>
        </div>
    </div>
    <div class="col-12">
        
    </div>

</div>
