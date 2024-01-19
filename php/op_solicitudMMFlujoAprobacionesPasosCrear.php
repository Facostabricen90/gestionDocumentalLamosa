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
$fecha2 = date("Ymd");
$hora2 = date("His");

$resultado = array();

$fluA = new flujos_aprobaciones();
$histF = new historiales_flujos();
$par = new parametros();

$sol = new solicitudes();
$sol->setSol_Codigo($_POST['codigo']);
$sol->consultar();

$usu5 = new usuarios();
$usu5->setUsu_Codigo($sol->getUsu_Codigo());
$usu5->consultar();

$area = new areas();
$area->setArea_Codigo($sol->getArea_Codigo());
$area->consultar();

$par->setPar_Codigo($sol->getSol_TipoDocumento());
$par->consultar();

if ($_POST['paso'] == "2") {
    $sol->setSol_EstadoActual("Revisión EHS");
    $sol->setSol_PasoActual("3");

    if ($_POST['archivo'] != "") {
        $ruta1 = "../imagenes/formatos/";

        $arc1 = $_POST['archivo'];
        $valores1 = explode('.', $arc1);
        $extension1 = end($valores1);
        $nombre_foto1 = eliminar_caracteres($sol->getSol_TipoDocumento()) . "_JefeAreaSol_" . $fecha2 . $hora2 . "." . $extension1;

        rename($ruta1 . $_POST['archivo'], $ruta1 . $nombre_foto1);
        $sol->setSol_Formato($nombre_foto1);
    }

    $resultado['resultado'] = $sol->actualizar();
}

if ($_POST['paso'] == "3") {
    $sol->setSol_EstadoActual("Ajustes");
    $sol->setSol_PasoActual("4");

    if ($_POST['archivo'] != "") {
        $ruta1 = "../imagenes/formatos/";

        $arc1 = $_POST['archivo'];
        $valores1 = explode('.', $arc1);
        $extension1 = end($valores1);
        $nombre_foto1 = eliminar_caracteres($sol->getSol_TipoDocumento()) . "_EHSSol_" . $fecha2 . $hora2 . "." . $extension1;

        rename($ruta1 . $_POST['archivo'], $ruta1 . $nombre_foto1);
        $sol->setSol_Formato($nombre_foto1);
    }

    $resultado['resultado'] = $sol->actualizar();
}

if ($_POST['paso'] == "4") {
    $sol->setSol_EstadoActual("Revisión Jefe Área");
    $sol->setSol_PasoActual("5");

    if ($_POST['archivo'] != "") {
        $ruta1 = "../imagenes/formatos/";

        $arc1 = $_POST['archivo'];
        $valores1 = explode('.', $arc1);
        $extension1 = end($valores1);
        $nombre_foto1 = eliminar_caracteres($sol->getSol_TipoDocumento()) . "_" . $fecha2 . $hora2 . "." . $extension1;

        rename($ruta1 . $_POST['archivo'], $ruta1 . $nombre_foto1);
        $sol->setSol_Formato($nombre_foto1);
    }

    $resultado['resultado'] = $sol->actualizar();
}

if ($_POST['paso'] == "5") {

    $sol->setSol_EstadoActual("Revisión EHS");
    $sol->setSol_PasoActual("6");

    if ($_POST['archivo'] != "") {
        $ruta1 = "../imagenes/formatos/";

        $arc1 = $_POST['archivo'];
        $valores1 = explode('.', $arc1);
        $extension1 = end($valores1);
        $nombre_foto1 = eliminar_caracteres($sol->getSol_TipoDocumento()) . "_JefeArea_" . $fecha2 . $hora2 . "." . $extension1;

        rename($ruta1 . $_POST['archivo'], $ruta1 . $nombre_foto1);
        $sol->setSol_Formato($nombre_foto1);
    }

    $resultado['resultado'] = $sol->actualizar();
}

