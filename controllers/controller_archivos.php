<?php

require_once('resources/config/db.php');
require_once('models/model_archivos.php');
require_once('controllers/controller_alumnos.php');
// require_once('controllers/controller_kardex.php');
require_once('controllers/controller_semestre.php');
require_once('controllers/controller_genero.php');
require_once('controllers/controller_estudios.php');
require_once('resources/lib/Composer/vendor/autoload.php');


class ArchivosController extends Archivos {

    private $conArc;
    public  $lastidupd;
    public  $fidUpd;

    public function __construct(){
        $conArc = new Archivos();
        $this->lstid = $conArc->lastId();
    }

    public function uploadFile($fname,$ftype,$fsize,$file) {
        // SUBIR ARCHIVOS
        $dir_doc = "resources/documentos/";
        $uploadOk = 1;

        $dir_file = $dir_doc . basename($fname);   //  ATRAPA EL ARCHIVO
        $typefile = strtolower(pathinfo($dir_file,PATHINFO_EXTENSION)); //  OBTIENE LA INFORMACION DEL ARCHIVO COMO: RUTA, NOMBRE Y EXTENSION

        //  VERIFICA EL TAMAÑO DEL ARCHIVO
        if($fsize > 5000000) {
            $uploadOk = 0;
        }

        //  VERIFICA EL TIPO DE ARCHIVO
        if ($typefile != "jpg" && $typefile != "jpeg") {   // ASI SE VALIDA EL TIPO:   $typefile != "png" && 
            $uploadOk = 0;
        }

        //  MUEVE EL ARCHIVO AL SERVIDOR SOLO CUANDO TODOS LOS FILTROS ANTERIORES SEAN CORRECTOS
        if ($uploadOk == 0) {
            // $errorfile = 'Error en el tipo de archivo, deben ser "PNG, JPG ó JPEG"';
            $errorfile = 0;
            return $errorfile;
        }else{

            $fch_r = date('Y-m-d');     //OBTIENE LA FECHA ACTUAL
            
            $gestor     =   fopen($file, "r");
            $content    = fread($gestor, $fsize);
            $dtarchivo  = addslashes($content);
            fclose($gestor);

            return $dtarchivo;
        }
    }

    public function comprobarType($type) {
        if ($type == 'image/jpg') {
            $typeresult = ".jpg";
            return $typeresult;
        }else{
            $typeresult = ".jpeg";
            return $typeresult;
        }
    }
}

$archivo = new Archivos ();
$archivo->setTable("archivos");
$archivo->setView('');

$archivo->setKey('id_archivo');

$archivo->setColumns('archivo');
$archivo->setColumns('mimetp_archivo');
$archivo->setColumns('fecha_reg_arc	');

$dtarc = $archivo->getAll();

$dir_doc = "resources/documentos/";
$rtcurp = "curps/";
$rtfotos = "fotos/";
$rtcertificados = "certificados/";
$rtcomprobantes = "comprobantes/";
$rtpdfs = "pdfs/";

$rtpdf = $dir_doc . $rtpdfs;

$fch_r = date('Y-m-d');     //OBTIENE LA FECHA ACTUAL

// ATRAPA EL ID DE LOS DATOS PERSONALES DEL ALUMNO
if((!empty($_GET['id'])) && (isset($_GET['id']))) {
    $lstid = $_GET['id'];
}else{
    $lstid = "";
}

