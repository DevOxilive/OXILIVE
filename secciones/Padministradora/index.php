<?php
session_start();
if (!isset($_SESSION['us']) || $_SESSION['puesto'] != 2) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us']) && $_SESSION['puesto'] == 2) {
    include("../../templates/header.php");
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
                <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">
                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Tus pacientes </h5>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>
                                            <?php echo $cantidad_pacien ?> pacientes
                                        </h6>
                                        <span class="text-success small pt-1 fw-bold">Activos en tus aseguradoras</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Sales Card -->


        </div>
    </section>

</main><!-- End #main -->

</html>
<?php
include("../../templates/footer.php");
?>