<?php
require('../../../fpdf/fpdf.php');
require('../../../connection/conexion.php');

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
    
 
//--------------------------------------- Empieza tabla Temperatura ---------------------------------------------------
$this->Ln(5);  
$this->SetFont('arial', 'B', 9);

// Espacio en blanco para la esquina superior izquierda
$this->Cell(30, 5, utf8_decode("Datos"), 1, 0, 'C');

// Encabezados de las columnas
$encabezados = ['De 9:00 AM a 14:00 PM', 'De 15:00 PM a 20:00 PM', 'De 21:00 PM a 02:00 AM', 'De 03:00 AM a 08:00 AM']; 

foreach ($encabezados as $encabezado) {
    $this->Cell(40, 5, utf8_decode($encabezado), 1, 0, 'C');
}

$this->Ln(5);  
$this->SetFont('arial', 'B', 9);
$this->SetTextColor(255, 255, 255);
$this->SetFillColor(254, 26, 26);
// Espacio en blanco para la esquina superior izquierda
$this->Cell(30, 5, utf8_decode("Temperatura"), 1, 0, 'C', 1);

// Encabezados de las columnas
$encabezados2 = [' ', ' ', '', ''];

foreach ($encabezados2 as $encabezado2) {
    $this->Cell(40, 5, utf8_decode($encabezado2), 1, 0, 'C');
}

$this->Ln(5);  
$this->SetFont('arial', 'B', 9);
$this->SetTextColor(255, 255, 255);
$this->SetFillColor(0, 12, 255);
// Espacio en blanco para la esquina superior izquierda
$this->Cell(30, 5, utf8_decode("Pulso"), 1, 0, 'C', 1);

// Encabezados de las columnas
$encabezados2 = [' ', ' ', '', ''];

foreach ($encabezados2 as $encabezado2) {
    $this->Cell(40, 5, utf8_decode($encabezado2), 1, 0, 'C');
}

$this->Ln();

//-------------------------------- Empieza tabla Respiracion, Tensión Arteria, Etc. -------------------------------
    
$this->Ln(4);
     $this->SetFont('arial', 'B', );
     
     $this->Cell(30, 5, utf8_decode(""), 0, 0, 'C');
     $this->SetTextColor(0, 0, 0);
     $this->SetFillColor(255, 255, 255);
     
     // Datos de las columnas
     $nombresColumnas = [
        ' ', ' ', '', ''];
     
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
$this->MultiCell(140, 24, utf8_decode(''), 1, 'L'); // Cuadro de texto, puedes cambiar el tamaño aquí


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
$this->SetTextColor(255, 255, 255);
$this->SetFillColor(254, 26, 26);
$this->SetDrawColor(0, 0, 0);

// Nombres de las columnas
$nombresColumnas = ["DESAYUNO (HORARIO)", "DESAYUNO (HORARIO)", "DESAYUNO (HORARIO)"];

// Imprimir nombres de columnas
foreach ($nombresColumnas as $nombre) {
    $this->Cell(61.64, 5, utf8_decode($nombre), 1, 0, 'C', 1);
}

$this->Ln(); // Salto de línea después de la primera fila

