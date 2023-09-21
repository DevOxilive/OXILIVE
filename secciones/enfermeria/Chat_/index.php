<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
} else {
    // esto queda pendiente para mostrar una mejor vista al usuario y no se confunca sobre esto...
    echo "Error en el sistema";
}
?>
<!-- seccion de chat formaulario-->
<link rel="stylesheet" href="css/index.css">
<main id="main" class="main">
<<<<<<< HEAD
=======
    <center>
        <h1>proximamente <b>Chat version 3<b></h1>
    </center>
>>>>>>> 6d5dbd6d0de6675092181156e46e7ed9c17e6ff9
    <br>
    <div class="row">
        <div class="content">
            <div class="user-list-container">
<<<<<<< HEAD
                <center>
                    <h1>Selecciona un <b>Chat</b></h1>
                </center>
=======
                <h1>Selecciona un <b>Chat</b></h1>
>>>>>>> 6d5dbd6d0de6675092181156e46e7ed9c17e6ff9
                <ul id="users-list">
                    <!-- aqui se generan los usuarios desde la base de datos -->
                </ul>
            </div>
        </div>
    </div>
</main>
<script src="js/usuarios.js"></script>
<!-- terminacion de chat -->
<?php
include("../../../templates/footer.php");
?>