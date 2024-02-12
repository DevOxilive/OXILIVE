<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../templates/header.php");
    include("../../model/administradora.php");
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
                <nav>
                    <div class="nav nav-tabs" id="folios-nav" role="tablist">
                        <button class="nav-link fw-bolder active" id="nav-consul-tab" data-bs-toggle="tab" data-bs-target="#nav-consul" type="button" role="tab" aria-controls="nav-consul" aria-selected="true">Consultas</button>
                        <button class="nav-link fw-bolder" id="nav-rec-tab" data-bs-toggle="tab" data-bs-target="#nav-rec" type="button" role="tab" aria-controls="nav-rec" aria-selected="false">Recetas</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-consul" role="tabpanel" aria-labelledby="nav-consul-tab" tabindex="0">
                        <br>
                        <?php foreach($lista_administradora as $admin){ ?>
                        <div class="card card-list">
                            <div class="card-header" data-bs-toggle="collapse" data-bs-target="#sub<?php echo $admin['id_administradora']; ?>">
                                <h5 class="item-title"><?php echo $admin['Nombre_administradora']; ?></h5>
                            </div>
                            <div class="card-body collapse" id="sub<?php echo $admin['id_administradora']; ?>">
                                bancos
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="tab-pane fade" id="nav-rec" role="tabpanel" aria-labelledby="nav-rec-tab" tabindex="0">
                    <br>
                        <?php foreach($lista_administradora as $admin){ ?>
                        <div class="card card-list">
                            <div class="card-header" data-bs-toggle="collapse" data-bs-target="#sub<?php echo $admin['id_administradora']; ?>">
                                <h5 class="item-title"><?php echo $admin['Nombre_administradora']; ?></h5>
                            </div>
                            <div class="card-body collapse" id="sub<?php echo $admin['id_administradora']; ?>">
                                bancos 
                            </div>
                        </div> >
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include("../../templates/footer.php");
?>