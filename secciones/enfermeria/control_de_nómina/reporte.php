<?php

include ("../../../connection/conexion.php");
use PhpOffice\PhpSpreadsheet\Spreadsheet;


$sql = $con->query("SELECT trabajador.*, puestos.Nombre_puestos 
FROM usuarios AS trabajador 
JOIN estado AS est ON trabajador.Estado = est.id_estado
JOIN puestos ON trabajador.id_departamentos = puestos.id_puestos
WHERE Nombre_puestos = 'Enfermeria'");
$sql = $con->query($sql);

$excel = new  Spreadsheet();
$hojaActiva = $excel->getActiveSheet();
$hojaActiva->setTitle("Nomina");


$hojaActiva->setCellValue('A1','Usuario');

$hojaActiva->setCellValue('B1','Nombre');

$hojaActiva->setCellValue('C1','Apellidos');

$hojaActiva->setCellValue('D1','Dias laborados');

$hojaActiva->setCellValue('F1','Sueldo total');

$hojaActiva->setCellValue('G1','Tipo de guardia');

$fila = 2;

while ($rows = $sql->PDO::fetch_assoc($resultado)) {
$hojaActiva->setCellValue('A'.$fila, $rows['id_usuarios']);
$hojaActiva->setCellValue('A'.$fila, $rows['Nombres']);
$hojaActiva->setCellValue('A'.$fila, $rows['Apellidos']);
$hojaActiva->setCellValue('A'.$fila, $rows['Nombre_puestos']);
$hojaActiva->setCellValue('A'.$fila, $rows['codigo_postal']);
$hojaActiva->setCellValue('A'.$fila, $rows['rfc']);	
$fila++;
}


?>