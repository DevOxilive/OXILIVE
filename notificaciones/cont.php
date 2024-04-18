<?php
session_start();
include('control/notificacion.php');
include('../connection/conexion.php');
$sql = "SELECT * FROM notificaciones WHERE id_recibe = :idus AND estatus = 1";
$notifi = $con->prepare($sql);
$notifi->bindParam(':idus', $_SESSION['idus']);
$notifi->execute();
echo   '<button type="button" class="btn btn-lg btn-danger" data-bs-toggle="popover" data-bs-title="Popover title" data-bs-content="And heres some amazing content. Its very engaging. Right?" aria-describedby="popover151559">Click to toggle popover</button>';
echo '<i class="bi bi-bell-fill fs-5"></i>'. "  " . $cantNoti = $notifi->rowCount();
