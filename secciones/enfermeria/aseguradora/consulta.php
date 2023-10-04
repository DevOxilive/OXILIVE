<?php
    include("../../../connection/conexion.php");
    $sentencia = $con->prepare("SELECT ase.*, ad.Nombre_admi
    FROM admi_enfer ad, asegu_enfer ase
    WHERE ad.id_admi_enfer = ase.admi;");
    $sentencia->execute();
    $lista_asegu_enfer = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>