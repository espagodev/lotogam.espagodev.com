
<div class="row">
    <div class="col-6 col-sm-6 col-md-6 col-lg-2 col-xl-2">
        <b>Apuestas:</b>
        <br/>
        <span class="total_quantity">0</span>
    </div>

    <div class="col-6 col-sm-6 col-md-6 col-lg-2 col-xl-2">
        <b>Total:</b>
        <br/>
        <span class="price_total">0</span>
    </div>
    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3">
        <b>Total A Pagar:</b>
        <br/>
        <input type="hidden" name="final_total"
            id="final_total_input" value=0>
        <span id="total_payable" class="text-success lead text-bold">0</span>
    </div>
    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3">
        <b>Loterias Seleccionadas:</b>
            <br/>
        <span id="total_loterias" class="text-info lead text-bold">0</span>
    </div>
    <div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
            <button type="button" class="btn btn-danger btn-sm pull-right"  id="pos-cancel"><i class="fa fa-close"></i> Cancelar</button>
    </div>
</div>
<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
        <button type="button" class="btn btn-info btn-sm btn-block waves-effect waves-light m-1" disabled>Borrador</button>
    </div>
    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
        <button type="button" class="btn btn-warning btn-sm btn-block waves-effect waves-light m-1 " disabled><i class="fa fa-pause"></i> Suspender</button>
    </div>
    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
    <button type="button" class="btn btn-success btn-sm btn-block pos-express-btn pos-express-finalize pull-right" data-pay_method="cash"><i class="fa fa-money"></i> Pagar</button>
    </div>
</div>
    <div class="div-overlay pos-processing"></div>


