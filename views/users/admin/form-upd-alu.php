<?php
include_once('views/template/header/header-form-alu.php');

require_once('controllers/controller_kardex.php');
require_once('controllers/controller_alumnos.php');
require_once('controllers/controller_semestre.php');
require_once('controllers/controller_genero.php');
require_once('controllers/controller_estudios.php');


// if (empty($dtkdx)) {
//     header('Location: index.php');
// }

?>
<body>
    
<?php
include_once('views/template/nav/nav-form-alu.php');
?>

<div class="div-body-form">
        <div class="contain-form">
            <form action="index.php?page=form-upd-files-alu&action=update&id=<?php echo $id;?>" method="post">
                <div class="contain-inputs">
                    <?php
                    foreach($dtalu as $rows):
                    ?>
                    <label for="name_alu">Nombre:</label>
                        <input type="text" name="name_alu" id="name_alu" value="<?php echo $rows['nombre_alum'];?>" placeholder="Ingrese su nombre" required><br>
                    <label for="apP_alu">Apellido Paterno:</label>
                        <input type="text" name="apP_alu" id="apP_alu" value="<?php echo $rows['ap_pat_alum'];?>" placeholder="Ingrese su apellido paterno" required><br>
                    <label for="apM_alu">Apellido Materno:</label>
                        <input type="text" name="apM_alu" id="apM_alu" value="<?php echo $rows['ap_mat_alum'];?>" placeholder="Ingrese su apellido materno" required><br>
                    <label for="fch_alu">Fecha de nacimiento:</label>
                        <input type="date" name="fch_alu" id="fch_alu" value="<?php echo $rows['fch_nac_alum'];?>" required><br>
                </div>
                <div class="contain-inputs">
                    <label for="dom_alu">Domicilio:</label>
                        <input type="text" name="dom_alu" id="dom_alu" value="<?php echo $rows['domic_alum'];?>" placeholder="Ingrese su domicilio" required><br>
                    <label for="tel_alu">Telefono:</label>
                        <input type="text" name="tel_alu" id="tel_alu" value="<?php echo $rows['telef_alum'];?>" placeholder="Ingrese su numero telefonico" required><br>
                    <?php
                    endforeach;
                    ?>
                    <label for="gen_alu">Genero:</label>
                        <select name="gen_alu" id="gen_alu" required>
                            <option value="#" disabled selected>Seleccione su genero</option>
                            <?php
                            foreach($dtgen as $rows):
                                $gen = $rows['id_genero'];
                                if($gen == $idgen) {
                                    echo ("<option selected value=". $rows['id_genero'] .">". $rows['genero'] ."</option>");
                                }else{
                                    echo ("<option value=". $rows['id_genero'] .">". $rows['genero'] ."</option>");
                                }
                            endforeach;
                            ?>
                        </select><br>
                </div>
                <div class="contain-inputs">
                    <?php
                    foreach($dtalu as $rows):
                    ?>
                    <label for="email_alu">Correo:</label>
                        <input type="text" name="email_alu" id="email_alu" value="<?php echo $rows['correo_alum'];?>" placeholder="Ingrese su correo" required><br>
                    <?php
                    endforeach;
                    ?>
                    <label for="ultest_alu">Ultimos estudios:</label>
                        <select name="ultest_alu" id="ultest_alu" required>
                            <option value="" disabled selected>¿Cual es su ultimo grado de estudios?</option>
                            <?php
                            foreach($dtest as $rows):
                                $est = $rows['id_estudio'];
                                if($est == $idest) {
                                    echo ("<option selected value=". $rows['id_estudio'] .">". $rows['estudio'] ."</option>");
                                }else{
                                    echo ("<option value=". $rows['id_estudio'] .">". $rows['estudio'] ."</option>");
                                }
                            endforeach;
                            ?>
                        </select><br>
                    <label for="sem_alu">Semestre:</label>
                        <select name="sem_alu" id="sem_alu" required>
                            <option value="" disabled selected>Seleccione el semestre</option>
                            <?php
                            foreach($dtsmt as $rows):
                                $sem = $rows['id_semestre'];
                                if($sem == $idsem) {
                                    echo ("<option selected value=". $rows['id_semestre'] .">". $rows['semestre'] ."</option>");
                                }else{
                                    echo ("<option value=". $rows['id_semestre'] .">". $rows['semestre'] ."</option>");
                                }
                            endforeach;
                            ?>
                        </select><br>
                </div>
                <div class="contain-btn">
                    <button type="submit" class="btn">Guardar</button>
                </div>
            </form>
        </div>
        <br>
        <!-- <div class="contain-table">
            <table>
                <tr>
                    <th>Matricula:</th>
                    <th>Nombre:</th>
                    <th>Edad:</th>
                    <th>Domicilio:</th>
                    <th>Telefono:</th>
                    <th>Genero:</th>
                    <th>Correo:</th>
                    <th>Ultimos Estudios:</th>
                    <th>Genero:</th>
                    <th>Semestre:</th>
                </tr>
                <?php
                // foreach($dtkdx as $rows):
                ?>
                <tr>
                    <td><?php //echo $rows['Matricula'];?></td>
                    <td><?php //echo $rows['NombreAlu'] ." ". $rows['ApPaterno'] ." ". $rows['ApMaterno'];?></td>
                    <td><?php //echo $rows['FechaNac'];?></td>
                    <td><?php //echo $rows['Edad'];?></td>
                    <td><?php //echo $rows['Domicilio'];?></td>
                    <td><?php //echo $rows['Telefono'];?></td>
                    <td><?php //echo $rows['Correo'];?></td>
                    <td><?php //echo $rows['Estudio']?></td>
                    <td><?php //echo $rows['Genero'];?></td>
                    <td><?php //echo $rows['Semestre'];?></td>
                </tr>
                <?php
                // endforeach;
                ?>
            </table>
        </div> -->
</div>