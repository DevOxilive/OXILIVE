<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
?>
    <div class="boxFolios">
        <?php
        include('../../../connection/conexion.php');
        $sql = "SELECT * FROM folios";
        $revisar = $con->prepare($sql);
        $revisar->execute();
        $tot = $revisar->rowCount();
        // valida si hay folios en la base de datos
        if ($tot > 0) {
            // valida si estan los campos vacios
            if ($_POST['bancos'] == "" || $_POST['administradora'] == "" || $_POST['tipo'] == "" || $_POST['cant'] == "") {
        ?>
                <p id="busc">buscando folios...</p>
            <?php
            }
            // revisa el rango de folios maximo por asignar
            if ($_POST['cant'] <= 50) {
                // comienza a cargar los datos
                $bancos = $_POST['bancos'];
                $administradora = $_POST['administradora'];
                $tipo = $_POST['tipo'];
                $limit = $_POST['cant'];
            ?>
                <div class="row mx-4">
                    <div class="col-md-6">
                        <b>Caracteristicas del folio(s)</b> solicitado: <br>

                        <?php
                        echo "Banco: " . $bancos . "<br>";
                        echo "Administradora: " . $administradora . "<br>";
                        echo "Tipo: " . $tipo . "<br>";
                        echo "Cantidad: " . $limit . "<br>";
                        ?>
                    </div>
                    <div class="col-md-6 ms-6">
                        <?php
                        if ($bancos == "" || $administradora == "" || $tipo == "" || $limit == "") {
                            echo "faltan campos por seleccionar";
                        } else {
                            $sql = 'SELECT * FROM folios 
                    WHERE bancoFolio = :bancoFolio
                    AND adminFolio = :adminFolio
                    AND tipo = :tipo
                    AND estado = 3';
                            $buscar = $con->prepare($sql);
                            $buscar->bindParam(':bancoFolio', $bancos);
                            $buscar->bindParam(':adminFolio', $administradora);
                            $buscar->bindParam(':tipo', $tipo);
                            $buscar->execute();
                            $folioSeek = $buscar->fetchAll(PDO::FETCH_ASSOC);
                            $rows = $buscar->rowCount();

                            $cont = 0;
                            $separar = 0;
                            if (count($folioSeek) > 0) {
                                if ($limit <= $rows) {
                                    foreach ($folioSeek as $fol) {
                                        $cont++;
                                        if ($cont <= $limit) {
                                            $separar++;
                        ?>
                                            <label for="folios"><?php echo $fol['folio'] ?></label>
                                            <input type="checkbox" name="folios[]" id="" value="<?php echo $fol['id_folio'] ?>" checked>
                                    <?php
                                            if ($separar >= 5) {
                                                echo "<br>";
                                                $separar = 0;
                                            }
                                        }
                                    }
                                    ?>
                    </div>
                </div>
            <?php
                                } else {
            ?>
                <script>
                    swal.fire({
                        title: '¡Ooups!',
                        text: "<?php echo "No hay '{$limit}': folios disponibles. Hay: '{$rows}' folios disponibles."; ?>",
                        icon: 'info'
                    });
                </script>
            <?php
                                }
                            } else {
            ?>
            <script>
                swal.fire({
                    title: '¡Ooups!',
                    text: "<?php echo "No hay folios disponibles para el banco: {$bancos} y administradora: {$administradora}."; ?>",
                    icon: 'info'
                });
            </script>
    <?php
                            }
                        }
                    } else {
    ?>
    <script>
        swal.fire({
            icon: 'info',
            title: 'Recordatorio!',
            text: 'solo se pueden enviar un maximo de 50 folios.'
        });
    </script>
<?php
                        echo "Disminulle la cantidad de folios solicitados a un maximo de 50!.";
                    }
                } else {
?>
<h4>No hay folios registrados en el sistema</h4>
<?php
                }
            }
