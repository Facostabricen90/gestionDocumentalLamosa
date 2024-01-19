<?php

include("op_sesion.php");
include("../class/solicitudes.php");
include("../class/historiales_flujos.php");
include("../class/flujos_aprobaciones.php");
include("../class/areas.php");
include("../class/parametros.php");
include("funciones_especiales.php");

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
$sol->setSol_Observaciones($_POST['observaciones']);
$sol->setSol_AccionDocumento($_POST['accionDocumento']);
$sol->setSol_TipoFlujo($par->getPar_TipoFlujo());
$sol->setSol_EstadoActual("Revisión Jefe Área");
$sol->setSol_PasoActual("2");
$sol->setSol_Estado("1");
$sol->setSol_Tipo($usu->getPla_Codigo());
$sol->setSol_CodigoDocumento($_POST['codigoDocumento']);
$sol->setSol_NombreDocumento($_POST['nombreDocumento']);
$sol->setSol_HistorialVersion($_POST['historialVersion']);
$sol->setSol_Tema($_POST['tema']);

$usu5 = new usuarios();
$usu5->setUsu_Codigo($sol->getUsu_Codigo());
$usu5->consultar();

if ($_POST['archivo'] != "") {
    $ruta1 = "../imagenes/formatos/";

    $arc1 = $_POST['archivo'];
    $valores1 = explode('.', $arc1);
    $extension1 = end($valores1);
    $nombre_foto1 = eliminar_caracteres($par->getPar_Nombre()) . "_" . $fecha2 . $hora2 . "." . $extension1;

    rename($ruta1 . $_POST['archivo'], $ruta1 . $nombre_foto1);
    $sol->setSol_Formato($nombre_foto1);
}

$resultado['resultado'] = $sol->insertar();

if ($resultado['resultado']) {
    $resultado['mensaje'] = "OK";
    $resSolCod = $sol->codigoSolicitudCreadaUsuario($_SESSION['GD_Usuario']);
    $resultado['planta'] = $usu5->getPla_Codigo();

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
    $histF->setHistF_Clasificacion("Solicitado - " . $_POST['accionDocumento']);
    $histF->setHistF_Observacion("Usuario Crea Solicitud y se notifica");
    $histF->setHistF_FechaHora($fecha . " " . $hora);
    $histF->setHistF_Estado("1");

    $histF->insertar();

    $fluA = new flujos_aprobaciones();
    $resCorr = $fluA->listarCorreosPasosNotificarTipoFlujo($_POST['area'], "2", $par->getPar_TipoFlujo());

    foreach ($resCorr as $registro) {
        $destinatario = $registro[1];

        $asunto = "Nueva Solicitud";

        $cuerpo = sprintf('

		<html> 
		<head> 
			<meta charset="utf-8">
			 <title>Gestón Documental</title> 
		</head> 
		<body> 
		<img src="https://gestiondocumental.sanlorenzo.com.co/imagenes/logosl.PNG" style="width: 250px">
		<h3 aling="center">Gestión Documental</h3>
		<p>Datos Nueva Solicitud:</p>
		<p><strong>Documento: </strong>%s</p>
		<p><strong>Tipo Documento: </strong>%s</p>
		<p><strong>Área: </strong>%s</p>
		<p><strong>Usuario Solicita: </strong>%s</p>
		<p><strong>Observaciones: </strong>%s</p>
		<br>
		<p>Mensaje Automático por la plataforma gestiondocumental.sanlorenzo.com.co</p>
		</body>


		</html> 

		', $_POST['accionDocumento'], $par->getPar_Nombre(), $area->getArea_Nombre(), $usu->getUsu_Nombre() . " " . $usu->getUsu_Apellido(), $_POST['observaciones']);

        //para el envío en formato HTML 

        $headers = "MIME-Version: 1.0\r\n";

        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

        //dirección del remitente 

        $headers .= "From: Gestión Documental <gestiondocumental@sanlorenzo-it.com>\r\n";
        //$headers .= "Bcc: willyelcalvo0310@gmail.com\r\n";
        //direcciones que recibirán copia oculta 
        //$headers .= "Bcc: davidfernando555@hotmail.com\r\n"; 
        //$headers .= "Bcc: willy0310_@hotmail.com\r\n"; 
        //$headers .= "Bcc: davidfernando5555@gmail.com\r\n";

        mail($destinatario, utf8_decode($asunto), utf8_decode($cuerpo), utf8_decode($headers));
    }
} else {
    $resultado['mensaje'] = $sol->imprimirError();
}
echo json_encode($resultado);
?>