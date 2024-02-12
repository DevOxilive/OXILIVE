<?php
include("../../../connection/conexion.php");
include("../../../templates/hea.php");
if (isset($_GET['txtID'])) {

$txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
$sentencia = $con->prepare("SELECT em.*, col.id AS colonia_id, col.nombre AS colonia, m.nombre AS municipio, e.nombre AS estadoDir, codigo_postal, g.genero AS Generoo 
FROM empleados em , colonias col, municipios m, estados e, genero g
WHERE em.colonia = col.id
AND col.municipio = m.id
AND em.genero = g.id_genero
AND m.estado = e.id AND em.id_empleado = :id_empleados");
$sentencia->bindParam(":id_empleados", $txtID);
$sentencia->execute();
$registro = $sentencia->fetch(PDO::FETCH_LAZY);

// //Traer los datos en la DB
$Nombres = $registro["nombres"];
$Apellidos = $registro["apellidos"];
$Genero = $registro["Generoo"];
$Curp = $registro["curp"];
$rfc = $registro["rfc"];
$telefono = $registro["telefonoUno"];
$telefonoDos = $registro["telefonoDos"];
$correo = $registro["correo"];
$cuentaBancaria = $registro["numCuenta"];
$nss = $registro["nss"];
$Puesto = $registro['departamento'];
$codigo_postal = $registro["codigo_postal"];
$coloniaId = $registro["colonia_id"];
$colonia = $registro["colonia"];
$municipio = $registro["municipio"];
$estado = $registro["estadoDir"];
$calle = $registro['calle'];
$numExt = $registro['numExt'];
$numInt = $registro['numInt'];
$calleUno = $registro['calleUno'];
$calleDos = $registro['calleDos'];
$referencias = $registro['referenciasDireccion'];
$tipoLicencia = $registro['tipoLicencia'];

$Ine = $registro['ineDoc'];
$acta = $registro['actaNacimiento'];
$comprobante = $registro['comprobanteDomicilio'];
$certificado = $registro['certificadoEstudios'];
$numCuenta = $registro['cuenta'];

$curp = $registro['curpDoc'];
$nssDoc = $registro['nssDoc'];
$rfcDoc = $registro['rfcDoc'];
$laboral = $registro['referenciaLabUno'];
$personal = $registro['referenciaLabDos'];
$licencia = $registro['licenciaUno'];
}