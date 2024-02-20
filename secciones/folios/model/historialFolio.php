<?php

$idFol = $_GET['idFol'];
$folio = $_GET['folio'];

$sentencia = $con -> prepare(
    "SELECT *
    FROM historial_folios h, tipomovimientofolio t, usuarios u
    WHERE h.tipoMovimiento = t.id_mov
    AND h.id_usuario = u.id_usuarios
    AND h.id_folio = :idFol"
);
$sentencia -> bindParam(":idFol", $idFol);
$sentencia -> execute();
$lista_historial = $sentencia -> fetchAll(PDO::FETCH_ASSOC);