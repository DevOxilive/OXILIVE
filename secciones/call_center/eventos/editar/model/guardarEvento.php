<?php
    include("../../../../../connection/conexion.php");
    $data = json_decode(file_get_contents('php://input'), true);


    
    $fechaServicio = $data['fechaServicio'] != "" ? $data["fechaServicio"] : NULL;
    $horaEntrada = $data['horaEntrada'] != "" ? $data["horaEntrada"] : NULL;
    $motivoConsulta = $data['motivoConsulta'] != "" ? $data["motivoConsulta"] : NULL;
    $nAutorizacion = $data['nAutorizacion'] != "" ? $data["nAutorizacion"] : NULL;
    $auEspecial = $data['auEspecial'] != "" ? $data["auEspecial"] : NULL;
    $asignarMedico = $data['asignarMedico'] != "" ? $data["asignarMedico"] : [];
    $tipoServicio = $data['tipoServicio'] != "" ? $data["tipoServicio"] : [];
    
    $id_sv = $data['id_sv'] != "" ? $data['id_sv'] : Null;
    
    
    
    $motivoConsulta = strtoupper($motivoConsulta);
   
   
    $sentencia=$con->prepare('
    UPDATE asignacion_servicio SET
    fecha = :fechaServicio,
    hora = :horaEntrada,
    moti_consulta = :motivoConsulta,
    numAutorizacion = :nAutorizacion,
    num_autorizacionEspecial = :auEspecial,
    num_medico = :asignarMedico,
    num_servicio = :tipoServicio,
    estado = 1
    WHERE id_sv = :id_sv;
');



         
            $sentencia->bindparam(':id_sv', $id_sv);
            $sentencia->bindparam(':fechaServicio', $fechaServicio);
            $sentencia->bindparam(':horaEntrada', $horaEntrada);
            $sentencia->bindparam(':motivoConsulta', $motivoConsulta);
            $sentencia->bindparam(':nAutorizacion', $nAutorizacion);
            $sentencia->bindparam(':auEspecial', $auEspecial);
            $sentencia->bindparam(':asignarMedico', $asignarMedico);
            foreach ($tipoServicio as $servicio) {
                $sentencia->bindparam(':tipoServicio', $servicio);
                $sentencia->execute();
           
         }
    

    
?>