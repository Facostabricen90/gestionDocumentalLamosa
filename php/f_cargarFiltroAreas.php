<?php
include("op_sesion.php");
include("../class/areas.php");
$are = new areas();
$resAre = $pla->listarAreaFiltroConPlanta($_SESSION['GD_Usuario'], $_POST['planta']);
$planta = $_POST['d_planta'];
foreach ($planta as $registro) {
    $vectorPais[$registro] = $registro;
}
?>
<div class="form-group">
    <label class="control-label">Área</label>
    <select class="form-control" required>
        <option value="-1">Todos</option>
        <?php foreach ($resAre as $registro) { ?>
            <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
        <?php } ?>
    </select>
</div>
