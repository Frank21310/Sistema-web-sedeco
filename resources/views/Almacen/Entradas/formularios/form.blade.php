@csrf
<div class="row d-grid gap-2 mx-auto col-12">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="">Solicitante</label>
                <select name="departamento_id" class="form-control custom-select" required>
                    <option value="">Selecciona el Solicitante</option>
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
                <label for="">Proveedor</label>
                <select name="proveedor_id" class="form-control custom-select" required>
                    <option value="">Selecciona un proveedor</option>
                    @foreach ($proveedores as $proveedor)
                        <option value="{{ $proveedor->id_proveedor }}">{{ $proveedor->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="">Entrega </label>
                <input type="text" class="form-control custom-input" name="entrega" >
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="">Cargo </label>
                <input type="text" class="form-control custom-input" name="cargoentrega" >
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="">Folio </label>
                <input type="text" class="form-control custom-input" name="folio" required>
            </div>
        </div>
    </div>
    
    <div class="row">

        <div class="col-4">
            <div class="form-group">
                <label for="">Factura</label>
                <input type="text" class="form-control custom-input" name="factura" required>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="">Fecha de factura</label>
                <input type="date" name="fechafactura" id="fechafactura" class="form-control custom-input" required>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="">Fecha de entrada </label>
                <input type="date" name="fechaentrada" id="fechaentrada" class="form-control custom-input" required>
            </div>
        </div>
    </div>
    <br>
    @include('Almacen.Entradas.formularios.vistaform')

    <br>



</div>
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("input[type=date]");
    </script>
@endpush
