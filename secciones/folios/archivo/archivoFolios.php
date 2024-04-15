<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    require_once "../../../connection/conexion.php";
    include_once("./consultaFolios.php");   

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
        <!--Por si se quiere agregar un boton o algo queda este div-->
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
                                <th scope="col">Estatus</th>
                                <th scope="col">Acciones</th>
                            </tr>
                            
                        </thead>
                        <?php foreach( $listaArchivoFolio as $estatus){ ?>
                        <tbody style="text-align: center;">
                            <tr>
                                <td><?php echo $estatus['folio']; ?></td>
                                <td><?php echo $estatus['bancoFolio']; ?></td>
                                <td><?php echo $estatus['folio']; ?></td>
                                <td><?php echo $estatus['estatus']; ?></td>
                                <td style="text-align: center;">
                                        <a class="btn btn-outline-primary" role="button"><i class="bi bi-box-arrow-right"></i></a>
                                        |
                                        <a class="btn btn-outline-danger"  role="button"><i class="bi bi-trash-fill"></i></a>
                                </td>
                            </tr>
                        </tbody>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
</main>
<script src="./js/ajaxFolios.js"></script>
<script src="../../js/tables.js"></script>
<?php
include("../../../templates/footer.php");
?>