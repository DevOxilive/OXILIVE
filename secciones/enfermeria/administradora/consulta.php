<?php
    include ("../../../connection/conexion.php");
    $sentencia=$con->prepare("SELECT a.*, ase.Nombre_aseguradora 'aseguradora', b.Nombre_banco 'banco'
    FROM aseguradoras ase, administradora a, bancos b
    WHERE b.id_bancos = a.banco AND
    a.id_administradora = ase.administradora;");
    $sentencia->execute();
    $lista_administradora=$sentencia->fetchAll(PDO::FETCH_ASSOC);

    $sentenciaA = $con->prepare("SELECT id_administradora,Nombre_administradora, Nombre_banco, Nombre_aseguradora 
    FROM administradora A, bancos B ,aseguradoras C WHERE A.banco = B.id_bancos AND A.id_administradora = C.administradora");
    $sentenciaA->execute();
    $listaAsociados = $sentenciaA->fetchAll(PDO::FETCH_ASSOC);


?>