if ($_POST['paso'] == "6") {
    $sol->setSol_EstadoActual("Subir PDF");
    $sol->setSol_PasoActual("7");

    if ($_POST['archivo'] != "") {
        $ruta1 = "../imagenes/formatos/";

        $arc1 = $_POST['archivo'];
        $valores1 = explode('.', $arc1);
        $extension1 = end($valores1);
        $nombre_foto1 = eliminar_caracteres($sol->getSol_TipoDocumento()) . "_EHS_" . $fecha2 . $hora2 . "." . $extension1;

        rename($ruta1 . $_POST['archivo'], $ruta1 . $nombre_foto1);
        $sol->setSol_Formato($nombre_foto1);
    }

    $resultado['resultado'] = $sol->actualizar();
}

if ($_POST['paso'] == "7") {
    $sol->setSol_EstadoActual("Divulgado");
    $sol->setSol_PasoActual("8");

    if ($_POST['archivo'] != "") {
        $ruta1 = "../imagenes/PDF/";

        $arc1 = $_POST['archivo'];
        $valores1 = explode('.', $arc1);
        $extension1 = end($valores1);
        $nombre_foto1 = eliminar_caracteres($sol->getSol_TipoDocumento()) . "_" . $fecha2 . $hora2 . "." . $extension1;

        rename($ruta1 . $_POST['archivo'], $ruta1 . $nombre_foto1);
        $sol->setSol_PDF($nombre_foto1);
    }
    $resultado['resultado'] = $sol->actualizar();
}

if ($_POST['paso'] == "8") {
    $sol->setSol_EstadoActual("Publicado");
    $sol->setSol_PasoActual("9");

    $resultado['resultado'] = $sol->actualizar();
}

