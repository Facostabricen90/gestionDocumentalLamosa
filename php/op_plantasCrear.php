<?php
include("op_sesion.php");
include("../class/plantas.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$pla = new plantas();
$pla->setPla_Grupo($_POST['grupo']);
$pla->setPla_Negocio($_POST['negocio']);
$pla->setPla_Distribucion($_POST['distribucion']);
$pla->setPla_Marca($_POST['marca']);
$pla->setPla_Nombre($_POST['nombre']);
$pla->setPla_FechaHora($fecha.' '.$hora);
$pla->setPla_Usuario($_SESSION['GD_Usuario']);
$pla->setPla_Estado("1");


$resultado['resultado'] = $pla->insertar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $pla->imprimirError();
}
echo json_encode($resultado);
?>