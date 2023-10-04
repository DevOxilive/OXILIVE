<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("./admiUP.php");
} else {
    echo "Error en el sistema";
}
?>
<html>
<link rel="stylesheet" href="../../../assets/css/vali.css">

</html>
<main id="main" class="main">

    <section class="section dashboard">
        <div class="card">
            <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                <h4
                    style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Datos Ah Editar</h4>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF;">
                <form action="./admiUP.php" method="POST" class="formLogin" id="formulario">
                <div class="contenido col-md-1"> <br>
                        <label for="txtID" class="form-label">Num</label>
                        <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId">
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <!-- Primera columna -->
                            <br>
                            <div class="formulario__grupo" id="grupo__Nombre_administradora">
                                <label for="Nombre_administradora" class="formulario__label">Nombre
                                    Administradora</label>
                                <div class="formulario__grupo-input">
                                    <input type="text" value="<?php echo $Nombre_administradora; ?>" class="formulario__input" name="Nombre_administradora"
                                        id="Nombre_administradora" placeholder="Nombre administradora">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- Segunda columna -->
                            <br>
                            <div class="formulario__grupo">
                                <label for="cpt" class="formulario__label">Agrega CPT 1</label>
                                <div class="formulario__grupo-input">
                                    <input type="text" value="<?php echo $cpt_admi; ?>" class="formulario__input" name="cpt" id="cpt"
                                        placeholder="EN-BA-03">
                                    <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <!-- Segunda columna -->
                            <br>
                            <div class="formulario__grupo">
                                <label for="des1" class="formulario__label">Descripción de CPT 1</label>
                                <div class="formulario__grupo-input">
                                    <input type="text" value="<?php echo $des1; ?>" class="formulario__input" name="des1" id="des1"
                                        placeholder="Apoyo Enfermeria 8 Horas">
                                    <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <!-- Segunda columna -->
                            <br>
                            <div class="formulario__grupo">
                                <label for="unidad" class="formulario__label">Unidad</label>
                                <div class="formulario__grupo-input">
                                    <input type="text" value="<?php echo $unidad; ?>" class="formulario__input" name="unidad" id="unidad"
                                        placeholder="Turno 8 Horas">
                                    <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <!-- Segunda columna -->
                            <br>
                            <div class="formulario__grupo">
                                <label for="cpt2" class="formulario__label">Agrega CPT 2</label>
                                <div class="formulario__grupo-input">
                                    <input type="text"  value="<?php echo $cpt2; ?>" class="formulario__input" name="cpt2" id="cpt2"
                                        placeholder="EN-BA-03">
                                    <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <!-- Segunda columna -->
                            <br>
                            <div class="formulario__grupo">
                                <label for="des2" class="formulario__label">Descripción de CPT 2</label>
                                <div class="formulario__grupo-input">
                                    <input type="text" value="<?php echo $des2; ?>" class="formulario__input" name="des2" id="des2"
                                        placeholder="Apoyo Enfermeria 9 Horas">
                                    <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- Segunda columna -->
                            <br>
                            <div class="formulario__grupo">
                                <label for="unidad2" class="formulario__label">Unidad 2</label>
                                <div class="formulario__grupo-input">
                                    <input type="text" value="<?php echo $unidad2; ?>" class="formulario__input" name="unidad2" id="unidad2"
                                        placeholder="Turno 9 Horas">
                                    <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <!-- Segunda columna -->
                            <br>
                            <div class="formulario__grupo">
                                <label for="cpt3" class="formulario__label">Agrega CPT 3</label>
                                <div class="formulario__grupo-input">
                                    <input type="text" value="<?php echo $cpt3; ?>" class="formulario__input" name="cpt3" id="cpt3"
                                        placeholder="EN-BA-03">
                                    <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <!-- Segunda columna -->
                            <br>
                            <div class="formulario__grupo">
                                <label for="des3" class="formulario__label">Descripción de CPT 3</label>
                                <div class="formulario__grupo-input">
                                    <input type="text" value="<?php echo $des3; ?>" class="formulario__input" name="des3" id="des3"
                                        placeholder="Apoyo Enfermeria 10 Horas">
                                    <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <!-- Segunda columna -->
                            <br>
                            <div class="formulario__grupo">
                                <label for="unidad3" class="formulario__label">Unidad 3</label>
                                <div class="formulario__grupo-input">
                                    <input type="text" value="<?php echo $unidad3; ?>" class="formulario__input" name="unidad3" id="unidad3"
                                        placeholder="Turno 10 Horas">
                                    <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <!-- Segunda columna -->
                            <br>
                            <div class="formulario__grupo">
                                <label for="cpt4" class="formulario__label">Agrega CPT 4</label>
                                <div class="formulario__grupo-input">
                                    <input type="text" value="<?php echo $cpt4; ?>" class="formulario__input" name="cpt4" id="cpt4"
                                        placeholder="EN-BA-03">
                                    <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <!-- Segunda columna -->
                            <br>
                            <div class="formulario__grupo">
                                <label for="des4" class="formulario__label">Descripción de CPT 4</label>
                                <div class="formulario__grupo-input">
                                    <input type="text" value="<?php echo $des4; ?>" class="formulario__input" name="des4" id="des4"
                                        placeholder="Apoyo Enfermeria 12 Horas">
                                    <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <!-- Segunda columna -->
                            <br>
                            <div class="formulario__grupo">
                                <label for="unidad4" class="formulario__label">Unidad 4</label>
                                <div class="formulario__grupo-input">
                                    <input type="text" value="<?php echo $unidad4; ?>" class="formulario__input" name="unidad4" id="unidad4"
                                        placeholder="Turno 12 Horas">
                                    <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <!-- Segunda columna -->
                            <br>
                            <div class="formulario__grupo">
                                <label for="cpt5" class="formulario__label">Agrega CPT 5</label>
                                <div class="formulario__grupo-input">
                                    <input type="text" value="<?php echo $cpt5; ?>" class="formulario__input" name="cpt5" id="cpt5"
                                        placeholder="EN-BA-03">
                                    <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- Segunda columna -->
                            <br>
                            <div class="formulario__grupo">
                                <label for="des5" class="formulario__label">Descripción de CPT 5</label>
                                <div class="formulario__grupo-input">
                                    <input type="text" value="<?php echo $des5; ?>" class="formulario__input" name="des5" id="des5"
                                        placeholder="Apoyo Enfermeria 15 Horas">
                                    <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <!-- Segunda columna -->
                            <br>
                            <div class="formulario__grupo">
                                <label for="unidad5" class="formulario__label">Unidad 5</label>
                                <div class="formulario__grupo-input">
                                    <input type="text" value="<?php echo $unidad5; ?>" class="formulario__input" name="unidad5" id="unidad5"
                                        placeholder="Turno 15 Horas">
                                    <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <!-- Segunda columna -->
                            <br>
                            <div class="formulario__grupo">
                                <label for="cpt6" class="formulario__label">Agrega CPT 6</label>
                                <div class="formulario__grupo-input">
                                    <input type="text" value="<?php echo $cpt6; ?>" class="formulario__input" name="cpt6" id="cpt6"
                                        placeholder="EN-BA-03">
                                    <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <!-- Segunda columna -->
                            <br>
                            <div class="formulario__grupo">
                                <label for="des6" class="formulario__label">Descripción de CPT 6</label>
                                <div class="formulario__grupo-input">
                                    <input type="text" value="<?php echo $des6; ?>" class="formulario__input" name="des6" id="des6"
                                        placeholder="Apoyo Enfermeria 24 Horas">
                                    <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <!-- Segunda columna -->
                            <br>
                            <div class="formulario__grupo">
                                <label for="unidad6" class="formulario__label">Unidad 6</label>
                                <div class="formulario__grupo-input">
                                    <input type="text" value="<?php echo $unidad6; ?>" class="formulario__input" name="unidad6" id="unidad6"
                                        placeholder="Turno 8 Horas">
                                    <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                                </div>
                            </div>

                        </div>
                        <br>
                        <div class="card-footer text-muted">
                            <div class="formulario__grupo formulario__grupo-btn-enviar d-flex ">
                                <button type="submit" class="btn btn-outline-success mr-2">Guardar</button>
                                <a name="registrar" id="" class="btn btn-outline-danger" onclick="confirmCancel(event)"
                                    role="button">Cancelar</a>
                            </div>
                        </div>
                </form>
            </div>
        </div>
</main>
<!-- ESTO SIRVE PARA LA ALERTA DE CANCELAR, SE MANEJA CON SWEET ALERT -->
<script>
function confirmCancel(event) {
    event.preventDefault();
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Si cancelas, se perderán los datos ingresados.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, cancelar',
        cancelButtonText: 'No, continuar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?php echo $url_base; ?>secciones/enfermeria/administradora/index.php";
        }
    });
}
</script>
<!-- ESTA ALERTA SIRVE PARA NO PERMITIR NINGUN CAMPO VACIO -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.formLogin').addEventListener('submit', function(event) {
        event.preventDefault();
        // Verifica si los campos obligatorios están vacíos
        var Nombre_administradora = document.getElementById('Nombre_administradora').value;
        var cpt = document.getElementById('cpt').value;
        if (!Nombre_administradora || !cpt || !cpt2 || !cpt3 || !cpt4 || !cpt5 || !cpt6 ) {
            Swal.fire({
                icon: 'error',
                title: 'Campos vacíos',
                text: 'Por favor, completa todos los campos obligatorios.',
            });
        } else {
            this.submit();
        }
    });
});
</script>
<?php
include("../../../templates/footer.php");
?>