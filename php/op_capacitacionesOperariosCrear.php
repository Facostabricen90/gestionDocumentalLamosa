<?php

include("op_sesion.php");
include("../class/capacitaciones_operarios.php");

date_default_timezone_set("America/Bogota");
$fecha = date("y-m-d");
$hora = date("h:i:s");

$resultado = array();

$capO = new capacitaciones_operarios();

$lista1 = $_POST['lista1'];
$lista2 = $_POST['lista2'];
$lista3 = $_POST['lista3'];
$lista4 = $_POST['lista4'];
$lista5 = $_POST['lista5'];
$lista6 = $_POST['lista6'];
$num = $_POST['num'];

for ($a = 0; $a < $num; $a++) {

    if ($lista5[$a] == "1") {
        $capO->setCapO_Codigo($lista6[$a]);
        $capO->consultar();

        if ($lista1[$a] == "true") {
            $capO->setCapO_Capacitado("1");
        } else {
            $capO->setCapO_Capacitado("0");
        }

        if ($lista2[$a] == "true") {
            $capO->setCapO_Novedades("1");
        } else {
            $capO->setCapO_Novedades("0");
        }

        $capO->setCapO_Observaciones($lista3[$a]);
        $capO->setCapO_HorasCapacitacion($_POST['hora']);
        $capO->setCapO_Fecha($_POST['fecha']);

        $resultado['resultado'] = $capO->actualizar();
    } else {
        $NO = 0;

        $capO->setSol_Codigo($_POST['codigo']);
        $capO->setOpe_Codigo($lista4[$a]);

        if ($lista1[$a] == "true") {
            $capO->setCapO_Capacitado("1");
            $NO++;
        } else {
            $capO->setCapO_Capacitado("0");
        }

        if ($lista2[$a] == "true") {
            $capO->setCapO_Novedades("1");
            $NO++;
        } else {
            $capO->setCapO_Novedades("0");
        }

        $capO->setCapO_Observaciones($lista3[$a]);
        $capO->setCapO_Hora($hora);
        $capO->setCapO_FechaHoraCrea($fecha . " " . $hora);
        $capO->setCapO_UsuarioCrea($_SESSION['GD_Usuario']);
        $capO->setCapO_Estado("1");
        $capO->setCapO_Fecha($_POST['fecha']);
        $capO->setCapO_HorasCapacitacion($_POST['hora']);
        if ($NO > 0) {
            $resultado['resultado'] = $capO->insertar();
        }
    }
}

if ($resultado['resultado']) {
    $resultado['mensaje'] = "OK";
} else {
    $resultado['mensaje'] = $capO->imprimirError();
}
echo json_encode($resultado);
?>