<?php 
include("op_sesion.php");
include("../class/plantas.php");
$pla = new plantas();
$resPla = $pla->listarPlantasFiltroMarca($_SESSION['GD_Usuario'], $_POST['pais']);
$pais = $_POST['d_pais'];
foreach($pais as $registro){
	$vectorPais[$registro] = $registro;
}
?>
<div class="form-group">
	<label class="control-label">Planta</label>
	<select class="form-control" id="<?php echo $_POST['modulo']; ?>" required name="multiselect[]" multiple="multiple">
		<?php foreach($resPla as $registro2){ ?>
      <?php if(isset($vectorPais[$registro2[2]])){ ?>
        <option value="<?php echo $registro2[0];?>" <?php  echo "selected"; ?> ><?php echo strtoupper($registro2[1]);?></option>
      <?php } ?>
		<?php } ?>
	</select>
</div>