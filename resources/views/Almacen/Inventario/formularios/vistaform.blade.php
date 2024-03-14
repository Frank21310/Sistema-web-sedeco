@csrf
<div class="row d-grid gap-2 col-6 mx-auto">
    <div class="col-12">
        <div class="form-group">
            <label for="">Descripcion</label>
            <input type="text" class="form-control custom-input" name="descripcion"
                value="{{ isset($Articulo) ? $Articulo->descripcion : old('descripcion') }}" required>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="">Categoria</label>
            <input type="text" class="form-control custom-input" name="categoria_id"
                value="{{ isset($Articulo) ? $Articulo->categoria_id : old('categoria_id') }}" required>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="">Estante</label>
            <input type="text" class="form-control custom-input" name="estante"
                value="{{ isset($Articulo) ? $Articulo->estante : old('estante') }}" required>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="">Unidad de medida</label>
            <input type="text" class="form-control custom-input" name="unidad_id"
                value="{{ isset($Articulo) ? $Articulo->unidad_id : old('unidad_id') }}" required>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="">Cantidad</label>
            <input type="text" class="form-control custom-input" name="cantidad"
                value="{{ isset($Articulo) ? $Articulo->cantidad : old('cantidad') }}" required>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="">Existencia</label>
            <input type="text" class="form-control custom-input" name="existencia"
                value="{{ isset($Articulo) ? $Articulo->existencia : old('existencia') }}" required>
        </div>
    </div>
</div>
