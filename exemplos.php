<?php 
die();

$jadLog = new JadLog();

// para consultar o tracking
 $res = $jadLog->tracking(["shipmentId"=>"12294600000416"]);
 vd($res);

//para calcular o frete
$response = $jadLog->calcFrete([
    "cepori"=>trim(str_replace('-','',$_GET['cepori'])),
    "cepdes"=>trim(str_replace('-','',$_GET['cepdes'])),
    "peso"=>$_GET['peso'],
    "vldeclarado"=>$_GET['vldeclarado']
]);

// para cancelar um pedido

$cancela = $jadLog->cancelarPedido(["shipmentId"=>"12294600000425"]);
vd($cancela);

$cancela = $jadLog->cancelarPedido(["pedido"=>"Pedido 01 (teste ) "]);
vd($cancela);

?>