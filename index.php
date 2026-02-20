<?php
include_once __DIR__."/config.php";

$jadLog = new JadLog();

if (isset($_GET['calcFrete'])):

    $base_api = 'http://localhost/_api';
    $dados = [
        "cepori" => trim(str_replace('-', '', $_GET['cepori'])),
        "cepdes" => trim(str_replace('-', '', $_GET['cepdes'])),
        "peso" => $_GET['peso'],
        "vldeclarado" => $_GET['vldeclarado'],
        "modalidade" => $_GET['modalidade']
    ];

    $response = $jadLog->calcFrete([
        "cepori" => trim(str_replace('-', '', $_GET['cepori'])),
        "cepdes" => trim(str_replace('-', '', $_GET['cepdes'])),
        "peso" => $_GET['peso'],
        "vldeclarado" => $_GET['vldeclarado'],
        "modalidade" => $_GET['modalidade']
    ]);

    //vd($response);
    $res = new stdClass;
    $res->valor = $response->frete[0]->vltotal;
    $res->prazo = $response->frete[0]->prazo;

    $saida = json_encode($res);
endif;

if (isset($_GET['incluir_pedido'])):
    //vd($_GET);
    $_GET['ip_obs'] = '';
    $dados = array(
        "conteudo" => $_GET['ip_conteudo'],
        "pedido" => array($_GET['ip_pedido']),
        "peso" => $_GET['ip_peso'],
        "valor" => $_GET['ip_valor'],
        "obs" => $_GET['ip_obs'],
        "destinatario" => $_GET['ip_dest'],
        "doc" => formatarDoc($_GET['ip_doc']),
        "rua" => $_GET['ip_rua'],
        "numero" => $_GET['ip_numero'],
        "bairro" => $_GET['ip_bairro'],
        "cidade" => $_GET['ip_cidade'],
        "uf" => $_GET['ip_uf'],
        "cep" => $_GET['ip_cep'],
        "fone" => $_GET['ip_fone'],
        "cel" => $_GET['ip_cel'],
        "email" => $_GET['ip_email'],
        "contato" => $_GET['ip_contato'],


    );
    $danfe = [
        "dfe" => array(
            [
                "cfop" => "",
                "danfeCte" => "",
                "nrDoc" => "DESC00000000",
                "serie" => "",
                "tpDocumento" => 0,
                "valor" => 20.2
            ]
        ),

    ];
    if ($_GET["ip_dfe"]) {
        $danfe = [
            "dfe" => array(
                [
                    "cfop" => "0",
                    "danfeCte" => "00000000000000000000000000000000000000000000",
                    "nrDoc" => $_GET["ip_dfe"],
                    "serie" => "1",
                    "tpDocumento" => 2,
                    "valor" => 20.2
                ]
            ),

        ];
    }
    $volume = [
        "volume" => array(
            [
                "altura" => 10,
                "comprimento" => 10,
                "identificador" => "1234567890",
                "largura" => 10,
                "peso" => 1.0
            ]
        ),
    ];
    $dados = array_merge($dados, $danfe);
    $dados = array_merge($dados, $volume);
    vd($danfe, "Dados incluir pedido", "p");
    $response = $jadLog->incluirPedido($dados);
    vd($response,"Resposta incluir pedido","p");

    $ip_res = $response;
endif;



