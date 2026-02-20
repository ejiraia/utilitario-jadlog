<?php 

function base_url(){
    
    if(empty($_SERVER['HTTPS'])){
        if(defined('PREFIXO')):
        $res = "http://".BASE_URL.'/';
        else:
            $res = "http://".BASE_URL.'/';
        endif;
    }else{
        if(defined('PREFIXO')):
            $res = "https://".BASE_URL.'/';
            else:
                $res = "https://".BASE_URL.'/';
            endif;
    }
    return $res;
    
  }
  function base_dir(){
    return BASE_DIR;
  }
  function url($path = ''){
    return base_url().$path;
  }


function vd($val,$titulo = '',$tagTitulo = "h2"){
    if($titulo != ''){
        echo "<$tagTitulo style='color:#88a;font-family: sans-serif;'>\"$titulo\"</$tagTitulo>";
    }
    var_dump_formatado($val,);
}

function dd($val){
    var_dump_formatado($val);
    die();
}

function pr($val,$titulo = '',$tagTitulo = "h2"){
    if($titulo != ''){
        echo "<$tagTitulo style='color:#88a;font-family: sans-serif;'>\"$titulo\"</$tagTitulo>";
    }
    print_r_formatado($val);
}

function pd($val){
    print_r_formatado($val);
    die();
}


function formatarDoc($doc){
    $naoPermitidos = [
        '.',
        '-',
        '/',
        ' '
    ];
    foreach($naoPermitidos as $item){
        $doc = str_replace($item,'',$doc);
    }
    return $doc;
}

function request(){
    return Request::use();
}

