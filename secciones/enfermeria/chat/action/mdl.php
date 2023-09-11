<?php

class Mensaje
{

    private $texto;

    function envioMensaje($mensaje)
    {
        $this->texto = $mensaje;
    }

    function cargarMensaje()
    {
        include_once('../../../../connection/conexion.php');
        echo $this->texto;
        $sentencia = $con->prepare("INSERT INTO msg value ('$this->texto')");
        $sentencia->execute();
    }

    function verMensajes()
    {
        include_once('../../../../connection/conexion.php');
        $sentencia = $con->prepare("SELECT * FROM mensajes");
        $sentencia->execute();
        $mensajes = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        foreach ($mensajes as $value) {
            echo $value;
        };
    }
}
