<?php

require_once('resources/config/db.php');
require_once('models/model_alumnos.php');

$alumnos = new Alumnos ();
$alumnos->setTable("alumno");
$alumnos->setView('view_alumno');

$alumnos->setKey('id_alumno');

$alumnos->setColumns('nombre_alum');
$alumnos->setColumns('ap_pat_alum');
$alumnos->setColumns('ap_mat_alum');
$alumnos->setColumns('fch_nac_alum');
$alumnos->setColumns('edad_alum');
$alumnos->setColumns('domic_alum');
$alumnos->setColumns('telef_alum');
$alumnos->setColumns('correo_alum');
$alumnos->setColumns('id_estudio');
$alumnos->setColumns('id_genero');
$alumnos->setColumns('id_semestre');

// VERIFICA QUE EL POST DEL FORMULARIO DE ALUMNO CONTENGA DATOS
if((!empty($_POST['name_alu'])) && (isset($_POST['name_alu']))) {

    $date = $_POST['fch_alu'];  //OBTEIENE LA FECHA DE NACIMIENTO A TRAVES DEL POST
    $fch_r = date('Y-m-d');     //OBTIENE LA FECHA ACTUAL
    $edad = $alumnos->clcEdad($date, $fch_r);   //CALCULA LA EDAD

    // ATRAPA LOS DATOS DEEL POST EN UN ARRAY
    $alumnos->values[] = "'". ($_POST['name_alu']) ."'";
    $alumnos->values[] = "'". ($_POST['apP_alu']) ."'";
    $alumnos->values[] = "'". ($_POST['apM_alu']) ."'";
    $alumnos->values[] = "'". ($_POST['fch_alu']) ."'";
    $alumnos->values[] = "'". ($edad) ."'";
    $alumnos->values[] = "'". ($_POST['dom_alu']) ."'";
    $alumnos->values[] = "'". ($_POST['tel_alu']) ."'";
    $alumnos->values[] = "'". ($_POST['email_alu']) ."'";
    $alumnos->values[] = $_POST['ultest_alu'];
    $alumnos->values[] = $_POST['gen_alu'];
    $alumnos->values[] = $_POST['sem_alu'];
}

//ATRAPA EL ID PARA HACER UN WHERE EN CASO DE NO SER ASI MUESTRA TODOS LOS DATOS DE LA TABLA
if ((!empty($_GET['id'])) && (isset($_GET['id'])))  {
    $id = $_GET['id'];
    $dtalu = $alumnos->getWhere($id);
    // $dtvwalu = $alumnos->getWhereView($id);
}else{
    $id = "";
    $dtalu = $alumnos->getAll();
    // $data_alu = $alumnos->getView();
}


foreach($dtalu as $rows):
    $idest = $rows['id_estudio'];
    $idgen = $rows['id_genero'];
    $idsem = $rows['id_semestre'];
endforeach;

// foreach($data_alu  as  $rows):
//     $idv  =  $rows['id_alumno'];
//     $namev = $rows['Nombre_alum'] .' '. $rows['Ap_Paterno_alum'] .' '. $rows['Ap_Materno_alum'];
//     $sem =   $rows['Semestre'];
// endforeach;

// DEFINE LA ACCION A REALIZAR: INSERT, UPDATE Y DELETE
if((!empty($_GET['action'])) && (isset($_GET['action']))) {
    $action = $_GET['action'];
    if($action === 'insert') {
        $alumnos->insertAlumno();
        $lstid = $alumnos->lastId();
        header('Location: index.php?page=form-files-alu&id='. $lstid .'');
    }elseif ($action === 'update') {
        $alumnos->updateAlumno($id);
        header('Location: index.php?page=form-upd-files-alu&id='. $id .'');
    }elseif ($action === 'delete') {
        $alumnos->deleteAlumno($id);
        header('Location: index.php?page=lst-alu');
    }
}

// if((!empty($_GET['lastid'])) && (isset($_GET['lastid']))) {
//     $lstid = $_GET['lastid'];
//     // echo "<pre>".$lstid."</pre>";
//     $dtlstid = $alumnos->getWhere($lstid);
// }


?>