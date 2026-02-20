<?php 

class Response{

    public function json( array|object $data, int|string $code = 200){
        http_response_code($code);
        echo json_encode($data);
        die();
    }

    static function return(){
        return new Self;
    }

    public function dump( array|object $data,string $titulo = '',$tag = "h2"){
        vd($data,$titulo,$tag);
        die();
    }

    
}
?>