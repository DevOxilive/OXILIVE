<?php
$sentencia=$con->prepare("SELECT *,(SELECT nombre_material FROM tipo_material WHERE tipo_material.id_material=almacen.tipo_material LIMIT 1)as tipo FROM almacen");
$sentencia->execute();
$lista_almacen=$sentencia->fetchAll(PDO::FETCH_ASSOC);

$senSalida=$con->prepare("SELECT * FROM salida_almacen");
$senSalida->execute();
$lista_salida=$senSalida->fetchAll(PDO::FETCH_ASSOC);

$sen1=$con->prepare("SELECT * FROM tipo_material");
$sen1->execute();
$lista_material=$sen1->fetchAll(PDO::FETCH_ASSOC);

$sen2=$con->prepare("SELECT * FROM estado_material");
$sen2->execute();
$estado_mate=$sen2->fetchAll(PDO::FETCH_ASSOC);

$sent=$con->prepare("SELECT nombre, cantidad, cantidad_adecuada FROM almacen");
$sent->execute();
$datos=$sent->fetchAll(PDO::FETCH_ASSOC);
?>