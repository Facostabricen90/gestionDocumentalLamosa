<?php
include("../class/areas.php");
include("../class/plantas.php");

$pla = $_POST['planta'];

$are = new areas();
$resAre = $are->listarAreasPlantasDistintas($pla);
?>

<?php
foreach ($resAre as $registro) {
    if (!isset($vectorUsuAreas[$registro['Area_Codigo']])) {
        ?>

        <option value="<?php echo $registro['Area_Codigo']; ?>"><?php echo $registro['Area_Nombre']; ?></option>
        <?php
    }
}  