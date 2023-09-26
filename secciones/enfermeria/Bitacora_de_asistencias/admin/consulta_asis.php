<?php
$checkIn= $_GET['checkIn'];
$checkOut= $_GET['checkOut'];

if($checkOut == NULL ){
    $sentencia = $con->prepare(

        "SELECT a.*, CONCAT (u.Nombres, ' ', u.Apellidos) AS 'Nombres'
        FROM asistencias a, usuarios u
        WHERE a.id_empleadoEnfermeria = u.id_usuarios AND
        a.id_asistencias=:checkIn;"
    );
    $sentencia->bindparam(':checkIn',$checkIn);
} else {
    $sentencia = $con->prepare(

        "SELECT a.*, CONCAT (u.Nombres, ' ', u.Apellidos) AS 'Nombres'
        FROM asistencias a, usuarios u
        WHERE a.id_empleadoEnfermeria = u.id_usuarios AND
        (a.id_asistencias=:checkIn OR
        a.id_asistencias=:checkOut); 
        "
    );
    $sentencia->bindparam(':checkIn', $checkIn);
    $sentencia->bindParam(':checkOut', $checkOut);
}

$sentencia->execute();
$lista_asistencias = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>