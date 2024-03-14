@csrf
<div class="row d-grid gap-2 col-8 mx-auto">
    <div class="col-12">
        <div class="form-group">
            <label for="">Descripcion</label>
            <input type="text" class="form-control custom-input" name="descripcion"
                required>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="">Categoria</label>
            <select class="form-control custom-select" name="categoria_id"  required>
                <option value="">Seleccione una categoria</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id_categoria}}" class="form-control">
                         {{ $categoria->nombre_categoria }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="">Estante</label>
            <input type="number" class="form-control custom-input" name="estante"
                 required placeholder="0">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="">Unidad de medida</label>
            <select class="form-control custom-select" name="unidad_id"  required>
                <option value="">Seleccione una unidad de medida</option>
                @foreach ($medidas as $medida)
                    <option value="{{ $medida->id_unidad}}" class="form-control">
                         {{ $medida->nombre_unidad }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="">Cantidad</label>
            <input type="number" class="form-control custom-input" name="cantidad"
                 required placeholder="0.00" min="0.00" step="0.001">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="">Existencia</label>
            <input type="number" class="form-control custom-input" name="existencia"
                 required placeholder="0.00" min="0.00" step="0.001">
        </div>
    </div>
</div>
