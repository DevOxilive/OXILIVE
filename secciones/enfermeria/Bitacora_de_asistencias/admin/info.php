<?php
session_start();
if (!isset($_SESSION['us'])) {
  header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
  include("../../../../templates/header.php");
  include("../../../../connection/conexion.php");
  include("./consulta_asis.php");

  // Array para almacenar IDs de usuarios ya mostrados
  $usuariosMostrados = array();

  ?>
<main id="main" class="main">
    <?php foreach($lista_asistencias as $registro) {
      // Verificar si el usuario ya ha sido mostrado
      if (!in_array($registro['id_empleadoEnfermeria'], $usuariosMostrados)) {
        // Mostrar la información del usuario
        ?>
    <div class="card" style="width: 25rem;">
        <div class="card-body">
            <div class="text-center">
                <ul class="list-group list-group-flush">
                    <!-- Muestra la imagen si está disponible -->
                    <li><img class="card-img-top" src="data:image/jpeg;base64, <?php echo $registro['checkFotografia']; ?>"
                        alt="Card image cap"></li>
                </ul>
                <!-- llama a los datos para su consulta -->
                <div class="list-group-item list-group-item-dark">ID Usuarios:
                    <?php echo $registro['id_empleadoEnfermeria']; ?></div>
                <div class="list-group-item list-group-item-dark">Nombres y Apellidos:
                    <?php echo $registro['Nombres']; ?></div>
                <!-- Muestra la ubicacion en el mapa (espero no truene con esto) -->
                <div class="card-text">Ubicación: <?php echo $registro['checkLatitud']."".$registro["checkLongitud"]; ?>
                </div>
            </div>
        </div>
    </div>
    <?php
        // Agregar el ID del usuario al array de usuarios mostrados
        $usuariosMostrados[] = $registro['id_empleadoEnfermeria'];
      }
    }?>
</main>

<?php
  include("../../../../templates/footer.php");
} else {
  echo "Error en el sistema";
}
?>