function validaMod($valor)
{
    if (isset($_GET['modalidade']) && $_GET['modalidade'] == $valor) {
        echo 'selected';
    } else {
        echo '';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilitário JadLog </title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        :root,body{
            color: #667;
        }
        * {
            
            color: inherit;
        }

        .btn {
            font-weight: 600;
        }
        .input-title{
            padding: 0 8px;
            background-color: #fff;
            position: relative;
            top: 8px;
            left:8px;
            color: #aaa;
            font-weight: normal;
            z-index: 10;
            
        }
        .input-title::after, .input-title::before{
            content: '';
            display: block;
            background-color: #ccc;
            height: 12px;
            width: 1px;
            position: absolute;
            top: 40%;
            left: 0;
        }
        .input-title::before{
            left: 100%;
        }
        .card{
            border-radius: 22px!important;
            overflow: hidden;
            border-color: var(--bs-blue);
        }
        .divider{
            color: #ccc;
            padding: 10px;
            display: flex;
            gap:8px;
            width: 100%;
            align-items: center;
        }
        .divider::after,.divider::before{
            content: '';
            height: 1px;
            width: 100%;
            background: linear-gradient(to right,#fff,#ccc,#fff);
        }
        
    </style>
</head>

<body>
    <div class="container">
    <a href="<?= base_url() ?>" style="text-decoration: none;" >
        <img src="./img/logo.jpg" alt="..." style="width: 80px;">
        - Prova de Conceito
    </a>
        <div class="p-4">
            
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link <?php if (!isset($ip_res)) {
                            echo 'active';
                        } ?>" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Calcular Frete</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link <?php if (isset($ip_res)) {
                        echo 'show active';
                    } ?>" id="incluir-tab" data-bs-toggle="tab" data-bs-target="#incluir" type="button" role="tab" aria-controls="incluir" aria-selected="false">Incluir Pedido</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="cancelar-tab" data-bs-toggle="tab" data-bs-target="#cancelar" type="button" role="tab" aria-controls="cancelar" aria-selected="false">Cancelar Pedido</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="rastrear-tab" data-bs-toggle="tab" type="button" role="tab" aria-controls="rastrear" data-bs-target="#rastrear" aria-selected="false">Rastrear Pedido</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="postos-coleta-tab" data-bs-toggle="tab" type="button" role="tab" aria-controls="postos-coleta" data-bs-target="#postos-coleta" aria-selected="false">Postos de Coleta</button>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <!-- Calcuar frete -->
                    <?php include './includes/calc-frete.php'?>
                <!-- Calcuar frete -->
                
                <!-- Incluir Pedido -->
                <?php include './includes/incluir-pedido.php'?>
                <!-- Incluir Pedido -->
                
                <!-- Cancelar Pedido -->
                <?php include './includes/cancelar-pedido.php'?>
                <!-- Cancelar Pedido -->

                <!-- Rastrear Pedido -->
                <?php include './includes/rastrear-pedido.php'?>
                <!-- Rastrear Pedido -->

                <!-- Postos de Coleta -->
                <?php include './includes/postos-coleta.php'?>
                <!-- Postos de Coleta -->
            </div>
        </div>

    </div>

    <footer class="border-top footer text-muted mt-5">
        <p class="text-center p-2 mt-2">
         Prova de conceito | Utilitário JadLog -  <?=date('Y')?>
        </p>
        <p class="text-center">
            <a href="<?= base_url() ?>" style="text-decoration: none;" >
                <img src="./img/logo.jpg" alt="..." style="width: 80px;">
            </a>
        </p>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

    <script>
        calcFrete.onsubmit = async (e) => {
            e.preventDefault()

            let url = 'actions.php'
            dados = {
                cepori: getOne('#calcFrete [name=cepori]').value,
                cepdes: getOne('#calcFrete [name=cepdes]').value,
                peso: getOne('#calcFrete [name=peso]').value,
                vldeclarado: getOne('#calcFrete [name=vldeclarado]').value,
                modalidade: getOne('#calcFrete [name=modalidade]').value,
                calcFrete: 'calcFrete'
            }
            url = url + '?' + in_get_string(dados)
            await fetch(url)
                .then(res => {
                    return res.json()
                })
                .then(dt => {
                    let saida = getOne('.saidaCalcFrete')
                    let valor = '' + dt.valor;
                    valor = valor.replace('.', ',')

                    if(dt.status){
                        saida.innerHTML = `<b>Valor:</b> R$ ${valor} <br><b>Prazo: </b>${dt.prazo} dias`
                        return;
                    }else{
                        
                        saida.innerHTML = `<div class="text-danger" ><b>Erro!</b> ${dt.msg}</div>`
                        return;
                    }

                    
                })
                .catch(erro => console.log(erro))
        }

        incluirPedido.onsubmit = async (e) => {
            let url = 'actions.php'
            dados = {

            }
            url = url + '?' + in_get_string(dados)
            await fetch(url)
                .then(res => {
                    return res.json()
                })
                .then(dt => {
                    console.log(dt);
                })
                .catch(erro => console.log(erro))
        }

        function getOne(seletor) {
            return document.querySelector(seletor)
        }

        function getAll(seletor) {
            return document.querySelectorAll(seletor)
        }

        function in_get_string(myObj) {
            let keys = Object.keys(myObj)
            let keysMap = keys.map(function(key) {
                return key + '=' + myObj[key]
            })
            let join = keysMap.join('&')
            return join;
        }
    </script>
</body>

</html>