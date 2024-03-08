<?php
if($_SESSION['puesto'] == 8 || $_SESSION['puesto'] == 1){
    $estado = 3;
}
$stmt = $con -> prepare(
    "SELECT f.adminFolio, f.bancoFolio, COUNT(f.id_folio) AS cantidadFolios
    FROM folios f
    WHERE f.estado = :estado
    AND f.tipo = 'CONSULTA'
    GROUP BY f.adminFolio, f.bancoFolio"
);
$stmt -> bindParam(':estado', $estado);
$stmt -> execute();
$consulta_cant = $stmt -> fetchAll(PDO::FETCH_ASSOC);

$stmt2 = $con -> prepare(
    "SELECT f.adminFolio, f.bancoFolio, COUNT(f.id_folio) AS cantidadFolios
    FROM folios f
    WHERE f.estado = :estado
    AND f.tipo = 'RECETA'
    GROUP BY f.adminFolio, f.bancoFolio"
);
$stmt2 -> bindParam(':estado', $estado);
$stmt2 -> execute();
$receta_cant = $stmt2 -> fetchAll(PDO::FETCH_ASSOC);