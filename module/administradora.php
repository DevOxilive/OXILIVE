<?php
$us= $_SESSION["us"];
$sentencia=$con->prepare("SELECT * FROM `administradora`");
$sentencia->execute();
$lista_administradora=$sentencia->fetchAll(PDO::FETCH_ASSOC);
?>