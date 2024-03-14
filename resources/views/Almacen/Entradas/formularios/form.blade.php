@csrf
<div class="row d-grid gap-2 mx-auto col-12">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="">Proveedor</label>
                <input type="text" class="form-control custom-input" name="proveedor_id" required>
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
                <input type="text" class="form-control custom-input" name="fechafactura" required>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="">Fecha de entrada </label>
                <input type="text" class="form-control custom-input" name="fechaentrada" required>
            </div>
        </div>
    </div>
    <br>
    @include('Almacen.Entradas.formularios.vistaform')

    <br>
    
    <div class="col-12">
        <div class="form-group">
            <label for="">Solicitante</label>
            <input type="text" class="form-control custom-input" name="departamento_id"  required>
        </div>
    </div>
</div>
