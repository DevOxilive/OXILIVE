<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../../../templates/header.php");
    include("../../../../../connection/conexion.php");
    include("../model/enfermeros.php");
    include("../model/pacientes.php");
    include("../../tipos/model/tipos.php");
} else {
    echo "Error en el sistema";
}
?>
<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="<?php echo $url_base ?>assets/css/foto_perfil.css">
    <link rel="stylesheet" href="<?php echo $url_base ?>assets/css/edit.css">
</head>
<main id="main" class="main">
    <section class="section dashboard">
        <div class="card">

            <!-- Encabezado del formulario de nueva guardia-->
            <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                <h4 style="text-align: center;
                        color: #fff;
                        font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Registro de nueva guardia
                </h4>
            </div>

            <!-- Cuerpo del formulario de registro de usuario -->
            <div class="card-body" style="border: 2px solid #BFE5FF;">
                <form method="POST" enctype="multipart/form-data" class="formLogin row g-3">

                    <div class="contenido col-md-12">
                        <br>
                        <h2>Asignación de servicio</h2>
                    </div>

                    <!-- Combo box para elegir el enfermero -->
                    <div class="contenido col-md-5">
                        <label for="nombres" class="form-label">Nombre(s)</label>
                        <select name="nombres" id="nombres" class="form-select">
                            <option value="">Elige el nombre del enfermero</option>
                            <?php foreach ($lista_enfermeros as $enfermeros) { ?>
                                <option value="<?php echo $enfermeros['id_usuarios']; ?>">
                                    <?php echo $enfermeros['Nombres'] . " " . $enfermeros['Apellidos']; ?>
                                </option>
                            <?php } ?>
                        </select>

                    </div>

                    <!-- Combo box para elegir paciente -->
                    <div class="contenido col-md-4">
                        <label for="paciente" class="form-label">Paciente</label>
                        <select id="paciente" name="paciente" class="form-select">
                            <option value="">Elige un paciente</option>
                            <?php foreach ($lista_pacientes as $pacientes) { ?>
                                <option value="<?php echo $pacientes['id_pacientes']; ?>">
                                    <?php echo $pacientes['Nombres'] . " " . $pacientes['Apellidos']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-3"></div>

                    <!-- Combo box para elegir el tipo de guardia -->
                    <div class="contenido col-md-5">
                        <label for="servicio" class="form-label">Tipo de servicio</label>
                        <select name="servicio" id="servicio" class="form-select">
                            <option value="">Elige el tipo de servicio</option>
                            <?php foreach ($lista_tipos as $servicios) { ?>
                                <option value="<?php echo $servicios['id_tipoServicio']; ?>">
                                    <?php echo $servicios['nombreServicio']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="contenido col-md-12">
                        <hr>
                        <h2>Asignación de horario</h2>
                    </div>

                    <!-- Ingreso de fecha de la guardia  -->
                    <div class="contenido col-md-3">
                        <label for="fechaServicio" class="form-label">Fecha</label>
                        <input type="date" id="fechaServicio" onkeydown="return false" name="fechaServicio" class="form-select">
                    </div>

                    <!-- Combo boxes para elegir la hora del horario -->
                    <div class="contenido col-md-3">
                        <label for="horaEntrada" class="form-label">Hora de entrada</label>
                        <input type="time" id="horaEntrada">
                    </div>
                    <div class="contenido col-md-3">
                        <label for="horaSalida" class="form-label">Hora de salida</label>
                        <input type="time" id="horaSalida">
                    </div>

                    <!-- Botones -->
                    <div class="col-12">
                        <br>
                        <button type="submit" class="btn btn-outline-primary">Guardar</button>
                        <a role="button" href="" onclick="confirmCancel(event)" name="cancelar" class="btn btn-outline-danger">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

</html>
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
                // Aquí puedes redirigir al usuario a otra página o realizar alguna otra acción
                window.location.href = "<?php echo $url_base; ?>secciones/enfermeria/servicios/horarios/index.php";
            }
        });
    }
</script>
<script src="../js/validacion.js" ></script>
<script src="../js/formBtns.js"></script>
<?php
include("../../../../../templates/footer.php");
?>