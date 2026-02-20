<?php 
class Dotenv{
    
    public static function  mount($val = ''){
        if(!is_string($val)){
            return 0;
        }
        $linhas = file($val);
        foreach($linhas as $linha){
            $linha_valor = trim( $linha); 
            
            if(trim($linha) == '' || strpos($linha_valor,'#') === 0){
                continue;
            }
            
            $linha = preg_replace('/=/','*=*',$linha,1);
            $linha = str_replace("'","",$linha);
            $linha = str_replace('"','',$linha);
            
            
            $env = explode('*=*',$linha);
            if(strpos('#',$env[0]) < -1){
                
                $_ENV["$env[0]"] = $env[1] ?? null;
                putenv($linha_valor);
            }
            
        }
        return $_ENV;

    }
    
}
?>