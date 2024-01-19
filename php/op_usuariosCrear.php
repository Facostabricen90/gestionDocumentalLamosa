<?php
include("op_sesion.php");
include("../class/usuarios_plantas.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$usu2 = new usuarios();

$usu2->setPla_Codigo($_POST['planta']);
$usu2->setUsu_Usuario($_POST['usuario']);
$usu2->setUsu_Contrasena($_POST['usuario']);
$usu2->setUsu_Nombre($_POST['nombre']);
$usu2->setUsu_Apellido($_POST['apellido']);
$usu2->setUsu_FechaHoraCrea($fecha.' '.$hora);
$usu2->setUsu_Cargo($_POST['cargo']);
$usu2->setUsu_Correo($_POST['correo']);
$usu2->setUsu_Telefono($_POST['telefono']);
$usu2->setUsu_Rol($_POST['rol']);
$usu2->setUsu_TipoFlujo($_POST['tipoFlujo']);
$usu2->setUsu_Estado("1");

$resultado['resultado'] = $usu2->insertar();

if($resultado['resultado']){
  $usuU = $usu2->listarUltimoUsuarioCrear();
  $usuP = new usuarios_plantas();
  $usuP->setUsu_Codigo($usuU);
  $usuP->setPla_Codigo($_POST['planta']);
  
  $resultado['resultado2'] = $usuP->insertar();
  if($resultado['resultado2']){
	 $resultado['mensaje'] = "OK";
  }else{
	 $resultado['mensaje'] = $usuP->imprimirError();
  }
}else{
	$resultado['mensaje'] = $usu2->imprimirError();
}
echo json_encode($resultado);
?>