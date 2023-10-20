<?php
    include("../../../../connection/conexion.php");
    $data = json_decode(file_get_contents('php://input'), true);
    
    $nom = $data['nombres']!="" ?  $data['nombres'] : NULL;
    $ape = $data['apellidos']!="" ? $data["apellidos"] : NULL;
    $gen = $data['genero']!="" ? $data["genero"] : NULL;
    $edad = $data['edad']!="" ? $data["edad"] : NULL;
    $tipo = $data['tipo']!="" ? $data["tipo"] : NULL;
    $telUno = $data['telUno']!="" ? $data["telUno"] : NULL;
    $telDos = $data['telDos']!="" ? $data["telDos"] : NULL;
    
    $col = $data['colonia']!="" ? $data["colonia"] : NULL;
    $calle = $data['calle']!="" ? $data["calle"] : NULL;
    $numExt = $data['numExt']!="" ? $data["numExt"] : NULL;
    $numInt = $data['numInt']!="" ? $data["numInt"] : NULL;
    $calleUno = $data['calleUno']!="" ? $data["calleUno"] : NULL;
    $calleDos = $data['calleDos']!="" ? $data["calleDos"] : NULL;
    $ref = $data['referencias']!="" ? $data["referencias"] : NULL;

    $sentencia = $con->prepare("
        INSERT INTO pacientes_call_center VALUES
        (NULL, :nom, :ape, :gen, :edad, :tipo, :telUno, :telDos, :col, :calle, :numExt, :numInt, :calleUno, :calleDos, :ref, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
    ");
    $sentencia->bindparam(':nom', $nom);
    $sentencia->bindparam(':ape', $ape);
    $sentencia->bindparam(':gen', $gen);
    $sentencia->bindparam(':edad', $edad);
    $sentencia->bindparam(':tipo', $tipo);
    $sentencia->bindparam(':telUno', $telUno);
    $sentencia->bindparam(':telDos', $telDos);
    $sentencia->bindparam(':col', $col);
    $sentencia->bindparam(':calle', $calle);
    $sentencia->bindparam(':numExt', $numExt);
    $sentencia->bindparam(':numInt', $numInt);
    $sentencia->bindparam(':calleUno', $calleUno);
    $sentencia->bindparam(':calleDos', $calleDos);
    $sentencia->bindparam(':ref', $ref);
    if($sentencia->execute()){
        echo json_encode('LISTO');
    }
?>