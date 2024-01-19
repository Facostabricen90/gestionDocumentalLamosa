<?php
include("op_sesion.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$usu3 = new usuarios();
$usu3->setUsu_Codigo($_POST['codigo']);
$usu3->consultar();

$usu3->setPla_Codigo($_POST['planta']);
$usu3->setUsu_Usuario($_POST['usuario']);
$usu3->setUsu_Nombre($_POST['nombre']);
$usu3->setUsu_Apellido($_POST['apellido']);
$usu3->setUsu_FechaHoraCrea($fecha.' '.$hora);
$usu3->setUsu_Cargo($_POST['cargo']);
$usu3->setUsu_Correo($_POST['correo']);
$usu3->setUsu_Telefono($_POST['telefono']);
$usu3->setUsu_Rol($_POST['rol']);
$usu3->setUsu_TipoFlujo($_POST['tipoFlujo']);
$usu3->setUsu_Estado($_POST['estado']);

$resultado['resultado'] = $usu3->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $usu3->imprimirError();
}
echo json_encode($resultado);
?>