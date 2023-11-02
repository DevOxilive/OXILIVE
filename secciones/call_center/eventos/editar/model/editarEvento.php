<?php
    include("../../../../connection/conexion.php");
    $data = json_decode(file_get_contents('php://input'), true);

    $num_paciente = $data['num_paciente'] != "" ?  $data['num_pacienete'] : NULL;
    $fechaServicio = $data['fechaServicio'] != "" ? $data["fechaServicio"] : NULL;
    $horaEntrada = $data['horaEntrada'] != "" ? $data["horaEntrada"] : NULL;
    $motivoConsulta = $data['motivoConsulta'] != "" ? $data["motivoConsulta"] : NULL;
    $nAutorizacion = $data['nAutorizacion'] != "" ? $data["nAutorizacion"] : NULL;
    $auEspecial = $data['auEspecial'] != "" ? $data["auEspecial"] : NULL;
    $asignarMedico = $data['id_usuarios'] != "" ? $data["id_usuarios"] : NULL;
    $tipoServicio = $data['idServicio'] != "" ? $data["idServicio"] : [];
    $usuariosMostrados = $data['num_paciente'] != "" ? $data['num_paciente'] : [];
    $ids_sv = $data['id_sv'] != "" ? $data['id_sv'] : [];
    
    
    
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
    estado = 1,
    WHERE num_paciente = :usuariosMostrados
    AND id_sv = :ids_sv;
    ');

     foreach ($usuariosMostrados as $usuariosId) {
        $sentencia->bindparam(':usuariosMostrados', $usuariosId);
         foreach($ids_sv as $id) {
            $sentencia->bindparam(':ids_sv', $id);
            $sentencia->bindparam(':fechaServicio', $fechaServicio);
            $sentencia->bindparam(':horaEntrada', $horaEntrada);
            $sentencia->bindparam(':motivoConsulta', $motivoConsulta);
            $sentencia->bindparam(':nAutorizacion', $nAutorizacion);
            $sentencia->bindparam(':auEspecial', $auEspecial);
            $sentencia->bindparam(':asignarMedico', $asignarMedico);
            foreach ($idServicio as $servicio) {
                $sentencia->bindparam(':idServicio', $servicio);

                if ($sentencia->execute()) {
                    echo '<script language="javascript"> ';
                    echo 'Swal.fire({
                        icon: "success",
                        title: "Servico Agregado",
                        showConfirmButton: false,
                        timer: 1500,
                    }).then(function() {
                        //window.location = "index.php";
                        });';
                    echo '</script>';
                } else {
                    echo '<script language="javascript"> ';
                    echo 'Swal.fire({
                                icon: "error",
                                title: "Error al agregar el servicio",
                                text: "Hubo errores en la inserción",
                                confirmButtonColor: "#d33",
                                confirmButtonText: "OK",
                            });';
                    echo '</script>';
                }
           
         }
    }
}
    
?>