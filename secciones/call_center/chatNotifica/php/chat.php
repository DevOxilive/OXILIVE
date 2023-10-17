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
$token = $_GET['chat'];
$s = $con->prepare("SELECT * FROM usuarios WHERE token = '$token'");
$s->execute();
$resultado = $s->fetchAll(PDO::FETCH_ASSOC);
if (count($resultado) > 0) {
    // El resultado se encuentra en $resultado['Usuario']
    foreach ($resultado as $filas) {
        $valorUsuario = $filas['Usuario'];
        $img = $filas['Foto_perfil'];
        $enviarA = $filas['id_usuarios'];
    }
?>
    <link rel="stylesheet" href="../css/chat.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- estilos del chat -->
    <main id="main" class="main">
        <div class="row">
            <div>
                <div>
                    <div class="chat-header">
                        <h2>
                            <a href="../index.php"><i class="bi bi-chevron-compact-left" style="color: white;"></i></a>
                        <?php
                        echo '<img src="data:image/jpg/png;base64,' . base64_encode($img) . '" class="iconoUsuario" alt="">';
                        echo $valorUsuario;
                    } else {
                        header("Location: ../../../../403.html");
                    }
                        ?>
                        </h2>
                    </div>
                    <div id="chat-container">
                        <div id="chat-messages">
                            <!-- aqui se generan los mensajes -->
                        </div>
                    </div>
                    <div id="chat-form">
                        <input type="hidden" value="<?php echo $_SESSION['us'] ?>" id="user">
                        <label for="fileInput" class="custom-file-upload">
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
        <div class="contenedor-documentos">
            <div id="list-documentos">

            </div>
        </div>
    </main>
    <script src="../js/documentos.js"></script>
    <script>
        const fileInput = document.getElementById('fileInput');

        fileInput.addEventListener('change', (event) => {
            const selectedFile = event.target.files[0];
            if (selectedFile) {
                console.log('Archivo seleccionado:', selectedFile.name);
                // Aquí puedes realizar otras acciones, como cargar el archivo o mostrar información adicional.
            }
        });
    </script>
    <!-- controlador de los estilos del chat -->
    <script src="../js/chatPriv.js"></script>
    <?php
    include("../../../../templates/footer.php");
    ?>Z