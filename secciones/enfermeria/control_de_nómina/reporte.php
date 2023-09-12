<?php

include("../../../connection/conexion.php");
include("../../../vendor/autoload.php");

use PhpOffice\PhpSpreadsheet\{Spreadsheet, IOFactory};


$consulta = "
    SELECT trabajador.*, puestos.Nombre_puestos 
    FROM usuarios AS trabajador 
    JOIN estado AS est ON trabajador.Estado = est.id_estado
    JOIN puestos ON trabajador.id_departamentos = puestos.id_puestos
    WHERE Nombre_puestos = 'Enfermeria'
";

$sentencia = $con->prepare($consulta);
$sentencia->execute();
$trabajadores = $sentencia->fetchAll(PDO::FETCH_ASSOC);


$excel = new Spreadsheet();
$hojaActiva = $excel->getActiveSheet();
$hojaActiva->setTitle("Nomina");

$hojaActiva->setCellValue('A1', 'Usuario');
$hojaActiva->setCellValue('B1', 'Nombre');
$hojaActiva->setCellValue('C1', 'Apellidos');
$hojaActiva->setCellValue('D1', 'Puesto'); // Cambié 'Dias laborados' a 'Puesto' ya que no se encuentra en tu consulta SQL
$hojaActiva->setCellValue('E1', 'Código Postal'); // Agregué 'Código Postal' como una columna adicional
$hojaActiva->setCellValue('F1', 'RFC'); // Agregué 'RFC' como una columna adicional

$fila = 2;

foreach ($trabajadores as $row) {
    $hojaActiva->setCellValue('A' . $fila, $row['id_usuarios']);
    $hojaActiva->setCellValue('B' . $fila, $row['Nombres']);
    $hojaActiva->setCellValue('C' . $fila, $row['Apellidos']);
    $hojaActiva->setCellValue('D' . $fila, $row['Nombre_puestos']);
    $hojaActiva->setCellValue('E' . $fila, $row['codigo_postal']);
    $hojaActiva->setCellValue('F' . $fila, $row['rfc']);
    $fila++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="nomina.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($excel, 'Xlsx');
$writer->save('php://output');

?>
