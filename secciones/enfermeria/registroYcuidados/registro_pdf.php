<?php
require('../../../fpdf/fpdf.php');



class PDF extends FPDF{

   // se establece que si el headre tiene contenido solo se colocara en la primera pagina 
    private $isFirstPage = true;
// Cabecera de página
function Header(){
   
 if ($this->isFirstPage) {
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
        
  $this->isFirstPage = false;
        }
   
       
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


function CreateTable($header, $data) {
     //Leyenda
     $this->SetFont('arial', '', 8);
     // Imprime la celda con la fuente configurada
    $this->SetFont('','B'); // Configura la fuente como negrita
    $this->Cell(18, 10, 'Realiza tu registro por horas, punteando en los recuadros. Recuerda utilizar tinta roja para temperatura y azul para el pulso.', 'C');
    $this->Ln(8);
    
//--------------------------------------- Empieza tabla Temperatura ---------------------------------------------------
    $this->SetFont('arial', 'B', 8); 
    $this->SetTextColor(255, 255, 255);
    $this->SetFillColor(0, 12, 255);
    $this->Cell(50, 5, utf8_decode("Temperarura (Rojo), Pulso (Azul)"), 1, 0, 'C', 1);
    

// Combinar cabeceras
$this->Ln();

$nombresColumnas = [
    "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", 
    "22", "23", "24", "01", "02", "03", "04", "05", "06", "07", "08"
];

$this->SetFont('arial', 'B', ); 
$this->SetTextColor(255, 255, 255);
$this->SetFillColor(255, 0, 0);
$this->Cell(9, 5, utf8_decode("Temp"), 1, 0, 'C', 1);
$this->SetFont('arial', 'B', ); 
$this->SetTextColor(255, 255, 255);
$this->SetFillColor(0, 12, 255);
$this->Cell(9, 5, utf8_decode("Pulso"), 1, 0, 'C', 1);
$this->SetFillColor(255, 255, 255);
$this->SetTextColor(0, 0, 0);
foreach ($nombresColumnas as $nombre) {
    $this->Cell(7.2, 5, utf8_decode($nombre), 1, 0, 'C', true);
}
$this->Ln();

// Combinar datos de filas
$temperaturas = ["40.5", "40", "39.5", "39", "38.5", "38", "37.5", "37", "36.5", "36", "35.5", "35"];
$pulsos = ["140", "130", "120", "110", "100", "90", "80", "70", "60", "50", "40", "30"];

// Rellenar la tabla con datos combinados
foreach ($temperaturas as $index => $temperatura) {
    $this->Cell(9, 5, utf8_decode($temperatura), 1, 0, 'C', 1);
    $this->Cell(9, 5, utf8_decode($pulsos[$index]), 1, 0, 'C', 1);
    foreach ($nombresColumnas as $nombre) {
        $this->Cell(7.2, 5, utf8_decode(""), 1, 0, 'C', 0);
    }
    $this->Ln();
}

 
//-------------------------------- Empieza tabla Respiracion, Tensión Arteria, Etc. -------------------------------
    
$this->Ln(4);
     $this->SetFont('arial', 'B', );
     
     $this->Cell(30, 5, utf8_decode(""), 0, 0, 'C');
     $this->SetTextColor(0, 0, 0);
     $this->SetFillColor(255, 255, 255);
     
     // Datos de las columnas
     $nombresColumnas = [
        'De 9:00 AM a 14:00 PM', 'De 15:00 PM a 20:00 PM', 'De 21:00 PM a 02:00 AM', 'De 03:00 AM a 08:00 AM'
     ];
     
     // Imprimir nombres de las columnas con espacios en blanco
     foreach ($nombresColumnas as $nombre) {
         $this->Cell(40, 5, utf8_decode($nombre), 1, 0, 'C', true);
     }
     $this->Ln();
     $this->SetTextColor(255, 255, 255);
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

//-------------------------------------- Empieza tabla vomitos, Evacuaciones, Etc. --------------------------------------------------
     $this->Ln(2);
     $this->SetFont('arial', 'B', 8);
     
     $this->Cell(30, 5, utf8_decode(""), 0, 0, 'C');
     $this->SetTextColor(255, 255, 255);
     $this->SetFillColor(0, 12, 255);
     
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
         $this->Cell(30, 5, utf8_decode($fila), 1, 0, 'R', 1);
         for ($i = 1; $i <= 12; $i++) {
             $this->Cell(13.3, 5, utf8_decode(""), 1, 0, 'C', 0);
         }
         $this->Ln();
     }
     
//------------------------------------- Empieza tabla UPP, Heridas o Hematomas ------------------------------------------ 
$this->Ln(4);
$this->SetFont('arial', '', 10);
$this->SetTextColor(0, 0, 0);
$this->SetFillColor(255, 255, 255);
$this->SetDrawColor(254, 26, 26);

// Celda UPP, Heridas o Hematomas
$this->MultiCell(30, 8, utf8_decode('UPP, Heridas o Hematomas (tipo y descripción)'), 1, 'C', 1);

// Inicializar un contador
$contador = 1;

$this->SetFont('arial', 'B', 10);
$this->SetFillColor(255, 255, 255);
$this->SetDrawColor(0, 0, 0);
// Establecer posición para la tabla y las columnas
$this->SetY($this->GetY() - 24); // Ajustar posición vertical
$this->SetX(40); // Ajustar posición horizontal para la primera columna

// Imprimir las celdas numeradas en la primera columna y celdas vacías en la segunda columna
for ($i = 1; $i <= 4; $i++) {
    $this->SetX(40); 
    $this->Cell(10, 6, utf8_decode($contador), 1, 0, 'C', 1); // Celda numerada
    $this->Cell(10, 6, utf8_decode(''), 1); // Celda vacía
    $contador++;
    $this->Ln(); // Nueva línea para la siguiente fila
}

// Establecer posición para el cuadro de texto
$this->SetFont('arial', '', 10);
$this->SetTextColor(0, 0, 0);
$this->SetY($this->GetY() - 24); // Ajustar posición vertical
$this->SetX(60); // Ajustar posición horizontal para el cuadro de texto

// Cuadro de texto
$this->MultiCell(140, 24, utf8_decode('(Descripción)'), 1, 'L'); // Cuadro de texto, puedes cambiar el tamaño aquí


//----------------------- Empieza tabla soluciones IV ----------------------------------------------------------
$this->Ln(5);
// Calcular el ancho de la página
$anchoPagina = $this->GetPageWidth();

// Calcular el ancho del cuadro
$anchoCuadro = 120; // El mismo ancho que estableces en $this->Cell(50, 5, ...);

// Calcular la posición X para centrar el cuadro en la página
$posicionX = ($anchoPagina - $anchoCuadro) / 2;

// Establecer la nueva posición X
$this->SetX($posicionX);

// Establecer el formato y dibujar el cuadro
$this->SetFont('arial', 'B', 10); 
$this->SetTextColor(255, 255, 255);
$this->SetFillColor(0, 12, 255);
$this->Cell(120, 5, utf8_decode("Soluciones IV"), 1, 0, 'C', 1);

$this->Ln(5);
$this->SetFont('arial', 'B', 8);
     $this->SetTextColor(255, 255, 255);
     $this->SetFillColor(254, 26, 26);
     
// Nombres de las columnas
$nombresColumnas = ["SOLUCIÓN", "FECHA", "CANT.", "GOT.", "FREC.", "INICIA.", "TERM."];
$this->SetX($posicionX);
// Imprimir nombres de las columnas
foreach ($nombresColumnas as $nombre) {
    $this->Cell(17.14, 5, utf8_decode($nombre), 1, 0, 'C', 1);
}

// Salto de línea para la primera fila
$this->Ln();

// Imprimir filas en blanco
for ($i = 1; $i <= 3; $i++) {
    $this->SetX($posicionX);
    // Imprimir celdas en blanco para cada columna
    foreach ($nombresColumnas as $nombre) {
      
        $this->Cell(17.14, 5, utf8_decode(''), 1, 0, 'C');
    }
    // Salto de línea para la siguiente fila en blanco
    $this->Ln();
}


//----------------------- Empieza Curación (Descripción de Procedimiento) ----------------------------------------------------------
$this->Ln(4);
$this->SetFont('arial', '', 8,); 
$this->SetTextColor(0,0,0);
$this->SetFillColor(255, 255, 255);
$this->SetDrawColor(255, 255, 255);

$this->SetX($this->GetX() + 18);
$this->Cell(40, 5, utf8_decode("Curación (Descripción del procedimiento)"), 1, 0, 'R', 1);

$this->Ln(5);
$this->SetFont('arial', '', 10);
$this->SetTextColor(0, 0, 0);
$this->SetFillColor(255, 255, 255);
$this->SetDrawColor(254, 26, 26);
$this->MultiCell(185, 30, utf8_decode(' '), 1, 'L'); // Cuadro de texto, puedes cambiar el tamaño aquí


//----------------------- Empieza Medicamentos (Sustancias activa, mg o gr, via de aplicacion) ----------------------------------------------------------

$this->Ln(3);
$this->SetFont('arial', 'b', 8,); 
$this->SetTextColor(255, 255, 255);
$this->SetFillColor(36, 29, 255);
$this->SetDrawColor(0, 0, 0);
$this->Cell(185, 5, utf8_decode("MEDICAMENTOS (SUSTENCIAS ACTIV, MG O GR VIA DE APLICACION)"), 1, 0, 'C', 1);

$this->Ln(5);
$this->SetFont('arial', 'b', 8,); 
$this->SetTextColor(255, 255, 255);
$this->SetFillColor(254, 26, 26);
$this->SetDrawColor(0, 0, 0);
// Nombres de las columnas
$nombresColumnas = ["MEDICAMENTOS:", "HORARIO:", "MEDICAMENTOS:", "HORARIO:"];

// Imprimir nombres de las columnas en una fila
foreach ($nombresColumnas as $nombre) {
    if (strpos($nombre, "MEDICAMENTOS") !== false) {
        $this->Cell(67.5, 5, utf8_decode($nombre), 1, 0, 'C', 1);
    } else {
        $this->Cell(25, 5, utf8_decode($nombre), 1, 0, 'C', 1);
    }
}

// Salto de línea para la primera fila
$this->Ln();

// Imprimir filas en blanco
for ($i = 1; $i <= 11; $i++) {
    // Imprimir celdas en blanco para cada columna
    foreach ($nombresColumnas as $nombre) {
        if (strpos($nombre, "MEDICAMENTOS") !== false) {
            $this->Cell(67.5, 4, utf8_decode(''), 1, 0, 'C');
        } else {
            $this->Cell(25, 4, utf8_decode(''), 1, 0, 'C');
        }
    }
    // Salto de línea para la siguiente fila en blanco
    $this->Ln();
}
//----------------------- Nota de enfermería (día) ----------------------------------------------------------

$this->Ln(4);
$this->SetFont('arial', 'B', 6,); 
$this->SetTextColor(0,0,0);
$this->SetFillColor(255, 255, 255);
$this->SetDrawColor(255, 255, 255);

$this->SetX($this->GetX() + 0);
$this->Cell(40, 5, utf8_decode("NOTA DE ENFERMERIA (DÍA)"), 1, 0, 'R', 1);

$this->Ln(5);
$this->SetFont('arial', '', 10);
$this->SetTextColor(0, 0, 0);
$this->SetFillColor(255, 255, 255);
$this->SetDrawColor(254, 26, 26);
$this->MultiCell(185, 30, utf8_decode(' '), 1, 'L'); // Cuadro de texto, puedes cambiar el tamaño aquí

//----------------------- Nota de enfermería (noche) ----------------------------------------------------------

$this->Ln(4);
$this->SetFont('arial', 'B', 6,); 
$this->SetTextColor(0,0,0);
$this->SetFillColor(255, 255, 255);
$this->SetDrawColor(255, 255, 255);

$this->SetX($this->GetX() + 0);
$this->Cell(40, 5, utf8_decode("NOTA DE ENFERMERIA (NOCHE)"), 1, 0, 'R', 1);

$this->Ln(5);
$this->SetFont('arial', '', 10);
$this->SetTextColor(0, 0, 0);
$this->SetFillColor(255, 255, 255);
$this->SetDrawColor(254, 26, 26);
$this->MultiCell(185, 30, utf8_decode(' '), 1, 'L'); // Cuadro de texto, puedes cambiar el tamaño aquí

//----------------------- Empieza tabla alimentos -----------------------------------------------------------------------------------------------


$this->Ln(3);
$this->SetFont('arial', 'B', 12); 
$this->SetTextColor(255, 255, 255);
$this->SetFillColor(254, 26, 26);
$this->SetDrawColor(0, 0, 0);
$this->Cell(185, 5, utf8_decode("ALIMENTOS"), 1, 0, 'C', 1);

$this->Ln(5);
$this->SetFont('arial', '', 8); 
$this->SetTextColor(0, 0, 0);
$this->SetFillColor(254, 26, 26);
$this->SetDrawColor(0, 0, 0);

// Nombres de las columnas
$nombresColumnas = ["DESAYUNO (HORARIO)", "DESAYUNO (HORARIO)", "DESAYUNO (HORARIO)", "OTROS:"];

// Imprimir nombres de columnas
foreach ($nombresColumnas as $nombre) {
    $this->Cell(40, 10, utf8_decode($nombre), 1, 0, 'C', 1);
}

$this->Ln(); // Salto de línea después de la primera fila

// Imprimir fila en blanco
foreach ($nombresColumnas as $nombre) {
    $this->Cell(40, 10, utf8_decode(''), 1, 0, 'C');
}

$this->Ln(); // Salto de línea después de la segunda fila








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