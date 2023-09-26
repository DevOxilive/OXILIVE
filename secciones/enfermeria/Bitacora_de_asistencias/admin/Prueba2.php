<?php
session_start();
if (!isset($_SESSION['us'])) {
  header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
  include("../../../../templates/header.php");
  include("../../../../connection/conexion.php");
  include("./consulta_asis.php");
}else {
  echo "Error en el sistema";
}

?>



<main id="main" class="main">
  <div class="card" style="width: 18rem;">
    <!-- Muestra la imagen si está disponible -->
    <?php foreach($lista_asistencias as $registro ){ ?>
    <img class="card-img-top" src="data:image/jpeg;base64, <?php echo $registro['checkFotografia']; ?>" alt="Card image cap">
    <div class="card-body">
      <div class="text-center">
        <ul class="list-group list-group-flush">
          <li class="list-group-item list-group-item-dark">ID Usuarios: <?php echo $registro['id_empleadoEnfermeria']; ?></li>
          <li class="list-group-item list-group-item-dark">Nombres y Apellidos: <?php echo $registro['Nombres']; ?></li>
        </ul>
        <div class="card-text">Ubicación: <?php echo $registro['checkUbicacion']; ?></div>
      </div>
    </div>
    <?php }?>
  </div>
</main>

<?php
include("../../../../templates/footer.php");
?>
