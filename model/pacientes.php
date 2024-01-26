<?php
$sentencia = $con->prepare("SELECT * FROM pacientes_call_center");
$sentencia->execute();
$lista_pacientes = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>