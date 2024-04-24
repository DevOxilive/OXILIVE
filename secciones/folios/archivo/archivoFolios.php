<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    require_once "../../../connection/conexion.php";
    include_once("./consultaFolios.php");
?>

<main id="main" class="main">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Archivo de Folios</h3>
                <hr>
                <div class="btn-box justify-content-first">
                    <a class="btn btn-outline-primary" href="./devolucion.php" role="button"><i class="bi bi-box-arrow-right"></i> Archivar</a>
                    <div class="dropdown">
                        <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" id="btnFiltro">
                            <i class="bi bi-funnel-fill"></i> Filtro
                        </button>
                        <ul class="dropdown-menu" id="lista">
                            <?php foreach ($fls as $bFl) { ?>
                                <li><a class="dropdown-item" href="archivoFolios.php?txtID=<?php echo $bFl['id_folio'];   ?>" onclick="filtro(event, '<?php echo $bFl['bancoFolio']; ?>')"><?php echo $bFl['bancoFolio']; ?></a></li>
                            <?php } ?>
                            <li class="deleteFilter"><a class="dropdown-item text-danger" href="#" onclick="limpiarFiltro(event)">Restaurar filtro</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-striped" id="myTable">
                        <thead class="customers">
                            <tr class="table-active table-group-divider">
                                <th scope="col">Banco</th>
                                <th scope="col">Folio</th>
                                <th scope="col">Estatus</th>
                                <th scope="col">Observaciones</th>
                            </tr>
                        </thead>
                        <?php foreach ($listaArchivoFolio as $estatus) { ?>
                            <tbody style="text-align: center;">
                                <tr>
                                    <td><?php echo $estatus['bancoFolio']; ?></td>
                                    <td><?php echo $estatus['folio']; ?></td>
                                    <td><span class="badge text-bg-success <?php echo ($estatus['estatus'] == 'ALMACENADO') ? 'success' : 'text-bg-danger'; ?> fs-6"><?php echo $estatus['estatus']; ?></span></td>
                                    <td style="text-align: center;"> | <a class="btn btn-outline-warning" role="button"><i class="bi bi-eye"></i></a></td>
                                </tr>
                            </tbody>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
</main>
<script src="./js/ajaxFolios.js"></script>

<script src="./js/filtro.js"></script>
<script src="./js/ajaxFolios.js"></script>
<?php
include("../../../templates/footer.php");
} else {
    echo "Error en el sistema";
}
?>
