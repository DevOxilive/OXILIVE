<?php
include("../../../connection/conexion.php");
if (isset($_POST['query'])) {
    $inpText = $_POST['query'];
    $sentencia = 'SELECT *,(SELECT Nombres FROM empleados WHERE empleados.id_empleados=salida_almacen.pide_salida LIMIT 1) as saco FROM salida_almacen WHERE nombre_matesali LIKE :search';
    $sen = $con->prepare($sentencia);
    $sen->execute(['search' => '%' . $inpText . '%']);
    $result = $sen->fetchAll(); 
    // var_dump($result);
    if ($result) {
        foreach ($result as $row) {
            echo '<a href="#" class="list-group-item list-group-item-action border-1" data-id_salida="' . htmlspecialchars($row["id_salida"]) . '" data-nombre_matesali="' . htmlspecialchars($row["nombre_matesali"]) . '" data-tipo_matesali="' . htmlspecialchars($row["tipo_matesali"]) . '" data-cantidad_salida="' . $row["cantidad_salida"] . '" data-estado_salida="' . htmlspecialchars($row["estado_salida"]) . '">' . $row["nombre_matesali"]  . '</a>';
        }
    } else {
        echo 'PRODUCTO NO EXISTENTE';
    }
}
?>