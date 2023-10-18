<?php
session_start();


    $_SESSION['temperatura'] = $_POST['temperatura'];
    $_SESSION['pulso'] = $_POST['pulso'];
    $_SESSION['respiracion'] = $_POST['respiracion'];
    $_SESSION['tensionArterial'] = $_POST['tensionArterial']; 
    $_SESSION['spo2'] = $_POST['spo2'];
    $_SESSION['glicemiaCapilar'] = $_POST['glicemiaCapilar'];
    $_SESSION['vomito'] = $_POST['vomito'];
    $_SESSION['evacuaciones'] = $_POST['evacuaciones'];
    $_SESSION['orina'] = $_POST['orina'];
    $_SESSION['ingestaLiquidos'] = $_POST['ingestaLiquidos'];
    $_SESSION['caidas'] = $_POST['caidas'];
    $_SESSION['drenajesVendajes'] = $_POST['drenajesVendajes'];
    $_SESSION['uppHh'] = $_POST['uppHh'];
    $_SESSION['descripcionUpp'] = $_POST['descripcionUpp']; 



    // Redirige al siguiente formulario (form2.php en este caso)
    header("Location: form2.php");
    exit();


?>
