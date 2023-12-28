<?php
include("../../config/session.php");
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="<?php echo $url_base ?>" type="image/x-icon">
<link rel="stylesheet" href="css/index.css">
<title>Oxilive</title>

<body>
    regresar: <a href="<?php echo $url_base ?>">puchale aquí</a>
    <br>
    cerrar sesion: <a href="<?php echo $url_base . "cerrar.php" ?>">puchale aquí</a>
    <br>
    <div class="contenedor">
        <h1>usuarios</h1>
        <div>
            <div class="buscador">
                <label for="buscador">buscar usuario</label>
                <input type="text" name="buscador" placeholder="buscar usuarios" id="buscador" maxlength="30">
            </div>
            <ul class="cajaUsuarios" id="listaUsuarios">
                <!-- listado de usuarios -->
            </ul>
            <ul id="chats">

            </ul>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="js/usuarios.js"></script>
<script src="js/selecChat.js"></script>
<script src="js/chats.js"></script>

</html>