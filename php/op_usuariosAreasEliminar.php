<?php
include("op_sesion.php");
include("../class/usuarios_areas.php");

$resultado = array();

$usuA = new usuarios_areas();
$usuA->setUsuA_Codigo($_POST['codigo']);



$resultado['resultado'] = $usuA->eliminar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $usuA->imprimirError();
}
echo json_encode($resultado);
?>