// DEFINE LA ACCION A REALIZAR: INSERT, UPDATE Y DELETE
if((!empty($_GET['actionfile'])) && (isset($_GET['actionfile']))) {
    $action = $_GET['actionfile'];

    if($action === 'insert') {

        //VERIFICA QUE $_FILES NO ESTE VACIO Y QUE SI CONTENGA ALGUN OBJETO
        if((!empty(($_FILES['curp']) && ($_FILES['foto']) && ($_FILES['cmpbnt']) && ($_FILES['certif']))) && (isset(($_FILES['curp']),($_FILES['foto']),($_FILES['cmpbnt']),($_FILES['certif']))))  { 

            $curpname = $_FILES['curp']['name'];
            $curptype = $_FILES['curp']['type'];
            $curpsize = $_FILES['curp']['size'];
            $curpfile = $_FILES['curp']['tmp_name'];

            $fotoname = $_FILES['foto']['name'];
            $fototype = $_FILES['foto']['type'];
            $fotosize = $_FILES['foto']['size'];
            $fotofile = $_FILES['foto']['tmp_name'];

            $compbntname = $_FILES['cmpbnt']['name'];
            $compbnttype = $_FILES['cmpbnt']['type'];
            $compbntsize = $_FILES['cmpbnt']['size'];
            $compbntfile = $_FILES['cmpbnt']['tmp_name'];
            
            $certifname = $_FILES['certif']['name'];
            $certiftype = $_FILES['certif']['type'];
            $certifsize = $_FILES['certif']['size'];
            $certiffile = $_FILES['certif']['tmp_name'];
            
            $upload = new ArchivosController();
            $curp = $upload->uploadFile($curpname,$curptype,$curpsize,$curpfile);
            $foto = $upload->uploadFile($fotoname,$fototype,$fotosize,$fotofile);
            $compbnt = $upload->uploadFile($compbntname,$compbnttype,$compbntsize,$compbntfile);
            $certif = $upload->uploadFile($certifname,$certiftype,$certifsize,$certiffile);

            // COMPROBAMOS QUE TODOS LOS ARCHIVOS HAYAN SIDO CORRECTOS
            if(($curp == 0) && ($foto == 0) && ($compbnt == 0) && ($certif == 0))  {
                header('Location: index.php?page=form-files-alu&id='. $lstid .'');
            }else{

                //  COMPRUEBA EL TIPO DE ARCHIVO PARA AGREGAR UNA EXTENSION AL MOMENTO DE GUARDAR TEMPORALMENTE
                $extfile = $upload->comprobarType($curptype);
                //  MOVEMOS EL ARCHIVO A UNA RUTA DEL SERVIDOR LOCAL DE MANERA TEMPORAL
                $rtarcurp = $dir_doc . $rtcurp . "CURP_" . $lstid . $extfile; 
                move_uploaded_file($curpfile,$rtarcurp);

                //  COMPRUEBA EL TIPO DE ARCHIVO PARA AGREGAR UNA EXTENSION AL MOMENTO DE GUARDAR TEMPORALMENTE
                $extfile = $upload->comprobarType($fototype);
                //  MOVEMOS EL ARCHIVO A UNA RUTA DEL SERVIDOR LOCAL DE MANERA TEMPORAL
                $rtarfoto = $dir_doc . $rtfotos . "FOTO_" . $lstid . $extfile; 
                move_uploaded_file($fotofile,$rtarfoto);

                //  COMPRUEBA EL TIPO DE ARCHIVO PARA AGREGAR UNA EXTENSION AL MOMENTO DE GUARDAR TEMPORALMENTE
                $extfile = $upload->comprobarType($compbnttype);
                //  MOVEMOS EL ARCHIVO A UNA RUTA DEL SERVIDOR LOCAL DE MANERA TEMPORAL
                $rtarcomprobante = $dir_doc . $rtcomprobantes . "COMPROBANTE_" . $lstid . $extfile; 
                move_uploaded_file($compbntfile,$rtarcomprobante);

                //  COMPRUEBA EL TIPO DE ARCHIVO PARA AGREGAR UNA EXTENSION AL MOMENTO DE GUARDAR TEMPORALMENTE
                $extfile = $upload->comprobarType($certiftype);
                //  MOVEMOS EL ARCHIVO A UNA RUTA DEL SERVIDOR LOCAL DE MANERA TEMPORAL
                $rtarcertificado = $dir_doc . $rtcertificados . "CERTIFICADO_" . $lstid . $extfile; 
                move_uploaded_file($certiffile,$rtarcertificado);

                $html = '';

                foreach($dtalu as $row):
                    $idalumno = $row['id_alumno'];
                    $namealumno = $row['nombre_alum'];
                    $apPalumno = $row['ap_pat_alum'];
                    $apMalumno = $row['ap_mat_alum'];
                    $fchalumno = $row['fch_nac_alum'];
                    $edadalumno = $row['edad_alum'];
                    $tlfalumno = $row['telef_alum'];
                    $correoalumno = $row['correo_alum'];
                    $id_sem = $row['id_semestre'];
                    $id_gen = $row['id_genero'];
                    $id_est = $row['id_estudio'];
                endforeach;

                foreach($dtsmt as $row):
                    $idsem  = $row['id_semestre'];

                    if($id_sem == $idsem) {
                        $sem = $row['semestre'];
                    }
                endforeach;

                foreach($dtgen as $row):
                    $idgen = $row['id_genero'];

                    if ($id_gen == $idgen) {
                        $gen = $row['genero'];
                    }
                endforeach;

                $html = '
                        <!DOCTYPE html>
                        <html lang="en">
                        <head>
                            <link rel="stylesheet" href="resources/css/pdf-style.css">
                        
                            <meta charset="UTF-8">
                            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            
                            <title>Document</title>
                        
                        </head>
                        
                        <body>
                            <div class="div-body">
                                <div class="nav">
                                    <table>
                                        <tr>
                                            <th id="tittle" colspan="6">Kardex</th>
                                        </tr>
                                        <tr>
                                            <th id="subtittle" colspan="7">Datos del alumno</th>
                                        </tr>
                                        <tr>
                                            <td colspan="6" class="td-space"></td>
                                            <td rowspan="4" colspan="1" id="td-foto"><img src="'. $rtarfoto .'" id="img-foto"/>
                                        </tr>
                                        <tr>
                                            <th id="subtittle" colspan="6">Datos del escolares</th>
                                        </tr>
                                        <tr>
                                            <th class="th-ttl">Matricula:</th>
                                            <th class="th-ttl" colspan="3">Nombre del alumno:</th>
                                            <th class="th-ttl" colspan="2">Semestre:</th>
                                        </tr>
                                        <tr>
                                            <td>'. $idalumno .'</td>
                                            <td colspan="3">'. $namealumno .' '. $apPalumno .' '. $apMalumno .'</td>
                                            <td colspan="2">'. $sem .'</td>
                                        </tr>
                                        <tr>
                                            <td class="td-space" colspan="7"></td>
                                        </tr>
                                        <tr>
                                            <th id="subtittle" colspan="7">Datos Personales</th>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Fecha de Nacimiento:</td>
                                            <td>'. $fchalumno .'</td>
                                            <th colspan="3">Genero:</td>
                                            <td>'. $gen .'</td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Edad:</td>
                                            <td>'. $edadalumno .'</td>
                                            <th colspan="3">Telefono:</td>
                                            <td>'. $tlfalumno .'</td>
                                        </tr>
                                        <tr>
                                            <th colspan="1">Correo:</td>
                                            <td colspan="6">'. $correoalumno .'</td>
                                        </tr>
                                    </table>
                                </div>
                                <div>
                                </div>
                            </div>
                        </body>
                        </html>';
                $html2 = '<div><img src="'. $rtarcurp .'" alt="" class="img-file"></div>';
                $html3 = '<div><img src="'. $rtarcomprobante .'" alt="" class="img-file"></div>';
                $html4 = '<div><img src="'. $rtarcertificado .'" alt="" class="img-file"></div>';

                $fpdf = $rtpdf .'Kardex_'. $lstid .'.pdf';

                $pdf = new \Mpdf\Mpdf(['format' => 'Letter']);
                $pdf->AddPage();
                $pdf->WriteHTML($html);
                $pdf->AddPage('P','','','','','0','0','0','0');
                $pdf->WriteHTML($html2);
                $pdf->AddPage('P','','','','','0','0','0','0');
                $pdf->WriteHTML($html3);
                $pdf->AddPage('P','','','','','0','0','0','0');
                $pdf->WriteHTML($html4);
                // print_r($html);
                // print_r($html2);
                // print_r($html3);
                // print_r($html4);
                // $pdf->OutPut('Kardex_'. $lstid .'.pdf','I');
                $pdf->OutPut($fpdf, 'F');


                $gestor = fopen($fpdf, "r");
                $fpdfsize = filesize($fpdf);
                $content = fread($gestor, $fpdfsize);
                $dtpdf = addslashes($content);
                fclose($gestor);

                $fpdftype = mime_content_type($fpdf);
    
                // INSERTAMOS EL ARCHIVO EN LA BASE DE DATOS 
                $archivo->insertArchivo($curp,$curptype,$fch_r);
                $idCurp = $archivo->lastId();
                // INSERTAMOS EL ARCHIVO EN LA BASE DE DATOS 
                $archivo->insertArchivo($compbnt,$compbnttype,$fch_r);
                $idCompbnt = $archivo->lastId();
                // INSERTAMOS EL ARCHIVO EN LA BASE DE DATOS 
                $archivo->insertArchivo($foto,$fototype,$fch_r);
                $idFoto = $archivo->lastId();
                // INSERTAMOS EL ARCHIVO EN LA BASE DE DATOS 
                $archivo->insertArchivo($certif,$certiftype,$fch_r);
                $idCertif = $archivo->lastId();
                // INSERTAMOS EL ARCHIVO EN LA BASE DE DATOS 
                $archivo->insertArchivo($dtpdf,$fpdftype,$fch_r);
                $idpdf = $archivo->lastId();


                // INSERTAMOS LOS ID EN LA TABLA KARDEX BASE DE DATOS 
                // $kardex->values[] = "'". $fch_r ."'";
                // $kardex->values[] = $lstid;
                // $kardex->values[] = $idCurp;
                // $kardex->values[] = $idCompbnt;
                // $kardex->values[] = $idFoto;
                // $kardex->values[] = $idCertif;
                // $kardex->values[] = $idpdf;

                // BORRA LOS ARCHIVOS QUE SE GUARDARON TEMPORALMENTE EN EL SERVIDOR
                unlink($fpdf);
                unlink($rtarcurp);
                unlink($rtarfoto);
                unlink($rtarcomprobante);
                unlink($rtarcertificado);    

                // $kardex->insertKardex();
                // REDIRECCIONAMOS HACIA LA TABLA DE VISTAS
                // &idalu='. $lstid .'&idCurp='. $idCurp .'&idComp='. $idCompbnt .'&idFt='. $idFoto .'&idCert='. $idCertif .'&idpdf='. $idpdf .'

            }
        }else{
            header('Location: index.php?page=form-files-alu&id='. $lstid .'');
        }
    }
}
?>

