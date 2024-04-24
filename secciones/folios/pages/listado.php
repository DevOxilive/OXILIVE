<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("../model/listaFolios.php");
}
?>
<main class="main" id="main">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title"><?php echo $admin . " - " . $banco; ?>
                        <span> (<?php echo $tipo; ?>)</span>
                    </h3>
                    <a onclick="backPage()" class="btn btn-outline-primary">Volver <i class="bi bi-arrow-return-left"></i></a>
                </div>
                <hr>
            </div>
            <div class="card-body">
                <div class="list-group">
                    <center>
                        <div class="col-3">
                            <?php foreach ($lista_folios as $fol) { ?>
                                <a href="folio.php?idFol=<?php echo $fol['id_folio']; ?>&folio=<?php echo $fol['folio']; ?>" class="list-group-item list-group-item-action list-group-item-primary"><?php echo $fol['folio'] ?></a>
                            <?php } ?>
                        </div>
                    </center>
                </div>
            </div>
        </div>
    </div>
</main>