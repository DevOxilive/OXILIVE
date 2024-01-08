<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("./add.php");
    include("../../../module/tipoequipos.php");
    include("../../../module/empleados.php");
} else {
    echo "Error en el sistema";
}
?>
<html>
<link rel="stylesheet" href="../../../assets/css/vali.css">
<link rel="stylesheet" href="../../../assets/css/edit.css">

</html>
<main id="main" class="main">
    <section class="section dashboard">
        <div class="card">
            <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                <h4 style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Datos para asignar</H4>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF;">
                <form action="./add.php" method="POST" class="formLogin row g-3" id="formulario">
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__nombre"> <br>
                            <label for="nombre" class="form-label">Nombre del equipo</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresa el nombre completo del dispositivo entregado" required>
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo"> <br>
                            <label class="form-label">Tipos de equipo que se entregan</label>
                            <?php foreach ($tipos_equipo as $tipo) { ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="tipo_equipo[]" value="<?php echo $tipo['id']; ?>">
                                    <label class="form-check-label">
                                        <?php echo $tipo['tipo']; ?>
                                    </label>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__tipo_equipo"> <br>
                            <label for="tipo_equipo" class="form-label">Tipo de equipo que se entrega</label>
                            <select id="tipo_equipo" name="tipo_equipo" class="form-select">
                                <?php foreach ($tipos_equipo as $tipo) { ?>
                                    <option value="<?php echo $tipo['id']; ?>"><?php echo $tipo['tipo']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div> -->
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__no_serie"> <br>
                            <label for="no_serie" class="form-label">No. Serie</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="no_serie" id="no_serie" placeholder="Numero de serie del equipo" required>
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__IMEI"> <br>
                            <label for="IMEI" class="form-label">IMEI</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="IMEI" id="IMEI" placeholder="IMEI del equipo" required>
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__entrego"> <br>
                            <label for="entrego" class="form-label">¿Quien lo entrega?</label>
                            <select id="entrego" name="entrego" class="form-select">
                                <option value="0" selected disabled>Elija una opcion</option>
                                <?php foreach ($lista_empleados as $entrego) { ?>
                                    <option value="<?php echo $entrego['id_empleados']; ?>"><?php echo $entrego['Nombres']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__recibio"> <br>
                            <label for="recibio" class="form-label">¿Quien lo recibe?</label>
                            <select id="recibio" name="recibio" class="form-select">
                                <option value="0" selected disabled>Elija una opcion</option>
                                <?php foreach ($lista_empleados as $recibio) { ?>
                                    <option value="<?php echo $recibio['id_empleados']; ?>"><?php echo $recibio['Nombres']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__autorizo"> <br>
                            <label for="autorizo" class="form-label">¿Quien lo autoriza?</label>
                            <select id="autorizo" name="autorizo" class="form-select">
                                <option value="0" selected disabled>Elija una opcion</option>
                                <?php foreach ($lista_empleados as $autorizo) { ?>
                                    <option value="<?php echo $autorizo['id_empleados']; ?>"><?php echo $autorizo['Nombres']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="contenido col-md-4">
                        <div class="formulario__grupo" id="grupo__observaciones"> <br>
                            <label for="observaciones" class="form-label">Observaciones del equipo</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="observaciones" id="observaciones" required>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="card-footer text-muted">
                        <div class="formulario__grupo formulario__grupo-btn-enviar">
                            <button type="submit" class="btn btn-outline-success">Guardar</button>
                            <a name="registrar" id="" class="btn btn-outline-danger" onclick="confirmCancel(event)" role="button">Cancelar</a>

                        </div>
                    </div>
                </form>
            </div>
        </div>
</main>
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
                window.location.href = "<?php echo $url_base; ?>secciones/sistemas/equipos/index.php";
            }
        });
    }
</script>
<?php
include("../../../templates/footer.php");
?>