function var_dump_formatado($data, $label='', $return = false) {

    $debug = debug_backtrace();
    $callingFile = $debug[0]['file'];
    $callingFileLine = $debug[0]['line'];

    ob_start();
    var_dump($data);
    $c = ob_get_contents();
    ob_end_clean();

    $c = preg_replace("/\r\n|\r/", "\n", $c);
    $c = str_replace("]=>\n", '] = ', $c);
    $c = preg_replace('/= {2,}/', '= ', $c);
    $c = preg_replace("/\[\"(.*?)\"\] = /i", "[$1] = ", $c);
    $c = preg_replace('/  /', "    ", $c);
    $c = preg_replace("/\"\"(.*?)\"/i", "\"$1\"", $c);
    $c = preg_replace("/(int|float)\(([0-9\.]+)\)/i", "$1() <span class=\"number\">$2</span>", $c);

    // Syntax Highlighting of Strings. This seems cryptic, but it will also allow non-terminated strings to get parsed.
    $c = preg_replace("/(\[[\w ]+\] = string\([0-9]+\) )\"(.*?)/sim", "$1<span class=\"string\">\"", $c);
    $c = preg_replace("/(\"\n{1,})( {0,}\})/sim", "$1</span>$2", $c);
    $c = preg_replace("/(\"\n{1,})( {0,}\[)/sim", "$1</span>$2", $c);
    $c = preg_replace("/(string\([0-9]+\) )\"(.*?)\"\n/sim", "$1<span class=\"string\">\"$2\"</span>\n", $c);

    $regex = array(
        // Numbers
        'numbers' => array('/(^|] = )(array|float|int|string|resource|object\(.*\)|\&amp;object\(.*\))\(([0-9\.]+)\)/i', '$1$2(<span class="number">$3</span>)'),
        // Keywords
        'null' => array('/(^|] = )(null)/i', '$1<span class="keyword">$2</span>'),
        'bool' => array('/(bool)\((true|false)\)/i', '$1(<span class="keyword">$2</span>)'),
        // Types
        'types' => array('/(of type )\((.*)\)/i', '$1(<span class="type">$2</span>)'),
        // Objects
        'object' => array('/(object|\&amp;object)\(([\w]+)\)/i', '$1(<span class="object">$2</span>)'),
        // Function
        'function' => array('/(^|] = )(array|string|int|float|bool|resource|object|\&amp;object)\(/i', '$1<span class="function">$2</span>('),
    );

    foreach ($regex as $x) {
        $c = preg_replace($x[0], $x[1], $c);
    }

    $style = '
    /* outside div - it will float and match the screen */
    .dumpr {
        background-color: #fbfbfb;
    }
    /* font size and family */
    .dumpr pre {
        color: #efefef;
        font-size: 11pt;
        /*font-family: "Courier New",Courier,Monaco,monospace;*/
        margin: 0px;
        padding-top: 5px;
        padding-bottom: 7px;
        padding-left: 9px;
        padding-right: 9px;
    }
    /* inside div */
    .dumpr div {
        padding:8px;
        background-color: #303035;
        border-radius: 4px;
        float: left;
        clear: both;
    }
    /* syntax highlighting */
    .dumpr span.string {color: LightSeaGreen;}
    .dumpr span.number {color: magenta;}
    .dumpr span.keyword {color: #007200;}
    .dumpr span.function {color: DeepSkyBlue;}
    .dumpr span.object {color: tomato;}
    .dumpr span.type {color: #0072c4;}
    ';

    $style = preg_replace("/ {2,}/", "", $style);
    $style = preg_replace("/\t|\r\n|\r|\n/", "", $style);
    $style = preg_replace("/\/\*.*?\*\//i", '', $style);
    $style = str_replace('}', '} ', $style);
    $style = str_replace(' {', '{', $style);
    $style = trim($style);

    $c = trim($c);
    $c = preg_replace("/\n<\/span>/", "</span>\n", $c);
    $data = $c;

    if ($label == ''){
        $line1 = '';
    } else {
        $line1 = "<strong>$label</strong> \n";
    }
    $linha_da_chamada = "$line1 $callingFile : $callingFileLine" ;
    $out = "\n<!-- Dumpr Begin -->\n".
        "<style type=\"text/css\">".$style."</style>\n".
        "<div class=\"dumpr\">
            <div>
                <pre>\n$data\n</pre>
            </div>
        </div>
        <div style=\"clear:both;\">&nbsp;</div>".
        "\n<!-- Dumpr End -->\n";
    if($return) {
        return $out;
    } else {
        echo $out;
    }
}

function print_r_formatado($data, $label='', $return = false) {

    $debug = debug_backtrace();
    $callingFile = $debug[0]['file'];
    $callingFileLine = $debug[0]['line'];

    ob_start();
    print_r($data);
    $data_string = ob_get_contents();
    ob_end_clean();

    $data_string = preg_replace("/\r\n|\r/", "\n", $data_string);
    $data_string = preg_replace("/\[/", "<span style='color:tomato;'>[</span>", $data_string);
    $data_string = preg_replace("/]/", "<span style='color:tomato;'>]</span>", $data_string);
    $data_string = preg_replace("/=>/", "<span style='color:magenta;'>=></span>", $data_string);
    $data_string = preg_replace("/Array/", "<span style='color:tomato;'>Array</span>", $data_string);
    $data_string = preg_replace("/Object/","<span style='color:pink;''>Object</span>",$data_string);
    $data_string = preg_replace("/stdClass/","<span style='color:DeepSkyBlue;''>stdClass</span>",$data_string);
    $data_string = preg_replace("/([0-9.])/", "<span style='color:BlueViolet'>$1</span>", $data_string);

    $style = '
    /* outside div - it will float and match the screen */
    .dumpr {
        background-color: #fbfbfb;
    }
    /* font size and family */
    .dumpr pre {
        color: #efefef;
        font-size: 11pt;
        /*font-family: "Courier New",Courier,Monaco,monospace;*/
        margin: 0px;
        padding-top: 5px;
        padding-bottom: 7px;
        padding-left: 9px;
        padding-right: 9px;
    }
    /* inside div */
    .dumpr div {
        padding:8px;
        background-color: #303035;
        border-radius: 4px;
        float: left;
        clear: both;
    }
    ';

    $style = preg_replace("/ {2,}/", "", $style);
    $style = preg_replace("/\t|\r\n|\r|\n/", "", $style);
    $style = preg_replace("/\/\*.*?\*\//i", '', $style);
    $style = str_replace('}', '} ', $style);
    $style = str_replace(' {', '{', $style);
    $style = trim($style);

    $data_string = trim($data_string);
    $data_string = preg_replace("/\n<\/span>/", "</span>\n", $data_string);
    $data = $data_string;

    if ($label == ''){
        $line1 = '';
    } else {
        $line1 = "<strong>$label</strong> \n";
    }
    $linha_da_chamada = "$line1 $callingFile : $callingFileLine" ;
    $out = "\n<!-- Dumpr Begin -->\n".
        "<style type=\"text/css\">".$style."</style>\n".
        "<div class=\"dumpr\">
        <div><pre>\n$data\n</pre></div></div><div style=\"clear:both;\">&nbsp;</div>".
        "\n<!-- Dumpr End -->\n";
    if($return) {
        return $out;
    } else {
        echo $out;
    }
}
function jadlog(){
    return JadLog::use();
}
?>