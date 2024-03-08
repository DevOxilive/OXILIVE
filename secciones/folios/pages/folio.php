<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("../model/historialFolio.php");
}
?>
<main class="main" id="main">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Folio <?php echo $folio; ?></h3>
                    <a href="" class="btn btn-outline-primary">Volver</a>
                </div>
                <hr>
            </div>
            <div class="card-body">
                <ul class="timeline-with-icons">
                    <?php foreach ($lista_historial as $historial) {
                        $tmstmp = strtotime($historial['fecha']);
                        $fecha = date('d-m-Y', $tmstmp);
                        $hora = date('H:i:s', $tmstmp);
                        switch ($historial['tipoMovimiento']) {
                            case 1:
                                $bg = "bg-primary-subtle";
                                $icon = "fa-file-import text-primary";
                                break;
                            case 2:
                                $bg = "bg-danger-subtle";
                                $icon = "fa-file-export text-danger";
                                break;
                            case 3:
                                $bg = "bg-warning-subtle";
                                $icon = "fa-box-archive text-warning";
                                break;
                            case 4:
                                $bg = "bg-success-subtle";
                                $icon = "hand-holding-box text-success";
                                break;
                        }
                    ?>
                        <li class="timeline-item mb-5 ps-3">
                            <span class="timeline-icon <?php echo $bg; ?>">
                                <i class="fa-solid <?php echo $icon; ?> fa-md fa-fw"></i>
                            </span>
                            <h5 class="fw-bold"><?php echo $historial['mov']; ?></h5>
                            <p class="text-muted my-3 fw-bold"><?php echo $fecha . " / " . $hora; ?></p>
                            <p class="text-muted mb-1 fw-semibold"><?php echo $historial['descripcion']; ?></p>
                            <p class="text-muted mb-2 fw-lighter fst-italic">
                                - Por el usuario
                                <a href="../../perfil/pages/profile.php?idus=<?php echo $historial['id_usuario']; ?>" class="fw-bold text-black">
                                    <?php echo $historial['usuario']; ?>
                                </a>
                            </p>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</main>