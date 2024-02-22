<?php
$puesto_id = $_SESSION['puesto'];
$sentencia = $con->prepare("SELECT Nombre_puestos FROM puestos");
$sentencia->execute();
$datos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
