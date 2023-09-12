<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("../../../connection/conexion.php");
    include_once("../chat/action/cargas.php");
    include_once("action/cargas.php");
} else {
    // esto queda pediente para mostrar una mejor vista al usuario y no se confunca sobre esto...
    echo "Error en el sistema";
}

$puesto = $_SESSION['puesto'];

?>
<!-- contenido general pagina vista del chat general -->

<main id="main" class="main">
    ENFERMERIA
    <center>
        <h1>proximamente <b>Chat</b> en construccion agregando websockets</h1>
    </center>
    <br>
    <div class="row">
        <div class="card">
            <div class="card-header">
                <a class="btn btn-outline-primary" href="../../../index.php" role="button">regresar al inicio</a> <!-- <i class="bi bi-person-fill"></i> -->
            </div>
            <div class="card-header" class="estatico">
                <h3><?php echo "(tú)" . $_SESSION['us'] ?></h3>
                <form action="" method="post">
                    <label for="mensaje">Mensaje</label>
                    <input type="text" placeholder="Escribir mensaje" name="mensaje" required>
                    <?php echo '<input type="hidden" name="puesto" value=" ' . $_SESSION['puesto'] . '">' ?>
                    <input type="submit" required>
                </form>
            </div>
            <div class="card-header">
                <p id="textos">
                    <?php
                    foreach ($verMensajes as $value) {
                        if ($value['id_departamento'] === 1) {
                            $text = "Admonistrador";
                        } else {
                            $text = "Enfermero";
                        }
                        echo "<h5 class='persona'>" . $text . "<h5>" . "<b>" . $value['msg'] . "</b><h6 class='fecha'>[" .  $value['fecha_hora']  . "]</h6>" . "<br>";
                    } ?>
                </p>
            </div>
        </div>
    </div>
    </div>
</main>
<style>
    .persona {
        font-size: 20px;
    }

    .fecha {
        font-size: 10px;
    }
</style>


</html>

<?php
include("../../../templates/footer.php");
?>