// Imprimir fila en blanco
foreach ($nombresColumnas as $nombre) {
    $this->Cell(61.64, 35, utf8_decode(''), 1, 0, 'C');
}
$this->Ln(); // Salto de línea después de la segunda fila
 }
}
//Instanciar funcionaes 
$pdf = new PDF();
$pdf-> AliasNbPages();
$pdf->AddPage();
require '../../../connection/conexion.php';
    $btnI = (isset($_GET['btnId'])) ? $_GET['btnId'] : "";
    $lista = $con->prepare("SELECT rc.*,a.id_asignacionHorarios,
    CONCAT(p.nombres, ' ', p.apellidos) AS 'paciente',
    t.nombreServicio,
    p.responsable,
    p.edad,
    gr.genero,
    CONCAT(u.Nombres, ' ', u.Apellidos) AS 'enfermero',
    CONCAT(u2.Nombres, ' ', u2.Apellidos) AS 'medico', u.id_usuarios 
FROM registro_clinico rc , pacientes_call_center p
INNER JOIN asignacion_horarios a ON p.id_pacientes = a.id_pacienteEnfermeria
INNER JOIN tipos_servicios t ON t.id_tipoServicio = a.id_tipoServicio
INNER JOIN usuarios u ON u.id_usuarios = a.id_usuario
INNER JOIN asignacion_servicio a2 ON a2.num_paciente = p.id_pacientes
INNER JOIN usuarios u2 ON u2.id_usuarios = a2.num_medico 
INNER JOIN genero gr ON gr.id_genero = p.genero WHERE id_RC = :id_rc LIMIT 1 ");
    $lista->bindParam(":id_rc",$btnI);
    $lista->execute();
    // $pdf->SetFont('Arial','B',10);
    while($listaPapus = $lista->fetch(PDO::FETCH_ASSOC)){
        $pdf->SetXY(20,75);
        $pdf->Cell(75, -62, ''.($listaPapus['paciente']),0, 0, 'R', 0);
        $pdf->SetXY(115,75);
        $pdf->Cell(75, -62, ''.($listaPapus['nombreServicio']),0, 0, 'R', 0);
        $pdf->SetXY(20,75);
        $pdf->Cell(61, -45, ''.($listaPapus['responsable']),0, 0, 'R', 0);
        $pdf->SetXY(20,75);
        $pdf->Cell(126, -46, ''.($listaPapus['edad']),0, 0, 'R', 0);
        $pdf->SetXY(20,75);
        $pdf->Cell(41, -30, ''.($listaPapus['medico']),0, 0, 'R', 0);
        $pdf->SetXY(20,75);
        $pdf->Cell(143, -30, ''.($listaPapus['genero']),0, 0, 'R', 0);
        $pdf->SetXY(20,75);
        $pdf->Cell(47, -14, ''.($listaPapus['diagnoticoPaciente']),0, 0, 'R', 0);
        $pdf->SetXY(20,75);
        $pdf->Cell(125, -14, ''.($listaPapus['peso']),0, 0, 'R', 0);
        $pdf->SetXY(20,75);
        $pdf->Cell(45, 25, ''.($listaPapus['temperatura']),0, 0, 'R', 0);
        $pdf->SetXY(20,75);
        $pdf->Cell(45, 35, ''.($listaPapus['pulso']),0, 0, 'R', 0);
        $pdf->SetXY(20,75);
        $pdf->Cell(45, 64, ''.($listaPapus['respiracion']),0, 0, 'R', 0);
        $pdf->SetXY(20,75);
        $pdf->Cell(45, 74, ''.($listaPapus['tensionArterial']),0, 0, 'R', 0);
        $pdf->SetXY(20,75);
        $pdf->Cell(45, 84, ''.($listaPapus['spo2']),0, 0, 'R', 0);
        $pdf->SetXY(20,75);
        $pdf->Cell(45, 93, ''.($listaPapus['glicemiaCapilar']),0, 0, 'R', 0);
        $pdf->SetXY(20,75);
        $pdf->Cell(28, 118, ''.($listaPapus['vomitos']),0, 0, 'R', 0);
        $pdf->SetXY(20,75);
        $pdf->Cell(28, 127, ''.($listaPapus['evacuaciones']),0, 0, 'R', 0);
        $pdf->SetXY(20,75);
        
        $pdf->Cell(28, 137, ''.($listaPapus['orina']),0, 0, 'R', 0);
        $pdf->SetXY(20,75);
        $pdf->Cell(28, 147, ''.($listaPapus['ingestaLiquidos']),0, 0, 'R', 0);
        $pdf->SetXY(20,75);
        $pdf->Cell(28, 157, ''.($listaPapus['caidas']),0, 0, 'R', 0);
        $pdf->SetXY(20,75);
        $pdf->Cell(28, 167, ''.($listaPapus['drenajesVendajes']),0, 0, 'R', 0);
        $pdf->SetXY(20,75);
        $pdf->Cell(36, 186, ''.($listaPapus['uppHh']),0, 0, 'R', 0);
        // SOLUCIONES
        $descripcionUpp = $listaPapus['descripcionUpp'];
        // Dividir el texto después de 45 palabras
        // $descripcionUppDividido = wordwrap($descripcionUpp, 45, "\n", true);
        // $pdf->Cell(138, 200, ($descripcionUppDividido), 0, 0, 'R', 0);
        
        // $pdf->SetXY(20,75);
        // $pdf->Cell(75, 205, ''.utf8_decode($listaPapus['solucion']),0, 0, 'R', 0);
}
        $header = [];
        // Datos de la tabla (5 columnas)
        $data = [];    
        $pdf->CreateTable($header, $data);
        // Cabecera de la tabla
        $pdf->Output();
    

?>