<?php

$servidor = "localhost";
$baseDeDatos = "chatdb";
$usuario = "root";
$clave = "";

try {
    $con = new PDO("mysql:host=$servidor;dbname=$baseDeDatos", $usuario, $clave);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    echo "Error: " . $ex->getMessage();
    die();
}

?>