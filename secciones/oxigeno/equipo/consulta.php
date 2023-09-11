<?php
//LISTA DE TANQUES
$sentencia=$con->prepare("SELECT tanques.*, 
(SELECT nombre_marca FROM marca_tanque WHERE marca_tanque.id_marca = tanques.marca LIMIT 1) as mar, 
(SELECT estado FROM estado_tanque WHERE estado_tanque.id_estado = tanques.estado_tanque LIMIT 1) as esta 
FROM tanques");
$sentencia->execute();
$lista_tanques=$sentencia->fetchAll(PDO::FETCH_ASSOC);

$s=$con->prepare("SELECT * FROM `tanques`");
$s->execute();
$lis=$s->fetchAll(PDO::FETCH_ASSOC);

//MARCA DEL TANQUE
$sentencia=$con->prepare("SELECT * FROM `marca_tanque`");
$sentencia->execute();
$lista_marca=$sentencia->fetchAll(PDO::FETCH_ASSOC);

//ESTADO DEL TANQUE
$sen1=$con->prepare("SELECT * FROM `estado_tanque`");
$sen1->execute();
$lista_estado=$sen1->fetchAll(PDO::FETCH_ASSOC);

//TAMAÑO DEL TANQUE
$sen2=$con->prepare("SELECT * FROM `tamano`");
$sen2->execute();
$lista_tama=$sen2->fetchAll(PDO::FETCH_ASSOC);

//SUMA DE TANQUES INFRA
$sen3=$con->prepare("SELECT SUM(cantidad) FROM tanques WHERE marca=1");
$sen3->execute();
$canti=$sen3->fetchColumn();

//SUMA DE TANQUES OXILIVE
$senOxi=$con->prepare("SELECT SUM(cantidad) FROM tanques WHERE marca=2");
$senOxi->execute();
$cantiOxi=$senOxi->fetchColumn();

//SUMA DE TANQUES AEMEH
$senAE=$con->prepare("SELECT SUM(cantidad) FROM tanques WHERE marca=3");
$senAE->execute();
$cantiAE=$senAE->fetchColumn();

//SUMA DECONCENTRADORES
$sencon=$con->prepare("SELECT SUM(cantidad) FROM tanques WHERE marca=4");
$sencon->execute();
$cantiCON=$sencon->fetchColumn();

//SUMA DE CONCENTRADORES LLENOS
$senconLl=$con->prepare("SELECT SUM(cantidad) FROM tanques WHERE marca=4 and estado_tanque=4");
$senconLl->execute();
$concen_lle=$senconLl->fetchColumn();

//SUMA INFRA LLENOS
$sen5=$con->prepare("SELECT SUM(cantidad) FROM tanques WHERE marca=1 and estado_tanque =4");
$sen5->execute();
$lleIn=$sen5->fetchColumn();

//SUMA DE TANQUES VERDES
$sen4=$con->prepare("SELECT SUM(cantidad) FROM tanques WHERE marca=5");
$sen4->execute();
$canti2=$sen4->fetchColumn();

//SUMA OXILIVE LLENOS
$sen6=$con->prepare("SELECT SUM(cantidad) FROM tanques WHERE marca=2 and estado_tanque =4");
$sen6->execute();
$lleOxi=$sen6->fetchColumn();

//SUMA OXILIVE LLENOS
$sen7=$con->prepare("SELECT SUM(cantidad) FROM tanques WHERE marca=5 and estado_tanque =4");
$sen7->execute();
$lleVer=$sen7->fetchColumn();

//SUMA DE TODOS LOS TANQUES
$sen8=$con->prepare("SELECT SUM(cantidad) FROM tanques WHERE marca !=4");
$sen8->execute();
$sumTan=$sen8->fetchColumn();
?>