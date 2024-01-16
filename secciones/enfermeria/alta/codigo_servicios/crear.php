<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../../templates/header.php");
    include("../../../../connection/conexion.php");
    include("model/consulta.php");
    include("./crearADD.php");
} else {
    echo "Error en el sistema";
}
?>
<html>
<link rel="stylesheet" href="../../../../assets/css/vali.css">
<link rel="stylesheet" href="../../../../assets/css/edit.css">
<main id="main" class="main">
    <section class="section dashboard">
        <div class="card">
            <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                <h4 style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Captura del Código Segun la administradora</h4>
            </div>

            <div class="card-body" style="border: 2px solid #BFE5FF;">
                <h4 class="card-title">Códigos</h4>
                <hr>
                <form action="./crearADD.php" method="POST" enctype="multipart/form-data" class="formLogin row g-3" id="formulario">
                    <!-- Select de Administradora -->
                    <div class="contenido col-md-4">
                        <label for="administradora" class="form-label">
                            Administradora a la que pertenece
                        </label>
                        <select id="administradora" name="administradora" class="form-select not-empty">
                            <option value="0" selected disabled>Elija una opción</option>
                            <?php foreach ($lis_admi as $listAdmin) { ?>
                                <option value="<?php echo $listAdmin['id_administradora']; ?>">
                                    <?php echo $listAdmin['Nombre_administradora']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-8"></div>

                    <!-- Input de Código -->
                    <div class="contenido col-md-3">
                        <label for="codigo" class="form-label">Código</label>
                        <input type="text" maxlength="12" name="codigo[]" id="codigo" class="form-control not-empty" placeholder="Ejemplo E20B-21-ND" required>
                    </div>

                    <!-- Input de Descripción -->
                    <div class="contenido col-md-3">
                        <label for="descripcion" class="form-label text-left">Descripción</label>
                        <input type="text" maxlength="40" name="descripcion[]" id="descripcion" class="form-control not-empty" required placeholder="Apoyo General 8 Horas">
                    </div>

                    <!-- Input de Unidad -->
                    <div class="contenido col-md-2">
                        <label for="unidad" class="form-label text-left">Unidad</label>
                        <input type="text" maxlength="40" name="unidad[]" id="unidad" class="form-control not-empty" required placeholder="Turno 8 Horas">
                    </div>

                    <!-- Botón de Agregar Código -->
                    <div class="col-md-1 align-self-center">
                        <br>
                        <button class="btn btn-info" id="add-btn">+</button>
                    </div>
                    <div class="col-md-3"></div>
                    <input type="hidden" id="beforeThis">
                    <div class="col-12 btns">
                        <button type="submit" class="btn btn-outline-success">Guardar</button>
                        <a role="button" onclick="confirmCancel(event)" name="cancelar" class="btn btn-outline-danger">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
</main>
<style>
    .campo-incompleto {
        border: 1px solid #ff0000;
        /* Añade un borde rojo */
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('.formLogin').addEventListener('submit', function(event) {
            event.preventDefault();

            // var administradora = document.getElementsByClassName('form-control');
            var numCampos = document.querySelectorAll('.form-row').length;
            var camposIncompletos = false;
            var campos = document.querySelectorAll('.form-row input');

            // Elimina la clase y el borde rojo al cambiar el valor de la administradora
            administradora.addEventListener('change', function() {
                administradora.classList.remove('campo-incompleto');
                administradora.style.border = '1px solid #ced4da'; /* Cambia el color del borde a su valor original */
            });

            campos.forEach(function(campo) {
                if (campo.value.trim() === "") {
                    camposIncompletos = true;
                    campo.classList.add('campo-incompleto');
                    campo.style.border = '1px solid #ff0000'; /* Cambia el color del borde a rojo */
                } else {
                    campo.classList.remove('campo-incompleto');
                    campo.style.border = '1px solid #ced4da'; /* Cambia el color del borde a su valor original */
                }
            });

            if (administradora.value === "0") {
                // Agrega la clase y el borde rojo al campo administradora si no se selecciona nada
                administradora.classList.add('campo-incompleto');
                administradora.style.border = '1px solid #ff0000'; /* Cambia el color del borde a rojo */
                Swal.fire({
                    icon: 'error',
                    title: 'Campo Administradora requerido',
                    text: 'Por favor, seleccione una administradora.',
                });
            } else if (camposIncompletos) {
                Swal.fire({
                    icon: 'error',
                    title: 'Campos Código, Descripción y Unidad requeridos',
                    text: 'Por favor, complete todos los campos Códigos, Descripción y Unidad en cada conjunto.',
                });
            } else {
                this.submit();
            }
        });
    });
</script>
<script src="js/addFieldsForm.js"></script>
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
                window.location.href = "<?php echo $url_base; ?>secciones/enfermeria/alta/codigo_servicios/index.php";
            }
        });
    }
</script>
<?php
include("../../../../templates/footer.php");
?>