<?php
// if ( !(is_page('gana-diario-resultados-anteriores')) ){
    date_default_timezone_set('America/Lima');
    
    function getFechaEs($fechaActual){
        setlocale(LC_TIME, 'es_PE.UTF-8');
        $fecha_f =  DateTime::createFromFormat('d/m/Y', $fechaActual);  // crear fecha a partir de formato ES
        $fecha_to_time = strtotime($fecha_f->format("Y-m-d"));          // convertir a UNIX time
        $fecha_string = strftime("%d %B %Y", $fecha_to_time);           // convertido a formato con mes en texto
        return $fecha_string;
    }
    
    function getTituloPost($fecha_string){
        $post_title = "Resultados Gana Diario " . $fecha_string ;       
        return $post_title;
    }
    
    try{
        //$html = file_get_contents('index.html', NULL,  NULL, 0, 8183);
        $html = file_get_contents('https://zonasegura.intralot.com.pe/i.do?m=historico&t=0&s=164',NULL, NULL, 0, 8183);
    
        if ($html=== false){
            exit ("No se pudo cargar la información de la página de resultados.");
        }else if ($html !== false) {
            
    
            $dd = new DOMDocument();
            $dd->loadHTML($html);
    
            $tabla = $dd->getElementsByTagName('table')->item(1);
            $trows = $tabla->getElementsByTagName('tr');
            $i = 0;
            foreach ($trows as $tr) {
                $tds = $tr->getElementsByTagName('td');
                if($tds->length >= 3) {
                    $fechaActual = date("d/m/Y");
    
                    $balls =  $tds->item(2)->nodeValue;
                    $bolillas = explode(" ", $balls);
    
                    
                    
                    // $fechaActual = "27/07/2017";            
                    if ($i === 0 ){ // && ( !(is_page(array('de-ayer', 'resultados-de-ganadiario-del-dia-de-ayer', 'ayer', 'gana-diario-resultados-de-ayer', 'resultados-de-ganadiario-de-ayer'))) ) ){ // primer ciclo
                         $ult_fecha_sorteo = trim($tds->item(0)->nodeValue); // última fecha del sorteo
    
                        if ( $ult_fecha_sorteo != $fechaActual) {
                            $fechaActual = $ult_fecha_sorteo;
                        }
    
                        $fecha_es = getFechaEs($fechaActual); // obtengo fecha en string español
    
                        echo '<div id="content-left-1">
                        <div id="imagen-sorteo"><img src="https://resultadosganadiario.com/images/logo-gana-diario.png" width="165" height="85" data-pin-nopin="true"></div>
                        <div id="ganadores-ball">
                        <ul class="loto-ballgs">
                        <li class="loto-ball-g"><span>'.  $bolillas[0] .'</span></li>
                        <li class="loto-ball-g"><span>'.  $bolillas[1] .'</span></li>
                        <li class="loto-ball-g"><span>'.  $bolillas[2] .'</span></li>
                        <li class="loto-ball-g"><span>'.  $bolillas[3] .'</span></li>
                        <li class="loto-ball-g"><span>'.  $bolillas[4] .'</span></li>
                        </ul>
                        <p style="line-height: 20px;" class="fecha-sorteo">Sorteo: <br> ' . $fechaActual . '</p>
                        </div>
                        <p style="text-align: justify; padding-left: 30px; padding-right: 10px; line-height: 20px;" class="venta"><br>De venta todos los días<br>Sorteo de Lunes a Domingo a las 09:15 PM</p>
                        </div>';
    
    
                    } elseif ($i === 1 ){ // && is_page(array('de-ayer', 'resultados-de-ganadiario-del-dia-de-ayer', 'ayer', 'gana-diario-resultados-de-ayer', 'resultados-de-ganadiario-de-ayer') ) ){
    
                        $ult_fecha_sorteo = trim($tds->item(0)->nodeValue); // última fecha del sorteo
    
                        if ( $ult_fecha_sorteo != $fechaActual) {
                            $fechaActual = $ult_fecha_sorteo;
                        }
    
                        $fecha_es = getFechaEs($fechaActual); // obtengo fecha en string español
    
                        echo '<div id="content-left-1">
                        <div id="imagen-sorteo"><img src="https://resultadosganadiario.com/images/logo-gana-diario.png" width="165" height="85" data-pin-nopin="true"></div>
                        <div id="ganadores-ball">
                        <ul class="loto-ballgs">
                        <li class="loto-ball-g"><span>'.  $bolillas[0] .'</span></li>
                        <li class="loto-ball-g"><span>'.  $bolillas[1] .'</span></li>
                        <li class="loto-ball-g"><span>'.  $bolillas[2] .'</span></li>
                        <li class="loto-ball-g"><span>'.  $bolillas[3] .'</span></li>
                        <li class="loto-ball-g"><span>'.  $bolillas[4] .'</span></li>
                        </ul>
                        <p style="line-height: 20px;" class="fecha-sorteo">Sorteo: <br> ' . $fechaActual . '</p>
                        </div>
                        <p style="text-align: justify; padding-left: 30px; padding-right: 10px; line-height: 20px;" class="venta"><br>De venta todos los días<br>Sorteo de Lunes a Domingo a las 09:15 PM</p>
                        </div>';
    
                    }
                    
                    $i++;
    
                    if ($i == 7) break; 
                    
            }
    
            
            
        }
    
        }
    }
    catch (Exception $e){
         echo '<div id="content-left-1">
                    <div id="imagen-sorteo"><img src="https://resultadosganadiario.com/images/logo-gana-diario.png" width="165" height="85" data-pin-nopin="true"></div>
                    <div id="ganadores-ball">
                    <ul class="loto-ballgs">
                    <li class="loto-ball-g"><span>'.  $custom_fields['num1'][0] .'</span></li>
                    <li class="loto-ball-g"><span>'.  $custom_fields['num2'][0] .'</span></li>
                    <li class="loto-ball-g"><span>'.  $custom_fields['num3'][0] .'</span></li>
                    <li class="loto-ball-g"><span>'.  $custom_fields['num4'][0] .'</span></li>
                    <li class="loto-ball-g"><span>'.  $custom_fields['num5'][0] .'</span></li>
                    </ul>
                    <p style="line-height: 20px;" class="fecha-sorteo">Sorteo: <br> ' . $custom_fields['dia'][0]. '/' . $custom_fields['mes'][0] . '/' . $custom_fields['ano'][0] . '</p>
                    </div>
                    <p style="text-align: justify; padding-left: 30px; padding-right: 10px; line-height: 20px;" class="venta"><br>De venta todos los días<br>Sorteo de Lunes a Domingo a las 09:15 PM</p>
                    </div>';
    }
    
    // }
    


?>