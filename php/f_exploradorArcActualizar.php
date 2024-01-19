<?php
include("op_sesion.php");
include("../class/explorador_archivos.php");
$exp = new explorador_archivos();
$exp->setEArc_Codigo($_POST['codigo']);
$exp->consultar();
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>ACTUALIZAR <?php echo $exp->getEArc_Tipo() == '1' ? "CARPETA":"ARCHIVO"; ?></strong>
      </div>

      <div class="panel-body">
        <form id="f_exploradorArcActualizar" role="form">
          <input type="hidden" id="EArc_CodigoAct" value="<?php echo $_POST['codigo']; ?>">
          <input type="hidden" id="EArc_ReferenciaAct" value="<?php echo $_POST['referencia']; ?>">
          
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
              <label class="control-label">Nombre:<span class="rojo">*</span></label>
              <input type="text" id="EArc_NombreAct" class="form-control" maxlength="100" value="<?php echo $exp->getEArc_Nombre(); ?>" required>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>