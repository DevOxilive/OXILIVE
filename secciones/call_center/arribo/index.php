<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include '../../../connection/conexion.php';
    include("../../../templates/header.php");
    echo '<link rel="stylesheet" href="css/probar.css">';
} else {
    // esto queda pendiente para mostrar una mejor vista al usuario y no se confunca sobre esto...
    echo "Error en el sistema";
}
?>
<main id="main" class="main">
    <?php
    $token = bin2hex(random_bytes(32));

    $checkToken = $con->prepare("SELECT token FROM usuarios");
    $checkToken->execute();
    $existToken = $checkToken->fetchAll(PDO::FETCH_ASSOC);
    foreach ($existToken as $tokenCheck) {
        if ($tokenCheck == $token) {
            // echo "detecto uno igual perro :V";
        } else {
            // $token = bin2hex(random_bytes(32));
        }
    }
    $stat = $con->prepare("SELECT * FROM usuarios");
    $stat->execute();
    $resultados = $stat->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <center>
        <table>
            <thead>
                <tr class="historial">
                    <th colspan="5">Acciones en tiempo real</th>
                </tr>
                <tr>
                    <th>Num</th>
                    <th>Medico</th>
                    <th>Paciente</th>
                    <th>Estado o actividad</th>
                    <th>Tiempo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($resultados as $filas) {
                    echo '<tr>
                            <td><b>' . $filas['id_usuarios'] . '</b></td>
                            <td>' . $filas['Usuario'] . '</td>
                            <td>' . $filas['Usuario'] . '</td>
                            <td>' . $filas['estatus'] . '</td>
                            <td>' . $filas['fecha_sesion'] . '</td>
                          <tr/>';
                }
                ?>
            </tbody>
        </table>
        <br>
        <table>
            <thead>
                <tr class="historial">
                    <th colspan="5">historial</th>
                </tr>
                <tr>
                    <th>Num</th>
                    <th>Medico</th>
                    <th>Paciente</th>
                    <th>Estado o actividad</th>
                    <th>Tiempo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($resultados as $filas) {
                    echo '<tr>
                            <td><b>' . $filas['id_usuarios'] . '</b></td>
                            <td>' . $filas['Usuario'] . '</td>
                            <td>' . $filas['Usuario'] . '</td>
                            <td>' . $filas['estatus'] . '</td>
                            <td>' . $filas['fecha_sesion'] . '</td>
                          <tr>';
                }
                ?>
            </tbody>
        </table>
    </center>
    <div class="popup">
        <div class="popup-content">
            <span class="close-popup">&times;</span>
            <h1>Chat emergente prueba 1</h1>
            <p>imprecion de los mensajes...</p>
            <input type="text" placeholder="escribe tu mensaje">
            <button class="envio">enviar</button>
            <button class="close-popup-button">Cerrar</button>
        </div>
    </div>
    <script>
        const popup = document.querySelector('.popup');
        const openPopupButton = document.querySelector('.open-popup-button');
        const closePopupButtons = document.querySelectorAll('.close-popup, .close-popup-button');

        openPopupButton.addEventListener('click', () => {
            popup.style.display = 'block';
        });
        closePopupButtons.forEach(button => {
            button.addEventListener('click', () => {
                popup.style.display = 'none';
            });
        });
    </script>
</main>
<?php
include("../../../templates/footer.php");
?>