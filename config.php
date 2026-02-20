<?php 
include_once __DIR__."/functions.php";
include_once "./class/JadLog.php";

define('BASE_URL',$_SERVER["HTTP_HOST"]);
define("BASE_DIR",__DIR__);
//CAMINHOS DA RAIZ DO SITE:
define("INCLUDE_PATH", base_url());

spl_autoload_register(function ($class_name) {
    $file = __DIR__.'/class/'.$class_name.'.php';
    if(file_exists($file)){
        include_once $file;
    }
});

Dotenv::mount(__DIR__.DIRECTORY_SEPARATOR.'.env');
//dd(getenv('JADLOG_API_KEY'));

?>