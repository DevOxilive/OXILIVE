<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("../../../connection/conexion.php");
    include("model/proxServicio.php");
} else {
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
            Bienvenid<?php if ($_SESSION['genero'] == 1) { ?>o<?php } else { ?>a<?php } ?>
            <?php echo ucfirst(strtolower($_SESSION['no'])); ?>
        </h1>
        <br>

        <!-- breadcrumb del dashboard pasado -->
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">
                    <!-- Card Proximo Servicio -->
                    <div class="col-12">
                        <div class="card info-card next-service-card" id="service-card">
                            <div class="card-body">
                                <h5 class="card-title">Próximo servicio</h5>
                                <?php if (!empty($lista_servicios)) { ?>
                                    <?php foreach ($lista_servicios as $servicios) { ?>
                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-clipboard-pulse"></i>
                                            </div>
                                            <div class="ps-4 ">
                                                <h6><a class="text-black" href="../../pacientes/paciente.php?idPac=<?php echo $servicios['id_pacientes']?>"><?php echo $servicios['nomPaciente']; ?></a></h6>
                                                <span class="text-muted small pt-2 ps-1"><?php echo $servicios['nomGuardia']; ?></span>
                                            </div>
                                        </div>
                                        <br>
                                        <!-- Botón de Empezar/Terminar Servicio -->
                                        <div class="ps-4" id="service-button"></div>
                                        <input type="hidden" id="idHor" name="idHor" value="<?php echo $servicios['id_asignacionHorarios'] ?>">
                                    <?php } ?>
                                <?php } else { ?>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-emoji-frown"></i>
                                        </div>
                                        <div class="ps-4 ">
                                            <h6>¡Lo siento!</h6>
                                            <span class="text-muted small pt-2 ps-1">No tienes próximos servicios</span>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div><!-- End Card Próximo Servicio -->
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
                                <h5 class="card-title">Actividad Reciente <span>| </span><span id="range-activity">Hoy</span></h5>

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
                                <h5 class="card-title">Horarios <span>| </span><span id="range-schedule">Semana</span></h5>
                                    
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
<script src="js/nextService.js"></script>
<script src="js/rangeActivity.js"></script>
<?php
include("../../../templates/footer.php");
?>