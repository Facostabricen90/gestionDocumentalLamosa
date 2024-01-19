<?php
include("op_sesion.php");
include("../class/usuarios_areas.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$usuAre = new usuarios_areas();

$larea = $_POST['area'];
foreach($larea as $registro){
  $usuAre->setUsu_Codigo($_POST['codigo']);
  $usuAre->setArea_Codigo($registro);

  $usuAre->setUsuA_UsuarioCrea($_SESSION['GD_Usuario']);
  $usuAre->setUsuA_FechaHora($fecha." ".$hora);

  $resultado['resultado'] = $usuAre->insertar(); 
}

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $usuAre->imprimirError();
}
echo json_encode($resultado);
?>