<?php
$sentencia = $con->prepare("SELECT *,
(SELECT Nombre_estado FROM estado WHERE estado.id_estado=usuarios.Estado LIMIT 1) as estado
FROM `usuarios` WHERE Estado = 1");
$sentencia->execute();
$lista_usuarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>