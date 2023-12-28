<?php

$servidor = "localhost";
$baseDeDatos = "u199109938_bdoxilive";
$usuario = "u199109938_administrator";
$clave = "sudo-ox1L1v3j3j3j3";

try {
    $con = new PDO("mysql:host=$servidor;dbname=$baseDeDatos", $usuario, $clave);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    echo "Error: " . $ex->getMessage();
    die();
}

?>