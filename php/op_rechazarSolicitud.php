<?php
include("op_sesion.php");
include("../class/solicitudes.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$apr = new solicitudes();
$apr->setSol_Codigo($_POST['codigo']);
$apr->consultar();

$apr->setSol_Tipo("No Aprobado");
$apr->setSol_EstadoActual("Rechazado");
$apr->setSol_PasoActual("0");

$resultado['resultado'] = $apr->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $apr->imprimirError();
}
echo json_encode($resultado);
?>