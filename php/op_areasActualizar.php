<?php
include("op_sesion.php");
include("../class/areas.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$area = new areas();
$area->setArea_Codigo($_POST['codigo']);
$area->consultar();


$area->setArea_Nombre($_POST['nombre']);
$area->setPla_Codigo($_POST['planta']);
$area->setArea_Estado($_POST['estado']);

$resultado['resultado'] = $area->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $area->imprimirError();
}
echo json_encode($resultado);
?>
