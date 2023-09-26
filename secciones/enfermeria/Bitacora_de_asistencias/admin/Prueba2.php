<?php
session_start();
if (!isset($_SESSION['us'])) {
  header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
  include("../../../../templates/header.php");
  include("../../../../connection/conexion.php");

  // Debes preparar la consulta y crear una instancia de PDOStatement
  $sql = "SELECT *
  FROM usuarios U
  INNER JOIN registro_bitacora R ON U.id_usuarios = R.id_usuario
  INNER JOIN asistencias A_checkIn ON U.id_usuarios = A_checkIn.id_empleadoEnfermeria 
  AND R.id_checkIn = A_checkIn.id_asistencias
  WHERE id_Rbitacora = :idRbi";

  $stmt = $con->prepare($sql);

  // Asignar el valor a :idRbi
  $idRbi = $_SESSION['IdRb'];
  $stmt->bindParam(':idRbi', $idRbi);

  // Ejecutar la consulta preparada
  $stmt->execute();

  // Obtener el resultado
  $registro = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($registro) {
    // Ahora puedes acceder a los campos específicos
    $id_usuarios = $registro['id_usuarios'];
    $nombresApellidos = $registro['Nombres'] . " " . $registro["Apellidos"];
    $ubicacion = $registro['checkUbicacion'];

    // Puedes mostrar la imagen si está en la base de datos, asumiendo que 'checkFotografia' es el campo de la imagen
    $imagenBase64 = base64_encode($registro['checkFotografia']);
  } else {
    echo "No se encontraron resultados para el id_Rbitacora deseado.";
  }
} else {
  echo "Error en el sistema";
}
?>

<!-- Empieza main -->
<main id="main" class="main">
  <div class="card" style="width: 18rem;">
    <!-- Muestra la imagen si está disponible -->
    <img class="card-img-top" src="data:image/jpeg;base64, <?php echo $imagenBase64; ?>" alt="Card image cap">
    <div class="card-body">
      <div class="text-center">
        <thead class="list-dark">
          <ul class="list-group list-group-flush">
            <!-- Muestra los detalles del registro -->
            <li class="list-group-item list-group-item-dark">ID Usuarios: <?php echo $id_usuarios; ?></li>
            <li class="list-group-item list-group-item-dark">Nombres y Apellidos: <?php echo $nombresApellidos; ?></li>
          </ul>
        </thead>
        <div class="card-body">
          <!-- Muestra la ubicación -->
          <div class="card-text">Ubicación: <?php echo $ubicacion; ?></div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php
include("../../../../templates/footer.php");
?>
