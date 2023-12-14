<?php
session_start();

if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
} else {
    // esto queda pediente para mostrar una mejor vista al usuario y no se confunca sobre esto...
    echo "Error en el sistema";
}
$token = $_GET['chat'];
//se verifica la existencia del usuario seleccionado
$s = $con->prepare("SELECT * FROM usuarios WHERE token = '$token'");
$s->execute();
$resultado = $s->fetchAll(PDO::FETCH_ASSOC);
//si hay un resultado se cargan los datos del usuario a quien se le mandara mensaje
if (count($resultado) > 0) {
    foreach ($resultado as $filas) {
        $valorUsuario = $filas['Usuario'];
        $img = $filas['Foto_perfil'];
        $enviarA = $filas['id_usuarios'];
    }
?>
    <link rel="stylesheet" href="../css/chat.css">
    <link rel="stylesheet" href="../css/archivos.css">
    <script src="../../../js/jquery-3.7.0.min.js"></script>
    <!-- estilos del chat -->
    <main id="main" class="main">
        <div class="row">
            <div>
                <div>
                    <div class="chat-header">
                        <h2>
                            <a href="../index.php"><i class="bi bi-chevron-compact-left" style="color: white;"></i></a>
                        <?php
                        echo '<img src="' . $img . '" class="iconoUsuario" alt="">';
                        echo $valorUsuario;
                    } else {
                        header("Location: ../../../../403.html");
                    }
                        ?>
                        <button id="btnMostrar"><i class="bi bi-folder-plus"></i></button>
                        </h2>
                    </div>
                    <!-- modulo de eliminacion de mensajes -->
                    <form action="eliminar_documento.php" method="post">
                        <div class="vistaArchivos" id="miGaleria">
                            <div id="list-documentos">

                            </div>
                        </div>
                    </form>
                    <div id="chat-container">
                        <div id="chat-messages">
                            <!-- aqui se generan los mensajes -->
                        </div>
                    </div>
                    <div id="chat-form">
                        <input type="hidden" value="<?php echo $_SESSION['us'] ?>" id="user">
                        <label for="fileInput" class="custom-file-upload" id="fileLabel">
                            <i class="bi bi-paperclip"></i>
                        </label>
                        <input type="file" id="fileInput" name="file">
                        <input type="text" id="message" placeholder="Escribe tu mensaje" maxlength="500">
                        <input type="hidden" value="<?php echo $enviarA; ?>" id='output'>
                        <button id="send"><img src="../img/pngwing.com.png" alt="" width="30px"></button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="../js/interfazArchi.js"></script>
    <script src="../js/documentos.js"></script>
    <!-- controlador de los estilos del chat -->
    <script src="../js/chatPriv.js"></script>
    <?php
    include("../../../templates/footer.php");
    ?>