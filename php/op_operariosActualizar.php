<?php
include("op_sesion.php");
include("../class/operarios.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();


$ope2 = new operarios();
$ope2->setOpe_Codigo($_POST['codigo']);
$ope2->consultar();

$ope2->setArea_Codigo($_POST['area']);
$ope2->setOpe_Nombre($_POST['nombre']);
$ope2->setOpe_Apellido($_POST['apellido']);
$ope2->setOpe_Cedula($_POST['cedula']);
$ope2->setOpe_Correo($_POST['correo']);
$ope2->setOpe_Telefono($_POST['telefono']);
$ope2->setOpe_FechaHoraCrea($fecha.' '.$hora);
$ope2->setOpe_Estado($_POST['estado']);
$ope2->setOpe_Sexo($_POST['sexo']);
$ope2->setOpe_CodigoCCosto($_POST['codigoccosto']);
$ope2->setOpe_NombreCCosto($_POST['nombreccosto']);
$ope2->setOpe_Jefe($_POST['jefe']);
$ope2->setOpe_Cargo($_POST['cargo']);
$ope2->setOpe_AreaLATAM($_POST['areaLatam']);
$ope2->setOpe_TipoFuncion($_POST['funcion']);
$ope2->setOpe_Gerencia($_POST['gerencia']);
$ope2->setOpe_SubArea($_POST['subarea']);
$ope2->setOpe_Estado($_POST['estado']);
$ope2->setPla_Codigo($_POST['planta']);

$resultado['resultado'] = $ope2->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $ope2->imprimirError();
}
echo json_encode($resultado);
?>