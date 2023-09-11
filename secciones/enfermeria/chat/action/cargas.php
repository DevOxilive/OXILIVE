<?php
// se hace una consulta a la base de datos, donde se incluye la ruta donde se encuentra la base de datos
include_once('/laragon/www/OXILIVE/connection/conexion.php');

// se prepara la sentencia sql para su ejecucion una vez llamando al metodo responsable de la conexion a la base de datos
$sentencia = $con->prepare("SELECT * FROM usuarios WHERE id_departamentos = '6'");
// en este momento se ejecuta la consulta sql y se asigna a una variable
$sentencia->execute();
$valores = $sentencia->fetchAll(PDO::FETCH_ASSOC);
// esta variable contiene cargado el valor de los usuarios en ella cargados en un arreglo


/**
 * para darle uso a los valores cargados previa mente se debeb recorer el arreglo creado
 * con la informacion traida de la base de datos
 * 
 * ahora podemos ver la consulta ejecutada...
 * 
 * 
 *  */
/** carga de mensajes insatantaneos */
    $msg = $_POST['mensaje'];

    $sentencia = $con->prepare("INSERT INTO mensajes (msg) VALUES ('$msg')");
    $sentencia->execute();
//apartado de mensajeria
$sentencia = $con->prepare("SELECT msg FROM mensajes");
$sentencia->execute();
$verMensajes = $sentencia->fetchAll(PDO::FETCH_ASSOC);
