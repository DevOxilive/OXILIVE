<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../../templates/header.php");
    $id_envio = $_GET['chat'];
} else {
    // esto queda pediente para mostrar una mejor vista al usuario y no se confunca sobre esto...
    echo "Error en el sistema";
}

<<<<<<< HEAD
$s = $con->prepare("SELECT * FROM usuarios WHERE id_usuarios = '$id_envio'");
=======
$s = $con->prepare("SELECT Usuario FROM usuarios WHERE id_usuarios = '$id_envio'");
>>>>>>> 6d5dbd6d0de6675092181156e46e7ed9c17e6ff9
$s->execute();

$resultado = $s->fetch(PDO::FETCH_ASSOC);
if ($resultado) {
    // El resultado se encuentra en $resultado['Usuario']
    $valorUsuario = $resultado['Usuario'];
?>


    <link rel="stylesheet" href="../css/chat.css">
    <!-- estilos del chat -->
    <main id="main" class="main">
        <div class="row">
            <div>
                <div>
                    <div class="chat-header">
                        <h2><?php
                            echo $valorUsuario;
                        } else {
<<<<<<< HEAD
                            echo "No se encontraron resultados";
=======
                            echo "No se encontraron resultados para el ID proporcionado.";
>>>>>>> 6d5dbd6d0de6675092181156e46e7ed9c17e6ff9
                        }
                            ?></h2>
                    </div>
                    <div id="chat-container">
                        <div id="chat-messages">
                            <!-- aqui se generan los mensajes -->
                        </div>
                    </div>
                    <div id="chat-form">
                        <input type="hidden" value="<?php echo $_SESSION['us'] ?>" id="user">
                        <input type="text" id="message" placeholder="Escribe tu mensaje">
                        <input type="hidden" value="<?php echo $id_envio; ?>" id='output'>
                        <button id="send"><img src="../img/pngwing.com.png" alt="" width="30px"></button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- controlador de los estilos del chat -->
    <script src="../js/chatPriv.js"></script>

    <?php
    include("../../../../templates/footer.php");
    ?>