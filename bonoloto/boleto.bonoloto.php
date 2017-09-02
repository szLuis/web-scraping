<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/style.css" rel="stylesheet">    
</head>
<body>
<?php
try{
    function getFechaEs($fechaActual, $formato = "%d %B %Y"){
        setlocale(LC_TIME, 'es_PE.UTF-8');
        $fecha_f =  DateTime::createFromFormat('d/m/Y', $fechaActual);  // crear fecha a partir de formato ES
        $fecha_to_time = strtotime($fecha_f->format("Y-m-d"));          // convertir a UNIX time
        $fecha_string = strftime($formato, $fecha_to_time);           // convertido a formato con mes en texto
        return $fecha_string;
    }


    $html = file_get_contents('http://www.loteriasyapuestas.es/es/bonoloto', NULL,  NULL);

    if ($html=== false){
        exit ("No se pudo cargar la información de la página de resultados.");
    }else if ($html !== false) {
        

        $domDoc = new DOMDocument();
        $domDoc->loadHTML($html);

        $xpath = new DOMXPath($domDoc);


        $fecha_sorteo_tag = $xpath->query("//*[@id='lastResultsTitleLink']"); 
        $fecha_sorteo_valor = substr(trim($fecha_sorteo_tag->item(0)->nodeValue),-10);
       
        $fecha_es = ucfirst(getFechaEs($fecha_sorteo_valor,"%A, %d de %B de %Y"));
        // echo $fecha_es;

        $valores_tag = $xpath->query("//*[@id='contenedor_ajax']/div/div[2]/div[1]/ul");
        $valores_bolillas = trim($valores_tag->item(0)->nodeValue);

        $bolillas = explode(" ", $valores_bolillas); 

        $complementario_tag = $xpath->query("//*[@id='contenedor_ajax']/div/div[2]/div[2]/span[1]"); 
        $complementario_valores_bolilla = trim($complementario_tag->item(0)->nodeValue);
       
        // echo $complementario_valores_bolilla;

        $reintegro_tag = $xpath->query("//*[@id='contenedor_ajax']/div/div[2]/div[2]/span[2]"); 
        $reintegro_tag_valores_bolilla = trim($reintegro_tag->item(0)->nodeValue);
       
        // echo $reintegro_tag_valores_bolilla;

        echo '<div id="content-left-1">
                <div id="imagen-sorteo">
                    <!-- <img src="images/logo-bonoloto.png" width="96" height="87" data-pin-nopin="true">  -->
                    <h3>SORTEO</h3>
                    <p id="fecha_string">'.  $fecha_es .'</p>
                </div>
                <div id="ganadores-ball">
                    <ul class="loto-ballgs">
                        <li class="loto-ball-g"><span>'.  $bolillas[0] .'</span></li>
                        <li class="loto-ball-g"><span>'.  $bolillas[1] .'</span></li>
                        <li class="loto-ball-g"><span>'.  $bolillas[2] .'</span></li>
                        <li class="loto-ball-g"><span>'.  $bolillas[3] .'</span></li>
                        <li class="loto-ball-g"><span>'.  $bolillas[4] .'</span></li>
                        <li class="loto-ball-g"><span>'.  $bolillas[5] .'</span></li>
                    </ul>
                    <ul class="loto-ballgs" style="margin-top:10px;">
                        <li style="background: none; margin-top: -10px; margin-right: 3.8em;">Complementario</li>
                        <li id="complementario" class="loto-ball-g"><span>'.  $complementario_valores_bolilla .'</span></li>
                        <li style="background: none; margin-top: -10px; margin-right: 18px; padding-left: .7em;">Reintegro</li>
                        <li id="reintegro" class="loto-ball-g"><span>'.  $reintegro_tag_valores_bolilla .'</span></li>
                    </ul>
                </div>
            </div>';

    }
}

catch (Exception $e){
    echo '<div id="content-left-1">
    <div id="imagen-sorteo">
        <!-- <img src="images/logo-bonoloto.png" width="96" height="87" data-pin-nopin="true">  -->
        <h3>SORTEO</h3>
        <p id="fecha_string">Domingo 13 de Diciembre de 2017</p>
    </div>
    <div id="ganadores-ball">
        <ul class="loto-ballgs">
            <li class="loto-ball-g"><span>'.  $custom_fields['num1'][0] .'</span></li>
            <li class="loto-ball-g"><span>'.  $custom_fields['num1'][0] .'</span></li>
            <li class="loto-ball-g"><span>'.  $custom_fields['num1'][0] .'</span></li>
            <li class="loto-ball-g"><span>'.  $custom_fields['num1'][0] .'</span></li>
            <li class="loto-ball-g"><span>'.  $custom_fields['num1'][0] .'</span></li>
            <li class="loto-ball-g"><span>'.  $custom_fields['num1'][0] .'</span></li>
        </ul>
        <ul class="loto-ballgs" style="margin-top:10px;">
            <li style="background: none; margin-top: -10px; margin-right: 3.8em;">Complementario</li>
            <li id="complementario" class="loto-ball-g"><span>30</span></li>
            <li style="background: none; margin-top: -10px; margin-right: 18px; padding-left: .7em;">Reintegro</li>
            <li id="reintegro" class="loto-ball-g"><span>33</span></li>
        </ul>
    </div>
</div>';
}



?>

</body>

</html>



