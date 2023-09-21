<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../../login.php');
} elseif (isset($_SESSION['us'])){
    include("../../../connection/conexion.php");
    include("../../../templates/hea.php");
    include("../../../module/genero.php");
    include("../../../module/estado.php");
    
} else {
    echo "Error en el sistema";
}
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Toma de asistencia</title>
    <!-- Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link href="<?php echo $url_base; ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $url_base; ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?php echo $url_base; ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?php echo $url_base; ?>assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?php echo $url_base; ?>assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?php echo $url_base; ?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?php echo $url_base; ?>assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link href="<?php echo $url_base; ?>assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!--Librerias de despliegue iconos-->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Estilos de la cámara -->
    <link rel="stylesheet" href="css/camara.css"> 
</head>
<body>
    <center>
	    <video muted id="video"></video>
	    <canvas id="canvas"></canvas>
        <div class="row btn-bar">
            <div class="ps-4" >
                <a class="btn btn-outline-danger" onclick="confirmCancel(event)" id="cancelar" role="button">
                        Cancelar
                </a>
            </div>
            <div class="ps-4" >
                <a class="btn btn-outline-primary" href="" id="boton" role="button">
                        Tomar foto
                </a>
            </div>
        </div>
    </center>
    <!-- Etiqueta oculta para mandar el id del usuario de la sesión que va a dar su check -->
    <input type="hidden" id="idUser" name="idUser" value="<?php echo $_SESSION['idus']; ?>">

    <input type="hidden" id="status" name="status" value="<?php echo $_SESSION['estado']; ?>">
    
    <!-- Etiqueta oculta para mandar la ubicación del usuario -->
    <input type="hidden" id="latitud" name="latitud">
    <input type="hidden" id="longitud" name="longitud">
</body>
<!-- Función de la cámara -->
<script src="js/camara.js"></script>