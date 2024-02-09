<?php
include("../../../ctrlArchivos/control/Archivero.php");

$obj = new Archivero();
$nueva = "../../../archvieroOxi/capitalHumano/";
$obj->crearCarpeta($nueva, "empleado rico");