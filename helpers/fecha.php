<?php
setlocale(LC_TIME, 'es_VE.UTF-8');
echo "Hora en Venezuela: " . date("d/m/Y h:i:s a");
echo "<br>";

date_default_timezone_set('America/Lima');
setlocale(LC_TIME, 'es_PE.UTF-8');
echo "Hora en Perú: " . date("d/m/Y h:i:s a");
echo "<br>";

date_default_timezone_set('Asia/Hong_Kong');
setlocale(LC_TIME, 'es_PE.UTF-8');
echo "Hora en Hong Kong: " . date("d/m/Y h:i:s a");
echo "<br>";

date_default_timezone_set('America/Santiago');
setlocale(LC_TIME, 'es_PE.UTF-8');
echo  "Hora en Santiago de Chile: " .  date("d/m/Y h:i:s a");

$fecha = date("d/m/Y");
echo "<br><br>fecha: " . $fecha;
$fecha_f =  DateTime::createFromFormat('d/m/Y', $fecha);

$fecha_to_time = strtotime($fecha_f->format("Y-m-d"));
$string_date =  strftime("%d %B %Y", $fecha_to_time);
echo "<br><br>fecha format: " . $string_date;
?>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
<script src="jquery/jquery.js" type="text/javascript" ></script>
<script src="bootstrap/js/bootstrap.min.js"  type="text/javascript"></script>



jQuery(document).find('.ps').each(function(){
		var href = jQuery(this).attr('rel');
		var text = jQuery(this).html();
		jQuery(this).replaceWith('<a href="'+href+'">'+text+'</a>');
	});

    jQuery(document).find('.psf').each(function(){
		var href = jQuery(this).attr('rel');
		var text = jQuery(this).html();
		jQuery(this).replaceWith('<a id="cookie_action_close_header" class="medium cli-plugin-button cli-plugin-main-button" href="'+href+'">'+text+'</a>');
	});



<style type="text/css">
						
    .GanadiarioZonaResultados {
        width: 250px;
        margin: 10px;
        float: left;
    }
    .GanadiarioZonaResultados .content .links{
        background: transparent url(images/gd-base-resultados.png) no-repeat scroll 0 bottom;
        padding-left: 10px;
        padding-bottom: 10px;
        text-align: left;
        overflow: hidden;
    }
    .GanadiarioZonaResultados .content .links .icon {
        background: transparent url(images/icon-vermas.png) no-repeat scroll 0 0;
        display: block;
        float: left;
        font-size: 0;
        height: 19px;
        margin-right: 5px;
        width: 19px;
    }
    .GanadiarioZonaResultados .content .links .view-more {
        float: left;
        padding: 4px 0;
    }
    .GanadiarioZonaResultados .content .links .view-more a {
        color: #757575;
        font-family: Arial,Helvetica,sans-serif;
        font-size: 11px;
        font-weight: bold;
        line-height: 1;
        text-decoration: none;
        text-transform: uppercase;
    }

    .GanadiarioZonaResultados .include {
        margin-bottom: 0;
    }
				
</style>


		
			 <div class="WebContentContainer">
				<div class="WebContentInformation">					
				</div>
				<div class="GanadiarioZonaResultados">
                    <div class="content">
                        <div class="include">
                            <iframe allowtransparency="true" frameborder="0" height="304px" scrolling="no" src="http://portal.intralot.com.pe/web_result_ganadiario.html" width="250px"></iframe></div>
                        <div class="links">
                            <div class="icon">+</div>
                            <div class="view-more">
                                <a data-toggle="modal" data-target="#resultadosAnterioresModal" href="">VER RESULTADOS ANTERIORES</a>
                                
                            </div>
                                
                        </div>
                    </div>          
		    
			    </div>
		    </div>
         
         <!-- <a href="javascript:openDivLayer('resultados','ganadiario','https://zonasegura.intralot.com.pe/i.do?m=resultados&amp;t=0&amp;s=164',600,480);">VER RESULTADOS ANTERIORES</a></div> -->




<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#valoracionDetalleModal">
  Launch demo modal
</button>


<!--Inicio Modal ResultadosAnteriores -->
<div class="modal fade" id="resultadosAnterioresModal" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-md" >
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Resultados anteriores</h4>
        </div>
        <div class="modal-body" style="padding:2px;" id="myModalBody">
        <iframe width="590" frameborder="0" height="516" src="https://zonasegura.intralot.com.pe/i.do?m=resultados&t=0&s=164"></iframe>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
    </div>
</div>
<!--Fin Modal ResultadosAnteriores -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<div class="div-layer" id="generic-div-layer" style="display:none;">
	<div class="mask">	
	</div>		
	<div class="main">
		<div class="border-top"></div>
		<div class="body">

			<div class="close">
				<a href="javascript:closeDivLayer()">x</a>
			</div>
			<div class="title-icon"></div>
			<div class="content">
				<iframe id="generic-iframe" src="" frameborder="0" scrolling="auto" height="" width="">	
				</iframe>
			</div>
		</div>
		<div class="border-bottom"></div>
	</div>
</div>
