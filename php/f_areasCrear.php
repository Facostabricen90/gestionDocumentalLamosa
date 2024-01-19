<?php
include("op_sesion.php");
include("../class/plantas.php");

$pla = new plantas();
$resPla = $pla->listarPlantasUsuarioCrear("1", $_SESSION['GD_Usuario']);
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>CREAR AREA</strong>
      </div>

      <div class="panel-body">
         <form id="f_areasCrear" role="form">
           <div class="form-group">
              <label class="control-label">Nombre: <span class="rojo">*</span></label>
              <input type="text" id="Area_Nombre" class="form-control" maxlength="60" required>
            </div>
            <div class="form-group">
              <label class="control-label">Planta<span class="rojo">*</span></label>
              <select id="Are_Pla_Codigo" class="form-control" required>
                <option></option>
                <?php foreach($resPla as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
         </form>
      </div>
    </div>
  </div>
</div>
