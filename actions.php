<?php 
include_once __DIR__."/config.php";

$jadLog = new JadLog();

if(request()->get('calcFrete')){

    $base_api = 'http://localhost/_api';
    $dados = [
        "cepori"=>trim(str_replace('-','',$_REQUEST['cepori'])),
        "cepdes"=>trim(str_replace('-','',$_REQUEST['cepdes'])),
        "peso"=>$_REQUEST['peso'],
        "vldeclarado"=>($_REQUEST['vldeclarado']),
        "modalidade"=>$_REQUEST['modalidade']
    ];

    

    $response = $jadLog->calcFrete([
        "cepori"=>trim(str_replace('-','',$_REQUEST['cepori'])),
        "cepdes"=>trim(str_replace('-','',$_REQUEST['cepdes'])),
        "peso"=>$_REQUEST['peso'],
        "vldeclarado"=>$_REQUEST['vldeclarado'],
        "modalidade"=>$_REQUEST['modalidade']
    ]);

    
    if($response):
        $res = new stdClass;
        $res->status = 1;
        $res->valor = $response->frete[0]->vltotal ?? null;
        $res->prazo =$response->frete[0]->prazo ?? null;
        $res->jadlog_response = $response;

        Response::return()->json($res);

    else:
        Response::return()->json(['status'=>0,
        'msg'=>'Não foi possível obter resposta da Jadlog.','jadlog_response'=>$response]);
    endif;
    
}

if(request()->get('incluir_pedido')){
    
    $_REQUEST['ip_obs']= '';
    $dados = array(
        "conteudo"=>$_REQUEST['ip_conteudo'],
        "pedido"=>array($_REQUEST['ip_pedido']),
        "peso"=>$_REQUEST['ip_peso'],
        "valor"=>$_REQUEST['ip_valor'],
        "obs"=>$_REQUEST['ip_obs'],
        "destinatario"=>$_REQUEST['ip_dest'],
        "doc"=>$_REQUEST['ip_doc'],
        "rua"=>$_REQUEST['ip_rua'],
        "numero"=>$_REQUEST['ip_numero'],
        "bairro"=>$_REQUEST['ip_bairro'],
        "cidade"=>$_REQUEST['ip_cidade'],
        "uf"=>$_REQUEST['ip_uf'],
        "cep"=>$_REQUEST['ip_cep'],
        "fone"=>$_REQUEST['ip_fone'],
        "cel"=>$_REQUEST['ip_cel'],
        "email"=>$_REQUEST['ip_email'],
        "contato"=>$_REQUEST['ip_contato'],
        

    );
    $danfe = [
        "dfe"=>array(
            ["cfop"=>"",
            "danfeCte"=>"",
            "nrDoc"=>"DESC00000000",
            "serie"=>"",
            "tpDocumento"=>0,
            "valor"=>20.2]
        ),
        
    ];
    if($_REQUEST["ip_dfe"]){
        $danfe = [
            "dfe"=>array(
                ["cfop"=>$_REQUEST["ip_dfe"],
                "danfeCte"=>"00000000000000000000000000000000000000000000",
                "nrDoc"=>"00000000",
                "serie"=>"1",
                "tpDocumento"=>2,
                "valor"=>20.2]
            ),
            
        ]; 
    }
    $volume = [
        "volume"=>array(
            ["altura"=>10,
            "comprimento"=>10,
            "identificador"=>"1234567890",
            "largura"=>10,
            "peso"=>1.0]
        ),
    ];
    $dados = array_merge($dados,$danfe);
    $dados = array_merge($dados,$volume);
    vd($danfe,"Dados incluir pedido","p");
    $response = $jadLog->incluirPedido($dados);
    vd($response,"Resposta incluir pedido","p");

    $ip_res = $response;
}

if(request()->get('action') == 'obterPostosDeColeta'){
    $cep = request()->get('cep');
    Response::return()
    ->dump(
        jadlog()->pickup($cep),
        "CEP $cep"
    );
}
    


?>