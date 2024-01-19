<?php
include("op_sesion.php");
include("../class/explorador_archivos.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");
$fechaL = date("Ymd");
$horaL = date("His");

$resultado = array();
$exp = new explorador_archivos();

$exp->setEArc_Nombre($_POST['nombre']);
$exp->setEArc_Referencia($_POST['referencia']);
$exp->setEArc_Tipo($_POST['tipo']);
$exp->setEArc_Estado('1');
$exp->setEArc_Modulo($_POST['modulo']);
$exp->setUsu_Modifica($_SESSION['GD_Usuario']);
$exp->setEArc_FechaHora($fecha.' '.$hora);
$ruta = "../imagenes/explorador/";
if($_POST['adjunto'] != "-1"){
	$arc = $_POST['adjunto'];
  $valores = explode('.', $arc);
  $extension = end($valores);
  $nombre = "EXP_".$fechaL.$horaL.".".$extension;

  rename($ruta.$_POST['adjunto'], $ruta.$nombre);
	
  $exp->setEArc_Link($nombre);
}
$resultado['resultado'] = $exp->insertar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $exp->imprimirError();
}
echo json_encode($resultado);
?>