<?php
// este archivo espera por la url el valor de el usuario a mandar mensaje para poder pintar el chat, y tiene un control de errores por alguna modificacion en la url
try {
    include("../../../config/session.php");
    if (!isset($_GET['id'])) {
        throw new Exception("Error Processing Request", 1);
    } else {
        $id = $_GET["id"];
    }
    if (empty($id)) {
        throw new Exception("Error Processing Request", 1);
    }

    $sql = "SELECT * FROM usuarios where token = '$id'";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/chat.css">
        <title>chat rico</title>
    </head>

    <body>
        <?php
        if (count($resultado) > 0) {
            foreach ($resultado as $filas) {
                $enviarA = $filas['id_usuarios'];
            }

        ?>
            <div class="chat-header">
                <h2>
                    <a href="../index.php">salir</a>
                    <?php
                    echo '<img src="" class="iconoUsuario" alt="proximamente :V">';
                    echo $filas['Usuario'];
                    ?>
                    <button id="btnMostrar">forler de archivos</button>
                </h2>
            </div>
            <div id="chat-container">
                <div id="chat-messages">
                    <!-- aqui se generan los mensajes -->
                </div>
            </div>
            <div id="chat-form">
                <input type="hidden" value="<?php echo $_SESSION['us'] ?>" id="user">
                <label for="fileInput" class="custom-file-upload" id="fileLabel">
                    enviar archivo
                </label>
                <input type="file" id="fileInput" name="file">
                <input type="text" id="message" placeholder="Escribe tu mensaje" maxlength="500">
                <input type="hidden" value="<?php echo $enviarA; ?>" id='output'>
                <button id="send"><img src="../img/pngwing.com.png" alt="" width="30px"></button>
            </div>
            </div>
    <?php
        } else {
            echo "error de comunicacion";
        }
    } catch (Exception $e) {
        echo "evita manipular la url!!!<br>estamos llamando a la policia<br>";
    }
    ?>
    </body>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- en mantenimiento -->
    <script src="../js/interfazArchi.js"></script>
    <script src="../js/documentos.js"></script>
    <!-- controlador de los estilos del chat -->
    <script src="../js/chatPriv.js"></script>

    </html>