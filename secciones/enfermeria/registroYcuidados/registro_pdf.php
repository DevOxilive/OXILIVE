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
     $this->SetFont('arial', '', 8);
     // Imprime la celda con la fuente configurada
    $this->SetFont('','B'); // Configura la fuente como negrita
    $this->Cell(18, 10, 'Realiza tu registro por horas, punteando en los recuadros. Recuerda utilizar tinta roja para temperatura y azul para el pulso.', 'C');
    $this->Ln(10);
    $this->SetFont('arial', 'B', 8); 
    $this->Cell(50, 5, utf8_decode("Temperarura (Rojo), Pulso (Azul)"), 1, 0, 'C');
    $this->SetFillColor(23, 32, 42);
    $this->Ln();

 
// Empieza tabla Respiracion, Tensión Arteria, Etc.
    
$this->Ln(4);
     $this->SetFont('arial', 'B', );
     
     $this->Cell(30, 5, utf8_decode(""), 0, 0, 'C');
     $this->SetTextColor(255, 255, 255);
     $this->SetFillColor(89, 150, 216);
     
     // Datos de las columnas
     $nombresColumnas = [
        'De 9:00 AM a 14:00 PM', 'De 15:00 PM a 20:00 PM', 'De 21:00 PM a 02:00 AM', 'De 03:00 AM a 08:00 AM'
     ];
     
     // Imprimir nombres de las columnas con espacios en blanco
     foreach ($nombresColumnas as $nombre) {
         $this->Cell(40, 5, utf8_decode($nombre), 1, 0, 'C', true);
     }
     $this->Ln();
     
     $this->SetFillColor(254, 26, 26);
     // Datos en las filas
     $filas = ["Respiración", "Tención Arterial", "SPO2", "Glicemia Capilar"];
     
     foreach ($filas as $fila) {
         $this->Cell(30, 5, utf8_decode($fila), 1, 0, 'C', 1);
         for ($i = 1; $i <= 4; $i++) {
             $this->Cell(40, 5, utf8_decode(""), 1, 0, 'C', 0);
         }
         $this->Ln();
     }

// Empieza tabla vomitos, Evacuaciones, Etc.
     $this->Ln(3);
     $this->SetFont('arial', 'B', 8);
     
     $this->Cell(30, 5, utf8_decode(""), 0, 0, 'C');
     $this->SetTextColor(255, 255, 255);
     $this->SetFillColor(89, 150, 216);
     
     // Datos de las columnas
     $nombresColumnas = [
         "1°", "2°", "3°", "1°", "2°", "3°", "1°", "2°", "3°", "1°", "2°", "3°"
     ];
     
     // Imprimir nombres de las columnas con espacios en blanco
     foreach ($nombresColumnas as $nombre) {
         $this->Cell(13.3, 5, utf8_decode($nombre), 1, 0, 'C', true);
     }
     $this->Ln();
     
     $this->SetFillColor(254, 26, 26);
     // Datos en las filas
     $filas = ["Vomito", "Evacuaciónes", "Orina", "Ingesta de Liquidos", "Caidas", "Drenajes y/o Ventajas"];
     
     foreach ($filas as $fila) {
         $this->Cell(30, 5, utf8_decode($fila), 1, 0, 'C', 1);
         for ($i = 1; $i <= 12; $i++) {
             $this->Cell(13.3, 5, utf8_decode(""), 1, 0, 'C', 0);
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
        $header = [];

        // Datos de la tabla (5 columnas)
        $data = [];    
        $pdf->CreateTable($header, $data);


    $pdf->Output();
?>