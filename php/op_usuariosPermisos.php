<?php
include("op_sesion.php");
include_once("../class/usuarios_permisos.php");


$resultado = array();

$usuPer = new usuarios_permisos();

$usuPer->setPer_Codigo($_POST['permiso']);
$usuPer->setUsu_Codigo($_POST['codigo']);

$usuPer->setUsuP_Ver("1");
$usuPer->setUsuP_Crear("1");
$usuPer->setUsuP_Eliminar("1");
$usuPer->setUsuP_Modificar("1");


$resultado['resultado'] = $usuPer->insertar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $usuPer->imprimirError();
}
echo json_encode($resultado);
?>