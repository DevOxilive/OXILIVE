<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../templates/header.php");
    include("model/cantidadFolios.php");
} else {
    echo "Error en el sistema";
}
?>
<!--<style>
    .nav-tabs {
        --bs-nav-tabs-border-color: #011A46;
        --bs-nav-tabs-border-width: 2px;
    }

    .nav-tabs .nav-link.active {
        border-top: 2px solid #011A46;
        border-right: 2px solid #011A46;
        border-left: 2px solid #011A46;
    }

    .nav-tabs .nav-link:hover {
        border-bottom: 2px solid #011A46;
    }
</style>-->
<main id="main" class="main">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Folios</h3>
                <hr>
            </div>
            <div class="card-body">
                <?php if ($_SESSION['puesto'] == 1 || $_SESSION['puesto'] == 8) { ?>
                    <div class="btn-box justify-content-start">
                        <a href="pages/entradaFolios.php" class="btn btn-primary">
                            <i class="bi bi-box-arrow-in-right"></i> Entrada
                        </a>
                        <a href="pages/entradaFolios.php" class="btn btn-warning" role="button">
                            <i class="bi bi-box-arrow-right"></i> Salida
                        </a>
                    </div>
                <?php } ?>
                <nav>
                    <div class="nav nav-tabs" id="folios-nav" role="tablist">
                        <button class="nav-link fw-bolder active" id="nav-consul-tab" data-bs-toggle="tab" data-bs-target="#nav-consul" type="button" role="tab" aria-controls="nav-consul" aria-selected="true">Consultas</button>
                        <button class="nav-link fw-bolder" id="nav-rec-tab" data-bs-toggle="tab" data-bs-target="#nav-rec" type="button" role="tab" aria-controls="nav-rec" aria-selected="false">Recetas</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-consul" role="tabpanel" aria-labelledby="nav-consul-tab" tabindex="0">
                        <br>
                        <div class="table-responsive-sm">
                            <table class="table table-striped" id="myTable">
                                <thead class="customers">
                                    <tr class="table-active table-group-divider">
                                        <th scope="col">Administradora</th>
                                        <th scope="col">Banco</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    <?php foreach ($consulta_cant as $cons) { ?>
                                        <tr>
                                            <td><?php echo $cons['adminFolio']; ?></td>
                                            <td><?php echo $cons['bancoFolio']; ?></td>
                                            <td><?php echo $cons['cantidadFolios']; ?></td>
                                            <td><a href="pages/listado.php?admin=<?php echo $cons['adminFolio']; ?>&banco=<?php echo $cons['bancoFolio']; ?>&tipo=CONSULTA&estado=3" class="btn btn-primary"><i class="bi bi-list-stars"></i></a></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-rec" role="tabpanel" aria-labelledby="nav-rec-tab" tabindex="0">
                        <br>
                        <div class="table-responsive-sm">
                            <table class="table table-striped" id="myTable2">
                                <thead class="customers">
                                    <tr class="table-active table-group-divider">
                                        <th scope="col">Administradora</th>
                                        <th scope="col">Banco</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    <?php foreach ($receta_cant as $cons) { ?>
                                        <tr>
                                            <td><?php echo $cons['adminFolio']; ?></td>
                                            <td><?php echo $cons['bancoFolio']; ?></td>
                                            <td><?php echo $cons['cantidadFolios']; ?></td>
                                            <td><a href="pages/listado.php?admin=<?php echo $cons['adminFolio']; ?>&banco=<?php echo $cons['bancoFolio']; ?>&tipo=RECETA&estado=3" class="btn btn-primary"><i class="bi bi-list-stars"></i></a></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="../../js/tables.js"></script>
<?php
include("../../templates/footer.php");
?>