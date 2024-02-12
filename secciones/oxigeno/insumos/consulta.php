<?php
//LISTA DE INSUMS
$sentencia=$con->prepare("SELECT insumos.*, 
(SELECT marca_insumo FROM marca_insumo WHERE marca_insumo.id_marca = insumos.marca_insumo LIMIT 1) as mar, 
(SELECT estado_insumo FROM estado_insumo WHERE estado_insumo.id_estado = insumos.estado_insumo LIMIT 1) as esta 
FROM insumos");
$sentencia->execute();
$lista_insumo=$sentencia->fetchAll(PDO::FETCH_ASSOC);

$s=$con->prepare("SELECT * FROM `tanques`");
$s->execute();
$lis=$s->fetchAll(PDO::FETCH_ASSOC);

//MARCA DEL INSUMO
$sentencia=$con->prepare("SELECT * FROM `marca_insumo`");
$sentencia->execute();
$lista_marca=$sentencia->fetchAll(PDO::FETCH_ASSOC);

//ESTADO DEL INSUMO
$sen1=$con->prepare("SELECT * FROM `estado_insumo`");
$sen1->execute();
$lista_estado=$sen1->fetchAll(PDO::FETCH_ASSOC);

//TAMAÑO DEL INSUMO
$sen2=$con->prepare("SELECT * FROM `tamano_insumo`");
$sen2->execute();
$lista_tama=$sen2->fetchAll(PDO::FETCH_ASSOC);
?>