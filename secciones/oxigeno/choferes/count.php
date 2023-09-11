<?php
$sente = $con->prepare("SELECT COUNT(*) FROM `choferes` WHERE estado = 1");
$sente->execute();
$cantidad_choferes = $sente->rowCount();
?>