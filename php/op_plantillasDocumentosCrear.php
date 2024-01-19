<?php

include("op_sesion.php");
include("../class/plantillas_documentos.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");
$diaa = 0;
$diam = 0;
$dia = 0;
$fecha2 = date("Ymd");
$hora2 = date("His");

if ($_POST['ano'] != "-1") {
    $ano = $_POST['ano'];
    $diaa = $ano * 360;
} else {
    $ano = 0;
}

if ($_POST['mes'] != "-1") {
    $mes = $_POST['mes'];
    $diam = $mes * 30.5;
} else {
    $mes = 0;
}

$dia = $diaa + $diam;

$resultado = array();

$plaD = new plantillas_documentos();

$plaD->setPlaD_Tipo($_POST['tipoDocumento']);

if ($_POST['archivo'] != "") {
    $ruta1 = "../imagenes/plantillas/";

    $arc1 = $_POST['archivo'];
    $valores1 = explode('.', $arc1);
    $extension1 = end($valores1);
    $nombre_foto1 = "Plantilla" . "_" . $_POST['tipoDocumento'] . $fecha2 . $hora2 . "." . $extension1;

    rename($ruta1 . $_POST['archivo'], $ruta1 . $nombre_foto1);
    $plaD->setPlaD_Plantilla($nombre_foto1);
}



$plaD->setPlaD_FechaHora($fecha . " " . $hora);
if ($dia != 0) {
    $plaD->setPlaD_TiempoRetencion($dia);
} else {
    $plaD->setPlaD_TiempoRetencion(NULL);
}
$plaD->setPlaD_UsuarioCrea($_SESSION['GD_Usuario']);
$plaD->setPlaD_Estado("1");
$plaD->setPlanta_codigo($_POST['planta_codigo']);

$resultado['resultado'] = $plaD->insertar();

if ($resultado['resultado']) {
    $resultado['mensaje'] = "OK";
} else {
    $resultado['mensaje'] = $plaD->imprimirError();
}
echo json_encode($resultado);
?>