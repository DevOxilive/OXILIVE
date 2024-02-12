<?php
session_start();
if (!isset($_SESSION['us']) || $_SESSION['puesto'] != 4) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us']) && $_SESSION['puesto'] == 4) {
    include("../../templates/header.php");
    include_once './choferes/consulta.php';
    include_once './equipo/consulta.php';
    include_once './rutas/consulta.php';
} else {
    echo "Error en el sistema";
}
?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">
                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-12">

                        <div class="card info-card customers-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filtro</h6>
                                    </li>
                                    <?php foreach ($lista_choferes as $registro) { ?>
                                        <?php if ($registro['estado'] == 1) {  ?>
                                            <li><a class="dropdown-item" href="#"><?php echo $registro['Nombre_completo']; ?></a></li>
                                        <?php } ?>
                                    <?php } ?>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Cantidad de choferes a tu disposicion <span>| Actualmente</span>
                                </h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>
                                            <?php echo $cantidad_choferes ?> SIN PROCESOS</h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $cantidad_choferes ?> de <span class="text-muted small pt-2 ps-1"><?php echo $cantidad_chofer ?></span>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div><!-- End Customers Card -->
                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Tanques de oxigeno <span>| Disponibles y llenos</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-speedometer"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?php echo $sumTan ?> TOTAL</h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $lleIn ?> de INFRA llenos</span> <br>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $lleVer ?> VERDES llenos</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filtro</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#"><?php echo $ru_firma ?> para recoleccion de firma</a></li>
                                    <li><a class="dropdown-item" href="#"><?php echo $ru_entrega ?> para entrega de equipo o insumos</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Concentradores <span> Disponibles y llenos</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-box2-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>
                                            <?php echo $cantiCON ?> TOTAL</h6>
                                        <span class="text-success small pt-1 fw-bold"> <?php echo $concen_lle ?> Concentradores llenos</span> <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filtro</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#"><?php echo $ru_firma ?> para recoleccion de firma</a></li>
                                    <li><a class="dropdown-item" href="#"><?php echo $ru_entrega ?> para entrega de equipo o insumos</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Portatiles <span> Disponibles y llenos</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-train-freight-front-fill" style="color: blue;"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>
                                            <?php echo $cantiCON ?> TOTAL</h6>
                                        <span class="text-success small pt-1 fw-bold"> <?php echo $concen_lle ?> Concentradores llenos</span> <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filtro</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#"><?php echo $ru_firma ?> para recoleccion de firma</a></li>
                                    <li><a class="dropdown-item" href="#"><?php echo $ru_entrega ?> para entrega de equipo o insumos</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Aspirador <span> Disponibles y llenos</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-train-lightrail-front-fill" style="color: brown;"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>
                                            <?php echo $cantiCON ?> TOTAL</h6>
                                        <span class="text-success small pt-1 fw-bold"> <?php echo $concen_lle ?> Concentradores llenos</span> <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filtro</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#"><?php echo $ru_firma ?> para recoleccion de firma</a></li>
                                    <li><a class="dropdown-item" href="#"><?php echo $ru_entrega ?> para entrega de equipo o insumos</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Cpac <span> Disponibles y llenos</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-exclamation" style="color:red;"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>
                                            <?php echo $cantiCON ?> TOTAL</h6>
                                        <span class="text-success small pt-1 fw-bold"> <?php echo $concen_lle ?> Concentradores llenos</span> <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filtro</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#"><?php echo $ru_firma ?> para recoleccion de firma</a></li>
                                    <li><a class="dropdown-item" href="#"><?php echo $ru_entrega ?> para entrega de equipo o insumos</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Bicap <span> Disponibles y llenos</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-exclamation" style="color:red;"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>
                                            <?php echo $cantiCON ?> TOTAL</h6>
                                        <span class="text-success small pt-1 fw-bold"> <?php echo $concen_lle ?> Concentradores llenos</span> <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filtro</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#"><?php echo $ru_firma ?> para recoleccion de firma</a></li>
                                    <li><a class="dropdown-item" href="#"><?php echo $ru_entrega ?> para entrega de equipo o insumos</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Aguas <span> Disponibles y llenos</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-droplet-fill" style="color:white;"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>
                                            <?php echo $cantiCON ?> TOTAL</h6>
                                        <span class="text-success small pt-1 fw-bold"> <?php echo $concen_lle ?> Concentradores llenos</span> <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filtro</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#"><?php echo $ru_firma ?> para recoleccion de firma</a></li>
                                    <li><a class="dropdown-item" href="#"><?php echo $ru_entrega ?> para entrega de equipo o insumos</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Vaso borboteador <span> Disponibles y llenos</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-prescription2" style="color:purple;";></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>
                                            <?php echo $cantiCON ?> TOTAL</h6>
                                        <span class="text-success small pt-1 fw-bold"> <?php echo $concen_lle ?> Concentradores llenos</span> <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- End Left side columns -->
            <!-- Right side columns -->
            <div class="col-lg-4">
                <!-- Recent Activity -->
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filtro</h6>
                            </li>

                            <li><a class="dropdown-item" href="#"><?php echo $ru_firma ?> para recoleccion de firma</a></li>
                            <li><a class="dropdown-item" href="#"><?php echo $ru_entrega ?> para entrega de equipo o insumos</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Rutas pendientes <span>| Hoy <?php echo date("Y-m-d"); ?></span></h5>
                        <div class="activity">
                            <div class="activity-item d-flex">
                                <div class="info-card revenue-card">
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-pci-card"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>
                                                <?php echo $canti_rutas ?> en proceso</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Recent Activity -->
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filtro</h6>
                            </li>

                            <li><a class="dropdown-item" href="#"><?php echo $ru_firma ?> para recoleccion de firma</a></li>
                            <li><a class="dropdown-item" href="#"><?php echo $ru_entrega ?> para entrega de equipo o insumos</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Reguladores <span>| Disponibles y llenos</span></h5>
                        <div class="activity">
                            <div class="activity-item d-flex">
                                <div class="info-card revenue-card">
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-lungs-fill" style="color: orange;"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>
                                                <?php echo $canti_rutas ?> TOTAL</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filtro</h6>
                            </li>

                            <li><a class="dropdown-item" href="#"><?php echo $ru_firma ?> para recoleccion de firma</a></li>
                            <li><a class="dropdown-item" href="#"><?php echo $ru_entrega ?> para entrega de equipo o insumos</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Mascarilla <span>| Disponibles y llenos</span></h5>
                        <div class="activity">
                            <div class="activity-item d-flex">
                                <div class="info-card revenue-card">
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-heart-pulse-fill" style="color:  black;"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>
                                                <?php echo $canti_rutas ?> TOTAL</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filtro</h6>
                            </li>

                            <li><a class="dropdown-item" href="#"><?php echo $ru_firma ?> para recoleccion de firma</a></li>
                            <li><a class="dropdown-item" href="#"><?php echo $ru_entrega ?> para entrega de equipo o insumos</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Canula <span>| Disponibles y llenos</span></h5>
                        <div class="activity">
                            <div class="activity-item d-flex">
                                <div class="info-card revenue-card">
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-exclamation" style="color:red;"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>
                                                <?php echo $canti_rutas ?>TOTAL</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filtro</h6>
                            </li>

                            <li><a class="dropdown-item" href="#"><?php echo $ru_firma ?> para recoleccion de firma</a></li>
                            <li><a class="dropdown-item" href="#"><?php echo $ru_entrega ?> para entrega de equipo o insumos</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Rec taq <span>| Disponibles y llenos</span></h5>
                        <div class="activity">
                            <div class="activity-item d-flex">
                                <div class="info-card revenue-card">
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-exclamation" style="color:red;"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>
                                                <?php echo $canti_rutas ?>TOTAL</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Right side columns -->

        </div>
    </section>
</main><!-- End #main -->

</html>
<?php
include("../../templates/footer.php");
?>