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
/*$sentencia2 = $con->prepare("SELECT * FROM admi_enfer WHERE id_admi_enfer=:id_admi_enfer ");*/
$sentencia2 = $con->prepare("SELECT * , (SELECT Nombres FROM pacientes_oxigeno WHERE
 pacientes_oxigeno.id_pacientes=proce_enfer.pacientes LIMIT 1) as pc, (SELECT No_nomina FROM pacientes_oxigeno WHERE pacientes_oxigeno.id_pacientes = proce_enfer.pacientes LIMIT 1) as nomina
 FROM proce_enfer WHERE id_proce=:id_proce");

$sentencia2->bindParam(":id_proce", $txtID);
$sentencia2->execute();

$pdf = new PDF();
$pdf-> AliasNbPages();
$pdf->AddPage();
while($cpts = $sentencia2->fetch(PDO::FETCH_ASSOC)){
$pdf->SetXY(20, 20);
$pdf->MultiCell(500, 5, ('Nombre del Paciente: ' . $cpts['pc']));
$pdf->SetXY(20,29);
$pdf->MultiCell(70, 5, ('Numero de Nomina: ' . $cpts['nomina']));
$pdf->SetXY(20, 30);
$pdf->MultiCell(70, 20, utf8_decode('Médico Tratante:' .$cpts['medico'])); 
$pdf->SetXY(100, 20);
$pdf->MultiCell(70, 5, utf8_decode('Código ICD:' .$cpts['codigo_ICD'])); 
$pdf->SetXY(100, 30);
$pdf->MultiCell(70, 5,  utf8_decode('Dx:' .$cpts['dx']));
}
$txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
$sentencia4 = $con->prepare("SELECT * FROM proce_enfer WHERE id_proce=:id_proce");
$sentencia4->bindParam(":id_proce", $txtID);
$sentencia4->execute();

    $pdf->SetFont('Arial','B',10);
    while($res = $sentencia4->fetch(PDO::FETCH_ASSOC)){
        $pdf->SetXY(10, 55);
        $pdf->Cell(10,10, '1', 1,0, 'C',0);
        $pdf->SetXY(20, 55);
        $pdf->Cell(27,10, $res['cpt'], 1,0, 'C',0);
        $pdf->Cell(40,10, $res['descripcion'], 1,0, 'C',0);
        $pdf->SetXY(87, 55);
        $pdf->Cell(35,10, $res['fecha'], 1,0, 'C',0);
        $pdf->SetXY(122, 55);
        $pdf->Cell(40,10, $res['unidad'], 1,0, 'C',0);
        $pdf->SetXY(162, 55);
        $pdf->Cell(40,10, '', 1,1, 'C',0);
    }
        $pdf->Output();
?>