<?php
include("op_sesion.php");
include("../class/solicitudes.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$sol = new solicitudes();

$resValVer = $sol->listarCodigoVersionValidar($_POST['codigo'], $_POST['version']);

$resultado['valorVersion'] = $resValVer[0];

echo json_encode($resultado);
?>