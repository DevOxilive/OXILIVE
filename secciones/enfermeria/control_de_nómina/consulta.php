<?php 
//Consulta prueba para los informes
include("../../../connection/conexion.php");

$consulta = "
SELECT A.id_empleadoEnfermeria, CONCAT(U.Nombres, ' ', U.Apellidos) AS NombreCompleto, T.nombreServicio, A.fechaAsis, R.hora_entrada, H.horarioEntrada,
(SELECT COUNT(id_Rbitacora) FROM registro_bitacora R2 WHERE R2.id_usuario = U.id_usuarios) AS numero_de_registros, T.sueldo
FROM asistencias A,  registro_bitacora R, tipos_servicios T, asignacion_horarios H, usuarios U
WHERE A.id_horario = H.id_asignacionHorarios
AND A.id_empleadoEnfermeria = U.id_usuarios
AND A.id_asistencias = R.id_checkIn
AND H.id_tipoServicio = T.id_tipoServicio
AND H.id_usuario = U.id_usuarios
AND A.fechaAsis = R.Registro_fecha
AND U.id_departamentos = 11;
";

$sentencia = $con->prepare($consulta);
$sentencia->execute();
$trabajador = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>