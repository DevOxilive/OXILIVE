<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    require_once "../../../connection/conexion.php";
} else {
    echo "Error en el sistema";
}
?>

<main id="main" class="main">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Archivo de Folios</h3>
                <hr>
                <div class="btn-box justify-content-first">
                    <a class="btn btn-outline-success" href="" role="button"><i class=""></i>Agregar</a>
                    <a class="btn btn-outline-info" href="" role="button"><i class=""></i>Quitar</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-striped" id="myTable">
                        <thead class="customers">
                            <tr class="table-active table-group-divider">
                                <th scope="col">Folio</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Tipo</th>
                            </tr>

                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</main>

<script src="../../js/tables.js"></script>
<?php
include("../../../templates/footer.php");
?>