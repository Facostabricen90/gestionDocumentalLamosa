<?php
include("op_sesion.php");



$resultado = array();
if($_POST['num']!=''){
  $num = substr("00".$_POST['num'], -3);
}
$cod = $_POST['planta'].$_POST['tipo'].$_POST['area'].$num;

$resultado['codigo'] = $cod;



echo json_encode($resultado);
?>