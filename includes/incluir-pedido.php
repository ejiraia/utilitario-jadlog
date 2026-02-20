<div class="tab-pane fade <?php if (isset($ip_res)) {
    echo 'show active';} ?>" id="incluir" role="tabpanel" aria-labelledby="profile-tab">
    <br>
    <form action="" id="incluirPedido">
        <div class="card shadow-lg ">
            <div class="card-header bg-primary text-white" >
                <h2 class="fw-light">Incluir Pedido</h2>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Dados Pedido</h3>
                    </div>
                    <div class="col-md-6 p-2">
                        <label class="input-title">Pedido:</label>
                        <input type="text" class="form-control"
                            value="<?= $_GET['ip_pedido'] ?? '' ?>"
                            name="ip_pedido" placeholder="Ex.: Pedido nº 123456">
                    </div>

                    <div class="col-md-2 p-2">
                        <span class="input-title">Peso:</span>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" step=".1"
                            value="<?= $_GET['ip_peso'] ?? '' ?>" name="ip_peso">
                            <span class="input-group-text" id="basic-addon1">KG</span>
                        </div>
                    </div>

                    <div class="col-md-2 p-2">
                        <label class="input-title">Valor:</label>
                        <div class="input-group mb-3">
                            <input type="number" step=".01"
                            value="<?= $_GET['ip_valor'] ?? '' ?>" class="form-control" name="ip_valor">
                            <span class="input-group-text" id="basic-addon1">R$</span>
                        </div>
                    </div>

                    <div class="col-md-12 p-2">
                        <label class="input-title">Conteudo:</label>
                        <input type="text" class="form-control"
                            value="<?= $_GET['ip_conteudo'] ?? '' ?>" placeholder="Ex.: Chapel de Juta" name="ip_conteudo">
                    </div>

                    <div class="col-md-4 p-2">
                        <label class="input-title">dfe:</label>
                        <input type="text"
                            value="<?= $_GET['ip_dfe'] ?? '' ?>" class="form-control" name="ip_dfe">
                    </div>

                    <div class="col-md-2 p-2">
                        <label class="input-title">Volume:</label>
                        <div class="input-group mb-3">
                            <input type="number"
                            value="<?= $_GET['ip_volume'] ?? null ?>" class="form-control" name="ip_volume">
                            <span class="input-group-text" id="basic-addon1">UN</span>
                        </div>
                    </div>

                    <div class="divider">//</div>
                    <div class="col-md-12 py-2">
                        <h3>Dados Destinatário</h3>
                    </div>

                    <div class="col-md-6 p-2">
                        <label class="input-title">Destinatário:</label >
                        <input type="text" value="<?= $_GET['ip_dest'] ?? '' ?>" class="form-control" name="ip_dest">
                    </div>

                    <div class="col-md-6 p-2">
                        <label class="input-title">CPF/CNPJ:</label>
                        <input type="text"
                            value="<?= $_GET['ip_doc'] ?? '' ?>" class="form-control" name="ip_doc">
                    </div>

                    <div class="col-md-5 p-2">
                        <label class="input-title">Rua:</label>
                        <input value="<?= $_GET['ip_rua'] ?? '' ?>" type="text" class="form-control" name="ip_rua">
                    </div>

                    <div class="col-md-3 p-2">
                        <label class="input-title">Número:</label>
                        <input value="<?= $_GET['ip_numero'] ?? '' ?>" type="text" class="form-control" name="ip_numero">
                    </div>

                    <div class="col-md-4 p-2">
                        <label class="input-title">Bairro:</label>
                        <input type="text" value="<?= $_GET['ip_bairro'] ?? '' ?>" class="form-control" name="ip_bairro">
                    </div>

                    <div class="col-md-5 p-2">
                        <label class="input-title">Cidade:</label>
                        <input value="<?= $_GET['ip_cidade'] ?? '' ?>"
                            type="text" class="form-control" name="ip_cidade">
                    </div>

                    <div class="col-md-3 p-2">
                        <label class="input-title">Estado:</label>
                        <input type="text" value="<?= $_GET['ip_uf'] ?? '' ?>"
                            class="form-control" name="ip_uf">
                    </div>

                    <div class="col-md-4 p-2">
                        <label class="input-title">CEP:</label>
                        <input type="text" value="<?= $_GET['ip_cep'] ?? '' ?>" class="form-control" name="ip_cep">
                    </div>

                    <div class="col-md-4 p-2">
                        <lebal class="input-title">Fone:</lebal>
                        <input type="text" class="form-control" value="<?= $_GET['ip_fone'] ?? '' ?>" name="ip_fone">
                    </div>

                    <div class="col-md-4 p-2">
                        <label class="input-title">Celular:</label>
                        <input type="text" value="<?= $_GET['ip_cel'] ?? '' ?>" class="form-control" name="ip_cel">
                    </div>

                    <div class="col-md-4 p-2">
                        <label class="input-title">Email:</label>
                        <input type="text" value="<?= $_GET['ip_email'] ?? '' ?>" class="form-control" name="ip_email">
                    </div>

                    <div class="col-md-6 p-2">
                        <label class="input-title">Contato:</label>
                        <input type="text" value="<?= $_GET['ip_contato'] ?? '' ?>" class="form-control" name="ip_contato">
                    </div>

                    <div class="col-md-12 p-2 text-center">
                        <input type="hidden" name="incluir_pedido" value="incluir_pedido">
                        <button class="btn btn-danger btn-lg px-5">Incluir Pedido</button>
                        <!-- <a href="<?= base_url() ?>" class="btn btn-outline-warning btn-lg">Limpar Dados</a> -->
                    </div>
                </div><!-- row -->
            </div><!-- card-body -->
        </div><!-- card -->
    </form>
    <div class="p-2 fs-2 text-center text-success">
        <?php if (isset($ip_res)):
            
            vd($ip_res);
        
        endif; ?>
    </div>
</div>