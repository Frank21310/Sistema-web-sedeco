@csrf
<div class="row d-grid gap-2 mx-auto col-12">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="">Departamento Solicitante</label>
                <select name="departamento_id" class="form-control custom-select" required>
                    <option value="" disabled selected>Selecciona el Solicitante</option>
                    @foreach ($Departamentos as $departamento)
                        <option value="{{ $departamento->id_departamento }}"
                            @if ($departamento->id_departamento == $Vale->departamento_id) selected @endif>
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
                <label for="">Solicitante</label>
                <select name="solicitante" class="form-control custom-select" required>
                    <option value="" disabled selected>Selecciona el Solicitante</option>
                    @foreach ($Empleados as $Empleado)
                        <option value="{{ $Empleado->num_empleado }}" @if ($Empleado->num_empleado == $Vale->solicitante) selected @endif>
                            {{ $Empleado->nombre }} {{ $Empleado->apellido_paterno }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="">Fecha de salida </label>
                <input type="date" name="fechasalida" id="fechaentrada" class="form-control custom-input"
                    value="{{ isset($Vale) ? $Vale->fechaentrada : old('fechasalida') }}" required>
            </div>
        </div>
    </div>
    <br>
    <div class="table-responsive">
        <table id="articulos-table" class="table custom-table">
            <thead class="custom-thead">
                <tr>
                    <th scope="col">Descripción</th>
                    <th scope="col">Salida</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detallevales as $detallevale)
                    <tr class="fila-original">
                        <td>
                            <input type="text" name="descripcion[]" value="{{ $detallevale->Inventario->descripcion }}"
                                class="form-control custom-input select2 buscador" placeholder="Buscar artículo"
                                id="mostrar">
                        </td>
                        <td>
                            <input type="hidden" name="articulo_id[]"
                                value="{{ $detallevale->Inventario->id_articulo }}"class="articulo-id">
                            <input type="number" name="salida[]" value="{{ $detallevale->salida }}"
                                class="form-control custom-input">
                        </td>
                        <td>
                            <button type="button" class="btn btn-success btn-add-row"><i
                                    class="fas fa-plus"></i></button>
                            <button type="button" class="btn btn-danger btn-remove-row"><i
                                    class="fas fa-trash-alt"></i></button>

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <br>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- jQuery UI -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


<script>
    $(document).ready(function() {
        // Función para inicializar el autocompletado en un elemento de entrada
        function initAutocomplete($element) {
            $element.autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "{{ route('buscarArticulos') }}",
                        dataType: 'json',
                        data: {
                            query: request.term
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                minLength: 1, // Número mínimo de caracteres antes de realizar la búsqueda
                appendTo: "#modalagregarentrada", // Esto fuerza el menú a mostrarse dentro del modal
                select: function(event, ui) {
                    $(this).val(ui.item
                    .label); // Establece el valor del primer input como la descripción
                    $(this).closest('tr').find('.articulo-id').val(ui.item
                    .value); // Establece el valor del segundo input como el ID
                    return false; // Evita que se actualice el valor del input con la descripción
                }
            });
        }

        const tableBody = $('#articulos-table tbody');
        const filaOriginal = tableBody.find('.fila-original').html();

        // Función para agregar una nueva fila al hacer clic en el botón de añadir
        function addRow() {
            const newRow = '<tr>' + filaOriginal + '</tr>';
            tableBody.append(newRow);
            // Inicializa el autocompletado en la nueva fila agregada
            initAutocomplete(tableBody.find('tr:last-child .buscador'));
        }

        // Evento clic para agregar una fila
        tableBody.on('click', '.btn-add-row', function() {
            addRow();
            // Elimina el botón de agregar del último elemento
            tableBody.find('tr:last-child .btn-add-row').remove();
        });

        // Evento clic para eliminar una fila
        tableBody.on('click', '.btn-remove-row', function() {
            $(this).closest('tr').remove();
        });

        // Inicializa el autocompletado en la fila original
        initAutocomplete(tableBody.find('.fila-original .buscador'));
    });
</script>


</script>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("input[type=date]");
    </script>
@endpush
