<?php
include("op_sesion.php");
include("../class/solicitudes.php");
include("../class/parametros.php");
include("funciones_especiales.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");
$fecha2 = date("Ymd");
$hora2 = date("His");

$resultado = array();

$par = new parametros();

$sol = new solicitudes();
$sol->setSol_Codigo($_POST['codigo']);
$sol->consultar();

$sol->setUsu_Codigo($_POST['usuario']);
$sol->setArea_Codigo($_POST['area']);
$sol->setSol_CodigoRadicado($_POST['codigoRadicado']);
$sol->setSol_CodigoDocumento($_POST['codigoDocumento']);
$sol->setSol_NombreDocumento($_POST['nombreDocumento']);
$sol->setSol_HistorialVersion($_POST['historialVersion']);
$sol->setSol_TipoDocumento($_POST['tipoDocumento']);
$sol->setSol_Fecha($_POST['fecha']);

if($sol->getSol_TipoFlujo() == "3"){
  $resNomEst = $par->hallarNombrePasoPorOrdenEHS($_POST['pasoActual']);
}else{
  $resNomEst = $par->hallarNombrePasoPorOrden($_POST['pasoActual']);
}

$sol->setSol_EstadoActual($resNomEst[0]);
$sol->setSol_PasoActual($_POST['pasoActual']);
$sol->setSol_Estado($_POST['estado']);
$sol->setSol_AccionDocumento($_POST['accionDocumento']);
$sol->setSol_TipoFlujo($_POST['tipoFlujo']);
$sol->setSol_Observaciones($_POST['observaciones']);

if($_POST['formato'] != ""){		
  $ruta1 = "../imagenes/formatos/";

  $arc1 = $_POST['formato'];
  $valores1 = explode('.', $arc1);
  $extension1 = end($valores1);
  $nombre_foto1 = eliminar_caracteres($sol->getSol_CodigoDocumento())."_".eliminar_caracteres($sol->getSol_NombreDocumento())."_Formato".$fecha2.$hora2.".".$extension1;

  rename($ruta1.$_POST['formato'], $ruta1.$nombre_foto1);
  $sol->setSol_Formato($nombre_foto1);
}

if($_POST['PDF'] != ""){		
  $ruta2 = "../imagenes/PDF/";

  $arc2 = $_POST['PDF'];
  $valores2 = explode('.', $arc2);
  $extension2 = end($valores2);
  $nombre_foto2 = eliminar_caracteres($sol->getSol_CodigoDocumento())."_".eliminar_caracteres($sol->getSol_NombreDocumento())."_PDF".$fecha2.$hora2.".".$extension2;

  rename($ruta2.$_POST['PDF'], $ruta2.$nombre_foto2);
  $sol->setSol_PDF($nombre_foto2);
}

$resultado['resultado'] = $sol->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $sol->imprimirError();
}
echo json_encode($resultado);
?>