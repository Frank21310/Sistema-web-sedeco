@csrf
<div class="row d-grid gap-2 mx-auto col-12">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="">Departamento</label>
                <select name="departamento_id" class="form-control custom-select" required>
                    <option value="">Selecciona el departamento</option>
                    @foreach ($Departamentos as $departamento)
                        <option value="{{ $departamento->id_departamento }}">{{ $departamento->nombre_departamento }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="">Solicitante</label>
                <select name="solicitante" class="form-control custom-select" required>
                    <option value="">Selecciona el Solicitante</option>
                    @foreach ($Solicitantes as $Solicitante)
                        <option value="{{ $Solicitante->num_empleado }}">{{ $Solicitante->nombre}} {{ $Solicitante->apellido_paterno}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="">Fecha de salida</label>
                <input type="date" name="fechasalida" id="fechasalida" class="form-control custom-input" required>
            </div>
        </div>
    </div>
    <input  name="solicitud" id="solicitud" value="1" class="form-control custom-input" hidden>

    
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
