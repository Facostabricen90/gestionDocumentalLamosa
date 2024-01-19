<?php
session_start();
include("../class/operarios.php");

$ope = new operarios($_SESSION['GDOPE_Usuario']);
$ope->consultar();

$conf_titulo = "GESTIÓN DOCUMENTAL";
if(!isset($_SESSION['GDOPE_Usuario'])){
	header("Location: op_cerrarSesion.php");
	exit;
}
?>