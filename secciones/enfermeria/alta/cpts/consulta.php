<?php
    include("../../../../connection/conexion.php");
    $sentencia = $con->prepare("SELECT c.id_cpt,c.cpt,c.admi, a.Nombre_administradora FROM cpts c INNER JOIN administradora a
    WHERE c.admi = a.id_administradora;");
    $sentencia->execute();
    $cpts = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>