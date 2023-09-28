<?php
try {
    include '../../../../connection/conexion.php';
    session_start();
    if (!isset($_SESSION['idus'])) {
        throw new Exception("");
    }
    $estado = "0";
    $sent = $con->prepare("SELECT * FROM mensajes WHERE id_salida = {$_SESSION['idus']} AND leido = {$estado}");
    $sent->execute();
    $result = $sent->fetchAll(PDO::FETCH_ASSOC);


    echo '<i class="bi bi-bell"></i> Mensajes sin leer: ' . count($result);
    // if (count($result) > 0) {
    //     foreach($result as $filas){
    //         echo '<script>
    //         Push.create("'. $filas['persona'] .'", {
    //             body: "'. $filas['msg'] .'",
    //             icon: "img/usuario.png",
    //             onClick: function() {
    //                 window.focus();
    //                 this.close();
    //             }
    //         });
    //         </script>';
    //     }
    // }
    // si deseas que una alerta molesta, quita los comentarios
} catch (Exception $e) {
    $e->getMessage();
}
