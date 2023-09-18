<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../../templates/header.php");
    include_once('../php/usuarios.php');
} else {
    // esto queda pediente para mostrar una mejor vista al usuario y no se confunca sobre esto...
    echo "Error en el sistema";
}
?>
<!-- seccion de chat formaulario-->
<link rel="stylesheet" href="css/index.css">
<main id="main" class="main">
    <center>
        <h1>proximamente <b>Chat</b> en construccion <b>version 3<b></h1>
    </center>
    <br>
    <div class="row">
        <div class="content">
            <div class="users-list">
                <?php
                if (count($valores) == 0) {
                    echo "sin usuarios para chatear X(";
                } elseif (count($valores) > 0) {
                    foreach ($valores as $listar) {
                        echo "<a href='chat.php?user_id={$listar['id_usuarios']}'>{$listar['Usuario']}</a> <br>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</main>
<script src="../js/usuarios.js"></script>
<!-- terminacion de chat -->
<?php
include("../../../../templates/footer.php");
?>