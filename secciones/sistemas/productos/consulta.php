<?php
$sentencia=$con->prepare("SELECT * FROM productos");
$sentencia->execute();
$listaproductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
?>