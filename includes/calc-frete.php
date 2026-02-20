<!-- Calcuar frete -->
<div class="tab-pane fade <?php if (!isset($ip_res)) {
        echo 'show active';
    } ?>" id="home" role="tabpanel" aria-labelledby="home-tab">

    <br>
    <form action="" id="calcFrete">
        <div class="card rounded-5 shadow-lg">
            <div class="card-header bg-primary text-white">
                <h2 style="font-weight: 300;">Calcular Frete</h2>
            </div>
            <div class="card-body ">
                <div class="row items-center">
                    <div class="col-md-5">
                        <label class="input-title">CEP: (Origem)</label>
                        <input type="text" name="cepori" class="form-control" required
                            value="<?php if (isset($saida)): echo $_GET['cepori'];
                                    else: echo '81610-020';
                                    endif; ?>">
                    </div>
                    <div class="col-md-2 text-center">
                        <div  style="height:100%;
                        display:flex;align-items:center;gap:8px;
                        justify-content:center;margin-top:8px;color: #bbb;">
                            <i class="fa-solid fa-chevron-right"></i>
                            <i class="fa-solid fa-chevron-right"></i>
                            <i class="fa-solid fa-truck"></i>
                            <i class="fa-solid fa-chevron-right"></i>
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label class="input-title">CEP: (Destino)</label>
                        <input type="text" name="cepdes" class="form-control" required
                            value="<?php if (isset($saida)): echo $_GET['cepdes']; else: echo '11750-000';endif; ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="input-title">Peso:</label>
                        <div class="input-group mb-3">
                        <input type="number" step=".01" name="peso" class="form-control" required
                        value="<?php if (isset($saida)): echo $_GET['peso']; else: echo '1.0'; endif; ?>">
                            <span class="input-group-text" id="basic-addon1">KG</span>
                        
                        </div>
                        
                    </div>
                    <div class="col-md-4">
                        <label class="input-title">Valor:</label>
                        <div class="input-group mb-3">
                        <input type="number" step=".01" name="vldeclarado" class="form-control" required
                            value="<?php if (isset($saida)): echo $_GET['vldeclarado'];else: echo '50.00'; endif;?>">
                            <span class="input-group-text" id="basic-addon1">R$</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="input-title">Modalidade:</label>
                        <select name="modalidade" class="form-select">
                            <option value="3" <?= validaMod(3) ?>>Normal</option>
                            <option value="9" <?= validaMod(9) ?>>Expresso</option>
                        </select>
                    </div>
                    <div class="col-md-12 p-2 text-center">
                        <input type="hidden" name="calcFrete" value="calcFrete">
                        <button class="btn btn-danger btn-lg px-5">Calcular Frete</button>
                        <!-- <a href="<?= base_url() ?>" 
                        class="btn btn-outline-warning btn-lg">Limpar Dados</a> -->
                    </div>
                </div>
            </div><!-- card-body -->
        </div><!-- Card -->
    </form>
    <div class="p-2 fs-2 text-center text-success saidaCalcFrete mt-4">
        <div class="saidaCalcFrete">

        </div>
    </div>

</div>