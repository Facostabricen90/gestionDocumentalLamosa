<?php
include("op_sesion.php");
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <form id="f_eliminarExplorador" role="form">
      <input type="hidden" id="EArc_CodigoEli" value="<?php echo $_POST['codigo']; ?>">
      <input type="hidden" id="EArc_ReferenciaEli" value="<?php echo $_POST['referencia']; ?>">
      <div class="form-group" align="center">
        <label class="control-label letra22">¿Desea eliminar este elemento?</label>
      </div>
    </form>
  </div>
</div>
