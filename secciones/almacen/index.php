<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../templates/header.php");
} else {
    echo "Error en el sistema";
}
?>
<main id="main" class="main">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-16">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Inicio</h3>
                        <hr>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Reporte Almacen <span>/Hoy</span></h5>
                        <div id="reportsChart"></div>
                    </div>

                </div>
            </div>
        </div>

</main>

</html>
<?php
include("../../templates/footer.php");
?>