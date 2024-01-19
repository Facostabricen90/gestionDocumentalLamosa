<?php
include("../class/areas.php");
include("../class/plantas.php");

$pla = $_POST['planta'];

$are = new areas();
$resAre = $are->listarAreasPlantasDistintasParaUsuarios('1', $_POST['codigo']);

foreach ($resAre as $registro) {
        ?>
        <option value="<?php echo $registro['Area_Codigo']; ?>"><?php echo $registro['Area_Nombre']; ?></option>
        <?php
}
