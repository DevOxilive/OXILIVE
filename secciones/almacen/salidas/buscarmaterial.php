<?php
include ("../../../connection/conexion.php");
 
if (isset($_POST['query'])) {
    $inpText = $_POST['query'];
    $sentencia = 'SELECT * FROM almacen WHERE nombre LIKE :search';
    $sen = $con->prepare($sentencia);
    $sen->execute(['search' => '%' . $inpText . '%']);
    $result = $sen->fetchAll();
    // var_dump($result);
    if ($result) { 
        foreach ($result as $row) {
            echo '<a href="#" class="list-group-item list-group-item-action border-1" data-id_almacen="' . htmlspecialchars($row["id_almacen"]) .'" data-nombre="' . htmlspecialchars($row["nombre"]) . '" data-tipo_material="' . htmlspecialchars($row["tipo_material"]) . '" data-cantidad="' . $row["cantidad"] . '" data-estado="' . htmlspecialchars($row["estado"]) . '" data-observaciones="' . htmlspecialchars($row["observaciones"]) . '">' . htmlspecialchars($row["nombre"]) .'</a>';
        }
    } else { 
        echo 'PRODUCTO NO EXISTENTE';
    }
}
?>
