<?php

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        include("../../../connection/conexion.php");

        if (!isset($_POST['folios'])) {
            throw new Exception(':D');
        }
        $folios = $_POST['folios'];
?>
        <h5>folios solicitados</h5>
    <?php
        foreach ($folios as $value) {
            $sql = "SELECT * FROM folios where id_folio = :id";
            $buscar = $con->prepare($sql);
            $buscar->bindParam(':id', $value);
            $buscar->execute();
            $respuesta = $buscar->rowCount();
            if ($respuesta > 0) {
                $fol = $buscar->fetchAll(PDO::FETCH_ASSOC);
                foreach ($fol as $folioSelect) {
                    echo "folios: seleccionado: {$folioSelect['folio']} <br>";
                }
            }
        }
        echo 'Administradora: ' . $_POST['administradora'] . " Banco: " . $_POST['bancos'] . " Tipo de folio: " . $_POST['tipo'] . "<br>";
    }
} catch (Exception $e) {
    ?>
    <script>
        swal.fire({
            icon: 'info',
            title: 'Folios no seleccionados!',
            text: 'Faltan campos por seleccionar.'
        });
    </script>
<?php
}
