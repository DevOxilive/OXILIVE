<?php
session_start();
$data = json_decode(file_get_contents('php://input'), true);
    $_SESSION['peso'] = $data['peso'];
    $_SESSION['diagnosticoMedico'] = $data['diagnosticoMedico'];
    $_SESSION['temperatura'] = $data['temperatura'];
    $_SESSION['pulso'] = $data['pulso'];
    $_SESSION['respiracion'] = $data['respiracion'];
    $_SESSION['tensionArterial'] = $data['tensionArterial']; 
    $_SESSION['spo2'] = $data['spo2'] != '' ? $data['spo2'] : NULL;
    $_SESSION['glicemiaCapilar'] = $data['glicemiaCapilar'] != '' ? $data['glicemiaCapilar'] : NULL;
    $_SESSION['vomito'] = $data['vomito'] != '' ? $data['vomito'] : NULL;
    $_SESSION['evacuaciones'] = $data['evacuaciones'] != '' ? $data['evacuaciones'] : NULL;
    $_SESSION['orina'] = $data['orina'] != '' ? $data['orina'] : NULL;
    $_SESSION['ingestaLiquidos'] = $data['ingestaLiquidos'] != '' ? $data['ingestaLiquidos'] : NULL;
    $_SESSION['caidas'] = $data['caidas'] != '' ? $data['caidas'] : NULL;
    $_SESSION['drenajesVendajes'] = $data['drenajesVendajes'] != '' ? $data['drenajesVendajes'] : NULL;
    $_SESSION['uppHh'] = $data['uppHh'] != '' ? $data['uppHh'] : NULL;
    $_SESSION['descripcionUpp'] = $data['descripcionUpp'] != '' ? $data['descripcionUpp'] : NULL; 

    echo true;


?>
