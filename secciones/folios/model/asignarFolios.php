<?php

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        session_start();
        include("../../../templates/header.php");
        include("../../../connection/conexion.php");
        include("../../../model/puestos.php");

        if (!isset($_POST['folios'])) {
            throw new Exception(':D');
        }
        $folios = $_POST['folios'];
?>
        <link rel="stylesheet" href="../css/checks.css">
        <link rel="stylesheet" href="../css/cajaMostrar.css">
        <main class="main" id="main">

            <div class="card card-form">
                <div class="card-header">
                    <h4>Folios solicitados</h4>
                </div>
                <div class="card-body">
                    <form action="guardarAsignacion.php" method="post">
                        <br>
                        <div class="row">
                            <div class="contenido col-md-6">
                                <label for="asigna">Nombre de quien asigna</label>
                                <input type="hidden" value="<?php echo $_SESSION['idus'] ?>" name="idus" id="asigna">
                                <input type="text" value="<?php echo $_SESSION['us'] ?>" name="asigna" id="asigna" readonly>
                            </div>
                            <div class="contenido col-md-6">
                                <label for="departamento">Departamento dirigido</label>
                                <select name="departamento" id="departamento">
                                    <option value="" selected disabled>Selecciona una opcion</option>
                                    <?php
                                    // no detectó el array key del $puesto['id_puesto']; si pueden revisarlo se los agradecere.
                                    foreach ($datos as $puesto => $key) {
                                        if ($puesto >= 3 && $puesto <= 5) {
                                            echo ' <option value="' . $id = $puesto + 1 . '">' . $key['Nombre_puestos'] . '</option> ';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <br>
                            <div class="contenido col-md-6">
                                <label for="usuario">Usuario dirigido</label>
                                <select name="usuario" id="usuario">
                                    <option value="" selected disabled>Esperando departamento</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="contenido col_md_12">
                            <label for="descripcion">Descripcion</label>
                            <input name="descripcion" id="descripcion" type="text" placeholder="descripcion" required maxlength="50">
                        </div>
                        <br>
                        <div class="col-md-12">
                            <div class="boxFolios">
                                <p>Caracteristicas del los folios seleccionados</p>
                                <p>
                                    <?php
                                    echo '<b>Administradora:</b> "' . $_POST['administradora'] . '"<br> <b>Banco:</b> "' . $_POST['bancos'] . '"<br> <b>Tipo de folio:</b> "' . $_POST['tipo'] . '"<br> <b>Cantidad:</b> "' . $_POST['cant'] . '".<br>';
                                    ?>
                                </p>
                                <?php
                                $separar = 0;
                                foreach ($folios as $value) {
                                    $sql = "SELECT * FROM folios where id_folio = :id";
                                    $buscar = $con->prepare($sql);
                                    $buscar->bindParam(':id', $value);
                                    $buscar->execute();
                                    $respuesta = $buscar->rowCount();
                                    if ($respuesta > 0) {
                                        $fol = $buscar->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($fol as $folioSelect) {
                                            $separar++;
                                ?>
                                            <label for="folios"><?php echo $folioSelect['folio'] ?></label>
                                            <input type="checkbox" name="folios[]" id="" value="<?php echo $folioSelect['id_folio'] ?>" checked>
                                <?php
                                            if ($separar >= 5) {
                                                echo "<br>";
                                                $separar = 0;
                                            }
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-outline-info">enviar</button>
                        <button onclick="" class="btn btn-outline-danger">cancelar</button>
                    </form>
                </div>
            </div>
            <script src="../js/cargaUsuCord.js"></script>
        <?php
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
    ?>
    </div>
        </main>