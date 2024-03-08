<?php
if (!empty($_GET['chat'])) {
    $loadChat = $_GET['chat'];
    session_start();
    include('../../../templates/header.php');
    include('../control/Chat.php');
    $chat = new Chat();
    //retorna el arreglo asociativo con los valores del usuario seleccionado
    $loadChat = $chat->loadChat($loadChat, $con);
    foreach ($loadChat as $data) {
?>

        <body>
            <main class="main" id="main">
                <div>
                    <div>
                        <?php echo $data['usuario'] ?>
                    </div>
                    <div class="box-messages" id="box-messages">
                        <!-- box-messages -->
                    </div>
                    <div>
                        <div>
                            <input type="hidden" value="<?php echo $data['token'] ?>" name="id_recibe" id="id_recibe">
                            <input type="file" name="archivos" id="archivos" accept=".pdf, .png, .jpg">
                            <input type="text" name="texto" id="texto">
                            <button name="enviar" id="enviar">enviar</button>
                        </div>
                    </div>
                </div>
            </main>
        </body>
        <?php
        include('../../../templates/footer.php');
        ?>
        <script src="../js/chat.js"></script>
<?php
    }
} else {
    echo "error al cargar el chat";
}
