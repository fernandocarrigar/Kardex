<?php
include_once('views/template/header/header-form-alu.php');

require_once('controllers/controller_alumnos.php');
require_once('controllers/controller_semestre.php');
require_once('controllers/controller_genero.php');
require_once('controllers/controller_estudios.php');
require_once('controllers/controller_archivos.php');
require_once('controllers/controller_kardex.php');

?>
<body>
    
<?php
include_once('views/template/nav/nav-form-alu.php');
?>

<div class="div-body-form">
        <div class="contain-form-file">
            <form action="index.php?page=lst-alu&actionfile=insert&id=<?php echo $id?>&actionkdx=insert" method="post" enctype="multipart/form-data">
                <div class="contain-title">
                    <h3>Subida de archivos:</h3> <p class="subtext">(Solo se permiten archivos: "JPG" o "JPEG")</p>
                </div>
                <div class="contain-inputs">
                    <label for="curp" id="lbl-file">Seleccione su CURP:</label>
                        <input type="file" class="input-file" name="curp" id="fileCurp" accept="image/png, image/jpeg, application/pdf" max-size="5000" required><br>
                    <label for="foto" id="lbl-file">Seleccione su foto:</label>
                        <input type="file" class="input-file" name="foto" id="foto" accept="image/png, image/jpeg, application/pdf" max-size="5000" required><br>
                </div>
                <div class="contain-inputs">
                    <label for="cmpbnt" id="lbl-file">Seleccione su comprobante de domicilio:</label>
                        <input type="file" class="input-file" name="cmpbnt" id="cmpbnt" accept="image/png, image/jpeg, application/pdf" max-size="5000" required><br>
                    <label for="certif" id="lbl-file">Seleccione su certificado:</label>
                        <input type="file" class="input-file" name="certif" id="certif" accept="image/png, image/jpeg, application/pdf" max-size="5000" required><br>
                </div>
                <div class="contain-btn">
                    <button type="submit" class="btn">Guardar</button>
                </div>
            </form>
        </div>
        <br>
        <div class="contain-table">
            <table>
                <tr>
                    <th>Matricula:</th>
                    <th>Nombre:</th>
                    <th>Fecha de nacimeinto:</th>
                    <th>Edad:</th>
                    <th>Domicilio:</th>
                    <th>Telefono:</th>
                    <th>Correo:</th>
                    <th>Ultimos Estudios:</th>
                    <th>Genero:</th>
                    <th>Semestre:</th>
                </tr>
                <?php
                foreach($dtalu as $rows):
                ?>
                <tr>
                    <td><?php echo $rows['id_alumno'];?></td>
                    <td><?php echo $rows['nombre_alum'] ." ". $rows['ap_pat_alum'] ." ". $rows['ap_mat_alum'];?></td>
                    <td><?php echo $rows['fch_nac_alum'];?></td>
                    <td><?php echo $rows['edad_alum'];?></td>
                    <td><?php echo $rows['domic_alum'];?></td>
                    <td><?php echo $rows['telef_alum'];?></td>
                    <td><?php echo $rows['correo_alum'];?></td>
                    <td><?php echo $rows['id_estudio'];?></td>
                    <td><?php echo $rows['id_genero'];?></td>
                    <td><?php echo $rows['id_semestre'];?></td>

                </tr>
                <?php
                endforeach;
                ?>
            </table>
        </div>
</div>