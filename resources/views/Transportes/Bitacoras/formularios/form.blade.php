@csrf
<div class="row d-grid gap-2 col mx-auto">
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <label for="">Marca</label>
                <input type="text" class="form-control custom-input" name="marca" placeholder="Escribe la marca "
                    required>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="">Modelo</label>
                <input type="text" class="form-control custom-input" name="modelo"
                 required placeholder="Escribe el modelo">
            </div>
        </div>
        
        <div class="col-4">
            <div class="form-group">
                <label for="">Color</label>
                <select class="form-control custom-select" name="color"  required>
                    <option value="">Selecciona el color</option>
                    <option value="Blanco">Blanco</option>
                    <option value="Negro">Negro</option>
                    <option value="Gris">Gris</option>
                    <option value="Rojo">Rojo</option>
                    <option value="Azul">Azul</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <label for="">Kilometraje</label>
                <input type="number" class="form-control custom-input" name="kilometros"
                 required placeholder="00000.00" min="0.00">
            </div>
            
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="">Año</label>
                <input type="number" class="form-control custom-input" name="año"
                 required  min="0" placeholder="0">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="">Placas</label>
                <input type="text" class="form-control custom-input" name="placas"
                      placeholder="XX-XX-00">
            </div>
        </div>
        <input type="text" class="form-control custom-input" name="condicion"
                     value="Excelente" hidden>
    </div>
    <hr>
    <div class="row">
        <div class="col-5">
            <div class="form-group">
                <label for="">Tipo de aceite</label>
                <input type="text" class="form-control custom-input" name="tipoaceite"
                      >
            </div>
        </div>
        
        <div class="col-7">
            <div class="form-group">
                <label for="">Medida de llanta
                </label>
                <input type="text" class="form-control custom-input" name="llanta"
                      placeholder="0" min="0">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <label for="">Tipo de filtro</label>
                <input type="text" class="form-control custom-input" name="filtro"
                      >
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="">Tipo de suspension</label>
                <input type="text" class="form-control custom-input" name="suspencion"
                      >
            </div>
            
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="">Tipo de motor</label>
                <input type="text" class="form-control custom-input" name="motor"
                      >
            </div>
            
        </div>
        
    </div>
    <div class="row">
        <div class="col-5">
            <div class="form-group">
                <label for="">Tipo de bujia</label>
                <input type="text" class="form-control custom-input" name="bujia"
                      placeholder="" >
            </div>
            
        </div>
        <div class="col-5">
            <div class="form-group">
                <label for="">Tipo de bateria</label>
                <input type="text" class="form-control custom-input" name="bateria"
                      placeholder="">
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <label for="">Tipo de rines</label>
                <input type="text" class="form-control custom-input" name="rines"
                      >
            </div>
        </div>
    </div>
</div>
