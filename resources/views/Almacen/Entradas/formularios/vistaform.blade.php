@csrf
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
                    <button type="button" class="btn btn-success btn-add-row"><i class="fas fa-plus"></i></button>
                </td>
            </tr>
            
        </tbody>
    </table>
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
