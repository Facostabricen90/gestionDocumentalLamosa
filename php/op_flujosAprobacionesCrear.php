<?php
include("op_sesion.php");
include("../class/flujos_aprobaciones.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$fluA = new flujos_aprobaciones();

$resultado = array();
$fluA->setUsu_Codigo($_POST['usuario']);
$fluA->setArea_Codigo($_POST['area']);
$fluA->setFluA_Paso($_POST['paso']);
$fluA->setFluA_FechaHora($fecha.' '.$hora);
$fluA->setFluA_Usuario($_SESSION['GD_Usuario']);
$fluA->setFluA_TipoFlujo($_POST['tipoFlujo']);
$fluA->setPla_Codigo($_POST['planta']);
$fluA->setFluA_Estado("1");


$resultado['resultado'] = $fluA->insertar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $fluA->imprimirError();
}
echo json_encode($resultado);
?>