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
<main id="main" class="main">
    <div class="row">
        <div>
            <div>
                <div id="chat-container">
                    <div id="chat-messages">

                    </div>
                </div>
                <div id="chat-form">
                    <input type="hidden" value="<?php echo $_SESSION['us'] ?>" id="user">
                    <input type="text" id="message" placeholder="Escribe tu mensaje">
                    <button id="send"><img src="../data/pngwing.com.png" alt="" width="40px"></button>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="../js/chat.js"></script>