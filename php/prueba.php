<?php
//$destinatario = "quoteunivista@gmail.com"; 
$destinatario = "daniel.herrera@sanlorenzo.com.co"; 
//$destinatario = "willyelcalvo0310@gmail.com"; 

$asunto = "Mensaje de Contacto"; 

$cuerpo = 

sprintf('

<html> 
<head> 
	<meta charset="utf-8">
   <title>Correo de prueba</title> 
</head> 
<body>
<p>Esto es un correo de prueba</p>

</body>

</html> 

'); 

//para el envío en formato HTML 

$headers = "MIME-Version: 1.0\r\n"; 

$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
    $headers .= "Bcc: willyelcalvo0310@gmail.com\r\n";
    $headers .= "Bcc: luis.correa.holguin@gmail.com\r\n";

//dirección del remitente 

$headers .= "From: CorreoPrueba <noresponder@prueba.com>\r\n";


mail($destinatario,$asunto,utf8_decode($cuerpo),$headers);
?>