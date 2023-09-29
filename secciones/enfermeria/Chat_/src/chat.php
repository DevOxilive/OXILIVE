<?php
try {//code..
    session_start();
    if (!isset($_SESSION['us'])) {
        header('Location: ../../../../login.php');
        throw new Exception(":D");
    } elseif (isset($_SESSION['us'])) {
        include("../../../../templates/header.php");
    } else {
        // esto queda pediente para mostrar una mejor vista al usuario y no se confunca sobre esto...
        echo "Error en el sistema";
    }
?>
    <link rel="stylesheet" href="../css/chat.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/chat.js"></script>
    <script src="../notificaciones/js/push.min.js"></script>
    <main id="main" class="main">
        <div class="chat-header">
            <h1>chat general</h1>
        </div>
        <div id="chat-container">
            <div id="chat-messages">

            </div>
        </div>
        <div id="chat-form">
            <input type="hidden" value="<?php echo $_SESSION['us'] ?>" id="user">
            <input type="text" id="message" placeholder="Escribe tu mensaje">
            <button id="send"><img src="../img/pngwing.com.png" alt="" width="40px"></button>
        </div>
    </main>
<?php
    include("../../../../templates/footer.php");
} catch (Exception $e) {
    $e->getMessage();
}

?>