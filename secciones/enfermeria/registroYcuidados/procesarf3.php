<?php
session_start();


    $_SESSION['drescripcionCuracion'] = $_POST['drescripcionCuracion'];
    $_SESSION['notaenferdia'] = $_POST['notaenferdia'];
    $_SESSION['notaenfernoche'] = $_POST['notaenfernoche'];
    $_SESSION['dasayunoH'] = $_POST['dasayunoH']; 
    $_SESSION['descripDesayuno'] = $_POST['descripDesayuno'];
    $_SESSION['comidaH'] = $_POST['comidaH'];
    $_SESSION['descripComida'] = $_POST['descripComida'];
    $_SESSION['cenaH'] = $_POST['cenaH'];
    $_SESSION['descripCena'] = $_POST['descripCena'];
    // Redirige al siguiente formulario (form2.php en este caso)
    header("Location: form4.php");
    exit();



?>
