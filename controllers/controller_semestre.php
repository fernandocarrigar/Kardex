<?php

require_once('resources/config/db.php');
require_once('models/model_semestre.php');

$semestre = new Semestre();
$semestre->setTable("semestre");
$semestre->setView('');

$semestre->setKey('id_semestre');

$dtsmt = $semestre->getAll();


?>