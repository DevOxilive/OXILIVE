<?php
include("../../../connection/conexion.php");

// Obtener el ID del paciente 
$pacienteId = $_GET['idPac'];   

    // Consulta para obtener los detalles del paciente utilizando el ID almacenado en la variable de sesión
    $consulta = "SELECT pacientes.*, Nombre_administradora, Nombre_aseguradora, Nombre_banco
    FROM pacientes_oxigeno AS pacientes
    JOIN administradora AS admin ON pacientes.Administradora = admin.id_administradora
    JOIN aseguradoras ON pacientes.Aseguradora = aseguradoras.id_aseguradora
    JOIN bancos ON pacientes.Banco = bancos.id_bancos
    WHERE pacientes.id_pacientes = :id_pacientes";

    $sentencia = $con->prepare($consulta);
    $sentencia->bindParam(':id_pacientes', $pacienteId);
    $sentencia->execute();
    $datos_paciente = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>