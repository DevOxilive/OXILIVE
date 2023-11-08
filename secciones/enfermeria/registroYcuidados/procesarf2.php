<?php
session_start();

$data = json_decode(file_get_contents('php://input'), true);

    $_SESSION['solucion'] = $data['solucion'] != '' ? $data['solucion'] : NULL; 
    $_SESSION['fecha'] = $data['fecha'] != '' ? $data['fecha'] : NULL;
    $_SESSION['cantidad'] = $data['cantidad'] != '' ? $data['cantidad'] : NULL; 
    $_SESSION['goteo'] = $data['goteo']  != '' ? $data['goteo'] : NULL; 
    $_SESSION['frecuencia'] = $data['frecuencia'] != ''? $data['frecuencia'] : NULL; 
    $_SESSION['inicia'] = $data['inicia'] != '' ? $data['inicia'] : NULL; 
    $_SESSION['termina'] = $data['termina'] != '' ? $data['termina'] : NULL; 


    echo true;
    

?>
