<?php
if ($_SESSION['puesto'] == 5) {
    $stmt = $con->prepare(
        ""
    );
} else if ($_SESSION['puesto'] == 8 || $_SESSION['puesto'] == 1) {
    $stmt = $con->prepare(
        "SELECT f.adminFolio, f.bancoFolio, f.tipo, h.fecha, h.tipoMovimiento, t.mov, h.descripcion, h.id_usuario, COUNT(h.id_historialFolio) 'cantidad'
        FROM historial_folios h, folios f, tipomovimientofolio t
        WHERE h.id_folio = f.id_folio
        AND h.tipoMovimiento = t.id_mov
        AND h.tipoMovimiento = 1
        OR h.tipoMovimiento = 2
        GROUP BY f.adminFolio, f.bancoFolio, f.tipo, h.fecha, h.tipoMovimiento, t.mov, h.descripcion, h.id_usuario
        ORDER BY h.fecha"
    );
}

$stmt->execute();
$lista_historial = $stmt->fetchAll(PDO::FETCH_ASSOC);