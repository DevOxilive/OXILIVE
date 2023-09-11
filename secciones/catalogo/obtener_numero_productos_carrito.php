<?php
session_start();
$numProductosCarrito = count($_SESSION['carrito']);
$response = array(
    'numProductosCarrito' => $numProductosCarrito
);
header('Content-Type: application/json');
echo json_encode($response);
