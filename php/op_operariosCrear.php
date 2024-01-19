<?php
include("op_sesion.php");
include("../class/operarios.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$ope = new operarios();
$ope->setArea_Codigo($_POST['area']);
$ope->setOpe_Nombre($_POST['nombre']);
$ope->setOpe_Apellido($_POST['apellido']);
$ope->setOpe_Cedula($_POST['cedula']);
$ope->setOpe_Correo($_POST['correo']);
$ope->setOpe_Telefono($_POST['telefono']);
$ope->setOpe_FechaHoraCrea($fecha.' '.$hora);
$ope->setOpe_Usuario($_SESSION['GD_Usuario']);
$ope->setOpe_Estado("1");
$ope->setOpe_Sexo($_POST['sexo']);
$ope->setOpe_CodigoCCosto($_POST['codigoccosto']);
$ope->setOpe_NombreCCosto($_POST['nombreccosto']);
$ope->setOpe_Jefe($_POST['jefe']);
$ope->setOpe_Cargo($_POST['cargo']);
$ope->setOpe_AreaLATAM($_POST['areaLatam']);
$ope->setOpe_TipoFuncion($_POST['funcion']);
$ope->setOpe_Gerencia($_POST['gerencia']);
$ope->setOpe_SubArea($_POST['subarea']);



$ope->setPla_Codigo($_POST['planta']);

$resultado['resultado'] = $ope->insertar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $ope->imprimirError();
}
echo json_encode($resultado);
?>