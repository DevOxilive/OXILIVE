<?php

$host = 'localhost';
$dataBase = 'u199109938_swoe';
$usuario = 'u199109938_hackerman';
$contraseña = 'SwOe@xilive12';

// $host ='localhost';
// $dataBase = 'bdoxilive';
// $usuario = 'root';
// $contraseña = '';

try {
    $con = new PDO("mysql:host=$host;dbname=$dataBase", $usuario, $contraseña);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . " para conectar la base de datos";
}