
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"> 
<base target="_parent" />
<link rel="stylesheet" type="text/css"href="css/web-result-ganadiario.css">
</head>
<body>
<div id="result-image">
	<img src="images/gd-background-resultado.png" title="Resultados Gana Diario">
	<?php

		date_default_timezone_set('America/Lima');

		function getFechaEs($fechaActual, $formato = "%d %B %Y"){
			setlocale(LC_TIME, 'es_PE.UTF-8');
			$fecha_f =  DateTime::createFromFormat('d/m/Y', $fechaActual);  // crear fecha a partir de formato ES
			$fecha_to_time = strtotime($fecha_f->format("Y-m-d"));          // convertir a UNIX time
			$fecha_string = strtoupper(strftime($formato, $fecha_to_time));           // convertido a formato con mes en texto
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
						$fechaActual = trim($tds->item(0)->nodeValue);;

						$balls =  $tds->item(2)->nodeValue;
						$bolillas = explode(" ", $balls);
						
						if ($i > 0){
							$fecha_es = getFechaEs($fechaActual,"%d %b"); // obtengo fecha en string español
							$dia_es = getFechaEs($fechaActual,"%A");

							echo '<div class="day"   id="day' . $i . '">' . $dia_es . '</div>
							<div class="ddmon" id="ddmon' . $i . '">' . $fecha_es . '</div>
							<div class="bolo" id="bolo' . $i . '1">'.  $bolillas[0] .'</div>
							<div class="bolo" id="bolo' . $i . '2">'.  $bolillas[1] .'</div>
							<div class="bolo" id="bolo' . $i . '3">'.  $bolillas[2] .'</div>
							<div class="bolo" id="bolo' . $i . '4">'.  $bolillas[3] .'</div>
							<div class="bolo" id="bolo' . $i . '5">'.  $bolillas[4] .'</div>';

						}
						
						$i++;

						if ($i == 7) break; 
						
					}
				}
			}
		}
		catch (Exception $e){
			
		}
	?>
</div>
</body>
</html>
