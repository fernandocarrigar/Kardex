<?php
include_once('views/template/header/header-form-alu.php');

require_once('controllers/controller_alumnos.php');
require_once('controllers/controller_semestre.php');
require_once('controllers/controller_genero.php');
require_once('controllers/controller_estudios.php');

?>
<body>
    
<?php
include_once('views/template/nav/nav-form-alu.php');
?>

<div class="div-body-form">
        <div class="contain-form">
            <form action="index.php?page=form-files-alu&action=insert" method="post">
                <div class="contain-inputs">
                    <label for="name_alu">Nombre:</label>
                        <input type="text" name="name_alu" id="name_alu" placeholder="Ingrese su nombre" required><br>
                    <label for="apP_alu">Apellido Paterno:</label>
                        <input type="text" name="apP_alu" id="apP_alu" placeholder="Ingrese su apellido paterno" required><br>
                    <label for="apM_alu">Apellido Materno:</label>
                        <input type="text" name="apM_alu" id="apM_alu" placeholder="Ingrese su apellido materno" required><br>
                    <label for="fch_alu">Fecha de nacimiento:</label>
                        <input type="date" name="fch_alu" id="fch_alu" required><br>
                </div>
                <div class="contain-inputs">
                    <label for="dom_alu">Domicilio:</label>
                        <input type="text" name="dom_alu" id="dom_alu" placeholder="Ingrese su domicilio" required><br>
                    <label for="tel_alu">Telefono:</label>
                        <input type="text" name="tel_alu" id="tel_alu" placeholder="Ingrese su numero telefonico" required><br>
                    <label for="gen_alu">Genero:</label>
                        <select name="gen_alu" id="gen_alu" required>
                            <option value="#" disabled selected>Seleccione su genero</option>
                            <?php
                            foreach($dtgen as $rows):
                            ?>
                            <option value="<?php echo $rows['id_genero'];?>"><?php echo $rows['genero'];?></option>
                            <?php
                            endforeach;
                            ?>
                        </select><br>
                </div>
                <div class="contain-inputs">
                    <label for="email_alu">Correo:</label>
                        <input type="text" name="email_alu" id="email_alu" placeholder="Ingrese su correo" required><br>
                    <label for="ultest_alu">Ultimos estudios:</label>
                        <select name="ultest_alu" id="ultest_alu" required>
                            <option value="" disabled selected>¿Cual es su ultimo grado de estudios?</option>
                            <?php
                            foreach($dtest as $rows):
                            ?>
                            <option value="<?php echo $rows['id_estudio'];?>"><?php echo $rows['estudio'];?></option>
                            <?php
                            endforeach;
                            ?>
                        </select><br>
                    <label for="sem_alu">Semestre:</label>
                        <select name="sem_alu" id="sem_alu" required>
                            <option value="" disabled selected>Seleccione el semestre</option>
                            <?php
                            foreach($dtsmt as $rows):
                            ?>
                            <option value="<?php echo $rows['id_semestre'];?>"><?php echo $rows['semestre'];?></option>
                            <?php
                            endforeach;
                            ?>
                        </select><br>
                </div>
                <div class="contain-btn">
                    <button type="submit" class="btn">Guardar</button>
                </div>
            </form>
        </div>
</div>