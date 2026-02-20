<?php 
include_once "./class/JadLog.php";
include_once "./functions.php";

function setStatus($st){
    switch ($st){
        case "CANCELADA A PEDIDO":
            return "CANCELADO";
            break ;
        default:
            return $st;
    }
}
function zebrar($val){
    if($val%2 == 0){
        return "bg-gray-300";
    }
    return "bg-white";
}
function setData($data){
    $newData = date('d/m/Y # H:i:s',strtotime($data));
    return str_replace('#','às',$newData);
}
$jadLog = new JadLog();
$res = $jadLog->tracking(["shipmentId"=>"12294600000002"]);
$dt = $res->consulta[0]->tracking;
//vd($dt);

$reqData = [
    "pedido"=>"91135",
    "shipmentId"=>"12294600000002"
];
$req = json_encode($reqData);

//vd(base64_encode($req));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rastrear Jadlog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-indigo-50">
<div class="p-4 shadow-md bg-white">
    <h2 class="text-2xl font-semibold">Rastrear Pedido n° 91135</h2>
</div>
<div class="p-4">
    <p class="font-bold">TRANSPORTADORA: <span class="text-gray-500">Jadlog</span></p>
    <h2 class="font-bold">STATUS: <span class="text-red-500"><?=setStatus($dt->status)?></span></h2>
    <br>
    
    <h2 class="font-bold text-3xl border-b border-b-gray-400 py-2 my-2">EVENTOS</h2>

    <table class="w-full">
        <thead>
            <tr class="bg-gray-500 text-white">
                <th class="text-left p-2">STATUS</th>
                <th class="text-left p-2">UNIDADE</th>
                <th class="text-left p-2">DATA</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($dt->eventos as $key => $ev): ?>
                <tr class="<?=zebrar($key+1)?>">
                    <td class="p-2"><?=$ev->status?></td>
                    <td class="p-2"><?=isset($ev->unidade)?$ev->unidade:' - '?></td>
                    <td class="p-2"><?=setData($ev->data)?>h</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


</div>
    
</body>
</html>