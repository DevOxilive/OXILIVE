<?php
if (isset($_POST['submit'])) {
    $countrynombre = $_POST['buscar_material'];
    $sentencia = 'SELECT * FROM almacen WHERE nombre = :nombre';
    $stmt = $con->prepare($sentencia);
    $stmt->execute(['nombre' => $countrynombre]);
    $row = $stmt->fetch();
} else {
    exit();
}
?>