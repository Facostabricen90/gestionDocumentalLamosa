<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
include("op_sesion.php");
include("../class/solicitudes.php");
include("../class/historiales_flujos.php");
include("../class/flujos_aprobaciones.php");
include("../class/areas.php");
include("../class/parametros.php");
include("funciones_especiales.php");
include("../class/plantillas_documentos.php");

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
$nombre_foto1 = '';
$Mail = '';
$validar = 0;

if ($_POST['paso'] == "2") {
    $resNomPar = $par->hallarNombrePasoPorOrden($_POST['pasoSiguiente']);

    $sol->setSol_EstadoActual($resNomPar[0]);
    $sol->setSol_PasoActual($_POST['pasoSiguiente']);
    $sol->setSol_CodigoDocumento($_POST['codigoDocumento']);
    $sol->setSol_TipoDocumento($_POST['tipoDocumento']);
    $sol->setSol_NombreDocumento($_POST['nombreDocumento']);
    $sol->setSol_HistorialVersion($_POST['historialVersion']);
    $sol->setSol_AccionDocumento($_POST['accionDocumento']);
    $sol->setSol_Tipo($_POST['planta']);

    $area_planta = new areas();
    $codigoareaactual = $area_planta->codigoAreaPlantaNombre($area->getArea_Nombre(), $_POST['planta']);
    $resultado['codigoareaplanta'] = $area->getArea_Nombre();
    if ($codigoareaactual != NULL) {
        if ($codigoareaactual != $sol->getArea_Codigo()) {
            $sol->setArea_Codigo($codigoareaactual);
        }
    }

    if ($_POST['formato'] != "NO APLICA") {
        $ruta1 = "../imagenes/formatos/";

        $arc1 = $_POST['formato'];
        $valores1 = explode('.', $arc1);
        $extension1 = end($valores1);
        $nombre_foto1 = $_POST['codigo'] . "_" . $fecha2 . $hora2 . "." . $extension1;

        rename($ruta1 . $_POST['formato'], $ruta1 . $nombre_foto1);
        $sol->setSol_Formato($nombre_foto1);
    } else {
        $plan = new plantillas_documentos();
        $resPlant = $plan->cargarPlantillaTipoDocumento($sol->getSol_TipoDocumento());
        if ($resPlant) {
            $sol->setSol_Formato($resPlant[0]);
        }
    }

    $resultado['resultado'] = $sol->actualizar();
}

if ($_POST['paso'] == "3") {
    $sol->setSol_EstadoActual("Elaboración");
    $sol->setSol_PasoActual("4");

    $resultado['resultado'] = $sol->actualizar();
}

if ($_POST['paso'] == "4") {
    $sol->setSol_EstadoActual("Revisión");
    $sol->setSol_PasoActual("5");

    if ($_POST['archivo'] != "") {
        $ruta1 = "../imagenes/formatos/";

        $arc1 = $_POST['archivo'];
        $valores1 = explode('.', $arc1);
        $extension1 = end($valores1);
        $nombre_foto1 = eliminar_caracteres($sol->getSol_CodigoDocumento()) . "_" . eliminar_caracteres($sol->getSol_NombreDocumento()) . "_" . $fecha2 . $hora2 . "." . $extension1;

        rename($ruta1 . $_POST['archivo'], $ruta1 . $nombre_foto1);
        $sol->setSol_Formato($nombre_foto1);
    }

    $resultado['resultado'] = $sol->actualizar();
}

if ($_POST['paso'] == "5") {//7
    if ($_POST['calificacion'] == "Requiere Ajustes") {
        $sol->setSol_EstadoActual("Revisión Jefe");
        $sol->setSol_AjustePasos('1');
        $validar = 1;
        $sol->setSol_PasoActual("6");
    } else {
        $sol->setSol_EstadoActual("Revisión Jefe");
        $sol->setSol_AjustePasos('0');
        $sol->setSol_PasoActual("6");
    }
    if ($_POST['archivo'] != "") {
        $ruta1 = "../imagenes/formatos/";

        $arc1 = $_POST['archivo'];
        $valores1 = explode('.', $arc1);
        $extension1 = end($valores1);
        $nombre_foto1 = eliminar_caracteres($sol->getSol_CodigoDocumento()) . "_" . eliminar_caracteres($sol->getSol_NombreDocumento()) . "_" . $fecha2 . $hora2 . "." . $extension1;

        rename($ruta1 . $_POST['archivo'], $ruta1 . $nombre_foto1);
        $sol->setSol_Formato($nombre_foto1);
    }

    $resultado['resultado'] = $sol->actualizar();
}

if ($_POST['paso'] == "6") { //9
//	$sol->setSol_EstadoActual("Aprobación");
//	
//	if($_POST['calificacion'] == "Requiere Ajustes"){
//		$sol->setSol_EstadoActual("Ajuste Jefe Aprobador Final");
//		$sol->setSol_PasoActual("10");	
//	}else{
//		$sol->setSol_EstadoActual("Subir PDF");
//		$sol->setSol_PasoActual("11");
//	}
    if ($_POST['calificacion'] == "Requiere Ajustes") {
        $sol->setSol_EstadoActual("Ajuste");
        $sol->setSol_AjustePasos('1');
        $validar = 1;
        $sol->setSol_PasoActual("7");
    } elseif ($sol->getSol_AjustePasos() == '1') {
        $sol->setSol_EstadoActual("Ajuste");
        $sol->setSol_AjustePasos('1');
        $validar = 1;
        $sol->setSol_PasoActual("7");
    } else {
        $sol->setSol_EstadoActual("Revisión");
        $sol->setSol_AjustePasos('0');
        $sol->setSol_PasoActual("8");
    }
    if ($_POST['archivo'] != "") {
        $ruta1 = "../imagenes/formatos/";

        $arc1 = $_POST['archivo'];
        $valores1 = explode('.', $arc1);
        $extension1 = end($valores1);
        $nombre_foto1 = eliminar_caracteres($sol->getSol_CodigoDocumento()) . "_" . eliminar_caracteres($sol->getSol_NombreDocumento()) . "_" . $fecha2 . $hora2 . "." . $extension1;

        rename($ruta1 . $_POST['archivo'], $ruta1 . $nombre_foto1);
        $sol->setSol_Formato($nombre_foto1);
    }
    $resultado['resultado'] = $sol->actualizar();
}

