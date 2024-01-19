<?php
include("../class/areas.php");
include("../class/plantas.php");

$pla = $_POST['planta'];

$are = new areas();
$resAre = $are->listarAreasPlantasDistintas($pla);
?>
<?php foreach ($resAre as $registro) { ?>
    <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
<?php } ?>

