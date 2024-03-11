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
        <div class="form-group">
            <label for="">Permisos</label>
            <select name="permiso_id" class="form-control custom-select"
                value="{{ isset($rol) ? $rol->permiso_id : old('permiso_id') }}" required>
                <option value="">Seleccione un permiso</option>
                @foreach ($permisos as $permiso)
                    <option value="{{ $permiso->id_permiso}}" class="form-control">
                         {{ $permiso->nombre_permiso }}
                    </option>
                @endforeach

            </select>
        </div>
    </div>

</div>
