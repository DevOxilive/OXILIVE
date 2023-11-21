<?php
include("../../../../connection/conexion.php");
include_once '../../../../templates/hea.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombres = isset($_POST['nombre']) ? $_POST['nombre'] : ""; 
    $apellido = isset($_POST['apellidos']) ? $_POST['apellidos'] : "";
    $genero = isset($_POST['genero']) ? $_POST['genero'] : "";
    $edad = isset($_POST['edad']) ? $_POST['edad'] : "";
    $telUno = isset($_POST['telUno']) ? $_POST['telUno'] : "";
    $telDos = isset($_POST['telDos']) ? $_POST['telDos'] : NULL;
    $colonia = isset($_POST['colonia']) ? $_POST['colonia'] : "";
    $calle = isset($_POST['calle']) ? $_POST['calle'] : ""; 
    $num_ext = isset($_POST['numExt']) ? $_POST['numExt'] : "";
    $num_int = isset($_POST['numInt']) ? $_POST['numInt'] : NULL;
    $referencias = isset($_POST['referencias']) ? $_POST['referencias'] : NULL;
    $responsable = isset($_POST['responsable']) ? $_POST['responsable'] : NULL;
    $No_nomina = isset($_POST['No_nomina']) ? $_POST['No_nomina'] : "";
    $rfc = isset($_POST['rfc']) ? $_POST['rfc'] : "";
    $banco = isset($_POST['banco']) ? $_POST['banco'] : "";

    $consultaDuplicados = $con->prepare("SELECT COUNT(*) FROM pacientes_call_center WHERE No_nomina = :No_nomina");
    $consultaDuplicados->bindParam(":No_nomina", $No_nomina);
    $consultaDuplicados->execute();
    $cantidadDuplicados = $consultaDuplicados->fetchColumn();
    if ($cantidadDuplicados > 0) {
        echo '<script language="javascript"> ';
        echo 'Swal.fire({
                icon: "warning",
                title: "DUPLICADO",
                text: "NOMINA YA EXISTE CON UN PACIENTE",
                showConfirmButton: false,
                timer: 2000,
            }).then(function() {
                window.location = "../buscador.php";
                });';
        echo '</script>';
        exit;
            }else{

    // Comprobar si se ha subido un archivo de comprobante
    if (isset($_FILES['comprobante']) && $_FILES['comprobante']['error'] === UPLOAD_ERR_OK) {
        $temporal_Comprobante = $_FILES['comprobante']['tmp_name'];
        $comprobante = $_FILES['comprobante']['name'];
        $ruta_destino = '../directorio_comprobante/' . $comprobante;

        if (move_uploaded_file($temporal_Comprobante, $ruta_destino)) {
            // Comprobar si se ha subido un archivo de Credencial_front
            if (isset($_FILES['Credencial_front']) && $_FILES['Credencial_front']['error'] === UPLOAD_ERR_OK) {
                $temporal_Credencial_front = $_FILES['Credencial_front']['tmp_name'];
                $Credencial_front = $_FILES['Credencial_front']['name'];
                $directorio_INES = '../directorio_INES/' . $Credencial_front;

                if (move_uploaded_file($temporal_Credencial_front, $directorio_INES)) {
                    // Comprobar si se ha subido un archivo de Credencial_post
                    if (isset($_FILES['Credencial_post']) && $_FILES['Credencial_post']['error'] === UPLOAD_ERR_OK) {
                        $temporal_Credencial_post = $_FILES['Credencial_post']['tmp_name'];
                        $Credencial_post = $_FILES['Credencial_post']['name'];
                        $directorio_INES = '../directorio_INES/' . $Credencial_post;

                        if (move_uploaded_file($temporal_Credencial_post, $directorio_INES)) {
                            // Comprobar si se ha subido un archivo de Credencial_aseguradora
                            if (isset($_FILES['Credencial_aseguradora']) && $_FILES['Credencial_aseguradora']['error'] === UPLOAD_ERR_OK) {
                                $temporal_Credencial_aseguradora = $_FILES['Credencial_aseguradora']['tmp_name'];
                                $Credencial_aseguradora = $_FILES['Credencial_aseguradora']['name'];
                                $directorio_INES = '../directorio_INES/' . $Credencial_aseguradora;

                                if (move_uploaded_file($temporal_Credencial_aseguradora, $directorio_INES)) {
                                    // Comprobar si se ha subido un archivo de Credencial_aseguradoras_post
                                    if (isset($_FILES['Credencial_aseguradoras_post']) && $_FILES['Credencial_aseguradoras_post']['error'] === UPLOAD_ERR_OK) {
                                        $temporal_Credencial_aseguradoras_post = $_FILES['Credencial_aseguradoras_post']['tmp_name'];
                                        $Credencial_aseguradoras_post = $_FILES['Credencial_aseguradoras_post']['name'];
                                        $directorio_INES = '../directorio_INES/' . $Credencial_aseguradoras_post;

                                        if (move_uploaded_file($temporal_Credencial_aseguradoras_post, $directorio_INES)) {
                                           
                                            $consulta = $con->prepare("INSERT INTO pacientes_call_center (nombres, apellidos, genero, edad, tipoPaciente, telefono,
                                            telefonoDos, colonia, calle, num_ext, num_int, referencias, comprobante, Credencial_front, Credencial_post, Credencial_aseguradora, Credencial_aseguradoras_post, responsable, No_nomina, rfc, bancosAdmi) VALUES 
                                            (:nom, :ape, :genero, :edad, NULL, :telUno, :telDos, :colonia, :calle, :num_ext, :num_int, :referencia, :comprobante, :Credencial_front, :Credencial_post, :Credencial_aseguradora, :Credencial_aseguradoras_post, :responsable, :No_nomina, :rfc, :banco)");

                                            $consulta->bindParam(":nom", $nombres);
                                            $consulta->bindParam(":ape", $apellido);
                                            $consulta->bindParam(":genero", $genero);
                                            $consulta->bindParam(":edad", $edad);
                                            $consulta->bindParam(":telUno", $telUno);
                                            $consulta->bindParam(":telDos", $telDos);
                                            $consulta->bindParam(":colonia", $colonia);
                                            $consulta->bindParam(":calle", $calle); 
                                            $consulta->bindParam(":num_ext", $num_ext);
                                            $consulta->bindParam(":num_int", $num_int);
                                            $consulta->bindParam(":referencia", $referencias);
                                            $consulta->bindParam(":comprobante", $comprobante);
                                            $consulta->bindParam(":Credencial_front", $Credencial_front);
                                            $consulta->bindParam(":Credencial_post", $Credencial_post);
                                            $consulta->bindParam(":Credencial_aseguradora", $Credencial_aseguradora);
                                            $consulta->bindParam(":Credencial_aseguradoras_post", $Credencial_aseguradoras_post);
                                            $consulta->bindParam(":responsable", $responsable);
                                            $consulta->bindParam(":No_nomina", $No_nomina);
                                            $consulta->bindParam(":rfc", $rfc);
                                            $consulta->bindParam(":banco", $banco);

                                            $consulta->execute();

                                            echo '<script language="javascript"> ';
                                            echo 'Swal.fire({
                                                    icon: "success",
                                                    title: "PACIENTE CREADO CORRECTAMENTE",
                                                    showConfirmButton: false,
                                                    timer: 1500,
                                                }).then(function() {
                                                    window.location = "../index.php";
                                                    });';
                                            echo '</script>';
                                        } else {
                                            echo "Error al mover el archivo de Credencial_aseguradoras_post.";
                                        }
                                    } else {
                                        echo "No se seleccionó un archivo de Credencial_aseguradoras_post o hubo un error al cargarlo.";
                                    }
                                } else {
                                    echo "Error al mover el archivo de Credencial_aseguradora.";
                                }
                            } else {
                                echo "No se seleccionó un archivo de Credencial_aseguradora o hubo un error al cargarlo.";
                            }
                        } else {
                            echo "Error al mover el archivo de Credencial_post.";
                        }
                    } else {
                        echo "No se seleccionó un archivo de Credencial_post o hubo un error al cargarlo.";
                    }
                } else {
                    echo "Error al mover el archivo de Credencial_front.";
                }
            } else {
                echo "No se seleccionó un archivo de Credencial_front o hubo un error al cargarlo.";
            }
        } else {
            echo "Error al mover el archivo de comprobante.";
        }
    } else {
        echo '<script language="javascript"> ';
                                            echo 'Swal.fire({
                                                    icon: "warning",
                                                    title: "FALTO SELECCIONAR COMPROBANTE",
                                                    showConfirmButton: false,
                                                    timer: 1500,
                                                }).then(function() {
                                                    window.location = "../crear/crearPaciente.php";
                                                    });';
                                            echo '</script>';
    }
}
}
?>
