<?php
include("op_sesion.php");
include("../class/adjuntos.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$adj = new adjuntos();

$adj->setAdj_Codigo($_POST['codajunto']);
$adj->consultar();

  $resultado['resultado'] = $adj->eliminar();

if($resultado['resultado']){
  $resultado['mensaje'] = "OK";
}else{
  $resultado['mensaje'] = $adj->imprimirError();

}
echo json_encode($resultado);
?>