<?php
include("op_sesion.php");
include("../class/areas.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$area = new areas();

$area->setArea_Nombre($_POST['nombre']);
$area->setPla_Codigo($_POST['planta']);
$area->setArea_Informes('1');
$area->setArea_FechaHora($fecha.' '.$hora);
$area->setArea_Usuario($_SESSION['GD_Usuario']);
$area->setArea_Estado("1");

$resultado['resultado'] = $area->insertar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $area->imprimirError();
}
echo json_encode($resultado);
?>
