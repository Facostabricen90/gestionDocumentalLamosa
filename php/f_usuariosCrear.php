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
        <strong>CREAR USUARIO</strong>
      </div>

      <div class="panel-body">
        <form id="f_usuariosCrear" role="form">
          
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
              <label class="control-label">Usuario:<span class="rojo">*</span></label>
              <input type="text" id="Usu_Usuario" class="form-control" maxlength="30" required>
            </div>

            <div class="form-group">
              <label class="control-label">Nombre:<span class="rojo">*</span></label>
              <input type="text" id="Usu_Nombre" class="form-control" maxlength="30" required>
            </div>

            <div class="form-group">
              <label class="control-label">Apellido:<span class="rojo">*</span></label>
              <input type="text" id="Usu_Apellido" class="form-control" maxlength="30" required>
            </div>
            <div class="form-group">
              <label class="control-label">Cargo:<span class="rojo">*</span></label>
              <input type="text" id="Usu_Cargo" class="form-control" maxlength="60" required>
            </div>
            <div class="form-group">
              <label class="control-label">Correo:<span class="rojo">*</span></label>
              <input type="email" id="Usu_Correo" class="form-control" maxlength="80" required>
            </div>
          </div>
          
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
              <label class="control-label">Telefono:<span class="rojo">*</span></label>
              <input type="text" id="Usu_Telefono" class="form-control" maxlength="20" required>
            </div>
            <div class="form-group">
              <label class="control-label">Rol:<span class="rojo">*</span></label>
              <select id="Usu_Rol" class="form-control" required>
                <option value="Usuario">Usuario</option>
                <option value="Usuario Compartido Planta">Usuario Compartido Planta</option>
                <option value="Administrador">Administrador</option>
              </select>
            </div>
            
            <div class="form-group">
              <label class="control-label">Planta<span class="rojo">*</span></label>
              <select id="Usu_Pla_Codigo" class="form-control" required>
                <option></option>
                <?php foreach($resPla as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
            
            <input type="hidden" value="1" id="Usu_TipoFlujo">

          </div>
          
        </form>
      </div>
    </div>
  </div>
</div>