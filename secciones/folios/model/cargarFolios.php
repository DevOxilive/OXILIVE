<?php
include("../../../connection/conexion.php");
include("../../../templates/hea.php");

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    echo $nombreFolio = $_POST["nombreFolio"];
    echo $id_folio = $_POST["idFolio"];
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
        for ($inicio; $inicio <= $rango; $inicio++, $cero = "00") {
            echo $cero . $inicio;
        }
    }
}
// $sql = "INSERT INTO folios (nombreFolio, id_banco, tipoFolio, statusFolio) VALUES ('$nombreFolio" . "$ceros" . "$i', $id_banco, 'no aplica', 'almacen')";
// $folio = $con->prepare($sql);
// $folio->execute();
?>