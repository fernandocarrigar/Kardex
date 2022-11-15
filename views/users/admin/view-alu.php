<?php
include_once('views/template/header/header-alu.php');

require_once('controllers/controller_alumnos.php');
require_once('controllers/controller_archivos.php');
require_once('controllers/controller_genero.php');
require_once('controllers/controller_semestre.php');
require_once('controllers/controller_estudios.php');
require_once('controllers/controller_kardex.php');

?>
<body>
    
<?php
include_once('views/template/nav/nav-alu.php');
?>

<div class="div-body">
<h3>Lista de alumnos</h3>
    <div class="contain-body">
        <div class="contain-table">
            <table>
                <tr>
                    <th>Matricula:</th>
                    <th>Nombre:</th>
                    <th>Fecha de nacimiento:</th>
                    <th>Edad:</th>
                    <th>Domicilio:</th>
                    <th>Telefono:</th>
                    <th>Correo:</th>
                    <th>Ultimos estudios:</th>
                    <th>Genero:</th>
                    <th>Semestre:</th>
                    <th colspan="3"></th>
                </tr>
                <?php
                    foreach ($dtkdx as $rows):     
                        $id_alumn = $rows['Matricula'];   
                // if ($dtkdx->num_rows > 0) {
                                    
                //     while ($rows = $dtkdx->fetch_assoc()) {                    
                ?>
                <a href=""></a>
                <tr>
                    <td><?php echo $id_alumn;?></td>
                    <td><?php echo $rows['NombreAlu'] ." ". $rows['ApPaterno'] ." ". $rows['ApMaterno'];?></td>
                    <td><?php echo $rows['FechaNac'];?></td>
                    <td><?php echo $rows['Edad'];?></td>
                    <td><?php echo $rows['Domicilio'];?></td>
                    <td><?php echo $rows['Telefono'];?></td>
                    <td><?php echo $rows['Correo'];?></td>
                    <td><?php echo $rows['Estudio']?></td>
                    <td><?php echo $rows['Genero'];?></td>
                    <td><?php echo $rows['Semestre'];?></td>
                    <td><a href="index.php?page=kdx-pdf-alu&id=<?php echo $rows['id_kardex'];?>" target="_blank"><i class="far fa-file-alt"></i></a></td>
                    <td><div><a href="index.php?page=form-upd-alu&id=<?php echo $rows['Matricula'];?>"><i class="far fa-edit"></i></a></div></td>
                    <td><a href="index.php?page=lst-alu&actionkdx=delete&id=<?php echo $rows['id_kardex'];?>"><i class="far fa-trash-alt"></i></a></td>
                    <td><form action="index.php?page=lst-alu&actionfile"></form></td>

                        <!-- <div id="miModal" class="modal">
                            <div class="modal-contenido">
                                <h2>¿Desea eliminar este registro?</h2>
                                <a href="#" type="button" class="btn">Cancelar</a>
                                <a href="index.php?page=form-upd-alu&id=<?php echo $rows['Matricula'];?>" class="btn" id="a-btn">1!</a>
                                <a href="index.php?page=form-upd-alu&id=<?php echo $rows['Matricula'];?>" class="btn" id="a-btn">2!</a>
                            </div>  
                        </div>     -->
                        <!-- <td><div><a href="#miModal"><i class="far fa-edit"></i></a></div></td> -->
                        <div id="modalview" class="modal">
                            <div class="modal-contain">
                                <a href="#" class="close">&times;</a>
                                <a href="index.php?page=form-upd-alu&id=<?php echo $rows['Matricula'] ?>">Actualizar</a>
                                <a href="index.php?page=form-upd-alu&id=<?php echo $rows['Matricula'] ?>">Actualizar</a>
                            </div>
                        </div>

                </tr>
                <?php
                //     }
                // }
                    endforeach;
                ?>
            </table>
        </div>
    </div>
</div>

</body>