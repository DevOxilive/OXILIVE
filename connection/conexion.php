<?php
$servidor = "localhost";
$baseDeDatos = "bdoxilive";
$usuario = "root";
$clave = "";
// $servidor = "localhost";
// $baseDeDatos = "u199109938_bdoxilive";
// $usuario = "u199109938_administrator";
// $clave = "sudo-Sw03j3j3j3";
try {
    $con = new PDO("mysql:host=$servidor;dbname=$baseDeDatos", $usuario, $clave);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    echo "Error: " . $ex->getMessage();
    die();
}
