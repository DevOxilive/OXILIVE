<?php

//Se asigna la varialbles checkIN y checkOut para realizar la consulta
$checkIn= $_GET['checkIn'];
$checkOut= $_GET['checkOut'];

// si checkOut no existe pasa a inserta el checkIn
if($checkOut == NULL ){
    $sentencia = $con->prepare(

        "SELECT a.*, CONCAT (u.Nombres, ' ', u.Apellidos) AS 'Nombres'
        FROM asistencias a, usuarios u
        WHERE a.id_empleadoEnfermeria = u.id_usuarios AND
        a.id_asistencias=:checkIn;"
    );
    $sentencia->bindparam(':checkIn',$checkIn);
// por el contrario si existe checkOut se insertan ambas   
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