<?php
include("op_sesion.php");
include("../class/adjuntos.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");
$fechaL = date("Ymd");
$horaL = date("His");

$resultado = array();

$adj = new adjuntos();

$ruta = "../imagenes/adjuntos/";

if($_POST['archivo1'] != ""){
  $adj->setAdj_FechaHora($fecha.' '.$hora);
  $adj->setAdj_Nombre($_POST['archivo1']);
  
  $adj->setAdj_Relacion($_POST['codigo']);
  $adj->setAdj_Usuario($_SESSION['GD_Usuario']);
  $adj->setAdj_Estado('1');
  
  $arc = $_POST['archivo1'];
  $valores = explode('.', $arc);
  $extension = end($valores);
  $nombre = "CAP1_".$fechaL.$horaL.".".$extension;

  rename($ruta.$_POST['archivo1'], $ruta.$nombre);
  
  $adj->setAdj_Ruta($nombre);
  
  $resultado['resultado'] = $adj->insertar();
}
if($_POST['archivo2'] != ""){
  $adj->setAdj_FechaHora($fecha.' '.$hora);
  $adj->setAdj_Nombre($_POST['archivo2']);
  
  $adj->setAdj_Relacion($_POST['codigo']);
  $adj->setAdj_Usuario($_SESSION['GD_Usuario']);
  $adj->setAdj_Estado('1');
  
  $arc = $_POST['archivo2'];
  $valores = explode('.', $arc);
  $extension = end($valores);
  $nombre = "CAP2_".$fechaL.$horaL.".".$extension;

  rename($ruta.$_POST['archivo2'], $ruta.$nombre);
  
  $adj->setAdj_Ruta($nombre);
  
  $resultado['resultado'] = $adj->insertar();
}
if($_POST['archivo3'] != ""){
  $adj->setAdj_FechaHora($fecha.' '.$hora);
  $adj->setAdj_Nombre($_POST['archivo3']);
  
  $adj->setAdj_Relacion($_POST['codigo']);
  $adj->setAdj_Usuario($_SESSION['GD_Usuario']);
  $adj->setAdj_Estado('1');
  
  $arc = $_POST['archivo3'];
  $valores = explode('.', $arc);
  $extension = end($valores);
  $nombre = "CAP3_".$fechaL.$horaL.".".$extension;

  rename($ruta.$_POST['archivo3'], $ruta.$nombre);
  
  $adj->setAdj_Ruta($nombre);
  
  $resultado['resultado'] = $adj->insertar();
}
if($_POST['archivo4'] != ""){
  $adj->setAdj_FechaHora($fecha.' '.$hora);
  $adj->setAdj_Nombre($_POST['archivo4']);
  
  $adj->setAdj_Relacion($_POST['codigo']);
  $adj->setAdj_Usuario($_SESSION['GD_Usuario']);
  $adj->setAdj_Estado('1');
  
  $arc = $_POST['archivo4'];
  $valores = explode('.', $arc);
  $extension = end($valores);
  $nombre = "CAP4_".$fechaL.$horaL.".".$extension;

  rename($ruta.$_POST['archivo4'], $ruta.$nombre);
  
  $adj->setAdj_Ruta($nombre);
  
  $resultado['resultado'] = $adj->insertar();
}
if($_POST['archivo5'] != ""){
  $adj->setAdj_FechaHora($fecha.' '.$hora);
  $adj->setAdj_Nombre($_POST['archivo5']);
  
  $adj->setAdj_Relacion($_POST['codigo']);
  $adj->setAdj_Usuario($_SESSION['GD_Usuario']);
  $adj->setAdj_Estado('1');
  
  $arc = $_POST['archivo5'];
  $valores = explode('.', $arc);
  $extension = end($valores);
  $nombre = "CAP5_".$fechaL.$horaL.".".$extension;

  rename($ruta.$_POST['archivo5'], $ruta.$nombre);
  
  $adj->setAdj_Ruta($nombre);
  
  $resultado['resultado'] = $adj->insertar();
}

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $adj->imprimirError();
}
echo json_encode($resultado);
?>