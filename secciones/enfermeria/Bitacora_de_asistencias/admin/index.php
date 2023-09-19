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
            <h5 class="card-title">Bitacora de asistencias</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-bordered  border-dark table-hover" id="myTable">
                        <thead class="table-dark">
                            <tr class="table-active table-group-divider" style="text-align: center;">
                                <th scope="col">Nombre completo</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Hora de entrada</th>
                                <th scope="col">Hora de salida</th>
                                <th scope="col">Estatus</th>
                                <th scope="col">Mas detalles</th>
                            </tr>
                        </thead>
                        <tbody>

                        
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