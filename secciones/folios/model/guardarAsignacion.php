<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('../../../connection/conexion.php');
    include('../../../templates/hea.php');
    $folios = $_POST['folios'];
    $idus = $_POST['idus'];
    $usuario = $_POST['usuario'];
    $departamento = $_POST['departamento'];
    $descripcion = $_POST['descripcion'];
    $tipo = 2;
    for ($i = 0; $i < count($folios); $i++) {
        $sql = "UPDATE folios SET estado = 1 WHERE id_folio = :id";
        $actualizar = $con->prepare($sql);
        $actualizar->bindParam(':id', $folios[$i]);
        $actualizar->execute();
        $sql = "INSERT INTO historial_folios (id_folio, id_usuario, tipoMovimiento, descripcion, fecha) VALUES (:id, :id_usuario, :tipoMovimiento, UPPER(:descripcion), NOW())";
        $cargar = $con->prepare($sql);
        $cargar->bindParam(':id', $folios[$i]);
        $cargar->bindParam(':id_usuario', $usuario);
        $cargar->bindParam(':tipoMovimiento', $tipo);
        $cargar->bindParam(':descripcion', $descripcion);
        $cargar->execute();
        echo "folio: " . $folios[$i] . " persona a quien se le asigna: " . $usuario . " persona que asigno: " . $idus . " num de departamento: " . $departamento . " descripcion: " . $descripcion . "<br>";
    }

?>
    <script>
        swal.fire({
            icon: 'info',
            title: 'carga completada',
            text: 'los folios fueron asignados correctamente'
        }).then(() => {
            window.location = "../index.php";
        })
    </script>
<?php
}
