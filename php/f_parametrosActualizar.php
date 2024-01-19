<?php
include("op_sesion.php");
include("../class/parametros.php");

$par = new parametros();
$par->setPar_Codigo($_POST['codigo']);
$par->consultar();
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>ACTUALIZAR PARAMETROS</strong>
      </div>

      <div class="panel-body">
        <form id="f_parametrosActualizar" role="form">
          <input type="hidden" id="Par_CodigoAct" value="<?php echo $_POST['codigo']; ?>">
          <div class="form-group">
            <label class="control-label">Nombre:<span class="rojo">*</span></label>
            <input type="text" id="Par_NombreAct" value="<?php echo $par->getPar_Nombre(); ?>" class="form-control" maxlength="30" required>
          </div>
          
          <div class="form-group">
            <label class="control-label">Tipo:<span class="rojo">*</span></label>
            <select id="Par_TipoAct" class="form-control" required>
              <option value="1" <?php echo $par->getPar_Tipo() == "1" ? "selected" : ""; ?>>Tipo de Documento</option>
              <option value="2" <?php echo $par->getPar_Tipo() == "2" ? "selected" : ""; ?>>Pasos</option>
              <option value="3" <?php echo $par->getPar_Tipo() == "3" ? "selected" : ""; ?>>Pasos EHS</option>
            </select>
          </div>
          
          <div class="form-group">
            <label class="control-label">Tipo Flujo: <span class="letra10 letraGris">Solo para Tipo Documento</span></label>
            <select id="Par_TipoFlujoAct" class="form-control">
              <option></option>
              <option value="1" <?php echo $par->getPar_TipoFlujo() == "1" ? "selected" : ""; ?>>Documentos Equipo Industrial</option>
              <option value="2" <?php echo $par->getPar_TipoFlujo() == "2" ? "selected" : ""; ?>>Perfil de Competencias</option>
              <option value="3" <?php echo $par->getPar_TipoFlujo() == "3" ? "selected" : ""; ?>>Matriz IPERC y/o Mapas de Seguridad</option>
            </select>
          </div>
          
          <div class="form-group">
            <label class="control-label">Estado:</label>
            <select id="Par_EstadoAct" class="form-control">
              <option value="1" <?php echo $par->getPar_Estado() == "1" ? "selected" : ""; ?>>Activo</option>
              <option value="0" <?php echo $par->getPar_Estado() == "0" ? "selected" : ""; ?>>Inactivo</option>
            </select>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>