<?php
include("op_sesion.php");
include("../class/explorador_archivos.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");
$fechaL = date("Ymd");
$horaL = date("His");

$resultado = array();
$exp = new explorador_archivos();
$exp->setEArc_Codigo($_POST['codigo']);
$exp->consultar();
$exp->setEArc_Estado('0');


$resultado['resultado'] = $exp->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $exp->imprimirError();
}
echo json_encode($resultado);
?>