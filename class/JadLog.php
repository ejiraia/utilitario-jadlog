<?php 

class JadLog{

    private $url_incluir = "https://www.jadlog.com.br/embarcador/api/pedido/incluir?";
    private $url_frete = "https://www.jadlog.com.br/embarcador/api/frete/valor?";
    private $url_tracking = "https://www.jadlog.com.br/embarcador/api/tracking/consultar?";
    private $url_pedido_cancelar = "https://www.jadlog.com.br/embarcador/api/pedido/cancelar?";
    public $url_consultar_XML_DACTE = 'https://www.jadlog.com.br/embarcador/api/cte/xml?';
    private $url_pickup = "https://www.jadlog.com.br/embarcador/api/pickup/pudos/";

    private $cnpj = "13951650000164";

    private $key = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOjEyMjk0NiwiZHQiOiIyMDIzMDMzMCJ9.LtGnGaZXzFRyRAsFZRBes7UU8ex0qdspuzeuAFkdoNw";

    public $headers;

    public function __construct()
    {
        $this->headers = array(
            'Content-Type: application/json',
            'description: ',
            'Authorization: Bearer '.$this->key
        );
    }

    static function use(){
        return new Self;
    }

    public function postDados($url = '',$post_data = ''){

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => $this->headers,
        CURLOPT_POST=>1,
        CURLOPT_POSTFIELDS=>json_encode($post_data),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return json_decode($response);
    }

    public function postDadosXml($url = '',$post_data = ''){

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => $this->headers,
        CURLOPT_POST=>1,
        CURLOPT_POSTFIELDS=>json_encode($post_data),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    public function calcFrete($dados = ''){
        
        $dt = (object)$dados;
        $dados_frete = [
            "cepori"=> str_replace('-','',$dt->cepori),
            "cepdes"=> str_replace('-','',$dt->cepdes),
            "frap"=> "N",
            "peso"=> $dt->peso,
            "cnpj"=> $this->cnpj,
            "conta"=> "",
            "contrato"=> "000",
            "modalidade"=> $dt->modalidade,
            "tpentrega"=> "D",
            "tpseguro"=> "N",
            "vldeclarado"=> $dt->vldeclarado,
            "vlcoleta"=> null,

        ];
        $post_data = [
            "frete"=>[$dados_frete]
        ];

        $res = $this->postDados($this->url_frete,$post_data);
        return $res;
    }

    public function incluirPedido($dados = ''){

        $dt = (object)$dados;

        $post_data = array(
            "conteudo"=>$dt->conteudo,
            "pedido"=>$dt->pedido,//array()
            "totPeso"=>$dt->peso,
            "totValor"=>$dt->valor,
            "obs"=>$dt->obs,
            "modalidade"=>9,
            "contaCorrente"=>"",
            "tpColeta"=>"K",
            "tipoFrete"=>0,
            "cdUnidadeOri"=>"1601",
            "cdUnidadeDes"=>null,
            "cdPickupOri"=>null,
            "cdPickupDes"=>null,
            "nrContrato"=>12345,
            "servico"=>1,
            "shipmentId"=>null,
            "vlColeta"=>null,
            "rem"=>[
            "nome"=>"Giftpar",
            "cnpjCpf"=>$this->cnpj,
            "ie"=>null,
            "endereco"=>"ANNE FRANK",
            "numero"=>"870",
            "compl"=>null,
            "bairro"=>"HAUER",
            "cidade"=>"CURITIBA",
            "uf"=>"PR",
            "cep"=>"81610020",
            "fone"=>"41 3077-7620",
            "cel"=>"41 3077-7620",
            "email"=>"eliton@giftconsult.com.br",
            "contato"=>"ELITON"
            ],
            "des"=>[
            "nome"=>$dt->destinatario,
            "cnpjCpf"=>$dt->doc,
            "ie"=>null,
            "endereco"=>$dt->rua,
            "numero"=>$dt->numero,
            "compl"=>null,
            "bairro"=>$dt->bairro,
            "cidade"=>$dt->cidade,
            "uf"=>$dt->uf,
            "cep"=>$dt->cep,
            "fone"=>$dt->fone,
            "cel"=>$dt->cel,
            "email"=>$dt->email,
            "contato"=>$dt->contato
            ],
            "dfe"=>$dt->dfe,//array()
            "volume"=>$dt->volume//array()

        );

        
        $res = $this->postDados($this->url_incluir,$post_data);
        return $res;
    }

    public function tracking($dados = ''){
        $post_data = [
            "consulta"=>array($dados),
            
        ];
        $res = $this->postDados($this->url_tracking,$post_data);
        return $res;
    }

    public function pickup($cep = ''){
        $post_data = [];
        $cep = preg_replace('/^[0-9]/','',$cep);
        $url = $this->url_pickup.$cep;
        $res = $this->postDados($url,$post_data);
        return $res;
    }

    public function cancelarPedido($dados = ''){

        $post_data = $dados;
        $res = $this->postDados($this->url_pedido_cancelar,$post_data);
        return $res;
    }
    
    public function consultarXmlDACTE(){
        
        
        $post_data = array(
            "dacte"=>'41230604884082001107570000121171041121171040'
        );
        $res = $this->postDadosXml($this->url_consultar_XML_DACTE,$post_data);
        return $res;
    }
    
}
?>
