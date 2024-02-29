<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../templates/header.php");
    include("../../connection/conexion.php");
    $sentencia = $con->prepare("SELECT *, CONCAT(e.nombres, ' ', e.apellidos) AS emple 
    FROM  empleados e 
    WHERE contrato = 'NO CONTRATADO';");
    $sentencia->execute();
    $contrato = $sentencia->fetchAll(PDO::FETCH_ASSOC);
} else {
    echo "Error en el sistema";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:400,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="assets/styles.css" />
</head>
<body>
<main id="main" class="main">
<div class="row">
    <div class="card">
        <div id="wrapper">
            <div class="content-area">
                <div class="container-fluid">
                    <div class="text-right mt-3 mb-3 d-fixed">
                    </div>
                   
                    <div class="row mt-3 mb-3">
                        <div class="col-md-6">
                            <div class="box">
                                <div id="bar"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="box">
                                <div id="donut"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
 include("../../templates/footer.php");
?>
    </div>
</div>

<main id="main" class="main">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.slim.min.js"></script>
    <script src="assets/data.js"></script>
    <script src="assets/scripts.js"></script>
<script>
            document.getElementById('btnToggle').addEventListener('click', function() {
            var tabla = document.getElementById('mostrar');
            if (tabla.style.display === 'none') {
                tabla.style.display = 'block';
                setTimeout(function() {
                    tabla.style.opacity = '1';
                }, 20); // Se inicia la transición después de un breve tiempo para que funcione correctamente
            } else {
                tabla.style.opacity = '0';
                setTimeout(function() {
                    tabla.style.display = 'none';
                },500); // Duración de la transición, ajusta según lo necesario
            }
        });
</script>
