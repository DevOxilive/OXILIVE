<?php
session_start();

$data = json_decode(file_get_contents('php://input'), true);

    $_SESSION['solucion'] = (isset($data['solucion']) ? $data['solucion'] : NULL); 
    $_SESSION['fecha'] = (isset($data['fecha']) ? $data['fecha'] : NULL); 
    $_SESSION['cantidad'] = (isset($data['cantidad']) ? $data['cantidad'] : NULL); 
    $_SESSION['goteo'] = (isset($data['goteo']) ? $data['goteo'] : NULL); 
    $_SESSION['frecuencia'] = (isset($data['frecuencia']) ? $data['frecuencia'] : NULL); 
    $_SESSION['inicia'] = (isset($data['inicia']) ? $data['inicia'] : NULL); 
    $_SESSION['termina'] = (isset($data['termina']) ? $data['termina'] : NULL); 


    echo true;
    

?>
