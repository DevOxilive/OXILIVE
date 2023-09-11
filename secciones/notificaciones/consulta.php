<?php
$idUsuario = $_SESSION['puesto'];
$sente =$con->prepare("SELECT COUNT(*) FROM notificaciones WHERE usuario_destino IN (SELECT id_puestos FROM puestos WHERE id_puestos = :idUsuario) and leida=0"); 
$sente->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
$sente->execute();
$totalNoti = $sente->fetchColumn();

$consulta = "SELECT * FROM notificaciones WHERE usuario_destino IN (SELECT id_puestos FROM puestos WHERE id_puestos = :idUsuario)";
$sentencia = $con->prepare($consulta);
$sentencia->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
$sentencia->execute();
$notificaciones = $sentencia->fetchAll(PDO::FETCH_ASSOC);

// Consulta SQL para seleccionar las notificaciones donde el usuario_destino coincide
$sql = "SELECT * FROM notificaciones WHERE usuario_destino = :idUsuario ORDER BY fecha DESC";
$stmt = $con->prepare($sql);
$stmt->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
$stmt->execute();
$notis = $stmt->fetchAll(PDO::FETCH_ASSOC);


$conNoLei = "SELECT * FROM notificaciones WHERE usuario_destino IN (SELECT id_puestos FROM puestos WHERE id_puestos = :idUsuario) AND leida = 0 ORDER BY fecha DESC";
$NoLeida = $con->prepare($conNoLei);
$NoLeida->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
$NoLeida->execute();
$notificaciones_no_leidas = $NoLeida->fetchAll(PDO::FETCH_ASSOC);
?>