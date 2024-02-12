<?php
$stmt = $con -> prepare(
    "SELECT f.id_banco, COUNT(f.id_folio) AS cantidadFolios, b.Nombre_banco
    FROM folios f, bancos b
    WHERE b.id_bancos = f.id_banco
    GROUP BY f.id_banco"
);
$stmt -> execute();
$listado_cant_folios = $stmt->fetchAll(PDO::FETCH_ASSOC);