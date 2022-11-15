<?php

require_once('resources/config/db.php');
require_once('models/model_kardex.php');
require_once('controllers/controller_alumnos.php');
require_once('controllers/controller_archivos.php');

$kardex = new Kardex ();
$kardex->setTable("kardex");
$kardex->setView('view_kardex');

$kardex->setKey('id_kardex');

$kardex->setColumns('fch_reg_kardex');
$kardex->setColumns('id_alumno');
$kardex->setColumns('id_arc_curp');
$kardex->setColumns('id_arc_cmpbnt');
$kardex->setColumns('id_arc_foto');
$kardex->setColumns('id_arc_certf');
$kardex->setColumns('id_arc_pdf');

$fch_r = date('Y-m-d');     //OBTIENE LA FECHA ACTUAL

if ((!empty($_GET['id'])) && (isset($_GET['id'])))  {
    $id = $_GET['id'];
    $dtkdx = $kardex->getWhere($id);
}else{
    $id = "";
    $dtkdx = $kardex->getAll();
}

// DEFINE LA ACCION A REALIZAR: INSERT, UPDATE Y DELETE
if((!empty($_GET['actionkdx'])) && (isset($_GET['actionkdx']))) {
    $action = $_GET['actionkdx'];
    if($action === 'insert') {
        // COMPROBAMOS QUE TODOS LOS ARCHIVOS HAYAN SIDO CORRECTOS
        if(($curp == 0) || ($foto == 0) || ($compbnt == 0) || ($certif == 0))  {
            header('Location: index.php?page=form-files-alu&id='. $lstid .'');
        }else{
            $kardex->values[] = "'". $fch_r ."'";
            $kardex->values[] = $lstid;
            $kardex->values[] = $idCurp;
            $kardex->values[] = $idCompbnt;
            $kardex->values[] = $idFoto;
            $kardex->values[] = $idCertif;
            $kardex->values[] = $idpdf;

            $kardex->insertKardex();

            header('Location: index.php?page=lst-alu');

        }
    }elseif($action === 'update'){
        if(($curp == 0) || ($foto == 0) || ($compbnt == 0) || ($certif == 0))  {
            header('Location: index.php?page=form-files-alu&id='. $lstid .'');
        }else{
        $kardex->values[] = "'". $fch_r ."'";
        $kardex->values[] = $lstid;
        $kardex->values[] = $idCurp;
        $kardex->values[] = $idCompbnt;
        $kardex->values[] = $idFoto;
        $kardex->values[] = $idCertif;
        $kardex->values[] = $idpdf;

        $kardex->updateKardex($id);

        header('Location: index.php?page=lst-alu');

        }
    }elseif($action === 'delete')   {
        foreach($dtkdx as $row):
            $id_alu = $row['Matricula'];
            $id_a1 = $row['id_archivo1'];
            $id_a2 = $row['id_archivo2'];
            $id_a3 = $row['id_archivo3'];
            $id_a4 = $row['id_archivo4'];
            $id_a5 = $row['id_archivo5'];
        endforeach;

        $kardex->deleteKardex($id);
        $alumnos->deleteAlumno($id_alu);
        $archivo->deleteArchivo($id_a1);
        $archivo->deleteArchivo($id_a2);
        $archivo->deleteArchivo($id_a3);
        $archivo->deleteArchivo($id_a4);
        $archivo->deleteArchivo($id_a5);

        header('Location: index.php?page=lst-alu');
    } 
}


?>