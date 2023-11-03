<?php
session_start();


    $_SESSION['numeroAsignacion'] = $_POST['numeroAsignacion'];
    

    // Redirige al siguiente formulario (form2.php en este caso)
    header("Location: form1.php");
    exit();



?>