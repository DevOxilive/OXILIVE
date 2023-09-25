<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../../templates/header.php");
} else {
    // esto queda pediente para mostrar una mejor vista al usuario y no se confunca sobre esto...
    echo "Error en el sistema";
}
?>
<link rel="stylesheet" href="../css/chat.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<main id="main" class="main">
    <br>
    <div class="row">
        <div>
            <div>
                <div id="chat-container">
                    <div id="chat-messages">

                        <!-- Aquí se generan los mensajes -->

                    </div>
                </div>
                <div id="chat-form">
                    <input type="hidden" value="<?php echo $_SESSION['us'] ?>" id="user">
                    <input type="text" id="message" placeholder="Escribe tu mensaje">
                    <button id="send"><img src="../img/pngwing.com.png" alt="" width="40px"></button>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/chat.js"></script>
</main>
<?php
include("../../../../templates/footer.php");
?>