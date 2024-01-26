<?php
$id = $_POST['idus'];
$rfc = $con->prepare("SELECT rfc, nombres FROM empleados WHERE id_empleado=:id");
$rfc->bindparam(':id', $id);
$rfc->execute();
$rfcConsul = $rfc->fetchAll(PDO::FETCH_ASSOC);

$carpeta = $rfcConsul['rfc'] . " " . $rfcConsul['nombres'];