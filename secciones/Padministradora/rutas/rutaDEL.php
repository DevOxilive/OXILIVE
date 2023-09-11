<?php
include("../../../connection/conexion.php");
if (isset($_GET['eliminar'])) {
  $eliminarID = $_GET['eliminar'];
  $sentenciaEliminar = $con->prepare("DELETE FROM ruta_diaria_oxigeno WHERE id_ruta=:eliminarID");
  $sentenciaEliminar->bindParam(":eliminarID", $eliminarID);
  if ($sentenciaEliminar->execute()) {
        header("Location: index.php"); // Redirigir al índice después de eliminar la ruta
    exit();
  } else {
    $_SESSION['mensaje'] = "Error al eliminar la ruta.";
  }
}

?> 