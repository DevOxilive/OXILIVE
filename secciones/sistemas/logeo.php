<?php
session_start();
if (!isset($_SESSION['us'])) {
  header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
  include("../../templates/header.php");
  include ("../../connection/conexion.php");
  include("../../secciones/usuarios/consulta.php");
} else {
  echo "Error en el sistema";
}

?>
<main id="main" class="main">
  <div class="row">
    <div class="card">
      <div class="card-header">
      <div class="card-header">
                <h4
                    style="text-align: center; color: black; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    <i class="bi bi-door-open-fill"></i>Logeo de los usuarios</h4>
            </div>
    </div>
    <div class="card-body">
      <div class="table-responsive-sm">
        <table class="table   border-dark table-hover" id="myTable">
          <thead class="table-dark">
            <tr class="table-active table-group-divider" style="text-align: center;">
              <th scope="col">Num</th>
              <th scope="col">Nombre</th>
              <th scope="col">Usuario</th>
              <th scope="col">Cantidad de logeos</th>
            </tr>
          </thead>
          <tbody>
        <?php foreach($lista_usuarios as $registro ){ ?>
          <tr>
            <th scope="row"><?php echo $registro['id_usuarios']; ?></th>
            <td><?php echo $registro['Nombres']; ?></td>
            <td><?php echo $registro['Usuario']; ?></td>
            <td style="text-align: center;"><?php echo $registro['inicios_sesion']; ?></td>            
            </tr>
            <?php }?>
        </tbody>
        </table>
      </div>
    </div>
  </div>
  
</main><!-- End #main -->
<script>
  $(document).ready(function () {
    $.noConflict();

    $('#myTable').DataTable({
      "language": {
        "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
      }
    });

  });
</script>
<?php
include("../../templates/footer.php");
?>