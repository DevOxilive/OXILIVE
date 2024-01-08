<?php

$host = 'localhost';
$dataBase = 'u199109938_swoe';
$usuario = 'root';
$contraseña = '';

// $host ='localhost';
// $dataBase = 'bdoxilive';
// $usuario = 'root';
// $contraseña = '';

try {
    $con = new PDO("mysql:host=$host;dbname=$dataBase", $usuario, $contraseña);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . " para conectar la base de datos";
}