<?php
$admin = $_GET['admin'];
$banco = $_GET['banco'];
$tipo = $_GET['tipo'];
$estado = $_GET['estado'];

$sentencia = $con -> prepare(
    "SELECT f.*
    FROM folios f
    WHERE f.tipo = :tipo
    AND f.bancoFolio = :banco
    AND f.adminFolio = :adminB
    AND f.estado = :estado"
);
$sentencia -> bindParam(':tipo', $tipo);
$sentencia -> bindParam(':adminB', $admin);
$sentencia -> bindParam(':banco', $banco);
$sentencia -> bindParam(':estado', $estado);

$sentencia -> execute();
$lista_folios = $sentencia -> fetchAll(PDO::FETCH_ASSOC);