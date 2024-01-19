<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
$remitentes = array();

$remitentes[0]['correo'] = 'orlajuni86@gmail.com';
$remitentes[0]['nombre'] = 'Frank';

$asunto = 'Hola tu';

$mensaje = '<h1>Hola cuerpo</h1>'
        . 'hola mas cuerpo';
header("https://esoft.evolveyourenglish.com/user/php/s_funcionesCorreoLamosa.php?r=" . $remitentes, "&a=" . $asunto . "&m=" . $mensaje);
//echo  envioCorreos($remitentes, $asunto, $mensaje);
