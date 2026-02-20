<?php 

class Request{

    private array $atributes;

    public function __construct() {
        $this->atributes = [
            "method"=>strtolower($_SERVER['REQUEST_METHOD']),
            ...$_REQUEST,
            ...$_FILES,
            
        ];
    }

    public function __get($name)
    {
        return $this->atributes[$name] ?? null;
    }

    public function __set($name, $value)
    {
        $this->atributes[$name] = $value;
    }

    public function get(string $name){
        if(isset($this->atributes[$name])){
            return $this->atributes[$name];
        }
        return null;
    }

    public function all(){
        return $this->atributes;
    }

    public function method(string $type = null){
        if($type){
            $this->atributes['method'] = strtolower($type);
            return $this;
        }
        return strtolower($this->get('method'));
    }

    public function make(array $atributes)
    {
        $this->atributes = $atributes;
        return $this;
    }

    static function use(){
        return new Self;
    }
}

?>