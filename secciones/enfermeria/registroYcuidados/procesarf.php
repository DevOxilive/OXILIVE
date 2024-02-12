<?php
session_start();

    

   
    $data = json_decode(file_get_contents('php://input'), true);
        $_SESSION['numeroAsignacion'] = $data['numeroAsignacion'];
        $_SESSION['paciente'] = $data['paciente'];
        $_SESSION['servicio'] = $data['servicio'];
        $_SESSION['responsable'] = $data['responsable'];
        $_SESSION['edad'] = $data['edad'];
        $_SESSION['medico'] = $data['medico']; 
        $_SESSION['enfermero'] = $data['enfermero'];
    
        echo true;
    
    
 



?>