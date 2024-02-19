<?php

use PhpParser\Node\Expr\Print_;
use SebastianBergmann\Environment\Console;

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
    <div id="wrapper">
        <div class="content-area">
            <div class="container-fluid">
                <div class="text-right mt-3 mb-3 d-fixed">
                    <br><br><br>
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

                        <!--Aquì voy a poner la tabla super puesta-->
                        <div class="container mt-4" id="mostrar" style="display: none;">
                            <div class="row">
                                <div class="col-md-6 offset-md-3">
                                    <div class="card">
                                        <div class="card-header">
                                            LISTADO DE EMPLEADOS QUE NO TIENEN CONTRATO
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Nombre</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($contrato as $listado): ?>
                                                    <tr>
                                                        <td><?php echo $listado["emple"]; ?></td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="box box3" style="border-radius: 10px;">
                                <h3 style="color: black; text-align: center;">AQUÌ NOSE QUE PONER</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5 mb-4">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.slim.min.js"></script>
    <!-- <script src="../../../../dist/apexcharts.js"></script> -->
    <script src="assets/data.js"></script>
    <script src="assets/scripts.js"></script>
    <script>
    document.getElementById('btnToggle').addEventListener('click', function() {
        var mensaje = document.getElementById('mostrar');
        if (mensaje.style.display === 'none') {
            mensaje.style.display = 'block';
        } else {
            mensaje.style.display = 'none';
        }
    });
    </script>
</body>

</html>
<?php
 include("../../templates/footer.php");
?>