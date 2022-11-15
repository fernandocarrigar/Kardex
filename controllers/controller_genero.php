<?php

require_once('resources/config/db.php');
require_once('models/model_tp_genero.php');

$genero = new Genero ();
$genero->setTable("tp_genero");
$genero->setView('');

$genero->setKey('id_genero');

$dtgen = $genero->getAll();

foreach($dtgen as $rows):
    $id_gen = $rows['id_genero'];
    $gen = $rows['genero'];
endforeach;


?>