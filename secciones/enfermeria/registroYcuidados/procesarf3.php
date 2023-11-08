<?php
session_start();

    $data = json_decode(file_get_contents('php://input'), true);

    $_SESSION['drescripcionCuracion'] = $data['drescripcionCuracion'] != '' ? $data['drescripcionCuracion'] : NULL; 
    $_SESSION['notaEnfermeria'] = $data['notaEnfermeria'] != '' ? $data['notaEnfermeria'] : NULL; 
    $_SESSION['descripComidas'] = $data['descripComidas'] != '' ? $data['descripComidas'] : NULL; 
    $_SESSION['horarioComidas'] = $data['horarioComidas'] != '' ? $data['horarioComidas'] : NULL; 
  
    echo true;

?>
