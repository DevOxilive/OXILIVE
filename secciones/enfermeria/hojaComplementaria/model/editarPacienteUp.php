<?php
include("../../../../connection/conexion.php");
include("../../../../templates/hea.php");


if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia = $con->prepare("
    SELECT pa.*, col.id AS colonia_id, col.nombre AS colonia, m.nombre AS municipio, e.nombre AS estadoDir, codigo_postal,bc.id_bancos, bc.Nombre_banco, ad.Nombre_administradora
    FROM pacientes_call_center pa, colonias col, bancos bc, administradora ad, municipios m, estados e
    WHERE pa.colonia = col.id
    AND col.municipio = m.id
    AND m.estado = e.id
    AND pa.bancosAdmi = bc.id_bancos
    AND bc.admi = ad.id_administradora
    AND pa.id_pacientes = :id_pacientes
    ");
    $sentencia->bindParam(":id_pacientes", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_ASSOC);
    $nombres = $registro["nombres"];
    $apellidos = $registro["apellidos"];
    $genero = $registro["genero"];
    $edad = $registro["edad"];
    $telUno = $registro["telefono"];
    $telDos = $registro["telefonoDos"];
    $codigo_postal = $registro["codigo_postal"];
    $coloniaId = $registro["colonia_id"];
    $colonia = $registro["colonia"];
    $municipio = $registro["municipio"];
    $estado = $registro["estadoDir"];
    $calle = $registro["calle"];
    $num_ext = $registro["num_ext"];
    $num_int = $registro["num_int"];
    $referencias = $registro["referencias"];
    $comprobante = $registro["comprobante"];
    $Credencial_front = $registro["Credencial_front"];
    $Credencial_post = $registro["Credencial_post"];
    $Credencial_aseguradora = $registro["Credencial_aseguradora"];
    $Credencial_aseguradoras_post = $registro["Credencial_aseguradoras_post"];
    $responsable = $registro["responsable"];
    $No_nomina = $registro["No_nomina"];
    $rfc = $registro["rfc"];
    $banco = $registro["id_bancos"];
    $admin = $registro["Nombre_administradora"];
}
if ($_POST) {
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $nombres = (isset($_POST["nombre"]) ? $_POST["nombre"] : "");
    $apellidos = (isset($_POST["apellidos"]) ? $_POST["apellidos"] : "");
    $rfc = (isset($_POST["rfc"]) ? $_POST["rfc"] : "");
    $genero = (isset($_POST["genero"]) ? $_POST["genero"] : "");
    $edad = (isset($_POST["edad"]) ? $_POST["edad"] : "");
    $telUno = (isset($_POST["telUno"]) ? $_POST["telUno"] : "");
    $telDos = (isset($_POST["telDos"]) ? $_POST["telDos"] : null);
    $codigo_postal = isset($_POST['codigo_postal']) ? $_POST['codigo_postal'] : "";
    $colonia = isset($_POST['colonia']) ? $_POST['colonia'] : "";
    $calle = isset($_POST['calle']) ? $_POST['calle'] : "";
    $num_ext = isset($_POST['numExt']) ? $_POST['numExt'] : "";
    $num_int = isset($_POST['numInt']) ? $_POST['numInt'] : NULL;
    $referencias = isset($_POST['referencias']) ? $_POST['referencias'] : NULL;
    $comprobante = isset($_POST['comprobante']) ? $_POST['comprobante'] : "";
    $Credencial_front = isset($_POST['Credencial_front']) ? $_POST['Credencial_front'] : "";
    $Credencial_post = isset($_POST['Credencial_post']) ? $_POST['Credencial_post'] : "";
    $Credencial_aseguradora = isset($_POST['Credencial_aseguradora']) ? $_POST['Credencial_aseguradora'] : "";
    $Credencial_aseguradoras_post = isset($_POST['Credencial_aseguradoras_post']) ? $_POST['Credencial_aseguradoras_post'] : "";
    $responsable = isset($_POST['responsable']) ? $_POST['responsable'] : NULL;
    $No_nomina = isset($_POST['No_nomina']) ? $_POST['No_nomina'] : "";
    $rfc = isset($_POST['rfc']) ? $_POST['rfc'] : "";
    $banco = isset($_POST['banco']) ? $_POST['banco'] : "";

    if (!empty($_FILES['comprobante']['name'])) {
        $nombreArchivoComprobante = $_FILES['comprobante']['name'];
        $rutaArchivoComprobante = "../directorio_comprobante/" . $nombreArchivoComprobante;
        if (move_uploaded_file($_FILES['comprobante']['tmp_name'], $rutaArchivoComprobante)) {
            $comprobante = $nombreArchivoComprobante;
        } else {
            echo "Error al guardar el comprobante.";
        }
    } else {
        $comprobante = $comprobanteA;
    }
    

    
    if (!empty($_FILES['Credencial_front']['name'])) {
        // Procesa la subida del nuevo Credencial INE Frontal aquí y actualiza la variable $Credencial_front con la nueva ruta.
        $nombreArchivoFront = $_FILES['Credencial_front']['name'];
        $rutaArchivoFront = "../directorio_INES/" . $nombreArchivoFront;
        move_uploaded_file($_FILES['Credencial_front']['tmp_name'], $rutaArchivoFront);
        $Credencial_front = $nombreArchivoFront;
    }
    // Repite el mismo proceso para la Credencial INE Posterior.
    if (!empty($_FILES['Credencial_post']['name'])) {
        // Procesa la subida del nuevo Credencial INE Posterior aquí y actualiza la variable $Credencial_post con la nueva ruta.
        $nombreArchivoPost = $_FILES['Credencial_post']['name'];
        $rutaArchivoPost = "../directorio_INES/" . $nombreArchivoPost;
        move_uploaded_file($_FILES['Credencial_post']['tmp_name'], $rutaArchivoPost);
        $Credencial_post = $nombreArchivoPost;
    }
    if (!empty($_FILES['Credencial_aseguradora']['name'])) {
        $nombreArchivoAseguradora = $_FILES['Credencial_aseguradora']['name'];
        $rutaArchivoAseguradora = "../directorio_INES/" . $nombreArchivoAseguradora;
        move_uploaded_file($_FILES['Credencial_aseguradora']['tmp_name'], $rutaArchivoAseguradora);
        $Credencial_aseguradora = $nombreArchivoAseguradora;
    }

    // Procesa Credencial Aseguradora Posterior si se proporcionó un nuevo archivo
    if (!empty($_FILES['Credencial_aseguradoras_post']['name'])) {
        $nombreArchivoAseguradoraPost = $_FILES['Credencial_aseguradoras_post']['name'];
        $rutaArchivoAseguradoraPost = "../directorio_INES/" . $nombreArchivoAseguradoraPost;
        move_uploaded_file($_FILES['Credencial_aseguradoras_post']['tmp_name'], $rutaArchivoAseguradoraPost);
        $Credencial_aseguradoras_post = $nombreArchivoAseguradoraPost;
    }
    $sentencia = $con->prepare("UPDATE pacientes_call_center 
    SET nombres = :nom, 
    apellidos = :ape,
    genero = :genero,
    edad = :edad, 
    telefono = :telUno, 
    telefonoDos = :telDos, 
    colonia = :colonia, 
    calle = :calle, 
    num_ext = :num_ext, 
    num_int = :num_int, 
    referencias = :referencia, 
    comprobante = :comprobante,
    Credencial_front = :Credencial_front, 
    Credencial_post = :Credencial_post, 
    Credencial_aseguradora = :Credencial_aseguradora, 
    Credencial_aseguradoras_post = :Credencial_aseguradoras_post, 
    responsable = :responsable, 
    No_nomina = :No_nomina, 
    rfc = :rfc, 
    bancosAdmi = :banco WHERE id_pacientes = :id_pacientes");

    $sentencia->bindParam(":id_pacientes", $txtID);
    $sentencia->bindParam(":nom", $nombres);
    $sentencia->bindParam(":ape", $apellidos);
    $sentencia->bindParam(":genero", $genero);
    $sentencia->bindParam(":edad", $edad);
    $sentencia->bindParam(":telUno", $telUno);
    $sentencia->bindParam(":telDos", $telDos);
    $sentencia->bindParam(":colonia", $colonia);
    $sentencia->bindParam(":calle", $calle);
    $sentencia->bindParam(":num_ext", $num_ext);
    $sentencia->bindParam(":num_int", $num_int);
    $sentencia->bindParam(":referencia", $referencias);
    $sentencia->bindParam(":comprobante", $comprobante);
    $sentencia->bindParam(":Credencial_front", $Credencial_front);
    $sentencia->bindParam(":Credencial_post", $Credencial_post);
    $sentencia->bindParam(":Credencial_aseguradora", $Credencial_aseguradora);
    $sentencia->bindParam(":Credencial_aseguradoras_post", $Credencial_aseguradoras_post);
    $sentencia->bindParam(":responsable", $responsable);
    $sentencia->bindParam(":No_nomina", $No_nomina);
    $sentencia->bindParam(":rfc", $rfc);
    $sentencia->bindParam(":banco", $banco);
    $sentencia->execute();
   

    echo '<script language="javascript"> ';
    echo 'Swal.fire({
        icon: "success",
        title: "DATOS MODIFICADOS",
        showConfirmButton: false,
        timer: 1500,
    }).then(function() {
        window.location = "../index.php";
        });';
    echo '</script>';
}

?>