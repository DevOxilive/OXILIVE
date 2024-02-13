<?php
require('../../../fpdf/fpdf.php');
class PDF extends FPDF{
private $isFirstPage = true;
    // Cabecera de página
function Header(){

 //Movernos a la derecha
 $this->Cell(50);
 //Salto de lìnea
 $this->Ln(25);
//Salto de línea
 $this->Ln(20);
 $this->SetXY(80, 15);

 $this->Image('../../../img/Logo.png', 12, 10, 45);
  //Arial bold 15
  $this->SetFont('Arial','B',20);
 $this->MultiCell(120, 8, ('VALE DE SALIDA DEL ALMACEN OXIGENO'), 1, 'C', false);
  // Continuar con el contenido
  $this->Ln(10);
  $this->SetFont('Arial','B',10);
  $this->Cell(30, 10, 'Fecha de solicitud: ____________________', 0, 'C', 0);

  $this->Cell(27, 10, ('Nombre y firma del solicitante: _____________'), 0, 'C', 0);
  $this->Cell(40, 10, ('Nombre y firma del conductor: _______________________'), 0, 'C', 0);
  
  $this->Ln(1);
  $this->SetX(90);
  $this->Cell(105, -30, ('Nombre y firma de quien recibe: __________________________'), 0, 'C', 0);
  $this->Ln(19);
  $this->SetX(90);
  $this->Cell(105, -30, ('Nombre y firma de quien entrega de almacen: ________________'), 0, 'C', 0);

  $this->Ln(30);
  $this->SetX(110);
  $this->Cell(40, 10, ('Camioneta: _______________________'), 0, 'C', 0);
    //Aquí va ir la tabla del insumo
    $this->SetXY(10, 76);
    $this->Cell(20, 10, 'CANTIDAD.', 1, 0, 'C', 0);
   //DESCRIPCION DEL INSUMO
    $this->SetXY(30, 76);
    $this->Cell(70, 10, 'DESCRIPCION DEL INSUMO.', 1, 0, 'C', 0);
    //PACIENTE
    $this->SetXY(100, 76);
    $this->Cell(43, 10, 'PACIENTE.', 1, 0, 'C', 0);
    //OBSERVACIONES
    $this->SetXY(143, 76);
    $this->Cell(60, 10, 'ASEGURADORA.', 1, 0, 'C', 0);
    //ESTA ES LA PARTE DE LA FIRMA DEL VOBO DE DIRECCIÓN
    // $this->Ln(30);
    $this->SetXY(45, 90);
    $this->Cell(90, 10, 'VoBo de Direccion: _______________________________________________', 0, 'C', 0);
    //OBSERVACIONES
    $this->SetXY(10, 95);
    $this->Cell(100, 20, 'OBSERVACIONES: ____________________________________________________________________________', 0, 'C', 0);
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
/*
$txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
$sentencia = $con->prepare("SELECT id_procedi,CONCAT(po.nombres, ' ', po.apellidos)AS Paciente,No_nomina,
CONCAT(u.Nombres, ' ', u.Apellidos) AS Medico ,
icd, dx, fecha, pacienteYnomina , c.cpt 
FROM procedimientos p, usuarios u, 
pacientes_call_center po , cpts c
WHERE p.medico = u.id_usuarios
AND p.pacienteYnomina = po.id_pacientes 
AND c.id_cpt = p.cpt
AND p.pacienteYnomina = :paciente;");
$sentencia->bindParam(":paciente",$txtID);
$sentencia->execute();*/

$pdf = new PDF();
$pdf-> AliasNbPages();
$pdf->AddPage();
// Definir los márgenes del cuadrado
$margenX = 9;
$margenY = 9;
$anchoCuadrado = 195;
$altoCuadrado = 100;
$pdf->Rect($margenX, $margenY, $anchoCuadrado, $altoCuadrado);










// while($imprime = $sentencia->fetch(PDO::FETCH_ASSOC)){
$pdf->SetXY(10, 20);
//$pdf->MultiCell(500, 5, ('Nombre del Paciente: '));
// $pdf->MultiCell(500, 5, ('Nombre del Paciente: '));
// $pdf->SetXY(10,29);
// $pdf->MultiCell(70, 5, ('Numero de Nomina: '  ));
// $pdf->SetXY(10, 30);
// $pdf->MultiCell(70, 20, ('Médico Tratante:')); 
// $pdf->SetXY(112, 20);
// $pdf->MultiCell(70, 5, ('Código ICD:')); 
// $pdf->SetXY(112, 29);
// $pdf->MultiCell(70, 5,  ('Dx:'));
// $pdf->SetXY(112, 37);
// $pdf->MultiCell(70, 5,  ('CPT:'));
// }

$pdf->Output();


?>