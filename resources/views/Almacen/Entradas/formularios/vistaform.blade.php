@csrf
<div class="table-responsive">
    <table
        class="table custom-table">
        <thead class="custom-thead">
            <tr>
                <th scope="col" class="">Descripcion</th>
                <th scope="col" class="">Unidad</th>
                <th scope="col" class="">Cantidad</th>
            </tr>
        </thead>
        <tbody>
            <tr class="">
                <td class="" scope="row">
                    <input type="text" name="descripcion" class="form-control custom-input">
                </td>
                <td class="">
                    <select name="unidad_id" class="form-control custom-select">
                        <option value="">Selecciona una medida</option>
                    </select>
                </td>
                <td class="">
                    <input type="number" class="form-control custom-input">
                </td>
            </tr>
        </tbody>
    </table>
</div>