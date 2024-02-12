<?php
session_start();
if (!isset($_SESSION['us'])) {
  header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
  include("../../templates/header.php");
  include("./consulta.php");
} else {
  echo "Error en el sistema";
}
?>
<main id="main" class="main">
    <div class="row">
        <div class="card-header" style="text-align: right;">
            <h1 style="text-align: center; color:black">Administradoras Y Bancos Asociados</h1>
        </div>
        <div class="card">
            <div class="card-header">
            <a class="btn btn-outline-success" href="../bancos/index.php" role="button"><i class="bi bi-bank2"></i>Regresar</a>       
        </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table   border-dark table-hover" id="myTable">
                        <thead class="table-dark">
                            <tr class="table-active table-group-divider" style="text-align: center;">
                                <th scope="col">Bancos</th>
                                <th scope="col">Administradora</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listaGeneral as $registro) { ?>
                            <tr class="" style="text-align: center; ">
                                <td><?php echo $registro['Nombre_banco']; ?></td>
                                <td><?php echo $registro['Nombre_administradora'];?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</main>
<script src="../../js/tables.js"></script>
<?php
include("../../templates/footer.php");
?>