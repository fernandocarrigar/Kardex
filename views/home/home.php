<?php
    include('views/template/header/header_home.php');
?>
<body>

<?php
    include('views/template/nav/nav_home.php');
?>
    <div class="div-body">
    <h3>¡Bienvenido!</h3>
        <div class="contain-body">
            <div class="contain-target">
                <div class="div-img">
                    <img class="img-tgt" src="resources/assets/img/lista.png" alt="lista">
                </div>
                <div>
                    <h5>Visualice los datos de los alumnos.</h5>
                    <a href="index.php?page=lst-alu" class="btn">Ver los datos</a>
                </div>
            </div>
            <div class="contain-target">
                <div class="div-img">
                    <img class="img-tgt" src="resources/assets/img/form.png" alt="lista">
                </div>
                <div>
                    <h5>Registre un nuevo alumno.</h5>
                    <a href="index.php?page=form-alu" class="btn">Realizar registro</a>
                </div>
            </div>
        </div>
    </div>
</body>