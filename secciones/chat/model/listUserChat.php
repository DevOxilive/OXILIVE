<?php
include('../../../connection/conexion.php');
include('../control/Chat.php');
$listChat = new Chat();
// listar usuarios en el inicio
$listChat->listUser($con);
