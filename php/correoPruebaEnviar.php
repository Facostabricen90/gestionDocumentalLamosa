<?php 
include("op_sesion.php");
include("../class/solicitudes.php");
include("funciones_especiales.php");
include("../class/areas.php");

$sol = new solicitudes();
$sol->setSol_Codigo('3410');
$sol->consultar();

$usu5 = new usuarios();
$usu5->setUsu_Codigo($sol->getUsu_Codigo());
$usu5->consultar();

$area = new areas();
$area->setArea_Codigo($sol->getArea_Codigo());
$area->consultar();

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
              <p>Cerámica San Lorenzo </p>', $fal->getFal_Codigo(), $fal->getFal_Falla(), $fal->getFal_EstadoActual(), $fal->getFal_Indicador())); */

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
            if ($mail_enviado) {
                echo 'Correo enviado correctamente.';
            } else {
                echo 'Error al enviar el correo.';
            }

