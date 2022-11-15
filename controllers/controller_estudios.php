<?php

require_once('resources/config/db.php');
require_once('models/model_ult_estudios.php');

$estudios = new Estudios ();
$estudios->setTable("ult_estudios");
$estudios->setView('');

$estudios->setKey('id_estudio');

$dtest = $estudios->getAll();


?>