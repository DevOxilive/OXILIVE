<?php
    include ("../../connection/conexion.php");
    $sentencia=$con->prepare("SELECT * FROM `administradora`");
    $sentencia->execute();
    $lista_administradora=$sentencia->fetchAll(PDO::FETCH_ASSOC);

    //Esta consulta es para agregar los bancos que corresponden a las administradoras
    $consultaAdmi=$con->prepare("SELECT b.id_bancos, b.Nombre_banco,b.admi, a.Nombre_administradora,
    a.id_administradora FROM bancos b INNER JOIN
        administradora a WHERE b.admi = a.id_administradora");
    $consultaAdmi->execute();
    $listaGeneral = $consultaAdmi->fetchAll(PDO::FETCH_ASSOC);


?>