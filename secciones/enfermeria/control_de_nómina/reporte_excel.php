<?php

// conexión a la base de datos
include("../../../connection/conexion.php");

// trae las librerias para el formato en excel
include("../../../vendor/autoload.php");
use PhpOffice\PhpSpreadsheet\{Spreadsheet, IOFactory};

// Consulta para traer los datos solicitados
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

//Se establecen los criterios del excel
$excel = new Spreadsheet();
$hojaActiva = $excel->getActiveSheet();
$hojaActiva->setTitle("Nomina");


// Establece estilos para la PRIMERA fila (encabezados)
$headerStyle = [
    'font' => [
        'bold' => true,
        'color' => ['rgb' => 'FFFFFF'],
        'size' => 15,
    ],
    'fill' => [
        'fillType' => 'solid',
        'startColor' => ['rgb' => '008080'],
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['rgb' => 'FFFFFF'],
        ],
    ],
];

$hojaActiva->getStyle('A1:F1')->applyFromArray($headerStyle);

// Llena la tabla con datos 
$hojaActiva->setCellValue('A1', 'Usuario');
$hojaActiva->setCellValue('B1', 'Nombre');
$hojaActiva->setCellValue('C1', 'Apellidos');
$hojaActiva->setCellValue('D1', 'Puesto'); 
$hojaActiva->setCellValue('E1', 'Sueldo');
$hojaActiva->setCellValue('F1', 'Tipo de guardia'); 
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

// columnas 'ANCHO DE COLUMNAS'
$hojaActiva->getColumnDimension('A')->setAutoSize(true);
$hojaActiva->getColumnDimension('B')->setAutoSize(true);
$hojaActiva->getColumnDimension('C')->setAutoSize(true);
$hojaActiva->getColumnDimension('D')->setAutoSize(true);
$hojaActiva->getColumnDimension('E')->setAutoSize(true);
$hojaActiva->getColumnDimension('F')->setAutoSize(true);

// determina la orieteción deL TEXTO
$hojaActiva->getStyle('A:F')->getAlignment()->setHorizontal('center');

// Es el formato que se le da a los numero dentro de la tabla
$hojaActiva->getStyle('E2:E' . $fila)->getNumberFormat()->setFormatCode('$ #,##0');


// Aplica estilo a todas las celdas de datos
$dataStyle = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['rgb' => 'FFFFFF'],
        ],
    ],
];

$hojaActiva->getStyle('A2:F' . ($fila - 1))->applyFromArray($dataStyle);

// Aplica estilo dentro de las celdas
for ($i = 2; $i <= $fila; $i += 2) {
    $hojaActiva->getStyle('A' . $i . ':F' . $i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('d3d3d3');
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="nomina.xlsx"');
header('Cache-Control: max-age=0');


$writer = IOFactory::createWriter($excel, 'Xlsx');
$writer->save('php://output');

?>
