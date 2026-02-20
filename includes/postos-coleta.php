<div class="tab-pane fade" id="postos-coleta" role="tabpanel" aria-labelledby="rastrear-tab">
    <br>
    <form action="/actions.php">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h2 class="fw-light">Postos de Coleta</h2>
            </div>
            <div class="card-body">
                <input type="hidden" name="action" 
                value="obterPostosDeColeta">
                <div class="row">
                    <div class="col-md-3 p-2">
                        <label class="input-title">CEP:</label >
                        <input type="text" class="form-control" name="cep">
                    </div>
                    <div class="col-md-6 p-2">
                        <br>
                        <button class="btn btn-danger">Buscar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>