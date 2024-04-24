<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("../model/historial.php");
}
?>
<main class="main" id="main">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Historial de Folios</h3>
                <hr>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <?php foreach ($lista_historial as $historial) { ?>
                        <li class="list-group-item">
                            <div class="row d-flex justify-content-between">
                                <div class="col-md-2 d-flex justify-content-center align-items-center">
                                    <?php switch ($historial['tipoMovimiento']) {
                                        case 1:
                                            $icon = 'bi bi-file-arrow-up-fill';
                                            $color = 'success';
                                            break;
                                        case 2:
                                            $icon = 'bi bi-file-arrow-down-fill';
                                            $color = 'primary';
                                            break;
                                        case 3:
                                            $icon = 'bi bi-circle';
                                            $color = 'warning';
                                            break;
                                        case 4:
                                            $icon = 'bi bi-circle';
                                            $color = 'danger';
                                            break;
                                    } ?>
                                    <div class="rounded-circle bg-<?php echo $color; ?>-subtle d-flex justify-content-center align-items-center" style="width: 4rem; height: 4rem;">
                                        <i class="<?php echo $icon; ?> fs-2 text-<?php echo $color; ?>"></i>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="col-md-6 d-flex justify-content-center">
                                            <?php echo $historial['mov']; ?>
                                        </div>
                                        /
                                        <div class="col-md-5 d-flex justify-content-center">
                                            <?php echo $historial['fecha']; ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <span class="d-flex justify-content-center">
                                            <?php echo $historial['adminFolio'] . " - " . $historial['bancoFolio']; ?>
                                        </span>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-9 d-flex justify-content-center">
                                            <?php echo $historial['descripcion']; ?>
                                        </div>
                                        <div class="col-md-3 d-flex justify-content-center">
                                            <i>- Por el usuario </i><b><?php  ?></b>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex justify-content-center align-items-center">
                                    <?php echo $historial['cantidad']; ?>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</main>