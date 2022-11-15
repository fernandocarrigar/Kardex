<?php

require_once('controllers/controller_kardex.php');

foreach($dtkdx as $row):
    $tipo = $row['TypeArchivo5'];
    $doc = $row['Archivo5'];
?>
<title>Kardex.pdf</title>
<?php
    echo '<iframe src="data:'. $tipo .'; base64,'. base64_encode($doc) .'" style="width:100%;height:100%;margin:0;">hola</iframe>';
endforeach;
?>

