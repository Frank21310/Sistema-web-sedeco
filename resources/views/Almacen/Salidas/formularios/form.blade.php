@csrf
<div class="row d-grid gap-2 mx-auto col">
    <div class="col">
        <div class="form-group">
            <label for="">Folio de entrada</label>
            <input type="text" class="form-control custom-input" name="entrada_id" required>
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="">Fecha de salida </label>
            <input type="date" name="fechasalida" id="fechasalida" class="form-control custom-input" required>
        </div>
    </div>
</div>


@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("input[type=date]");
    </script>
@endpush
