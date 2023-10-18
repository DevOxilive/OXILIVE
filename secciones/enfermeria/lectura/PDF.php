<?php
require('../../../fpdf/fpdf.php');

class PDF extends FPDF
{
    private $imprimirEncabezadoPaciente = true;
function Header()
{
    // Logo
    $this->Image('../../../img/Logo.png', 15, 5, 60);
    $this->SetXY(155,10); 
    $this->SetMargins(15, 15, 15); 
    $this->SetFont('Arial', 'B', 15);
    // Título
    $this->Cell(1 ,4, '', 0, 1, 'C'); 
    $this->setX(50);
    $this->MultiCell(0, 10, utf8_decode('Historial De Paciente:'), 0, 'C');
    $this->Ln(25);
    //Este es para el RFC
    $this->SetXY(130,19); 
    $this->SetFont('Arial', 'B', 10);
    $this->Cell(1 ,4, '', 0, 1, 'C'); 
    $this->setX(40);
    $this->MultiCell(0, 10, utf8_decode('RFC Del Paciente:'), 0, 'C');
    $this->Ln(25);
    $this->SetXY(130,19); 
    $this->SetFont('Arial', 'B', 10);
    $this->Cell(1 ,4, '', 0, 1, 'C'); 
    $this->setX(135);
    $this->MultiCell(0, 10, utf8_decode('Edad:'), 0, 'C');
    $this->Ln(25);
}

    function Footer()
    {
        // Contenido del pie de página
        // ...
    }
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

require '../../../connection/conexion.php';

$txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

$sentencia = $con->prepare("SELECT p.id_procedi, p.icd, p.dx, p.pacienteYnomina, 
u.id_usuarios, CONCAT(u.Nombres, ' ', u.Apellidos) AS Medico,
po.id_pacientes, CONCAT(po.Nombres, ' ', po.Apellidos) AS Paciente,po.No_nomina,
po.Fecha_registro, po.Edad,po.municipio,po.colonia,po.rfc,
cp.id_cpt, cp.cpt , cp.descripcion, cp.unidad
FROM procedimientos p, usuarios u, 
pacientes_oxigeno po , cpts_administradora cp
WHERE p.medico = u.id_usuarios
AND p.pacienteYnomina = po.id_pacientes
AND p.cpt = cp.id_cpt AND p.pacienteYnomina = :paciente;");

$sentencia->bindParam(":paciente", $txtID);
$sentencia->execute();

$pdf->Ln(0.6);
$pdf->setX(4);
$pdf->SetFont('Times', 'B', 10);
$alturaCelda = 20;
$imprimirEncabezadoPaciente = true;
while ($histrial = $sentencia->fetch(PDO::FETCH_ASSOC)) {
    if ($imprimirEncabezadoPaciente) {
        $pdf->SetFont('Arial', '', 15);
        $pdf->SetXY(149, 14);
        $pdf->SetTextColor(255, 0, 0); // Establecer el color a rojo (R, G, B)
        $pdf->MultiCell(90, 10, utf8_decode($histrial['Paciente']));
        $pdf->SetTextColor(0, 0, 0);
        $imprimirEncabezadoPaciente = false;
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY(132, 23.2);
         $pdf->SetTextColor(255, 0, 0); // Establecer el color a rojo (R, G, B)
        $pdf->MultiCell(90, 10, utf8_decode($histrial['rfc']));
         $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetXY(170, 23.2);
         $pdf->SetTextColor(255, 0, 0); // Establecer el color a rojo (R, G, B)
        $pdf->MultiCell(90, 10, utf8_decode($histrial['Edad']));
         $pdf->SetTextColor(0, 0, 0);
        //Aqui van los datos que se muestran en la tabla
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetXY(15, 40);
        $pdf->MultiCell(40, 10, utf8_decode('Medico que lo atendio:'), 1, 'C');
        $pdf->SetXY($pdf->GetX() + 40, $pdf->GetY() - 10);
        $pdf->SetXY(55, 40);
        $pdf->MultiCell(40, 20, utf8_decode('Fecha de ingreso:'), 1, 'C');
        $pdf->SetXY($pdf->GetX() -40, $pdf->GetY() + 20);
        $pdf->SetXY(95, 40);
        $pdf->MultiCell(45, 20, utf8_decode('Colonia:'), 1, 'C');
        $pdf->SetXY($pdf->GetX() - 40, $pdf->GetY() + 10);
        $pdf->SetXY(140, 40);
        $pdf->MultiCell(60, 20, utf8_decode('Ingreso por:'), 1, 'C');
        $pdf->Ln(0);
        
    }
    $pdf->SetFont('Arial', '', 9);
    $pdf->Ln(0);
    $pdf->setX(15);
    $pdf->Cell(40, $alturaCelda, utf8_decode($histrial['Medico']), 1, 0, 'C', 0);
    $pdf->Cell(40, $alturaCelda, utf8_decode($histrial['Fecha_registro']), 1, 0, 'C', 0);
    $pdf->Cell(45, $alturaCelda, utf8_decode($histrial['colonia']), 1, 0, 'C', 0);
    $pdf->Cell(60, $alturaCelda, utf8_decode($histrial['dx']), 1, 1, 'C', 0);
}

$pdf->Output();


?>