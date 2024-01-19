<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../ext/PHPMailer/src/Exception.php';
require '../ext/PHPMailer/src/PHPMailer.php';
require '../ext/PHPMailer/src/SMTP.php';

function envioCorreos($remitentes, $asunto, $mensaje, $archivo = NULL) {
    // Inicialización
    $mail = new PHPMailer(true);

    try {
        //Opciones del Sevidor
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                    // Activa el proceso de salida
        $mail->isSMTP();                                            // Activa el SMTP
        $mail->Host = 'smtp.gmail.com';                             // Define el host para el SMTP
        $mail->SMTPAuth = true;                                     // Activa la autenticación por SMTP
        //$mail->Helo = "esoft.evolveyourenglish.com";                  //Muy importante para que llegue a hotmail y otros
        $mail->Username = 'lamosagestiondocumental@gmail.com';            // Usuario/Correo
        $mail->Password = 'nwtkurfonssscryn';                              // Password
        $mail->SMTPSecure = 'ssl';     // Habilita encriptación TLS
        $mail->Port = 465;                                          // Puerto de conexión
        //Recipientes
        $mail->setFrom('lamosagestiondocumental@gmail.com', 'La mosa');
$mail->SMTPDebug = 2;
        $primero = true;
        $lcorreos = "";
        foreach ($remitentes as $rem) {
            $mail->addAddress($rem['correo'], $rem['nombre']);

            if (!$primero) {
                $lcorreos .= "; ";
            }
            $primero = false;
            $lcorreos .= $rem['nombre'] . " <" . $rem['correo'] . ">";
        }


        //Contenido
        // cabecera
        $mensaje_cabecera = 'Hola';
        $mensaje_pie = '<br><br><br><br><hr><div>'
                . 'Este es un correo electrónico automático.<br>'
                . 'No respondas a este correo electrónico. No se responderán a los correos electrónicos enviados a esta dirección.<br>'
                . '</div>';

        $mail->isHTML(true);                                  // Formato HTML
        $mail->Subject = utf8_decode($asunto);
        $mail->Body = utf8_decode($mensaje_cabecera . $mensaje . $mensaje_pie);
        $mail->AltBody = 'Tu cliente de correo no soporta mensajes HTML';

        if ($archivo != NULL) {
            foreach ($archivo as $arc) {
                $mail->addAttachment($arc);
            }
        }

        $mail->send();

        return 1;
    } catch (Exception $e) {
        return "El mensaje no pudo ser enviado. Error de correo: {$mail->ErrorInfo}";
    }
}
