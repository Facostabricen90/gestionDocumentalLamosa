<?php
include("op_sesion.php");
include("../class/usuarios_plantas.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$usuPla = new usuarios_plantas();

$lplantas = $_POST['planta'];
foreach($lplantas as $registro){
  $usuPla->setUsu_Codigo($_POST['codigo']);
  $usuPla->setPla_Codigo($registro);



  $resultado['resultado'] = $usuPla->insertar(); 
}

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $usuPla->imprimirError();
}
echo json_encode($resultado);
?>