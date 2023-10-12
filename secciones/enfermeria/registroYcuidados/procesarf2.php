<?php
session_start();


    $_SESSION['solucion'] = $_POST['solucion'];
    $_SESSION['fecha'] = $_POST['fecha'];
    $_SESSION['cantidad'] = $_POST['cantidad'];
    $_SESSION['goteo'] = $_POST['goteo']; 
    $_SESSION['frecuencia'] = $_POST['frecuencia'];
    $_SESSION['inicia'] = $_POST['inicia'];
    $_SESSION['termina'] = $_POST['termina'];

    // Redirige al siguiente formulario (form2.php en este caso)
    header("Location: form3.php");
    exit();



?>