if ($_POST['paso'] == "7") {//6
    $sol->setSol_EstadoActual("Revisión");
    $sol->setSol_PasoActual("8");

    if ($_POST['archivo'] != "") {
        $ruta1 = "../imagenes/formatos/";

        $arc1 = $_POST['archivo'];
        $valores1 = explode('.', $arc1);
        $extension1 = end($valores1);
        $nombre_foto1 = eliminar_caracteres($sol->getSol_CodigoDocumento()) . "_" . eliminar_caracteres($sol->getSol_NombreDocumento()) . "_" . $fecha2 . $hora2 . "." . $extension1;

        rename($ruta1 . $_POST['archivo'], $ruta1 . $nombre_foto1);
        $sol->setSol_Formato($nombre_foto1);
    }

    $resultado['resultado'] = $sol->actualizar();
}

if ($_POST['paso'] == "8") { //5
    $sol->setSol_EstadoActual("Aprobación Jefe");
    $sol->setSol_PasoActual("9");

    if ($_POST['archivo'] != "") {
        $ruta1 = "../imagenes/formatos/";

        $arc1 = $_POST['archivo'];
        $valores1 = explode('.', $arc1);
        $extension1 = end($valores1);
        $nombre_foto1 = eliminar_caracteres($sol->getSol_CodigoDocumento()) . "_" . eliminar_caracteres($sol->getSol_NombreDocumento()) . "_" . $fecha2 . $hora2 . "." . $extension1;

        rename($ruta1 . $_POST['archivo'], $ruta1 . $nombre_foto1);
        $sol->setSol_Formato($nombre_foto1);
    }

    $resultado['resultado'] = $sol->actualizar();
}

//if($_POST['paso'] == "8"){
//	$sol->setSol_EstadoActual("Aprobación");
//	$sol->setSol_PasoActual("9");
//	
//	if($_POST['archivo'] != ""){		
//		$ruta1 = "../imagenes/formatos/";
//
//		$arc1 = $_POST['archivo'];
//		$valores1 = explode('.', $arc1);
//		$extension1 = end($valores1);
//		$nombre_foto1 = eliminar_caracteres($sol->getSol_CodigoDocumento())."_".eliminar_caracteres($sol->getSol_NombreDocumento())."_".$fecha2.$hora2.".".$extension1;
//
//		rename($ruta1.$_POST['archivo'], $ruta1.$nombre_foto1);
//		$sol->setSol_Formato($nombre_foto1);
//	}
//
//	$resultado['resultado'] = $sol->actualizar();
//}

if ($_POST['paso'] == "9") {//10
//	$sol->setSol_EstadoActual("Subir PDF");
//	$sol->setSol_PasoActual("11");
//	
//	if($_POST['archivo'] != ""){		
//		$ruta1 = "../imagenes/formatos/";
//
//		$arc1 = $_POST['archivo'];
//		$valores1 = explode('.', $arc1);
//		$extension1 = end($valores1);
//		$nombre_foto1 = eliminar_caracteres($sol->getSol_CodigoDocumento())."_".eliminar_caracteres($sol->getSol_NombreDocumento())."_".$fecha2.$hora2.".".$extension1;
//
//		rename($ruta1.$_POST['archivo'], $ruta1.$nombre_foto1);
//		$sol->setSol_Formato($nombre_foto1);
//	}
    $sol->setSol_EstadoActual("Aprobación");

    $sol->setSol_EstadoActual("Subir PDF");
    $sol->setSol_PasoActual("10");

    $resultado['resultado'] = $sol->actualizar();
}

if ($_POST['paso'] == "10") {//11
    $sol->setSol_EstadoActual("Divulgado");
    $sol->setSol_PasoActual("11");

    if ($_POST['archivo'] != "") {
        $ruta1 = "../imagenes/PDF/";

        $arc1 = $_POST['archivo'];
        $valores1 = explode('.', $arc1);
        $extension1 = end($valores1);
        $nombre_foto1 = eliminar_caracteres($sol->getSol_CodigoDocumento()) . "-" . eliminar_caracteres($sol->getSol_NombreDocumento()) . "-" . $fecha2 . $hora2 . "." . $extension1;

        rename($ruta1 . $_POST['archivo'], $ruta1 . $nombre_foto1);
        $sol->setSol_PDF($nombre_foto1);
    }
    $resultado['resultado'] = $sol->actualizar();
}

