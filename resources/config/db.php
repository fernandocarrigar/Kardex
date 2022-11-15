<?php

class Conectar {

    public  $conexion;
    private $host = "localhost";    //------    ESTA LINEA DEINE EL SERVIDOR  -------//
    private $user = "root";         //------    ESTA LINEA DEINE EL USUARIO  -------//
    private $pass = "";             //------    ESTA LINEA DEINE LA CONTRASEÑA  -------//
    private $dbname   = "kardex";   //------    ESTA LINEA DEINE LA BASE DATOS  -------//

    public function conexionBD() {

        $conexion = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        // if($conexion->connect_error){
        //     echo "Error en la conexion:" . $conexion->connect_errno . ":" . $conexion->connect_error;
        // } else {
        //     echo "conexion hecha";
        // }

        return $conexion;
    }
}

$con = new Conectar();
$connect = $con->conexionBD();
//  print_r($con->conexionBD());

?>