<?php

$html = file_get_contents('http://www.loteriasyapuestas.es/es/bonoloto', NULL,  NULL);
header("Content-Type:text/plain");
echo $html;
?>