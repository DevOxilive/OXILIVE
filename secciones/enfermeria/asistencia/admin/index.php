<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../index.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../../templates/header.php");
    include('../../../../connection/conexion.php');
    include("../../../usuarios/consulta.php");
    include('consulta.php');
} else {
    echo "Error en el sistema";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<main id="main" class="main">
    <div class="row">
        <div class="card-header" style="text-align: right;">
            <a class="btn btn-outline-dark" href="genepaci.php" role="button">
                <i class="bi bi-printer-fill"></i>
            </a>
        </div>
        <hr>
        <div class="card">
            <div class="card-header">
            <a class="btn btn-outline-primary" href="crear.php" role="button">
                <i class="bi bi-clipboard-check-fill"></i>
                    Registrar asistencia
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-bordered  border-dark table-hover" id="myTable">
                        <thead class="table-dark">
                            <tr class="table-active table-group-divider" style="text-align: center;">
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Check In/<br>Check Out</th>
                                <th scope="col">Hora salida</th>
                                <th scope="col">Paciente</th>
                                <th scope="col">Ubicación</th>
                                <th scope="col">Fotografía</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lista_asistencias as $asistencias) { ?>
                            <tr>
                                <td>
                                    <?php echo $asistencias['nombreUsu']; ?>
                                </td>
                                <td>
                                    <?php echo $asistencias['apellidosUsu']; ?>
                                </td>
                                <td>
                                    <?php echo $asistencias['id_asistencias']; ?>
                                </td>
                                <td>
                                    <?php echo $asistencias['id_empleadoEnfermeria']; ?>
                                </td>
                                <td>
                                    <?php echo 'Hola'; //echo $asistencias['Paciente']; ?>
                                </td>
                                <td>
                                    <?php echo $asistencias['checkUbicacion']; ?>
                                </td>
                                <td>
                                    <?php echo $asistencias['checkFotografia']; ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>  
            </div>
        </div>
    </div>
</main>


<?php
    include('../../../../templates/footer.php');
?>