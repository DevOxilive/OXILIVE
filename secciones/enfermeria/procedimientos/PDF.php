<?php
require('../../../fpdf/fpdf.php');
class PDF extends FPDF{
// Cabecera de página
function Header(){
    //Arial bold 15
    $this->SetFont('Arial','B',10);
    //Movernos a la derecha
    $this->Cell(50);
    //Título
    $this->Cell(90,10,'PROCEDIMIENTOS REALIZADOS',0,0,'C');
    //Salto de línea
    $this->Ln(25);
   //Salto de línea
   $this->Ln(10);
    
    // Continuar con el contenido
    $this->Cell(10, 10, 'No.', 1, 0, 'C', 0);
    $this->Cell(27, 10, 'CPT.', 1, 0, 'C', 0);
    $this->Cell(40, 10, utf8_decode('Descripción'), 1, 0, 'C', 0);
    $this->Cell(35, 10, ('Fecha'), 1, 0, 'C', 0);
    $this->Cell(40, 10, 'Unidades', 1, 0, 'C', 0);
    $this->Cell(40, 10, 'Firma paciente', 1, 1, 'C', 0);
    $this->SetXY(150, 12);
    $this->MultiCell(50, 5, ('ENFERMERIA GENERAL' . "\n" . '8 HORAS'), 1, 'C', false);
}

// Pie de página
function Footer(){
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10, ('Página '.$this->PageNo()).'/{nb}',0,0,'C');
}

}

require('../../../connection/conexion.php');

$txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
$sentencia = $con->prepare("SELECT p.id_procedi,CONCAT(po.Nombres, ' ', po.Apellidos)AS Paciente,po.No_nomina,
CONCAT(u.Nombres, ' ', u.Apellidos) AS Medico ,
 p.icd, p.dx, p.fecha, p.pacienteYnomina 
FROM procedimientos p, usuarios u, 
pacientes_oxigeno po 
WHERE p.medico = u.id_usuarios
AND p.pacienteYnomina = po.id_pacientes 
AND p.pacienteYnomina = :paciente LIMIT 1;");
$sentencia->bindParam(":paciente",$txtID);
$sentencia->execute();

$pdf = new PDF();
$pdf-> AliasNbPages();
$pdf->AddPage();
while($imprime = $sentencia->fetch(PDO::FETCH_ASSOC)){
$pdf->SetXY(20, 20);
//$pdf->MultiCell(500, 5, ('Nombre del Paciente: '));
$pdf->MultiCell(500, 5, ('Nombre del Paciente: '.$imprime['Paciente']));
$pdf->SetXY(20,29);
$pdf->MultiCell(70, 5, ('Numero de Nomina: ' .$imprime['No_nomina'] ));
$pdf->SetXY(20, 30);
$pdf->MultiCell(70, 20, utf8_decode('Médico Tratante:' .$imprime['Medico'])); 
$pdf->SetXY(100, 20);
$pdf->MultiCell(70, 5, utf8_decode('Código ICD:' .$imprime['icd'] )); 
$pdf->SetXY(100, 30);
$pdf->MultiCell(70, 5,  utf8_decode('Dx:' .$imprime['dx'] ));
}
//Aquí mando a imprimir La lista de los CPTS , DESCRIPCION, FECHA, UNIDAD
$txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
$lista = $con->prepare("SELECT p.id_procedi, p.pacienteYnomina, p.cpt,cp.cpt,p.fecha, cp.descripcion,cp.unidad  
FROM procedimientos p, cpts_administradora cp WHERE p.cpt = cp.id_cpt AND 
pacienteYnomina = :paciente;");
$lista->bindParam(":paciente",$txtID);
$lista->execute();

$pdf->SetFont('Arial', 'B', 10);
$y = 55;
$alturaCelda = 20; // Nueva altura de la celda
$contador = 1; 
$pdf->SetFont('Arial', 'B', 10);
$y = 55;
$alturaCelda = 20; // Nueva altura de la celda
$contador = 1; 
while ($res = $lista->fetch(PDO::FETCH_ASSOC)) {
    $pdf->SetXY(10, $y);
    $pdf->Cell(10, $alturaCelda, $contador, 1, 0, 'C', 0); // Muestra el contador en lugar de '1'
    $pdf->SetXY(20, $y);
    $pdf->Cell(27, $alturaCelda, $res['cpt'], 1, 0, 'C', 0);
    $pdf->SetXY(47, $y);
    $descripcion = $res['descripcion'];
    $pdf->MultiCell(40, 10, $descripcion, 1, 'C'); // Utiliza MultiCell en lugar de Cell
    $pdf->SetXY(87, $y);
    $pdf->Cell(35, $alturaCelda, $res['fecha'], 1, 0, 'C', 0);
    $pdf->SetXY(122, $y);
    $pdf->Cell(40, $alturaCelda, $res['unidad'], 1, 0, 'C', 0);
    $pdf->SetXY(162, $y);
    $pdf->Cell(40, $alturaCelda, '', 1, 1, 'C', 0);
    $y += $alturaCelda; // Actualiza la posición vertical para la siguiente fila
    $contador++;
}
$pdf->Output();




?>