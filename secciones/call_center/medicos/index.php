<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../../login.php');
}elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("../../../connection/conexion.php");
    include("consulta.php");
}else{
    echo "Error en el sistema";
}
?>
<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="<?php echo $url_base; ?>assets/css/foto_perfil.css">
    <link rel="stylesheet" href="<?php echo $url_base; ?>assets/css/edit.css">
</head>
<main id="main" class="main">
    <input type="hidden" id="statusUs" name="statusUs" value="<?php echo $_SESSION['estado']; ?>">
    <div class="pagetitle">
        <!-- Encabezado dinámico dependiendo el género y el nombre del usuario -->
        <h1>
            <!-- Bienvenid<?php if ($_SESSION['genero'] == 1) { ?>o<?php } else { ?>a<?php } ?>
            <?php echo ucfirst(strtolower($_SESSION['no'])); ?> -->
        </h1>
    </div><!-- End Page Title -->
    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-12">
                <div class="card info-card next-service-card">
                    <div class="card-body">
                        <!--Aquí empiezo mis pruebas xD-->
                        <?php foreach ($ltServicio as $servicio) : ?>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Solicitado por: <?php echo $servicio['nom_solicitante']; ?></h5>
                                <p class="card-text">Motivo de consulta: <?php echo $servicio['moti_consulta']; ?></p>
                                <div class="map-container">
                                    <!-- <iframe
                                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1dLATITUD!2dLONGITUD!3d15!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTXCsDQzJzQ1LjEiTiAxNcKwMzUnMTkuMCJX!5e0!3m2!1sen!2sus!4v1622145678145!5m2!1sen!2sus"
                                                width="600" height="450" style="border:0;" allowfullscreen=""
                                                loading="lazy"></iframe> -->
                                </div>
                                <!-- Botón "Iniciar Servicio" -->
                                <?php
                                    $asignacion = $servicio['asignacion'];
                                    if ($asignacion == 1) {
                                    $mensaje = "Servicio Iniciado";
                                    } else {
                                    $mensaje = "Iniciar Servicio";
                                    }
                                ?>
                                <a href="#" class="btn btn-primary" onclick="mostrarAlerta('<?php echo $mensaje; ?>')"><?php echo $mensaje; ?></a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <!--Aquí termina mi card de iniciar el servicio-->
                    </div>
                </div>
            </div>
            <!--Este es su modelo de alex End Card Próximo Servicio -->
            <!-- Card Actividad reciente -->
            <div class="col-12">
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filtro</h6>
                            </li>

                            <li><a class="dropdown-item" onclick="range(this)">Hoy</a></li>
                            <li><a class="dropdown-item" onclick="range(this)">Esta semana</a></li>
                            <li><a class="dropdown-item" onclick="range(this)">Esta quincena</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Actividad Reciente <span>| </span><span id="range-activity">Hoy</span>
                        </h5>

                        <div class="activity" id="activity">

                        </div>

                    </div>
                </div>
            </div><!-- End Actividad reciente -->
            <!-- Horarios del usuario -->
            <div class="col-12">
                <div class="card info-card customers-card">
                    <!-- Filtro -->
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>
                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>
                    <!-- End Filtro -->
                    <div class="card-body">
                        <h5 class="card-title">Horarios <span>| Últimos tres</span></h5>

                    </div>
                </div>
            </div><!-- End Horarios del usuario -->

        </div>
        </div>
        <!-- End Left side columns -->
        </div>
    </section>
</main>

</html>

<script>
    function mostrarAlerta(mensaje) {
        alert(mensaje);
    }
</script>
<script src="js/nextService.js"></script>
<script src="js/rangeActivity.js"></script>
<?php
include("../../../templates/footer.php");
?>