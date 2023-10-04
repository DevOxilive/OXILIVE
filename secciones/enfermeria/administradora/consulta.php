<?php
    include ("../../../connection/conexion.php");
    $sentencia=$con->prepare("SELECT * from `admi_enfer`;");
    $sentencia->execute();
    $lista_administradora=$sentencia->fetchAll(PDO::FETCH_ASSOC);

    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia2 = $con->prepare("SELECT * FROM admi_enfer WHERE id_admi_enfer=:id_admi_enfer ");
    $sentencia2->bindParam(":id_admi_enfer", $txtID);
    $sentencia2->execute();
    $cpts = $sentencia2->fetchAll(PDO::FETCH_ASSOC);
?>