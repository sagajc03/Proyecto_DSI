<div class="row align-items-end text-end">
    <div class="col-2">
        <label class="col-form-label fw-bold">Descripción detallada:</label>
    </div>
    <div class="col-2">
        <input type="text" class="form-control" name="Descripcion[]" placeholder="">
    </div>
    <div class="col-2 ">
        <label class="col-form-label fw-bold">Producto o servicio:*</label>
    </div>
    <div class="col-2">
        <input type="text" class="form-control" name="Producto[]" placeholder="" value="">
    </div>
    <div class="col-2 ">
        <label class="col-form-label fw-bold">Unidad de Medida:*</label>
    </div>
    <div class="col-2">
        <input type="text" class="form-control" name="Unidad[]" placeholder="" value="">
    </div>
</div>
<div class="row align-items-end text-end">
    <div class="col-2">
        <label class="col-form-label fw-bold">Cantidad:*</label>
    </div>
    <div class="col-2">
        <input type="number" step="0.01" class="form-control" name="Cantidad[]" placeholder="">
    </div>
    <div class="col-2 ">
        <label class="col-form-label fw-bold">Valor Unitario:*</label>
    </div>
    <div class="col-2">
        <input type="number" step="0.01" class="form-control" name="ValorUnitario[]" placeholder="" value="">
    </div>
    <div class="col-2 ">
        <label class="col-form-label fw-bold">Descuento:</label>
    </div>
    <div class="col-2">
        <input type="number" step="0.01" class="form-control" name="Descuento[]" placeholder="%" value="0">
    </div>
</div>
<div class="row align-items-end text-end">
    <div class="col-2">
        <label class="col-form-label fw-bold">Objeto de impuesto:</label>
    </div>
    <div class="col-4">
        <select name="ObjImpuesto[]" class="form-select">
            <option selected>Seleccione..</option>
            <option value="No_objeto_de_impuesto" >No objeto de impuesto</option>
            <option value="Si_objeto_de_impuesto" >Si objeto de impuesto</option>
            <option value="Si_objeto_de_impuesto_y_no_desglose" >Si objeto de impuesto y no obligado desglose</option>
        </select>
    </div>
</div>
<hr>