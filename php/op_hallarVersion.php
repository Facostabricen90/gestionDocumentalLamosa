<?php
include("op_sesion.php");
include("../class/solicitudes.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$sol = new solicitudes();

$resValVer = $sol->HallarVersionSiguenteCodigo($_POST['codigo']);

$CodSig = intval($resValVer[0]) + 1;
$CodSig = str_pad($CodSig, 3, "0", STR_PAD_LEFT);

$resultado['valorVersion'] = $CodSig;

echo json_encode($resultado);
?>