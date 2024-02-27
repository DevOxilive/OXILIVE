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
                                <div class="col-md-1 d-flex justify-content-center align-items-center">
                                    <?php switch ($historial['tipoMovimiento']) {
                                        case 1:
                                    ?>
                                            <i class="bi bi-circle"></i>
                                        <?php
                                            break;
                                        case 2:
                                        ?>
                                            <i class="bi bi-circle"></i>
                                        <?php
                                            break;
                                        case 3:
                                        ?>
                                            <i class="bi bi-circle"></i>
                                        <?php
                                            break;
                                        case 4:
                                        ?>
                                            <i class="bi bi-circle"></i>
                                    <?php
                                            break;
                                    } ?>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <?php echo $historial['mov']; ?>
                                    </div>
                                    <div class="row">
                                        <span>
                                            <?php echo $historial['adminFolio'] . " - " . $historial['bancoFolio']; ?>
                                        </span>
                                    </div>
                                    <div class="row">
                                        <?php echo $historial['descripcion']; ?>
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