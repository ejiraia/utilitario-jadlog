<div class="tab-pane fade" id="rastrear" role="tabpanel" aria-labelledby="rastrear-tab">
    <br>
    <form action="/rastrear.php">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h2 class="fw-light">Rastrear Pedido</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 p-2">
                        <label class="input-title">Pedido (Shipment  ID):</label >
                        <input type="text" class="form-control" name="pedido">
                    </div>
                    <div class="col-md-6 p-2">
                        <br>
                        <button class="btn btn-danger">Confirmar pedido</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>