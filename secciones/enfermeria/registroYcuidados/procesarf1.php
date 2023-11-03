<?php
session_start();
$data = json_decode(file_get_contents('php://input'), true);
    $_SESSION['peso'] = $data['peso'];
    $_SESSION['diagnosticoMedico'] = $data['diagnosticoMedico'];
    $_SESSION['temperatura'] = $data['temperatura'];
    $_SESSION['pulso'] = $data['pulso'];
    $_SESSION['respiracion'] = $data['respiracion'];
    $_SESSION['tensionArterial'] = $data['tensionArterial']; 
    $_SESSION['spo2'] = (isset($data['spo2']) ? $data['spo2'] : NULL);
    $_SESSION['glicemiaCapilar'] = (isset($data['glicemiaCapilar']) ? $data['glicemiaCapilar'] : NULL);
    $_SESSION['vomito'] = (isset($data['vomito']) ? $data['vomito'] : NULL);
    $_SESSION['evacuaciones'] = (isset($data['evacuaciones']) ? $data['evacuaciones'] : NULL);
    $_SESSION['orina'] = (isset($data['orina']) ? $data['orina'] : NULL);
    $_SESSION['ingestaLiquidos'] = (isset($data['ingestaLiquidos']) ? $data['ingestaLiquidos'] : NULL);
    $_SESSION['caidas'] = (isset($data['caidas']) ? $data['caidas'] : NULL);
    $_SESSION['drenajesVendajes'] = (isset($data['drenajesVendajes']) ? $data['drenajesVendajes'] : NULL);
    $_SESSION['uppHh'] = (isset($data['uppHh']) ? $data['uppHh'] : NULL);
    $_SESSION['descripcionUpp'] = (isset($data['descripcionUpp']) ? $data['descripcionUpp'] : NULL); 

    echo true;


?>
