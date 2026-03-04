<?php 

class BaseCLI{

    protected array $args;
    protected array $commands_list = [
        "--help" => "help",
        "-h" => "help",
        "serve" => "sobe um servidor na porta 5000",
        "--port=<port>" => "define a porta do servidor",
        "-d" => "define o diretório de start"
    ];

    public function __construct($argv)
    {
        $this->args = [
            ...$this->fomatarArgV($argv),
            ...$_REQUEST,
        ];
    }
    protected function fomatarArgV(array $argv):array{
        $res = [];
        foreach($argv as $arg){
            $data = explode("=",$arg);
            $str = $data[0];
            if(strpos('-',$str) === 0 && substr($str,0,2) != '-'){
                
                $new_data = [];
                $new_data[0] = substr($str,0,2);
                $new_data[1] = substr($str,2) ?? true;
                $data = $new_data;
            }
            $res[$data[0]] = $data[1] ?? true;

        }
        return $res;
    }
    public function get(string $name){
        return $this->args[$name] ?? null;
    }
    public function all(){
        return $this->args;
    }
    public function commands(){
        return $this->commands_list;
    }
}
?>