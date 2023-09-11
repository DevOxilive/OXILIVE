<?php
if (isset($_POST['submit'])) {
    $countrynombre = $_POST['buscar_material_devolver'];
    $sentencia = 'SELECT * FROM salida_almacen WHERE nombre_matesali = :nombre_matesali';
    $stmt = $con->prepare($sentencia);
    $stmt->execute(['nombre_matesali' => $countrynombre]);
    $row = $stmt->fetch();
} else {
    exit();
}
?>