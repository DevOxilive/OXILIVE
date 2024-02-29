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
                    <div class="main">
                        <div class="row sparkboxes mt-4 mb-4">
                            <div class="col-md-4">
                                <a href="./empleados/crear.php" class="color">
                                    <div class="box box1">
                                        <h3>REGISTRAR <i class="bi bi-people-fill"></i></h3>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="#" id="btnToggle" class="color">
                                    <div class="box box2">
                                        <h3>SIN CONTRATOS <i class="bi bi-person-rolodex"></i></h3>
                                    </div>
                                </a>
                             </div>
                    </div>
                        <!--Aquì voy a poner la tabla super puesta-->
                        <div class="container mt-6" id="mostrar" style="display: none;">
                            <div class="row">
                                <div class="col-md-8 offset-md-2">
                                    <div class="card">
                                        <div class="card-header text-center">
                                            LISTADO DE EMPLEADOS QUE NO TIENEN CONTRATO
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>Nombre</th>
                                                        <th>Estatus</th>
                                                        <th>Editar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($contrato as $listado): ?>
                                                    <tr class="text-center">
                                                        <td><?php echo $listado["emple"];?></td>
                                                        <td><span class="badge text-bg-success <?php echo ($listado['contrato'] == 'SI CONTRATADO') ? 'success' :'text-bg-danger'; ?> fs-6"><?php echo $listado['contrato']; ?></span></td>
                                                        <td><a class="btn btn-primary" href="empleados/editar.php?txtID=<?php echo $listado['id_empleado']; ?>" role="button"> <i class="bi bi-pencil-fill"></i></a></td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
