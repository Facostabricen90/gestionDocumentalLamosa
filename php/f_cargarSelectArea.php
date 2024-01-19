<?php
include("../class/areas.php");
include("../class/plantas.php");

$pla = $_POST['planta'];

$are = new areas();
$resAre = $are->listarAreasPlantasDistintas($pla);
?>

<?php foreach ($resAre as $registro1) { ?>
    <option value="<?php echo $registro1['Area_Codigo']; ?>"><?php echo $registro1['Area_Nombre']; ?></option>
<?php }
?>