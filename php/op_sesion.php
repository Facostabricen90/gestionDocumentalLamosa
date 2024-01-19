<?php
session_start();
include("../class/usuarios.php");
include("../class/usuarios_permisos.php");
$usuper = new usuarios_permisos();

$usu = new usuarios($_SESSION['GD_Usuario']);
$usu->consultar();

$conf_titulo = "GESTIÓN DOCUMENTAL";
if(!isset($_SESSION['GD_Usuario'])){
	header("Location: op_cerrarSesion.php");
	exit;
}
?>