<?php
include("op_sesion.php");
include("../class/plantas.php");

$pla = new plantas();
$pla->setPla_Codigo($_POST['codigo']);
$pla->consultar();
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>ACTUALIZAR PLANTA</strong>
      </div>

      <div class="panel-body">
        <form id="f_plantasActualizar" role="form">
          <input type="hidden" id="Pla_CodigoAct" value="<?php echo $_POST['codigo']; ?>">
          <div class="form-group">
            <label class="control-label">Nombre:<span class="rojo">*</span></label>
            <input type="text" id="Pla_NombreAct" value="<?php echo $pla->getPla_Nombre(); ?>" class="form-control" maxlength="50" required>
          </div>
          
                    
          <div class="form-group">
            <label class="control-label">Estado:</label>
            <select id="Pla_EstadoAct" class="form-control">
              <option value="1" <?php echo $pla->getPla_Estado() == "1" ? "selected" : ""; ?>>Activo</option>
              <option value="0" <?php echo $pla->getPla_Estado() == "0" ? "selected" : ""; ?>>Inactivo</option>
            </select>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>