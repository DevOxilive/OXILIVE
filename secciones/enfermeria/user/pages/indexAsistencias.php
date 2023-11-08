<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../../templates/header.php");
    include("../../../../connection/conexion.php");
    $id = $_GET['id'];
    include("../model/fechasAsistencias.php");
} else {
    echo "Error en el sistema";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="<?php echo $url_base; ?>assets/css/foto_perfil.css">
    <link rel="stylesheet" href="<?php echo $url_base; ?>assets/css/edit.css">
    <link rel="stylesheet" href="<?php echo $url_base; ?>secciones/enfermeria/user/css/timeline.css">
</head>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Asistencias</h1>
        <br>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo $url_base; ?>secciones/enfermeria/user/index.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Asistencias</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard">
        <div class="page-content page-container" id="page-content">
            <div class="padding">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="timeline p-4 block mb-4">
                            <div class="tl-item active">
                                <div class="tl-dot b-warning"></div>
                                <div class="tl-content">
                                    <div class="">@twitter thanks for you appreciation and @google thanks for you appreciation</div>
                                    <div class="tl-date text-muted mt-1">13 june 18</div>
                                </div>
                            </div>
                            <div class="tl-item">
                                <div class="tl-dot b-primary"></div>
                                <div class="tl-content">
                                    <div class="">Do you know how Google search works.</div>
                                    <div class="tl-date text-muted mt-1">45 minutes ago</div>
                                </div>
                            </div>
                            <div class="tl-item">
                                <div class="tl-dot b-danger"></div>
                                <div class="tl-content">
                                    <div class="">Thanks to <a href="#" data-abc="true">@apple</a>, for iphone 7</div>
                                    <div class="tl-date text-muted mt-1">1 day ago</div>
                                </div>
                            </div>
                            <div class="tl-item">
                                <div class="tl-dot b-danger"></div>
                                <div class="tl-content">
                                    <div class="">Order placed <a href="#" data-abc="true">@eBay</a> you will get your products</div>
                                    <div class="tl-date text-muted mt-1">1 Week ago</div>
                                </div>
                            </div>
                            <div class="tl-item">
                                <div class="tl-dot b-warning"></div>
                                <div class="tl-content">
                                    <div class="">Learn how to use <a href="#" data-abc="true">Google Analytics</a> to discover vital information about your readers.</div>
                                    <div class="tl-date text-muted mt-1">3 days ago</div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
</main>
<script src="../js/timeline.js"></script>

</html>
<?php
include("../../../../templates/footer.php");
?>