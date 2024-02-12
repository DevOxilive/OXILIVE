<?php
include '../../connection/conexion.php'; // Asegúrate de proporcionar la ruta correcta al archivo de conexión
// $usuarioDestino = $_SESSION['us']; // Reemplaza con el nombre de usuario actual

// Consultar las notificaciones para el usuario actual
$sql = "SELECT * FROM notificaciones ORDER BY fecha DESC";
$stmt = $con->prepare($sql);
$stmt->execute();

// Mostrar las notificaciones en la página web
while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<div>{$fila['mensaje']} - {$fila['fecha']}</div>";
}
?>