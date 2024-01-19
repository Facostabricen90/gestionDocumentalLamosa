<?php
include("op_sesion.php");
include("../class/parametros.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$par = new parametros();

$par->setPar_Nombre($_POST['nombre']);
$par->setPar_Tipo($_POST['tipo']);
$par->setPar_TipoFlujo($_POST['tipoFlujo']);
$par->setPar_FechaHora($fecha.' '.$hora);
$par->setPar_Usuario($_SESSION['GD_Usuario']);
$par->setPar_Estado("1");

$resultado['resultado'] = $par->insertar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $par->imprimirError();
}
echo json_encode($resultado);
?>