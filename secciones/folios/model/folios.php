<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include('../../../connection/conexion.php');
    $sql = "SELECT * FROM folios";
    $rev = $con->prepare($sql);
    $rev->execute();
    $tot = $rev->rowCount();

    $sql = 'SELECT * FROM folios 
    WHERE bancoFolio = "' . $_POST['bancos'] . '" 
    AND adminFolio = "' . $_POST['administradora'] . '" 
    AND tipo = "' . $_POST['tipo'] . '"
    AND estado = 3;';
    $buscar = $con->prepare($sql);
    $buscar->execute();
    $folioSeek = $buscar->fetchAll(PDO::FETCH_ASSOC);
    $rows = $buscar->rowCount();
    $limit = $_POST['cant'];
    $cont = 0;
    $separa = 0;
    if ($tot > 0) {
?>
        <p>Corrobora que sean los folios correctos.</p>
        <p>si deseas quitar alguno de la lista preciona en el checkbox color azul</p>
        <?php
        if ($limit > 50 || $limit < 1) {
        ?>
            <script>
                swal.fire({
                    title: '¡Recordatorio!',
                    text: "Solo puedes asignar 50 folios!",
                    icon: 'info'
                });
            </script>
            <?php
        }
        if ($limit <= $rows) {
            foreach ($folioSeek as $fol) {
                $cont++;
                if ($cont <= $limit) {
                    $separa++;
            ?>
                    <label for=""><?php echo $fol['folio'] ?></label>
                    <input type="checkbox" name="folios[]" id="" value="<?php echo $fol['id_folio'] ?>" checked>
            <?php
                    if ($separa >= 5) {
                        echo "<br>";
                        $separa = 0;
                    }
                }
            }
        } else {
            ?>
            <script>
                swal.fire({
                    title: '¡Ooups!',
                    text: "<?php echo "No hay '{$limit}': folios disponibles. solo hay: '{$rows}' folios"; ?>",
                    icon: 'info'
                });
            </script>
<?php
        }
    } else {
        echo "no hay folios en la base de datos";
    }
}
