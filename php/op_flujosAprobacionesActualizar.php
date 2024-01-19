<?php
include("op_sesion.php");
include("../class/flujos_aprobaciones.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$fluA = new flujos_aprobaciones();
$fluA->setFluA_Codigo($_POST['codigo']);
$fluA->consultar();

$fluA->setUsu_Codigo($_POST['usuario']);
$fluA->setArea_Codigo($_POST['area']);
$fluA->setFluA_Paso($_POST['paso']);
$fluA->setFluA_TipoFlujo($_POST['tipoFlujo']);
$fluA->setFluA_Estado($_POST['estado']);
$fluA->setPla_Codigo($_POST['planta']);
$fluA->setFluA_Responsable($_POST['responsable']);

$resultado['resultado'] = $fluA->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $fluA->imprimirError();
}
echo json_encode($resultado);
?>