if ($_POST['paso'] == "11") { //12
    $sol->setSol_EstadoActual("Publicado");
    $sol->setSol_PasoActual("12");
    $sol->setSol_FechaPublicacion($fecha . " " . $hora);

//	if($_POST['archivo'] != ""){		
//		$ruta1 = "../imagenes/PDF/";
//
//		$arc1 = $_POST['archivo'];
//		$valores1 = explode('.', $arc1);
//		$extension1 = end($valores1);
//		$nombre_foto1 = eliminar_caracteres($sol->getSol_CodigoDocumento())."_".eliminar_caracteres($sol->getSol_NombreDocumento())."_".$fecha2.$hora2.".".$extension1;
//
//		rename($ruta1.$_POST['archivo'], $ruta1.$nombre_foto1);
//		$sol->setSol_PDF($nombre_foto1);
//	}

    $resultado['resultado'] = $sol->actualizar();
}

if ($resultado['resultado']) {
    $resultado['mensaje'] = "OK";
    $resSolCod = $_POST['codigo'];
    $resultado['planta'] = $sol->getSol_Tipo();
    $resultado['areas'] = $area->getArea_Codigo();

    if ($_POST['paso'] == "2") {
        $histF->setSol_Codigo($resSolCod);
        $histF->setUsu_Codigo($_SESSION['GD_Usuario']);
        $histF->setHistF_Paso("2");
        $histF->setHistF_Clasificacion($_POST['accionDocumento']);
        $histF->setHistF_Observacion("Se Asigna Códgo, Nombre y Versión del Archivo");
        $histF->setHistF_FechaHora($fecha . " " . $hora);
        $histF->setHistF_Estado("1");

        $histF->insertar();

        $resCorr = $fluA->listarCorreosPasosNotificarTipoFlujo($sol->getArea_Codigo(), $_POST['pasoSiguiente'], $sol->getSol_TipoFlujo());

        //librerias
        /* require '../ext/PHPMailer/PHPMailerAutoload.php';
          $mail = new PHPMailer();

          //Create a new PHPMailer instance
          $mail->IsSMTP();

          //Configuracion servidor mail
          $mail->FromName = utf8_decode(sprintf('Asignación de Lineamientos'));
          $mail->From = "sistemasugerencias@lamosa.com"; //remitente
          $mail->SMTPAuth = true;
          $mail->SMTPSecure = ''; //seguridad
          $mail->Host = "smtp.office365.com"; // servidor smtp
          $mail->Port = 587; //puerto 587
          $mail->Username = 'sistemasugerencias@lamosa.com'; //nombre usuario
          $mail->Password = 'srzqmnvmsxjlszqw'; //contraseña
          //Agregar destinatario
          //$mail->AddAddress("cristian.posada@etexgroup.com");
          $mail->AddAddress("frank.acosta@colombiataxis.com");
          $mail->AddAddress("oalopez@sanlorenzo.com.co");

          foreach ($resCorr as $registro) {
          $mail->AddAddress($registro[1]);
          }
          $mail->AddBCC("mercadeo@colombiataxis.com");

          $mail->Subject = utf8_decode(sprintf('Asignación de Lineamientos'));
          $mail->Body = utf8_decode(sprintf('Asignación de Lineamientos:

          Tipo Documento: %s
          Código Documento: %s
          Nombre Documento: %s
          Versión: %s
          Área: %s
          Fecha Solicitud: %s
          Usuario Solicita: %s

          Atte,
          Cerámica San Lorenzo', $sol->getSol_TipoDocumento(), $sol->getSol_CodigoDocumento(), $sol->getSol_NombreDocumento(), $sol->getSol_HistorialVersion(), $area->getArea_Nombre(), $sol->getSol_Fecha(), $usu5->getUsu_Nombre() . " " . $usu5->getUsu_Apellido()));

          $archivo = '../images/tempSospechoso/' . $fecha . "_" . $hora . '.pdf';
          $mail->AddAttachment($archivo, "Sospechosos.pdf");
          //Avisar si fue enviado o no y dirigir al index
          $mail->Send();

      
        //foreach ($resCorr as $registro) {
            //echo $registro[1];
            $para = 'frank.acosta@colombiataxis.com';
            $asunto = 'Correo de prueba';
            /*$mensaje = utf8_decode(sprintf('<h2>Fallas causa raiz:</h2>
              <br>
              <p>Codigo de falla: %s </p>
              <p>Descripcion de la falla: %s </p>
              <p>Estado actual del proceso de falla: %s </p>
              <p>Indicador de falla: %s </p>
              <br>
              <p>Atte, </p>
              <p>Cerámica San Lorenzo </p>', $fal->getFal_Codigo(), $fal->getFal_Falla(), $fal->getFal_EstadoActual(), $fal->getFal_Indicador()));

            $mensaje = utf8_decode(sprintf('<h2>Asignación de Lineamientos:</h2>
    <br>
    <p>Tipo Documento: %s</p>
    <p>Código Documento: %s</p>
    <p>Nombre Documento: %s</p>
    <p>Versión: %s</p>
    <p>Área: %s</p>
    <p>Fecha Solicitud: %s</p>
    <p>Usuario Solicita: %s</p>
    <br>
    <p>Atte,</p>
    <p>Cerámica San Lorenzo </p>', $sol->getSol_TipoDocumento(), $sol->getSol_CodigoDocumento(), $sol->getSol_NombreDocumento(), $sol->getSol_HistorialVersion(), $area->getArea_Nombre(), $sol->getSol_Fecha(), $usu5->getUsu_Nombre() . " " . $usu5->getUsu_Apellido()));

// Encabezados del correo
            $headers = "From: SanLorenzo@sanlorenzo.com\r\n";
            $headers .= "Reply-To: SanLorenzo@sanlorenzo.com\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=utf-8\r\n";

// Envío del correo
            $mail_enviado = mail($para, $asunto, $mensaje, $headers);

// Verificar si el correo fue enviado o no
            /*if ($mail_enviado) {
                echo 'Correo enviado correctamente.';
            } else {
                echo 'Error al enviar el correo.';
            }*/
        
        $resultado['nombre'] = $usu5->getUsu_Nombre();
        $mensajito = utf8_decode(sprintf('Asignación de Lineamientos:

          Tipo Documento: %s
          Código Documento: %s
          Nombre Documento: %s
          Versión: %s
          Área: %s
          Fecha Solicitud: %s
          Usuario Solicita: %s

          Atte,
          Cerámica San Lorenzo', $sol->getSol_TipoDocumento(), $sol->getSol_CodigoDocumento(), $sol->getSol_NombreDocumento(), $sol->getSol_HistorialVersion(), $area->getArea_Nombre(), $sol->getSol_Fecha(), $usu5->getUsu_Nombre() . " " . $usu5->getUsu_Apellido()));

        $resultado['tip'] = $sol->getSol_TipoDocumento();
        $resultado['codDoc'] = $sol->getSol_CodigoDocumento();
        $resultado['nomDoc'] = $sol->getSol_NombreDocumento();
        $resultado['ver'] = $sol->getSol_HistorialVersion();
        $resultado['are'] = $area->getArea_Nombre();
        $resultado['fechaSol'] = $sol->getSol_Fecha();
        $resultado['usuSol'] = $usu5->getUsu_Nombre() . " " . $usu5->getUsu_Apellido();
        
         //$resultado['mens'] = $mensajito; 
        }



    if ($_POST['paso'] == "3") {
        $histF->setSol_Codigo($resSolCod);
        $histF->setUsu_Codigo($_SESSION['GD_Usuario']);
        $histF->setHistF_Paso("3");
        $histF->setHistF_Clasificacion("Asignación de Lineamiento");
        $histF->setHistF_Observacion($_POST['observaciones']);
        $histF->setHistF_FechaHora($fecha . " " . $hora);
        $histF->setHistF_Estado("1");

        $histF->insertar();

        $resCorr = $fluA->listarCorreosPasosNotificarTipoFlujo($sol->getArea_Codigo(), "4", $sol->getSol_TipoFlujo());

        //librerias
        /* require '../ext/PHPMailer/PHPMailerAutoload.php';
        $mail = "$Mail" + 1 + "";
        $i = 2;
        $mail = new PHPMailer();

        //Create a new PHPMailer instance

        $mail->IsSMTP();

        //Configuracion servidor mail
        $mail->FromName = utf8_decode(sprintf('Elaboración - Actualización'));
        $mail->From = "sistemasugerencias@lamosa.com"; //remitente
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = ''; //seguridad
        $mail->Host = "smtp.office365.com"; // servidor smtp
        $mail->Port = 587; //puerto 587
        $mail->Username = 'sistemasugerencias@lamosa.com'; //nombre usuario
        $mail->Password = 'srzqmnvmsxjlszqw'; //contraseña
        //Agregar destinatario
        //$mail->AddAddress("");
        //$mail->AddAddress("cristian.posada@etexgroup.com");
        $mail->AddAddress("daniel.herrera@sanlorenzo.com.co");
        $mail->AddAddress("oalopez@sanlorenzo.com.co");

        foreach ($resCorr as $registro) {
            $mail->AddAddress($registro[1]);
        }
        $mail->AddBCC("mercadeo@colombiataxis.com");

        $mail->Subject = utf8_decode(sprintf('Elaboración - Actualización'));
        $mail->Body = utf8_decode(sprintf('Datos Solicitud:

		Gestion: Elaboración - Actualización
		Tipo Documento: %s
		Código Documento: %s
		Nombre Documento: %s
		Versión: %s
		Área: %s
		Fecha Solicitud: %s
		Usuario Solicita: %s
		Observaciones: %s

		Atte,
		Cerámica San Lorenzo', $sol->getSol_TipoDocumento(), $sol->getSol_CodigoDocumento(), $sol->getSol_NombreDocumento(), $sol->getSol_HistorialVersion(), $area->getArea_Nombre(), $sol->getSol_Fecha(), $usu5->getUsu_Nombre() . " " . $usu5->getUsu_Apellido(), $_POST['observaciones']));

        $archivo = '../images/tempSospechoso/' . $fecha . "_" . $hora . '.pdf';
        $mail->AddAttachment($archivo, "Sospechosos.pdf");
        //Avisar si fue enviado o no y dirigir al index
        $mail->Send();
        $mail = "$Mail" + ($i) + "";
        $i++;
        
        $para = 'frank.acosta@colombiataxis.com';
            $asunto = 'Correo de prueba';
            /*$mensaje = utf8_decode(sprintf('<h2>Fallas causa raiz:</h2>
              <br>
              <p>Codigo de falla: %s </p>
              <p>Descripcion de la falla: %s </p>
              <p>Estado actual del proceso de falla: %s </p>
              <p>Indicador de falla: %s </p>
              <br>
              <p>Atte, </p>
              <p>Cerámica San Lorenzo </p>', $fal->getFal_Codigo(), $fal->getFal_Falla(), $fal->getFal_EstadoActual(), $fal->getFal_Indicador())); 

            $mensaje = utf8_decode(sprintf('<h2>Asignación de Lineamientos:</h2>
    <br>
    <p>Tipo Documento: %s</p>
    <p>Código Documento: %s</p>
    <p>Nombre Documento: %s</p>
    <p>Versión: %s</p>
    <p>Área: %s</p>
    <p>Fecha Solicitud: %s</p>
    <p>Usuario Solicita: %s</p>
    <br>
    <p>Atte,</p>
    <p>Cerámica San Lorenzo :. </p>', $sol->getSol_TipoDocumento(), $sol->getSol_CodigoDocumento(), $sol->getSol_NombreDocumento(), $sol->getSol_HistorialVersion(), $area->getArea_Nombre(), $sol->getSol_Fecha(), $usu5->getUsu_Nombre() . " " . $usu5->getUsu_Apellido()));

// Encabezados del correo
            $headers = "From: SanLorenzo@sanlorenzo.com\r\n";
            $headers .= "Reply-To: SanLorenzo@sanlorenzo.com\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=utf-8\r\n";

// Envío del correo
            $mail_enviado = mail($para, $asunto, $mensaje, $headers);

// Verificar si el correo fue enviado o no
            /*if ($mail_enviado) {
                echo 'Correo enviado correctamente.';
            } else {
                echo 'Error al enviar el correo.';
            }*/
        
    }

    if ($_POST['paso'] == "4") {
        $histF->setSol_Codigo($resSolCod);
        $histF->setUsu_Codigo($_SESSION['GD_Usuario']);
        $histF->setHistF_Paso("4");

        if ($sol->getSol_AccionDocumento() == "Nuevo") {
            $histF->setHistF_Clasificacion("Elaborado");
        }

        if ($sol->getSol_AccionDocumento() == "Actualización") {
            $histF->setHistF_Clasificacion("Actualizado");
        }

        $histF->setHistF_Observacion($_POST['observaciones']);
        $histF->setHistF_FechaHora($fecha . " " . $hora);
        $histF->setHistF_Estado("1");
        $histF->setHistF_Adjunto($nombre_foto1);

        $histF->insertar();

        $resCorr = $fluA->listarCorreosPasosNotificarTipoFlujo($sol->getArea_Codigo(), "5", $sol->getSol_TipoFlujo());

        //librerias
        /*require '../ext/PHPMailer/PHPMailerAutoload.php';
        $mail = "$Mail" + 1 + "";
        $i = 2;
        $mail = new PHPMailer();

        //Create a new PHPMailer instance

        $mail->IsSMTP();

        //Configuracion servidor mail
        $mail->FromName = utf8_decode(sprintf('Revisión Aprobación EHS'));
        $mail->From = "sistemasugerencias@lamosa.com"; //remitente
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = ''; //seguridad
        $mail->Host = "smtp.office365.com"; // servidor smtp
        $mail->Port = 587; //puerto 587
        $mail->Username = 'sistemasugerencias@lamosa.com'; //nombre usuario
        $mail->Password = 'srzqmnvmsxjlszqw'; //contraseña
        //Agregar destinatario
        $mail->AddAddress("cristian.posada@etexgroup.com");
        $mail->AddAddress("daniel.herrera@sanlorenzo.com.co");
        $mail->AddAddress("oalopez@sanlorenzo.com.co");

        foreach ($resCorr as $registro) {
            $mail->AddAddress($registro[1]);
        }
        $mail->AddBCC("mercadeo@colombiataxis.com");

        $mail->Subject = utf8_decode(sprintf('Revisión Aprobación EHS'));
        $mail->Body = utf8_decode(sprintf('Datos Solicitud:

		Gestion: Revisión - Aprobación EHS
		Tipo Documento: %s
		Código Documento: %s
		Nombre Documento: %s
		Versión: %s
		Área: %s
		Fecha Solicitud: %s
		Usuario Solicita: %s
		Observaciones: %s

		Atte,
		Cerámica San Lorenzo', $sol->getSol_TipoDocumento(), $sol->getSol_CodigoDocumento(), $sol->getSol_NombreDocumento(), $sol->getSol_HistorialVersion(), $area->getArea_Nombre(), $sol->getSol_Fecha(), $usu5->getUsu_Nombre() . " " . $usu5->getUsu_Apellido(), $_POST['observaciones']));

        $archivo = '../images/tempSospechoso/' . $fecha . "_" . $hora . '.pdf';
        $mail->AddAttachment($archivo, "Sospechosos.pdf");
        //Avisar si fue enviado o no y dirigir al index
        $mail->Send();
         * 
         */
    }

    if ($_POST['paso'] == "5") { //7
        $histF->setSol_Codigo($resSolCod);
        $histF->setUsu_Codigo($_SESSION['GD_Usuario']);
        $histF->setHistF_Paso("5");
        $histF->setHistF_Clasificacion($_POST['calificacion']);
        $histF->setHistF_Observacion($_POST['observaciones']);
        $histF->setHistF_FechaHora($fecha . " " . $hora);
        $histF->setHistF_Estado("1");
        if ($_POST['archivo'] != '' || $_POST['archivo'] != NULL) {
            $histF->setHistF_Adjunto($nombre_foto1);
        }
        $histF->insertar();

        $resCorr = $fluA->listarCorreosPasosNotificarTipoFlujo($sol->getArea_Codigo(), "6", $sol->getSol_TipoFlujo());

        //librerias
        /*require '../ext/PHPMailer/PHPMailerAutoload.php';
        $mail = "$Mail" + 1 + "";
        $i = 2;
        $mail = new PHPMailer();

        //Create a new PHPMailer instance

        $mail->IsSMTP();

        //Configuracion servidor mail
        $mail->FromName = utf8_decode(sprintf('Revisión Aprobación Jefe'));
        $mail->From = "sistemasugerencias@lamosa.com"; //remitente
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = ''; //seguridad
        $mail->Host = "smtp.office365.com"; // servidor smtp
        $mail->Port = 587; //puerto 587
        $mail->Username = 'sistemasugerencias@lamosa.com'; //nombre usuario
        $mail->Password = 'srzqmnvmsxjlszqw'; //contraseña
        //Agregar destinatario
        $mail->AddAddress("cristian.posada@etexgroup.com");
        $mail->AddAddress("daniel.herrera@sanlorenzo.com.co");
        $mail->AddAddress("oalopez@sanlorenzo.com.co");

        foreach ($resCorr as $registro) {
            $mail->AddAddress($registro[1]);
        }
        $mail->AddBCC("mercadeo@colombiataxis.com");

        $mail->Subject = utf8_decode(sprintf('Revisión Aprobación Jefe'));
        $mail->Body = utf8_decode(sprintf('Datos Solicitud:

    Gestion: Revisión Aprobación Jefe
    Tipo Documento: %s
    Código Documento: %s
    Nombre Documento: %s
    Versión: %s
    Área: %s
    Fecha Solicitud: %s
    Usuario Solicita: %s
    Observaciones: %s

    Atte,
    Cerámica San Lorenzo', $sol->getSol_TipoDocumento(), $sol->getSol_CodigoDocumento(), $sol->getSol_NombreDocumento(), $sol->getSol_HistorialVersion(), $area->getArea_Nombre(), $sol->getSol_Fecha(), $usu5->getUsu_Nombre() . " " . $usu5->getUsu_Apellido(), $_POST['observaciones']));

        $archivo = '../images/tempSospechoso/' . $fecha . "_" . $hora . '.pdf';
        $mail->AddAttachment($archivo, "Sospechosos.pdf");
        //Avisar si fue enviado o no y dirigir al index
        $mail->Send();
         * 
         */
    }

    if ($_POST['paso'] == "6") {//9
        $histF->setSol_Codigo($resSolCod);
        $histF->setUsu_Codigo($_SESSION['GD_Usuario']);
        $histF->setHistF_Paso("6");
        $histF->setHistF_Clasificacion($_POST['calificacion']);
        $histF->setHistF_Observacion($_POST['observaciones']);
        $histF->setHistF_FechaHora($fecha . " " . $hora);
        $histF->setHistF_Estado("1");
        if ($_POST['archivo'] != '' || $_POST['archivo'] != NULL) {
            $histF->setHistF_Adjunto($nombre_foto1);
        }
        $histF->insertar();

        $resCorr = $fluA->listarCorreosPasosNotificarTipoFlujo($sol->getArea_Codigo(), $sol->getSol_PasoActual(), $sol->getSol_TipoFlujo());

        //librerias
        /*require '../ext/PHPMailer/PHPMailerAutoload.php';
        $mail = "$Mail" + 1 + "";
        $i = 2;
        $mail = new PHPMailer();

        //Create a new PHPMailer instance

        $mail->IsSMTP();

        if ($validar == 1) {
            $texto = "Ajuste Lider Documento";
        } else {
            $texto = "Revisión Mejora Continua";
        }

        //Configuracion servidor mail
        $mail->FromName = utf8_decode(sprintf($texto));
        $mail->From = "sistemasugerencias@lamosa.com"; //remitente
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = ''; //seguridad
        $mail->Host = "smtp.office365.com"; // servidor smtp
        $mail->Port = 587; //puerto 587
        $mail->Username = 'sistemasugerencias@lamosa.com'; //nombre usuario
        $mail->Password = 'srzqmnvmsxjlszqw'; //contraseña
        //Agregar destinatario
        $mail->AddAddress("cristian.posada@etexgroup.com");
        $mail->AddAddress("daniel.herrera@sanlorenzo.com.co");
        $mail->AddAddress("oalopez@sanlorenzo.com.co");

        foreach ($resCorr as $registro) {
            $mail->AddAddress($registro[1]);
        }
        $mail->AddBCC("mercadeo@colombiataxis.com");

        $mail->Subject = utf8_decode(sprintf($texto));
        $mail->Body = utf8_decode(sprintf('Datos Solicitud:

    Gestion: %s
    Tipo Documento: %s
    Código Documento: %s
    Nombre Documento: %s
    Versión: %s
    Área: %s
    Fecha Solicitud: %s
    Usuario Solicita: %s
    Observaciones: %s

    Atte,
    Cerámica San Lorenzo', $texto, $sol->getSol_TipoDocumento(), $sol->getSol_CodigoDocumento(), $sol->getSol_NombreDocumento(), $sol->getSol_HistorialVersion(), $area->getArea_Nombre(), $sol->getSol_Fecha(), $usu5->getUsu_Nombre() . " " . $usu5->getUsu_Apellido(), $_POST['observaciones']));

        $archivo = '../images/tempSospechoso/' . $fecha . "_" . $hora . '.pdf';
        $mail->AddAttachment($archivo, "Sospechosos.pdf");
        //Avisar si fue enviado o no y dirigir al index
        $mail->Send();
         * 
         */
    }

    if ($_POST['paso'] == "7") { //6
        $histF->setSol_Codigo($resSolCod);
        $histF->setUsu_Codigo($_SESSION['GD_Usuario']);
        $histF->setHistF_Paso("7");
        $histF->setHistF_Clasificacion("Ajustado");
        $histF->setHistF_Observacion($_POST['observaciones']);
        $histF->setHistF_FechaHora($fecha . " " . $hora);
        $histF->setHistF_Estado("1");
        $histF->setHistF_Adjunto($nombre_foto1);

        $histF->insertar();

        $resCorr = $fluA->listarCorreosPasosNotificarTipoFlujo($sol->getArea_Codigo(), "8", $sol->getSol_TipoFlujo());

        //librerias
        /*require '../ext/PHPMailer/PHPMailerAutoload.php';
        $mail = "$Mail" + 1 + "";
        $i = 2;
        $mail = new PHPMailer();

        //Create a new PHPMailer instance

        $mail->IsSMTP();

        //Configuracion servidor mail
        $mail->FromName = utf8_decode(sprintf('Revisión Mejora Continua'));
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

        foreach ($resCorr as $registro) {
            $mail->AddAddress($registro[1]);
        }

        $mail->Subject = utf8_decode(sprintf('Revisión Mejora Continua'));
        $mail->Body = utf8_decode(sprintf('Datos Solicitud:

    Gestion: Revisión Mejora Continua
    Tipo Documento: %s
    Código Documento: %s
    Nombre Documento: %s
    Versión: %s
    Área: %s
    Fecha Solicitud: %s
    Usuario Solicita: %s
    Observaciones: %s

    Atte,
    Cerámica San Lorenzo', $sol->getSol_TipoDocumento(), $sol->getSol_CodigoDocumento(), $sol->getSol_NombreDocumento(), $sol->getSol_HistorialVersion(), $area->getArea_Nombre(), $sol->getSol_Fecha(), $usu5->getUsu_Nombre() . " " . $usu5->getUsu_Apellido(), $_POST['observaciones']));

        $archivo = '../images/tempSospechoso/' . $fecha . "_" . $hora . '.pdf';
        $mail->AddAttachment($archivo, "Sospechosos.pdf");
        //Avisar si fue enviado o no y dirigir al index
        $mail->Send();
         * 
         */
    }

    if ($_POST['paso'] == "8") {
        $histF->setSol_Codigo($resSolCod);
        $histF->setUsu_Codigo($_SESSION['GD_Usuario']);
        $histF->setHistF_Paso("8");
        $histF->setHistF_Clasificacion($_POST['calificacion']);
        $histF->setHistF_Observacion($_POST['observaciones']);
        $histF->setHistF_FechaHora($fecha . " " . $hora);
        $histF->setHistF_Estado("1");
        $histF->setHistF_Adjunto($nombre_foto1);

        $histF->insertar();

        $resCorr = $fluA->listarCorreosPasosNotificarTipoFlujo($sol->getArea_Codigo(), "9", $sol->getSol_TipoFlujo());

        //librerias
        /*require '../ext/PHPMailer/PHPMailerAutoload.php';
        $mail = "$Mail" + 1 + "";
        $i = 2;
        $mail = new PHPMailer();

        //Create a new PHPMailer instance

        $mail->IsSMTP();

        //Configuracion servidor mail
        $mail->FromName = sprintf('Aprobador Final Jefe');
        $mail->From = "sistemasugerencias@lamosa.com"; //remitente
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = ''; //seguridad
        $mail->Host = "smtp.office365.com"; // servidor smtp
        $mail->Port = 587; //puerto 587
        $mail->Username = 'sistemasugerencias@lamosa.com'; //nombre usuario
        $mail->Password = 'srzqmnvmsxjlszqw'; //contraseña
        //Agregar destinatario
        $mail->AddAddress("cristian.posada@etexgroup.com");
        $mail->AddAddress("daniel.herrera@sanlorenzo.com.co");
        $mail->AddAddress("oalopez@sanlorenzo.com.co");

        foreach ($resCorr as $registro) {
            $mail->AddAddress($registro[1]);
        }

        $mail->Subject = sprintf('Aprobador Final Jefe');
        $mail->Body = utf8_decode(sprintf('Datos Solicitud:

    Gestion: Aprobador Final Jefe
    Tipo Documento: %s
    Código Documento: %s
    Nombre Documento: %s
    Versión: %s
    Área: %s
    Fecha Solicitud: %s
    Usuario Solicita: %s
    Observaciones: %s

    Atte,
    Cerámica San Lorenzo', $sol->getSol_TipoDocumento(), $sol->getSol_CodigoDocumento(), $sol->getSol_NombreDocumento(), $sol->getSol_HistorialVersion(), $area->getArea_Nombre(), $sol->getSol_Fecha(), $usu5->getUsu_Nombre() . " " . $usu5->getUsu_Apellido(), $_POST['observaciones']));

        $archivo = '../images/tempSospechoso/' . $fecha . "_" . $hora . '.pdf';
        $mail->AddAttachment($archivo, "Sospechosos.pdf");
        //Avisar si fue enviado o no y dirigir al index
        $mail->Send();
         * 
         */
    }

    if ($_POST['paso'] == "9") { //
        $histF->setSol_Codigo($resSolCod);
        $histF->setUsu_Codigo($_SESSION['GD_Usuario']);
        $histF->setHistF_Paso("9");
        $histF->setHistF_Clasificacion("Ajuste Jefe Aprobador Final");
        $histF->setHistF_Observacion($_POST['observaciones']);
        $histF->setHistF_FechaHora($fecha . " " . $hora);
        $histF->setHistF_Estado("1");
        $histF->setHistF_Adjunto($nombre_foto1);

        $histF->insertar();

        $resCorr = $fluA->listarCorreosPasosNotificarTipoFlujo($sol->getArea_Codigo(), "10", $sol->getSol_TipoFlujo());

        //librerias
        /*require '../ext/PHPMailer/PHPMailerAutoload.php';
        $mail = "$Mail" + 1 + "";
        $i = 2;
        $mail = new PHPMailer();

        //Create a new PHPMailer instance

        $mail->IsSMTP();

        //Configuracion servidor mail
        $mail->FromName = sprintf('Subir PDF');
        $mail->From = "sistemasugerencias@lamosa.com"; //remitente
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = ''; //seguridad
        $mail->Host = "smtp.office365.com"; // servidor smtp
        $mail->Port = 587; //puerto 587
        $mail->Username = 'sistemasugerencias@lamosa.com'; //nombre usuario
        $mail->Password = 'srzqmnvmsxjlszqw'; //contraseña
        //Agregar destinatario
        $mail->AddAddress("cristian.posada@etexgroup.com");
        $mail->AddAddress("daniel.herrera@sanlorenzo.com.co");
        $mail->AddAddress("oalopez@sanlorenzo.com.co");

        foreach ($resCorr as $registro) {
            $mail->AddAddress($registro[1]);
        }

        $mail->Subject = sprintf('Subir PDF');
        $mail->Body = utf8_decode(sprintf('Datos Solicitud:

    Gestion: Subir PDF
    Tipo Documento: %s
    Código Documento: %s
    Nombre Documento: %s
    Versión: %s
    Área: %s
    Fecha Solicitud: %s
    Usuario Solicita: %s
    Observaciones: %s

    Atte,
    Cerámica San Lorenzo', $sol->getSol_TipoDocumento(), $sol->getSol_CodigoDocumento(), $sol->getSol_NombreDocumento(), $sol->getSol_HistorialVersion(), $area->getArea_Nombre(), $sol->getSol_Fecha(), $usu5->getUsu_Nombre() . " " . $usu5->getUsu_Apellido(), $_POST['observaciones']));

        $archivo = '../images/tempSospechoso/' . $fecha . "_" . $hora . '.pdf';
        $mail->AddAttachment($archivo, "Sospechosos.pdf");
        //Avisar si fue enviado o no y dirigir al index
        $mail->Send();
         * 
         */
    }

    if ($_POST['paso'] == "10") {
        $histF->setSol_Codigo($resSolCod);
        $histF->setUsu_Codigo($_SESSION['GD_Usuario']);
        $histF->setHistF_Paso("10");
        $histF->setHistF_Clasificacion("Subir PDF");
        $histF->setHistF_Observacion($_POST['observaciones']);
        $histF->setHistF_FechaHora($fecha . " " . $hora);
        $histF->setHistF_Estado("1");
        $histF->setHistF_Adjunto($nombre_foto1);

        $histF->insertar();

        $resCorr = $fluA->listarCorreosPasosNotificarTipoFlujo($sol->getArea_Codigo(), "11", $sol->getSol_TipoFlujo());

        //librerias
        /*require '../ext/PHPMailer/PHPMailerAutoload.php';
        $mail = "$Mail" + 1 + "";
        $i = 2;
        $mail = new PHPMailer();

        //Create a new PHPMailer instance

        $mail->IsSMTP();

        //Configuracion servidor mail
        $mail->FromName = utf8_decode(sprintf('Divulgación'));
        $mail->From = "sistemasugerencias@lamosa.com"; //remitente
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = ''; //seguridad
        $mail->Host = "smtp.office365.com"; // servidor smtp
        $mail->Port = 587; //puerto 587
        $mail->Username = 'sistemasugerencias@lamosa.com'; //nombre usuario
        $mail->Password = 'srzqmnvmsxjlszqw'; //contraseña
        //Agregar destinatario
        $mail->AddAddress("cristian.posada@etexgroup.com");
        $mail->AddAddress("daniel.herrera@sanlorenzo.com.co");
        $mail->AddAddress("oalopez@sanlorenzo.com.co");

        foreach ($resCorr as $registro) {
            $mail->AddAddress($registro[1]);
        }

        $mail->Subject = utf8_decode(sprintf('Divulgación'));
        $mail->Body = utf8_decode(sprintf('Datos Solicitud:

    Gestion: Divulgación
    Tipo Documento: %s
    Código Documento: %s
    Nombre Documento: %s
    Versión: %s
    Área: %s
    Fecha Solicitud: %s
    Usuario Solicita: %s
    Observaciones: %s

    Atte,
    Cerámica San Lorenzo', $sol->getSol_TipoDocumento(), $sol->getSol_CodigoDocumento(), $sol->getSol_NombreDocumento(), $sol->getSol_HistorialVersion(), $area->getArea_Nombre(), $sol->getSol_Fecha(), $usu5->getUsu_Nombre() . " " . $usu5->getUsu_Apellido(), $_POST['observaciones']));

        $archivo = '../images/tempSospechoso/' . $fecha . "_" . $hora . '.pdf';
        $mail->AddAttachment($archivo, "Sospechosos.pdf");
        //Avisar si fue enviado o no y dirigir al index
        $mail->Send();
         * 
         */
    }

    if ($_POST['paso'] == "11") {
        $histF->setSol_Codigo($resSolCod);
        $histF->setUsu_Codigo($_SESSION['GD_Usuario']);
        $histF->setHistF_Paso("11");
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