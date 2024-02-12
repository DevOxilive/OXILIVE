<?php
include("../../../connection/conexion.php");
include("../../../templates/hea.php");

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    echo $tipo = $_POST["tipofolio"];
    echo $cuerpo = $_POST["cuerpo"];
    echo $id_banco = $_POST["banco"];
    echo $inicio = $_POST["inicioFolio"];
    echo $rango = $_POST["rangoFolio"];
    echo "<br>";


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

        echo "<br>";
        echo "cuerpo del folio: $cuerpo, inicio del folio: $inicio, termino del folio: $rango, banco asociado: $id_banco, tipo de folio: $tipo <br>";


        for($i = $inicio; $i <= $rango; $i++){
            $folio = $cuerpo . str_pad($i, 3, '0', STR_PAD_LEFT);
            echo $folio . "<br>";
            $sql = "INSERT INTO folios (folio, tipo, id_banco, estatus) VALUES ('$folio', '$tipo', $id_banco, 1)";
            $folio = $con->prepare($sql);
            $folio->execute();
            $respuesta = $folio->rowCount();
            if($respuesta){
               echo "true";
               $respuesta2 = true; 
            } else {
                echo 'false';
                break;
            }
        } 
        if ($respuesta2) {
            ?>
        <script>
            Swal.fire({
                icon: 'info',
                title: 'listo',
                text: 'carga de folios lista',
            });
        </script>
<?php
        }
    }
} else {
    echo "las cosas como son jaja XD lo más rico de las cosas";
}
?>