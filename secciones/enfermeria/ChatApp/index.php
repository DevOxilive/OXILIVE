<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("../../../connection/conexion.php");
} else {
    // esto queda pediente para mostrar una mejor vista al usuario y no se confunca sobre esto...
    echo "Error en el sistema";
}

?>
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
            <div class="card-header">
                <h3><?php echo "(tú)" . $_SESSION['us'] ?></h3>

                <input type="hidden" id="user" placeholder="Usuario" readonly value="<?php echo $_SESSION['us']; ?>">
                <input type="text" id="message" placeholder="Mensaje" required>
                <button onclick="sendMessage()">Enviar</button>
            </div>
            <div>
                <div id="chat"></div>
            </div>
</main>
<script src="js/socket.js"></script>

</html>
<?php
include("../../../templates/footer.php");
?>