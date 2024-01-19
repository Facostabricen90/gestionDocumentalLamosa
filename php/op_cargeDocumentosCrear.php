<?php
include("op_sesion.php");
include("../class/solicitudes.php");
include("../class/historiales_flujos.php");
include("funciones_especiales.php");
include("../class/parametros.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$histF = new historiales_flujos();

$par = new parametros();
$par->setPar_Codigo($_POST['tipoDocumento']);
$par->consultar();

$sol = new solicitudes();

$sol->setUsu_Codigo($_POST['usuario']);
$sol->setArea_Codigo($_POST['area']);
$sol->setSol_CodigoDocumento($_POST['codigo']);
$sol->setSol_NombreDocumento($_POST['nombre']);
$sol->setSol_HistorialVersion($_POST['version']);
$sol->setSol_Formato(NULL);
$sol->setSol_TipoDocumento($_POST['tipoDocumento']);
$sol->setSol_Tipo(NULL);
$sol->setSol_TipoFlujo($par->getPar_TipoFlujo());
$sol->setSol_Fecha($fecha);
$sol->setSol_Hora($hora);
$sol->setSol_Tema('CARGUE MASIVO');
$sol->setSol_Observaciones($_POST['observacion']);
$sol->setSol_PasoActual('12');
$sol->setSol_EstadoActual('Publicado');
$sol->setSol_Estado('1');
$sol->setSol_AprobacionSolicitud('NULL');
$sol->setSol_AccionDocumento('NULL');

if($_POST['archivo'] != ""){		
		$ruta1 = "../imagenes/PDF/";

		$arc1 = $_POST['archivo'];
		$valores1 = explode('.', $arc1);
		$extension1 = end($valores1);
		$nombre_foto1 = eliminar_caracteres($_POST['codigo'])."_".eliminar_caracteres($_POST['nombre'])."_".$fecha2.$hora2.".".$extension1;

		rename($ruta1.$_POST['archivo'], $ruta1.$nombre_foto1);
		$sol->setSol_PDF($nombre_foto1);
	}


$resultado['resultado'] = $sol->insertar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
  $resSolCod = $sol->codigoSolicitudCreadaUsuario($_POST['usuario']);
  
  $sol->setSol_Codigo($resSolCod[0]);
  $sol->consultar();
  
  $sol->setSol_CodigoRadicado($resSolCod[0]);
  
  $sol->actualizar();
  
  $histF->setSol_Codigo($resSolCod[0]);
  $histF->setUsu_Codigo($_SESSION['GD_Usuario']);
  $histF->setHistF_Paso("1");
  $histF->setHistF_Clasificacion("Solicitado");
  $histF->setHistF_Observacion("Usuario Crea Solicitud y se notifica");
  $histF->setHistF_FechaHora($fecha." ".$hora);
  $histF->setHistF_Estado("1");
  
  $histF->insertar();
}else{
	$resultado['mensaje'] = $sol->imprimirError();
}
echo json_encode($resultado);
?>
