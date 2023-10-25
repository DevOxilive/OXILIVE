<?php
    include("../../../../connection/conexion.php");
    $data = json_decode(file_get_contents('php://input'), true);

    $nom = $data['nombres'] != "" ?  $data['nombres'] : NULL;
    $ape = $data['apellidos'] != "" ? $data["apellidos"] : NULL;
    $gen = $data['genero'] != "" ? $data["genero"] : NULL;
    $edad = $data['edad'] != "" ? $data["edad"] : NULL;
    $tipo = $data['tipo'] != "" ? $data["tipo"] : NULL;
    $telUno = $data['telUno'] != "" ? $data["telUno"] : NULL;
    $telDos = $data['telDos'] != "" ? $data["telDos"] : NULL;

    $col = $data['colonia'] != "" ? $data["colonia"] : NULL;
    $calle = $data['calle'] != "" ? $data["calle"] : NULL;
    $numExt = $data['numExt'] != "" ? $data["numExt"] : NULL;
    $numInt = $data['numInt'] != "" ? $data["numInt"] : NULL;
    $calleUno = $data['calleUno'] != "" ? $data["calleUno"] : NULL;
    $calleDos = $data['calleDos'] != "" ? $data["calleDos"] : NULL;
    $ref = $data['referencias'] != "" ? $data["referencias"] : NULL;

    $idPac = $data['idPac'];
    
    $nom = strtoupper($nom);
    $ape = strtoupper($ape);
    $calle = strtoupper($calle);
    $numExt = strtoupper($numExt);
    if ($calleUno != NULL) {
        $calleUno = strtoupper($calleUno);
    }
    if ($calleDos != NULL) {
        $calleDos = strtoupper($calleDos);
    }
    if ($ref != NULL) {
        $ref = strtoupper($ref);
    }
    $sentencia=$con->prepare('
    UPDATE pacientes_call_center SET
    nombres = :nom,
    apellidos = :ape,
    genero = :gen,
    edad = :edad,
    tipoPaciente = :tipo,
    telefono = :telUno,
    telefonoDos = :telDos,
    colonia = :col,
    calle = :calle,
    num_ext = :numExt,
    num_int = :numInt,
    calleUno = :calleUno,
    calleDos = :calleDos,
    referencias = :ref
    WHERE id_pacientes = :idPac;
    ');
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
    $sentencia->bindparam(':idPac', $idPac);
    if ($sentencia->execute()) {
        echo json_encode(true);
    }
?>
