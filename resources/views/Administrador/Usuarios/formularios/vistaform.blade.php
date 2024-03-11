@csrf


<div class="row mb-3">
    <label for="empleado_num" class="col-md-4 col-form-label text-md-end">{{ __('Empleado') }}</label>

    <div class="col-md-6">
        <span id="empleado_num" class="form-control custom-span" name="empleado_num" >
            {{ isset($Users) ? $Users->Empleados->nombre : old('empleado_num') }}
        </span>

    </div>
</div>

<div class="row mb-3">
    <label for="id_rol" class="col-md-4 col-form-label text-md-end">{{ __('Rol') }}</label>

    <div class="col-md-6">
        <span id="id_rol" class="form-control custom-span" name="rol_id" >
            {{ isset($Users) ? $Users->Roles->nombre_rol : old('rol_id') }}
        </span>
    </div>
</div>

<div class="row mb-3">
    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo') }}</label>

    <div class="col-md-6">
        <span id="email" class="form-control custom-span" name="email" >
            {{ isset($Users) ? $Users->email : old('email') }}
        </span>
    </div>
</div>

