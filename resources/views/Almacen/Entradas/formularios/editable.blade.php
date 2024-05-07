@csrf
<div class="row d-grid gap-2 mx-auto col-12">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="">Solicitante</label>
                <select name="departamento_id" class="form-control custom-select" required>
                    <option value="" disabled selected>Selecciona el Solicitante</option>
                    @foreach ($Departamentos as $departamento)
                        <option value="{{ $departamento->id_departamento }}" @if ($departamento->id_departamento == $Entrada->departamento_id) selected @endif>
                            {{ $departamento->nombre_departamento }}
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
                    <option value="">Selecciona un proveedor</option >
                    @foreach ($proveedores as $proveedor)
                        <option value="{{ $proveedor->id_proveedor }}" @if ($proveedor->id_proveedor == $Entrada->proveedor_id) selected @endif
                            >{{ $proveedor->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="">Folio </label>
                <input type="text" class="form-control custom-input" name="folio" value="{{(isset($Entrada))?$Entrada->folio:old('folio')}}" required>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-4">
            <div class="form-group">
                <label for="">Factura</label>
                <input type="text" class="form-control custom-input" name="factura" value="{{(isset($Entrada))?$Entrada->factura:old('factura')}}" >
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="">Fecha de factura</label>
                <input type="date" name="fechafactura" id="fechafactura" class="form-control custom-input" value="{{(isset($Entrada))?$Entrada->fechafactura:old('fechafactura')}}" required>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="">Fecha de entrada </label>
                <input type="date" name="fechaentrada" id="fechaentrada" class="form-control custom-input"  value="{{(isset($Entrada))?$Entrada->fechaentrada:old('fechaentrada')}}" required>
            </div>
        </div>
    </div>
    <br>
    <div class="table-responsive">
        <table id="articulos-table" class="table custom-table">
            <thead class="custom-thead">
                <tr>
                    <th scope="col">Descripción</th>
                    <th scope="col">Unidad</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articulos as $articulo)
                    <tr>
                        <td>
                            <label for="">Descripción</label>
                            <input type="text" name="descripcion[]" value="{{ $articulo->descripcion }}" class="form-control custom-input">
                        </td>
                        <td>
                            <label for="">Unidad de medida</label>
                            <select name="unidad_id[]" class="form-control custom-select" required>
                                <option value="">Selecciona una medida</option>
                                @foreach ($medidas as $medida)
                                    <option value="{{ $medida->id_unidad }}" @if ($articulo->unidad_id == $medida->id_unidad) selected @endif>{{ $medida->nombre_unidad }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <label for="">Cantidad</label>
                            <input type="number" name="cantidad[]" value="{{ $articulo->cantidad }}" class="form-control custom-input">
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-remove-row"><i class="fas fa-trash-alt"></i></button>

                        </td>
                    </tr>
                    
                @endforeach
                <button type="button" class="btn btn-success btn-add-row"><i class="fas fa-plus"></i></button>

            </tbody>
        </table>
    </div>
    
    <br>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tableBody = document.querySelector('#articulos-table tbody');

        // Función para agregar una nueva fila al hacer clic en el botón de añadir
        function addRow() {
            const newRow = `
                <tr>
                    <td>
                        <input type="text" name="descripcion[]" class="form-control custom-input">
                    </td>
                    <td>
                        <select name="unidad_id[]" class="form-control custom-select" required>
                            <option value="">Selecciona una medida</option>
                            @foreach ($medidas as $medida)
                                <option value="{{ $medida->id_unidad }}">{{ $medida->nombre_unidad }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" name="cantidad[]" class="form-control custom-input">
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-remove-row"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
            `;
            tableBody.insertAdjacentHTML('beforeend', newRow);
        }

        // Evento clic para agregar una fila
        document.querySelector('.btn-add-row').addEventListener('click', addRow);

        // Evento clic para eliminar una fila
        tableBody.addEventListener('click', function (event) {
            if (event.target.classList.contains('btn-remove-row')) {
                event.target.closest('tr').remove();
            }
        });
    });
</script>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("input[type=date]");
    </script>
    
@endpush
