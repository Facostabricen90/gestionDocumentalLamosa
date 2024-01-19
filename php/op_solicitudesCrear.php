<?php
include("op_sesion.php");
include("../class/solicitudes.php");
include("../class/historiales_flujos.php");
include("../class/flujos_aprobaciones.php");
include("../class/areas.php");
include("../class/parametros.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$par = new parametros();
$par->setPar_Codigo($_POST['tipoDocumento']);
$par->consultar();

$histF = new historiales_flujos();

$sol = new solicitudes();
$sol->setUsu_Codigo($_SESSION['GD_Usuario']);
$sol->setArea_Codigo($_POST['area']);
$sol->setSol_TipoDocumento($par->getPar_Nombre());
$sol->setSol_Fecha($fecha);
$sol->setSol_Hora($hora);
$sol->setSol_Tema($_POST['tema']);
$sol->setSol_NombreDocumento($_POST['tema']);
$sol->setSol_Observaciones($_POST['observaciones']);
$sol->setSol_TipoFlujo($par->getPar_TipoFlujo());
$sol->setSol_EstadoActual("Clasificación y Codificación");
$sol->setSol_PasoActual("2");
$sol->setSol_Estado("1");

if ($_POST['planta'] == "-1") {
    $sol->setSol_Tipo($usu->getPla_Codigo());
}else{
    $sol->setSol_Tipo($_POST['planta']);
}


$usu5 = new usuarios();
$usu5->setUsu_Codigo($sol->getUsu_Codigo());
$usu5->consultar();

$resultado['resultado'] = $sol->insertar();

if ($resultado['resultado']) {
    $resultado['mensaje'] = "OK";
    $resSolCod = $sol->codigoSolicitudCreadaUsuario($_SESSION['GD_Usuario']);
    $resultado['planta']= $sol->getSol_Tipo();
    $resultado['codigo']= $resSolCod[0];

    $sol->setSol_Codigo($resSolCod[0]);
    $sol->consultar();

    $area = new areas();
    $area->setArea_Codigo($sol->getArea_Codigo());
    $area->consultar();

    $sol->setSol_CodigoRadicado($resSolCod[0]);

    $sol->actualizar();

    $histF->setSol_Codigo($resSolCod[0]);
    $histF->setUsu_Codigo($_SESSION['GD_Usuario']);
    $histF->setHistF_Paso("1");
    $histF->setHistF_Clasificacion("Solicitado");
    $histF->setHistF_Observacion("Usuario Crea Solicitud y se notifica");
    $histF->setHistF_FechaHora($fecha . " " . $hora);
    $histF->setHistF_Estado("1");

    $histF->insertar();

    $fluA = new flujos_aprobaciones();
    $resCorr = $fluA->listarCorreosPasosNotificarTipoFlujo($_POST['area'], "2", $par->getPar_TipoFlujo());

    //librerias
    require '../ext/PHPMailer/PHPMailerAutoload.php';
    $mail = new PHPMailer();

    //Create a new PHPMailer instance
    $mail->IsSMTP();

    //Configuracion servidor mail
    $mail->FromName = sprintf('Nueva Solicitud');
    $mail->From = "sistemasugerencias@lamosa.com"; //remitente
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = ''; //seguridad
    $mail->Host = "smtp.office365.com"; // servidor smtp
    $mail->Port = 587; //puerto 587
    $mail->Username = 'sistemasugerencias@lamosa.com'; //nombre usuario
    $mail->Password = 'srzqmnvmsxjlszqw'; //contraseña
    //Agregar destinatario
    //$mail->AddAddress("cristian.posada@etexgroup.com");
    $mail->AddAddress("daniel.herrera@sanlorenzo.com.co");
    $mail->AddAddress("oalopez@sanlorenzo.com.co");

//	foreach($resCorr as $registro){
//		$mail->AddAddress($registro[1]);
//	}
    //$mail->AddBCC("mercadeo@colombiataxis.com");

    $mail->Subject = sprintf('Nueva Solicitud');
    $mail->Body = utf8_decode(sprintf('Datos Nueva Solicitud:
	
	Tipo Documento: %s
	Tema: %s
	Area: %s
	Usuario Solicita: %s
	Observaciones: %s

	Atte,
	Cerámica San Lorenzo
  
  Mensaje Automático por la plataforma gestiondocumental.sanlorenzo.com.co', $par->getPar_Nombre(), $_POST['tema'], $area->getArea_Nombre(), $usu->getUsu_Nombre() . " " . $usu->getUsu_Apellido(), $_POST['observaciones']));

    //$archivo = '../images/tempSospechoso/'.$fecha."_".$hora.'.pdf';
    //$mail->AddAttachment($archivo,"Sospechosos.pdf");
    //Avisar si fue enviado o no y dirigir al index
    $mail->Send();
} else {
    $resultado['mensaje'] = $sol->imprimirError();
}
echo json_encode($resultado);
?>