<?php
require('../../../fpdf/fpdf.php');



class PDF extends FPDF{
// Cabecera de página
function Header(){
     // Logo
    //Movernos a la derecha
    $this->Image('../../../img/Logo.png', 150, 6, 40); // Mover la imagen 75 unidades hacia la derecha
    //Arial bold 15
    $this->SetFont('Arial','B',18);
    //Movernos a la derecha
    $this->Cell(30);
    //Título
    $this->SetTextColor(255, 0, 0); // Rojo
    $this->MultiCell(80, 7, utf8_decode('REGISTRO CLÍNICO Y' . "\n" . ' CUIDADOS GENERALES'), 0, 'C', false);
    $this->SetTextColor(0, 0, 0); // Restablecer a negro (opcional)
    $this->SetXY(145,35);
    //fecha
    // Configura la fuente
    $this->SetFont('arial', '', 10);
    // Imprime la celda con la fuente configurada
    $this->Cell(15, -10, 'FECHA:   ' . date('d/m/Y'), 0, 1, 'L');
        // Columna 1 (más ancha)
        $this->SetXY(10, 40);
        $this->MultiCell(120, 8, utf8_decode('Nombre del Paciente:'), 1, 'L', false);
        $this->SetXY(10, 48);
        $this->MultiCell(120, 8, utf8_decode('Familiar responsable:'), 1, 'L', false);
        $this->SetXY(10, 56);
        $this->MultiCell(120, 8, utf8_decode('Nombre del Médico:'), 1, 'L', false);
        $this->SetXY(10, 64);
        $this->MultiCell(120, 8, utf8_decode('Diagnóstico Médico:'), 1, 'L', false);

        // Columna 2 (más estrecha)
        $this->SetXY(130, 40);
        $this->MultiCell(70, 8, utf8_decode('Horario de Servicio:'), 1, 'L', false);
        $this->SetXY(130, 48);
        $this->MultiCell(70, 8, utf8_decode('Edad:'), 1, 'L', false);
        $this->SetXY(130, 56);
        $this->MultiCell(70, 8, utf8_decode('Sexo:'), 1, 'L', false);
        $this->SetXY(130, 64);
        $this->MultiCell(70, 8, utf8_decode('Peso:'), 1, 'L', false);
        
       
    }

 


// Pie de página
function Footer(){
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10, utf8_decode('Página '.$this->PageNo()).'/{nb}',0,0,'C');
    
}

//Tabla de respiración
function CreateTable($header, $data) {
     //Leyenda
     $this->SetFont('arial', '', 7);
     // Imprime la celda con la fuente configurada
    $this->SetFont('','B'); // Configura la fuente como negrita
    $this->Cell(18, 10, 'Realiza tu registro por horas, punteando en los recuadros. Recuerda utilizar tinta roja para temperatura y azul para el pulso.', 'C');
    $this->Ln(10); 
       
// Definir alturas de las filas
$rowHeight = 8;
// Definir anchos de las columnas
$colWidths = [38, 38, 38, 38, 38];
// Cabecera de la tabla
$this->SetFont('Arial', 'B', 8);
$this->SetFillColor(234, 233, 233); // Color de fondo para la cabecera Gris claro
foreach ($header as $col) { //trae los datos de la cabcera y 
    $this->Cell(array_shift($colWidths), $rowHeight, utf8_decode($col), 1, 0, 'C', true);
}
$this->Ln();


    // Datos de la tabla
    $this->SetFont('Arial', '', 12);
    foreach ($data as $row) {
        foreach ($row as $key => $cell) {
            if ($key == 0) { // Cambiar a 1 para la segunda columna
                $this->SetFillColor(248, 0, 0); // Fondo rojo
                $this->SetTextColor(255, 255, 255); // Texto blanco
            } else {
                $this->SetFillColor(255, 255, 255); // Fondo blanco (predeterminado)
                $this->SetTextColor(0, 0, 0); // Texto negro (predeterminado)
            }
            $this->Cell(38, 5, utf8_decode($cell), 1, 0, 'L', true);
        }
        $this->Ln();
     }
     
     $this->Ln("10");
     $this->SetFont('arial', '', 7);
     
     $this->Cell(19, 5, utf8_decode("Datos"), 0, 0, 'C');
     $this->SetTextColor(0, 0, 0);
     $this->SetFillColor(254, 26, 26);
     
     // Definir 13 columnas
     for ($i = 1; $i <= 13; $i++) {
         $this->Cell(13, 5, utf8_decode($i . '°'), 1, 0, 'C', true);
     }
     $this->Ln();
     
     // Datos en las filas
     $filas = ["Vomito", "Evacuaciónes", "Orina", "Ingesta de Liquidos", "Caidas", "Drenajes y/o Ventajas"];
     
     foreach ($filas as $fila) {
         $this->Cell(30, 5, utf8_decode($fila), 1, 0, 'C', 1);
         for ($i = 1; $i <= 12; $i++) {
             $this->Cell(8, 5, utf8_decode(""), 1, 0, 'C', 0);
         }
         $this->Ln();
     }
     
     $this->Ln(10);
     $this->SetFont('arial', '', 10);
     // Celda 1
     $this->SetTextColor(0, 0, 0);
     $this->SetFillColor(255, 255, 255);
     $this->MultiCell(19, 5, utf8_decode('UPP, Heridas o Hematomas' . "\n" . '(tipo y descripción)'), 1, 'C', false);
     
     

        
    }
 }
//Instanciar funcionaes 
    $pdf = new PDF();
    $pdf-> AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',10);
    
        // Cabecera de la tabla
        $header = ['','De 9:00 AM a 14:00 PM', 'De 15:00 PM a 20:00 PM', 'De 21:00 PM a 02:00 AM', 'De 03:00 AM a 08:00 AM'];

        // Datos de la tabla (5 columnas)
        $data = [
            ['Respiración', '', '', '', ''],
            ['Tención Arterial', '', '', '', ''],
            ['SPO2', '', '', '', ''],
            ['Glicemia Capilar', '', '', '', ''],
            
        ];    
        $pdf->CreateTable($header, $data);


    $pdf->Output();
?>