<div class="row d-grid gap-2 mx-auto col-12">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="">Solicitante</label>
                <span class="form-control custom-span">{{ Auth::user()->Empleados->nombre }}
                    {{ Auth::user()->Empleados->apellido_paterno }}
                    {{ Auth::user()->Empleados->apellido_materno }}</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="">Departamento Solicitante</label>
                <span 
                    class="form-control custom-span">{{ Auth::user()->Empleados->Departamento->nombre_departamento }}</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="">Fecha solicitada</label>
                <input type="date" name="fechasalida" id="fechasalida" class="form-control custom-input" required>
            </div>
        </div>
    </div>

    <br>
    @include('Almacen.Vales.formularios.vistaform')

    <br>


</div>
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("input[type=date]");
    </script>
@endpush
