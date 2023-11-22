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
    <link rel="stylesheet" href="../css/archivos.css">
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
                        <button id="btnMostrar"><i class="bi bi-folder-plus"></i></button>
                    </h2>
                </div>
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
<script>
    document.getElementById('btnMostrar').addEventListener('click', function () {
        var galeria = document.getElementById('miGaleria');
        var chatContainer = document.getElementById('chat-container');

        if (galeria.style.display === 'none') {
            galeria.style.display = 'grid';
            chatContainer.classList.add('ocult');
        } else {
            galeria.style.display = 'none';
            chatContainer.classList.remove('ocult');

        }
    });
</script>
<script src="../js/documentos.js"></script>
<!-- controlador de los estilos del chat -->
<script src="../js/chatPriv.js"></script>
<?php
include("../../../templates/footer.php");
?>