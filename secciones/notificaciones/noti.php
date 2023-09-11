<?php
include '../../connection/conexion.php'; 

function registrarNotificacion($usuarioDestino, $mensaje) {
    global $conn; 

    $sql = "INSERT INTO notificaciones (usuario_destino, mensaje) VALUES (:usuario_destino, :mensaje)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':usuario_destino', $usuarioDestino);
    $stmt->bindParam(':mensaje', $mensaje);

    if ($stmt->execute()) {
        echo "Notificación registrada exitosamente";
    } else {
        echo "Error al registrar la notificación: " . $stmt->errorInfo()[2];
    }
}
?>