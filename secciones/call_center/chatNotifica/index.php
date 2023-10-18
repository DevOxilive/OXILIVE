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
<script src="notificaciones/js/push.min.js"></script>
<script src="js/notificaciones.js"></script>
<link rel="stylesheet" href="css/index.css">

<body>
    <main id="main" class="main">
        <br>
        <div class="row">
            <div class="content">
                <div class="user-list-container">
                    <div id="notifi"></div>
                    <h1><b>Chats</b></h1>
                    <ul id="users-list">
                        <!-- aqui se generan los usuarios desde la base de datos -->
                    </ul>
                </div>
            </div>
        </div>
    </main>
</body>
<script src="js/usuarios.js"></script>
<!-- terminacion de chat -->
<?php
include("../../../templates/footer.php");
?>