<?php
include '../../../connection/conexion.php';

do {
    $regresar = false;
    $token = bin2hex(random_bytes(32));

    $checkToken = $con->prepare("SELECT token FROM usuarios");
    $checkToken->execute();
    $existToken = $checkToken->fetchAll(PDO::FETCH_ASSOC);
    foreach ($existToken as $tokenCheck) {
        if ($tokenCheck == $token) {
            $regresar = true;
            echo "son iguales";
        } else {
            $token = bin2hex(random_bytes(32));
            $regresar = false;
        }
    }
    echo "este es nuevo: {$token} <br>";
} while ($regresar == true);
