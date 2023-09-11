<?php
session_start();
if (!isset($_SESSION['us']) || $_SESSION['puesto'] != 9) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])|| $_SESSION['puesto'] == 2) {
    include("../../templates/header.php");
    include("./consulta.php");
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

                            <div class="card-body">
                                <h5 class="card-title">Tus rutas pendientes <span>| Actualmente</span>
                                </h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>
                                            <?php echo $cantidad_rutas ?> restantes</h6>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div><!-- End Customers Card -->
                    
        </div>
    </section>

</main><!-- End #main -->

</html>
<?php
include("../../templates/footer.php");
?>