if ($resultado['resultado']) {
    $resultado['mensaje'] = "OK";
    $resSolCod = $_POST['codigo'];
    $resultado['planta'] = $usu5->getPla_Codigo();
    $resultado['areas'] = $area->getArea_Codigo();

    if ($_POST['paso'] == "2") {
        $histF->setSol_Codigo($resSolCod);
        $histF->setUsu_Codigo($_SESSION['GD_Usuario']);
        $histF->setHistF_Paso("2");
        $histF->setHistF_Clasificacion($_POST['calificacion']);
        $histF->setHistF_Observacion($_POST['observaciones']);
        $histF->setHistF_FechaHora($fecha . " " . $hora);
        $histF->setHistF_Estado("1");
        $histF->setHistF_Adjunto($nombre_foto1);

        $histF->insertar();

        $resCorr = $fluA->listarCorreosPasosNotificarTipoFlujo($sol->getArea_Codigo(), "3", $sol->getSol_TipoFlujo());

        foreach ($resCorr as $registro) {
            $destinatario = $registro[1];

            $asunto = "Revisión EHS";

            $cuerpo = sprintf('
			<html> 
			<head> 
				<meta charset="utf-8">
				<title>Gestón Documental</title> 
			</head> 
			<body> 
			<img src="https://gestiondocumental.sanlorenzo.com.co/imagenes/logosl.PNG" style="width: 250px">
			<h3 aling="center">Gestión Documental</h3>
			<p>Revisión EHS:</p>
			<p><strong>Tipo Documento: </strong>%s</p>
			<p><strong>Área: </strong>%s</p>
			<p><strong>Fecha Solicitud: </strong>%s</p>
			<p><strong>Usuario Solicita: </strong>%s</p>
			<p><strong>Observaciones: </strong>%s</p>
			<br>
			<p>Mensaje Automático por la plataforma gestiondocumental.sanlorenzo.com.co</p>
			</body>

			</html> 

			', $sol->getSol_TipoDocumento(), $area->getArea_Nombre(), $sol->getSol_Fecha(), $usu5->getUsu_Nombre() . " " . $usu5->getUsu_Apellido(), $_POST['observaciones']);

            //para el envío en formato HTML 
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

            //dirección del remitente 
            $headers .= "From: Gestión Documental <gestiondocumental@sanlorenzo-it.com>\r\n";

            mail($destinatario, utf8_decode($asunto), utf8_decode($cuerpo), utf8_decode($headers));
        }
    }

    if ($_POST['paso'] == "3") {
        $histF->setSol_Codigo($resSolCod);
        $histF->setUsu_Codigo($_SESSION['GD_Usuario']);
        $histF->setHistF_Paso("3");
        $histF->setHistF_Clasificacion($_POST['calificacion']);
        $histF->setHistF_Observacion($_POST['observaciones']);
        $histF->setHistF_FechaHora($fecha . " " . $hora);
        $histF->setHistF_Estado("1");
        $histF->setHistF_Adjunto($nombre_foto1);

        $histF->insertar();

        $resCorr = $fluA->listarCorreosPasosNotificarTipoFlujo($sol->getArea_Codigo(), "4", $sol->getSol_TipoFlujo());

        foreach ($resCorr as $registro) {
            $destinatario .= $registro[1];
        }

        $asunto = "Solicitud Para Gestionar";

        $cuerpo = sprintf('
		<html> 
		<head> 
			<meta charset="utf-8">
			<title>Gestón Documental</title> 
		</head> 
		<body> 
		<img src="https://gestiondocumental.sanlorenzo.com.co/imagenes/logosl.PNG" style="width: 250px">
		<h3 aling="center">Gestión Documental</h3>
		<p>Ajustes:</p>
		<p><strong>Tipo Documento: </strong>%s</p>
		<p><strong>Área: </strong>%s</p>
		<p><strong>Fecha Solicitud: </strong>%s</p>
		<p><strong>Usuario Solicita: </strong>%s</p>
		<p><strong>Observaciones: </strong>%s</p>
		<br>
		<p>Mensaje Automático por la plataforma gestiondocumental.sanlorenzo.com.co</p>
		</body>

		</html> 

		', $sol->getSol_TipoDocumento(), $area->getArea_Nombre(), $sol->getSol_Fecha(), $usu5->getUsu_Nombre() . " " . $usu5->getUsu_Apellido(), $_POST['observaciones']);

        //para el envío en formato HTML 
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

        //dirección del remitente 
        $headers .= "From: Gestión Documental <gestiondocumental@sanlorenzo-it.com>\r\n";

        mail($destinatario, utf8_decode($asunto), utf8_decode($cuerpo), utf8_decode($headers));
    }

    if ($_POST['paso'] == "4") {
        $histF->setSol_Codigo($resSolCod);
        $histF->setUsu_Codigo($_SESSION['GD_Usuario']);
        $histF->setHistF_Paso("4");

        $histF->setHistF_Clasificacion("Ajustado");

        $histF->setHistF_Observacion($_POST['observaciones']);
        $histF->setHistF_FechaHora($fecha . " " . $hora);
        $histF->setHistF_Estado("1");
        $histF->setHistF_Adjunto($nombre_foto1);

        $histF->insertar();

        $resCorr = $fluA->listarCorreosPasosNotificarTipoFlujo($sol->getArea_Codigo(), "5", $sol->getSol_TipoFlujo());

        foreach ($resCorr as $registro) {
            $destinatario = $registro[1];
        }

        $asunto = "Solicitud Para Gestionar";

        $cuerpo = sprintf('
		<html> 
		<head> 
			<meta charset="utf-8">
			<title>Gestón Documental</title> 
		</head> 
		<body> 
		<img src="https://gestiondocumental.sanlorenzo.com.co/imagenes/logosl.PNG" style="width: 250px">
		<h3 aling="center">Gestión Documental</h3>
		<p>Revisión:</p>
		<p><strong>Tipo Documento: </strong>%s</p>
		<p><strong>Área: </strong>%s</p>
		<p><strong>Fecha Solicitud: </strong>%s</p>
		<p><strong>Usuario Solicita: </strong>%s</p>
		<p><strong>Observaciones: </strong>%s</p>
		<br>
		<p>Mensaje Automático por la plataforma gestiondocumental.sanlorenzo.com.co</p>
		</body>

		</html> 

		', $sol->getSol_TipoDocumento(), $area->getArea_Nombre(), $sol->getSol_Fecha(), $usu5->getUsu_Nombre() . " " . $usu5->getUsu_Apellido(), $_POST['observaciones']);

        //para el envío en formato HTML 
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

        //dirección del remitente 
        $headers .= "From: Gestión Documental <gestiondocumental@sanlorenzo-it.com>\r\n";

        mail($destinatario, utf8_decode($asunto), utf8_decode($cuerpo), utf8_decode($headers));
    }

    if ($_POST['paso'] == "5") {
        $histF->setSol_Codigo($resSolCod);
        $histF->setUsu_Codigo($_SESSION['GD_Usuario']);
        $histF->setHistF_Paso("5");
        $histF->setHistF_Clasificacion("Revisión Jefe Área");
        $histF->setHistF_Observacion($_POST['observaciones']);
        $histF->setHistF_FechaHora($fecha . " " . $hora);
        $histF->setHistF_Estado("1");
        $histF->setHistF_Adjunto($nombre_foto1);

        $histF->insertar();

        $resCorr = $fluA->listarCorreosPasosNotificarTipoFlujo($sol->getArea_Codigo(), "6", $sol->getSol_TipoFlujo());

        foreach ($resCorr as $registro) {
            $destinatario = $registro[1];
        }

        $asunto = "Solicitud Para Gestionar";

        $cuerpo = sprintf('
    <html> 
    <head> 
      <meta charset="utf-8">
      <title>Gestón Documental</title> 
    </head> 
    <body> 
    <img src="https://gestiondocumental.sanlorenzo.com.co/imagenes/logosl.PNG" style="width: 250px">
    <h3 aling="center">Gestión Documental</h3>
    <p>Revisión EHS:</p>
    <p><strong>Tipo Documento: </strong>%s</p>
    <p><strong>Área: </strong>%s</p>
    <p><strong>Fecha Solicitud: </strong>%s</p>
    <p><strong>Usuario Solicita: </strong>%s</p>
    <p><strong>Observaciones: </strong>%s</p>
    <br>
    <p>Mensaje Automático por la plataforma gestiondocumental.sanlorenzo.com.co</p>
    </body>

    </html> 

    ', $sol->getSol_TipoDocumento(), $area->getArea_Nombre(), $sol->getSol_Fecha(), $usu5->getUsu_Nombre() . " " . $usu5->getUsu_Apellido(), $_POST['observaciones']);

        //para el envío en formato HTML 
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

        //dirección del remitente 
        $headers .= "From: Gestión Documental <gestiondocumental@sanlorenzo-it.com>\r\n";

        mail($destinatario, utf8_decode($asunto), utf8_decode($cuerpo), utf8_decode($headers));
    }

    if ($_POST['paso'] == "6") {
        $histF->setSol_Codigo($resSolCod);
        $histF->setUsu_Codigo($_SESSION['GD_Usuario']);
        $histF->setHistF_Paso("6");
        $histF->setHistF_Clasificacion("Revisión EHS");
        $histF->setHistF_Observacion($_POST['observaciones']);
        $histF->setHistF_FechaHora($fecha . " " . $hora);
        $histF->setHistF_Estado("1");
        $histF->setHistF_Adjunto($nombre_foto1);

        $histF->insertar();

        $resCorr = $fluA->listarCorreosPasosNotificarTipoFlujo($sol->getArea_Codigo(), "7", $sol->getSol_TipoFlujo());

        foreach ($resCorr as $registro) {
            $destinatario = $registro[1];
        }

        $asunto = "Solicitud Para Gestionar";

        $cuerpo = sprintf('
    <html> 
    <head> 
      <meta charset="utf-8">
      <title>Gestón Documental</title> 
    </head> 
    <body> 
    <img src="https://gestiondocumental.sanlorenzo.com.co/imagenes/logosl.PNG" style="width: 250px">
    <h3 aling="center">Gestión Documental</h3>
    <p>Subir PDF:</p>
    <p><strong>Tipo Documento: </strong>%s</p>
    <p><strong>Área: </strong>%s</p>
    <p><strong>Fecha Solicitud: </strong>%s</p>
    <p><strong>Usuario Solicita: </strong>%s</p>
    <p><strong>Observaciones: </strong>%s</p>
    <br>
    <p>Mensaje Automático por la plataforma gestiondocumental.sanlorenzo.com.co</p>
    </body>

    </html> 

    ', $sol->getSol_TipoDocumento(), $area->getArea_Nombre(), $sol->getSol_Fecha(), $usu5->getUsu_Nombre() . " " . $usu5->getUsu_Apellido(), $_POST['observaciones']);

        //para el envío en formato HTML 
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

        //dirección del remitente 
        $headers .= "From: Gestión Documental <gestiondocumental@sanlorenzo-it.com>\r\n";

        mail($destinatario, utf8_decode($asunto), utf8_decode($cuerpo), utf8_decode($headers));
    }

    if ($_POST['paso'] == "7") {
        $histF->setSol_Codigo($resSolCod);
        $histF->setUsu_Codigo($_SESSION['GD_Usuario']);
        $histF->setHistF_Paso("7");
        $histF->setHistF_Clasificacion("Subir PDF");
        $histF->setHistF_Observacion($_POST['observaciones']);
        $histF->setHistF_FechaHora($fecha . " " . $hora);
        $histF->setHistF_Estado("1");
        $histF->setHistF_Adjunto($nombre_foto1);

        $histF->insertar();

        $resCorr = $fluA->listarCorreosPasosNotificarTipoFlujo($sol->getArea_Codigo(), "8", $sol->getSol_TipoFlujo());

        foreach ($resCorr as $registro) {
            $destinatario = $registro[1];
        }

        $asunto = "Solicitud Para Gestionar";

        $cuerpo = sprintf('
    <html> 
    <head> 
      <meta charset="utf-8">
      <title>Gestón Documental</title> 
    </head> 
    <body> 
    <img src="https://gestiondocumental.sanlorenzo.com.co/imagenes/logosl.PNG" style="width: 250px">
    <h3 aling="center">Gestión Documental</h3>
    <p>Divulgación:</p>
    <p><strong>Tipo Documento: </strong>%s</p>
    <p><strong>Área: </strong>%s</p>
    <p><strong>Fecha Solicitud: </strong>%s</p>
    <p><strong>Usuario Solicita: </strong>%s</p>
    <p><strong>Observaciones: </strong>%s</p>
    <br>
    <p>Mensaje Automático por la plataforma gestiondocumental.sanlorenzo.com.co</p>
    </body>

    </html> 

    ', $sol->getSol_TipoDocumento(), $area->getArea_Nombre(), $sol->getSol_Fecha(), $usu5->getUsu_Nombre() . " " . $usu5->getUsu_Apellido(), $_POST['observaciones']);

        //para el envío en formato HTML 
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

        //dirección del remitente 
        $headers .= "From: Gestión Documental <gestiondocumental@sanlorenzo-it.com>\r\n";

        mail($destinatario, utf8_decode($asunto), utf8_decode($cuerpo), utf8_decode($headers));
    }

    if ($_POST['paso'] == "8") {
        $histF->setSol_Codigo($resSolCod);
        $histF->setUsu_Codigo($_SESSION['GD_Usuario']);
        $histF->setHistF_Paso("8");
        $histF->setHistF_Clasificacion("Divulgación");
        $histF->setHistF_Observacion($_POST['observaciones']);
        $histF->setHistF_FechaHora($fecha . " " . $hora);
        $histF->setHistF_Estado("1");

        $histF->insertar();
    }
} else {
    $resultado['mensaje'] = $sol->imprimirError();
}
echo json_encode($resultado);
?>