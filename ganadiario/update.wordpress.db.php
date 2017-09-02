<?php
$usuario = "root";
$pass = "**";

$mysqli = new mysqli("localhost", $usuario, $pass, "wordpress");

if ($mysqli->connect_errno) {
    exit("Problemas al intentar conectarse al servidor de base de datos.");
}

$html = file_get_contents('index.html', NULL,  NULL, 0, 8183);
//$html = file_get_contents('https://zonasegura.intralot.com.pe/i.do?m=historico&t=0&s=164',NULL, NULL, 0, 21700);
echo $html;
exit();
if (!$html){
    exit ("No se pudo cargar la información de la página de resultados.");
}else if ($html) {
    date_default_timezone_set('America/Lima');

    $dd = new DOMDocument();
    $dd->loadHTML($html);
    $tabla = $dd->getElementsByTagName('table')->item(1);
    $trows = $tabla->getElementsByTagName('tr');
    $i = 0;
    foreach ($trows as $tr) {
        $tds = $tr->getElementsByTagName('td');
        if($tds->length >= 3) {
            
            $fechaActual = "27/07/2017";            

            $ult_fecha_sorteo = trim($tds->item(0)->nodeValue); // fecha para validar update DB

                
                $fecha_sorteo = explode("/", $tds->item(0)->nodeValue);
                $dia = $fecha_sorteo[0];
                $mes = $fecha_sorteo[1];
                $year = $fecha_sorteo[2];
                echo "Fecha: " . $tds->item(0)->nodeValue . " <br>"; // A
                echo "Sorteo: " . $tds->item(1)->nodeValue . " <br>"; // B
                $balls =  $tds->item(2)->nodeValue;
                $bolillas = explode(" ", $balls);
                
                echo "<br>Bolilla 1: " . $bolillas[0] . " <br>"; // C
                echo "Bolilla 2: " . $bolillas[1] . " <br>"; // C
                echo "Bolilla 3: " . $bolillas[2] . " <br>"; // C
                echo "Bolilla 4: " . $bolillas[3] . " <br>"; // C
                echo "Bolilla 5: " . $bolillas[4] . " <br>"; // C
                if ($i == 7) break; // don't check any further rows

                $i++;

                echo "--------------------------------------------------<br>";
            //}
        }
    }

    //Actualizar título del post
    if($ult_fecha_sorteo === $fechaActual) {
    
        
        setlocale(LC_TIME, 'es_PE.UTF-8');
        $fecha_f =  DateTime::createFromFormat('d/m/Y', $fechaActual);  // crear fecha a partir de formato ES
        $fecha_to_time = strtotime($fecha_f->format("Y-m-d"));          // convertir a UNIX time
        $fecha_string = strftime("%d %B %Y", $fecha_to_time);           // convertido a formato con mes en texto
        $post_title = "Resultados Gana Diario " . $fecha_string ;       
        echo "<br> Nuevo título: " . $post_title;

        try{
            
            $mysqli->query ("UPDATE wp_postmeta SET meta_value='$bolillas[0]' WHERE meta_key='num1' AND post_id=25");
            $mysqli->query ("UPDATE wp_postmeta SET meta_value='$bolillas[1]' WHERE meta_key='num2' AND post_id=25");
            $mysqli->query ("UPDATE wp_postmeta SET meta_value='$bolillas[2]' WHERE meta_key='num3' AND post_id=25");
            $mysqli->query ("UPDATE wp_postmeta SET meta_value='$bolillas[3]' WHERE meta_key='num4' AND post_id=25");
            $mysqli->query ("UPDATE wp_postmeta SET meta_value='$bolillas[4]' WHERE meta_key='num5' AND post_id=25");

            $mysqli->query ("UPDATE wp_postmeta SET meta_value='$dia' WHERE meta_key='dia' AND post_id=25");
            $mysqli->query ("UPDATE wp_postmeta SET meta_value='$mes' WHERE meta_key='mes' AND post_id=25");
            $mysqli->query ("UPDATE wp_postmeta SET meta_value='$year' WHERE meta_key='ano' AND post_id=25");

            $mysqli->query ("UPDATE wp_posts SET post_title='$post_title' WHERE ID=25");
            

            echo "<br> Todos los datos han sido actualizados.";
        }

        catch(Exception $e){
            echo $e->getMessage();
        }
    }
}

?>