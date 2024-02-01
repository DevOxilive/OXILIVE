<?php

if (isset($idEmp)) {
    $consulta = $con->prepare(
        "SELECT e.*, c.codigo_postal, c.nombre 'colName', m.nombre 'delName', es.nombre 'estName'
        FROM empleados e, colonias c, municipios m, estados es
        WHERE e.colonia = c.id
        AND c.municipio = m.id
        AND m.estado = es.id
        AND e.id_empleado = :id"
    );
    $consulta->bindParam(":id", $idEmp);
    $consulta->execute();
    $lista_datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
} else if (isset($idPac)) {
    $consulta = $con->prepare(
        "SELECT p.*, c.codigo_postal, c.nombre 'colName', m.nombre 'delName', es.nombre 'estName'
        FROM pacientes_call_center p, colonias c, municipios m, estados es
        WHERE p.colonia = c.id
        AND c.municipio = m.id
        AND m.estado = es.id
        AND p.id_pacientes = :id"
    );
    $consulta->bindParam(":id", $idPac);
    $consulta->execute();
    $lista_datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
}
if (isset($lista_datos)) {
    foreach ($lista_datos as $datos) {
        $calle = $datos['calle'];
        $numExt = $datos['num_ext'];
        $numInt = isset($datos['num_int']) ? $datos['num_int'] : "";
        $cp = $datos['codigo_postal'];
        $colonia = $datos['colName'];
        $delName = $datos['delName'];
        $estName = $datos['estName'];
        $calleUno = isset($datos['calleUno']) ? $datos['calleUno'] : "";
        $calleDos = isset($datos['calleDos']) ? $datos['calleDos'] : "";
        $referencias = isset($datos['referencias']) ? $datos['referencias'] : "";
    }
} else {
    $calle = "";
    $numExt = "";
    $numInt = "";
    $cp = "";
    $colonia = "";
    $delName = "";
    $estName = "";
    $calleUno = "";
    $calleDos = "";
    $referencias = "";
}
