<?php
include("op_sesion.php");
include("../class/flujos_aprobaciones.php");
include("../class/areas.php");
include("../class/parametros.php");
include("../class/plantas.php");

$are = new areas();
$are->setPla_Codigo($_POST['planta']);
$resAre = $are->listarAreasPlantas();

$fluA = new flujos_aprobaciones();
$fluA->setFluA_Codigo($_POST['flujo']);
$fluA->consultar();

$are_act = new areas($fluA->getArea_Codigo());
$are_act->consultar();


foreach ($resAre as $registro2) {
?>
<option value="<?php echo $registro2[0]; ?>" <?php echo $are_act->getArea_Nombre() == $registro2[1] ? "selected" : ""; ?>><?php echo $registro2[1]; ?></option>
<?php } ?>