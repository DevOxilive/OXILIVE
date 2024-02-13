<?php
include("../../../connection/conexion.php");
include("../../../templates/hea.php");
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    session_start();
    $idus = $_SESSION['idus'];
    $tipo = $_POST["tipofolio"];
    $cuerpo = $_POST["cuerpo"];
    $banco = $_POST["banco"];
    $inicio = $_POST["inicioFolio"];
    $rango = $_POST["rangoFolio"];
    $administradora = $_POST['administradora'];
    $estado = 3;
    if ($inicio >= $rango) {
?>
        <script>
            Swal.fire({
                icon: 'info',
                title: 'ERROR',
                text: 'El valor de inicio debe ser menor al rango',
            }).then(function() {
                window.location = "../pages/entradaFolios.php";
            });
        </script>
        <?php
    } else {
        // $tamaño = strlen($rango);
        for ($i = $inicio; $i <= $rango; $i++) {
            $folio = $cuerpo . str_pad($i, 3, '0', STR_PAD_LEFT);
            $sql = "INSERT INTO folios (folio, tipo, bancoFolio, adminFolio, estado) VALUES (:folio, :tipo, :bancoFolio, :adminFolio, :estado)";
            $cargaFolio = $con->prepare($sql);
            $cargaFolio->bindParam(':folio', $folio);
            $cargaFolio->bindParam(':tipo', $tipo);
            $cargaFolio->bindParam(':bancoFolio', $banco);
            $cargaFolio->bindParam(':adminFolio', $administradora);
            $cargaFolio->bindParam(':estado', $estado);
            $cargaFolio->execute();
            $respuesta = $cargaFolio->rowCount();
            $id = $con->lastInsertId();
            if ($respuesta) {
                $respuesta2 = true;
                $mov = 1;
                $descripcion = "ENTRADA AL SISTEMA";
            } else {
                $respuesta2 = false;
                break;
            }
            $sql = "INSERT INTO historial_folios (id_folio, id_usuario, tipoMovimiento, descripcion, fecha) VALUES (:id_folio, :id_usuario, :tipoMovimiento, :descripcion, NOW())";
            $historial = $con->prepare($sql);
            $historial->bindParam(":id_folio", $id);
            $historial->bindParam(":id_usuario", $idus);
            $historial->bindParam(":tipoMovimiento", $mov);
            $historial->bindParam(":descripcion", $descripcion);
            $historial->execute();
        }
        if ($respuesta2) {

        ?><script>
                Swal.fire({
                    icon: 'info',
                    title: 'listo',
                    text: 'carga de folios lista',
                }).then(() => {
                    window.location = "../index.php";
                });
            </script><?php
                    }
                }
            } else {
                echo "las cosas como son jaja XD lo más rico de las cosas";
            }
                        ?>