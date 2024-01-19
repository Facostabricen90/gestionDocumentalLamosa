<?php
include("op_sesion.php");
include("../class/parametros.php");

$par = new parametros();

if($_POST['tipoFlujo'] == "3"){
  $resPar = $par->listarParametroTipo("3", "-1");
}else{
  $resPar = $par->listarParametroTipo("2", "-1"); 
}

?>
<div class="form-group">
  <label class="control-label">Paso: <span class="rojo">*</span></label>
  <select id="FluA_PasoAct" class="form-control" required>
    <option></option>
    <?php foreach($resPar as $registro2){ ?>
      <option value="<?php echo $registro2[2]; ?>"><?php echo $registro2[2].". ".$registro2[1]; ?></option>
    <?php } ?>
  </select>
</div>