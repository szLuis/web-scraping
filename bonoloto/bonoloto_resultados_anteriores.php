<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/style.css" rel="stylesheet">
    <script src="../jquery/jquery.min.3.js"></script>
    
</head>
<body>
<?php

function is_page($pagina){
    if ("anteriores" === $pagina )
    return true;
}

if( is_page( 'anteriores'  )){
 //if( is_page( array('anteriores', 'lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'hoy-lunes', 'hoy-martes', 'hoy-viernes', 'ayer')) ){
    function print_boleto($newxpath, $i, $fecha_sorteo_valor){
 $valores_tag = $newxpath->query("//*[@id='drawsList']/div[" . $i . "]/div[2]/div[2]/div[1]/ul/li[1]");
 $bolillas1 = trim($valores_tag->item(0)->nodeValue);

 $valores_tag = $newxpath->query("//*[@id='drawsList']/div[" . $i . "]/div[2]/div[2]/div[1]/ul/li[2]");
 $bolillas2 = trim($valores_tag->item(0)->nodeValue);

 $valores_tag = $newxpath->query("//*[@id='drawsList']/div[" . $i . "]/div[2]/div[2]/div[1]/ul/li[3]");
 $bolillas3 = trim($valores_tag->item(0)->nodeValue);

 $valores_tag = $newxpath->query("//*[@id='drawsList']/div[" . $i . "]/div[2]/div[2]/div[1]/ul/li[4]");
 $bolillas4 = trim($valores_tag->item(0)->nodeValue);

 $valores_tag = $newxpath->query("//*[@id='drawsList']/div[" . $i . "]/div[2]/div[2]/div[1]/ul/li[5]");
 $bolillas5 = trim($valores_tag->item(0)->nodeValue);

 $valores_tag = $newxpath->query("//*[@id='drawsList']/div[" . $i . "]/div[2]/div[2]/div[1]/ul/li[6]");
 $bolillas6 = trim($valores_tag->item(0)->nodeValue);

 
 $complementario_tag = $newxpath->query("//*[@id='drawsList']/div[" . $i . "]/div[2]/div[2]/div[2]/ul/li/span"); 
 $complementario_valores_bolilla = trim($complementario_tag->item(0)->nodeValue);
 
 $reintegro_tag = $newxpath->query("//*[@id='drawsList']/div[" . $i . "]/div[2]/div[2]/div[3]/ul/li/span"); 
 $reintegro_tag_valores_bolilla = trim($reintegro_tag->item(0)->nodeValue);

 echo '<div id="content-left-1">
         <div id="imagen-sorteo">
             <!-- <img src="images/logo-bonoloto.png" width="96" height="87" data-pin-nopin="true">  -->
             <h3>SORTEO</h3>
             <p id="fecha_string">'.  $fecha_sorteo_valor .'</p>
         </div>
         <div id="ganadores-ball">
             <ul class="loto-ballgs">
                 <li class="loto-ball-g"><span>'.  $bolillas1 .'</span></li>
                 <li class="loto-ball-g"><span>'.  $bolillas2 .'</span></li>
                 <li class="loto-ball-g"><span>'.  $bolillas3 .'</span></li>
                 <li class="loto-ball-g"><span>'.  $bolillas4 .'</span></li>
                 <li class="loto-ball-g"><span>'.  $bolillas5 .'</span></li>
                 <li class="loto-ball-g"><span>'.  $bolillas6 .'</span></li>
             </ul>
             <ul class="loto-ballgs" style="margin-top:10px;">
                 <li style="background: none; margin-top: -10px; margin-right: .1em; width:auto;">Complementario</li>
                 <li id="complementario" class="loto-ball-g"><span>'.  $complementario_valores_bolilla .'</span></li>
                 <li style="background: none; margin-top: -10px; margin-right: 5px; padding-left: .2em; width:auto;">Reintegro</li>
                 <li id="reintegro" class="loto-ball-g"><span>'.  $reintegro_tag_valores_bolilla .'</span></li>
             </ul>
         </div>
     </div>
     <div style="clear:both;margin-bottom: 25px;"></div>';

}

$html = file_get_contents('http://www.loteriasyapuestas.es/es/bonoloto', NULL,  NULL);

if ($html=== false){
 exit ("No se pudo cargar la información de la página de resultados.");
}elseif ($html !== false) {
 

 $domDoc = new DOMDocument();
 $domDoc->loadHTML($html);

 $xpath = new DOMXPath($domDoc);

 $link_resultados_anteriores = $xpath->query("//*[@id='contenedor_ajax']/div/div[3]/div[2]/a"); 
 $link_resultados_anteriores_value =  "http://www.loteriasyapuestas.es/" . $link_resultados_anteriores->item(0)->getAttribute('href');
 
 try{
    function getFechaEs($fechaActual, $formato = "%d %B %Y"){
         setlocale(LC_TIME, 'es_ES.UTF-8');
         $fecha_f =  DateTime::createFromFormat('d/m/Y', $fechaActual);  // crear fecha a partir de formato ES
         $fecha_to_time = strtotime($fecha_f->format("Y-m-d"));          // convertir a UNIX time
         $fecha_string = strftime($formato, $fecha_to_time);           // convertido a formato con mes en texto
         return $fecha_string;
     }

     $html_resultados_anteriores = file_get_contents($link_resultados_anteriores_value, NULL,  NULL);
 
     $newdomDoc = new DOMDocument();
     
     $newdomDoc->loadHTML($html_resultados_anteriores);
     
     $newxpath = new DOMXPath($newdomDoc);

     
     $resultados_anteriores = $newxpath->query("//*[@id='drawsList']"); 
     echo '<div style="float:left; margin-right: 25px;">';
     
     for ($i=1; $i < 11 ; $i++) { 
         
         $fecha_sorteo_tag = $newxpath->query("//*[@id='drawsList']/div[" . $i . "]/div[2]/div[1]/div[1]/h3");
         $fecha_sorteo_valor = ucfirst(substr(trim($fecha_sorteo_tag->item(0)->nodeValue),16));

         $dia = explode(" ",$fecha_sorteo_valor);

         if (is_page('anteriores')){
             print_boleto($newxpath, $i, $fecha_sorteo_valor);

         }elseif ( (is_page('lunes') || is_page('hoy-lunes') )&& $i < 7 && $dia[0] === "Lunes") {
             print_boleto($newxpath, $i, $fecha_sorteo_valor);
             break;   
         }elseif ( (is_page('martes') || is_page('hoy-martes') ) && $i < 7 && $dia[0] === "Martes") {
             print_boleto($newxpath, $i, $fecha_sorteo_valor);
             break;   
         }elseif ( (is_page('miercoles') || is_page('hoy-miercoles') ) && $i < 7 && $dia[0] === "Miércoles") {
             print_boleto($newxpath, $i, $fecha_sorteo_valor);
             break;   
         }elseif ( (is_page('jueves') || is_page('hoy-jueves') ) && $i < 7 && $dia[0] === "Jueves") {
             print_boleto($newxpath, $i, $fecha_sorteo_valor);
             break;   
         }elseif ( (is_page('viernes') || is_page('hoy-viernes') ) && $i < 7 && $dia[0] === "Viernes") {
             print_boleto($newxpath, $i, $fecha_sorteo_valor);
             break;   
         }elseif ( (is_page('sabado') || is_page('hoy-sabado') ) && $i < 7 && $dia[0] === "Sábado") {
             print_boleto($newxpath, $i, $fecha_sorteo_valor);
             break;   
         }elseif ( is_page('ayer')  && $i === 2 ) {
             print_boleto($newxpath, $i, $fecha_sorteo_valor);
             break;   
         }

     }

    echo '</div>';
     
 }

 catch(Exception $e){
    echo "No se pudo cargar la información de la página de resultados.";
 }

} 
}

?>
   
</body>
</html>