<?php
include("op_sesion.php");
include("../class/areas.php");
include("../class/plantas.php");

$pla = new plantas();
$resPla = $pla->listarPlantasUsuarioCrear("1", $_SESSION['GD_Usuario']);
  
$area = new areas();
$area->setArea_Codigo($_POST['codigo']);
$area->consultar();
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>ACTUALIZAR AREA</strong>
      </div>

      <div class="panel-body">
         <form id="f_areasActualizar" role="form">
           <input type="hidden" id="Area_CodigoAct" value="<?php echo $_POST['codigo'] ?>">
           <div class="form-group">
              <label class="control-label">Nombre: <span class="rojo">*</span></label>
              <input type="text" id="Area_NombreAct" value="<?php echo $area->getArea_Nombre(); ?>" class="form-control" maxlength="60" required>
            </div>
            <div class="form-group">
              <label class="control-label">Planta<span class="rojo">*</span></label>
              <select id="Are_Pla_CodigoAct" class="form-control" required>
                <option></option>
                <?php foreach($resPla as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>" <?php echo $area->getPla_Codigo() == $registro[0] ? "selected" : ""; ?>><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
           <div class="form-group">
              <label class="control-label">Estado:</label>
             <select id="Area_EstadoAct" class="form-control">
             <option value="1" <?php echo $area->getArea_Estado() == "1" ? "selected" : ""; ?>>Activo</option>
              <option value="0" <?php echo $area->getArea_Estado() == "0" ? "selected" : ""; ?>>Inactivo</option>
             </select>
            </div>
           
         </form>
      </div>
    </div>
  </div>
</div>
