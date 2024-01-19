<?php
include("op_sesion.php");
include("../class/operarios.php");
include("../class/areas.php");
include("../class/plantas.php");

$pla = new plantas();
$resPla = $pla->listarPlantasUsuarioCrear("1", $_SESSION['GD_Usuario']);

$ope = new operarios();
$ope->setOpe_Codigo($_POST['codigo']);
$ope->consultar();

$are = new areas();
$are->setPla_Codigo($ope->getPla_Codigo());
$resAre = $are->listarAreasPlantas();
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>ACTUALIZAR OPERARIO</strong>
      </div>

      <div class="panel-body">
        <form id="f_operariosActualizar" role="form">
          <input type="hidden" id="Ope_CodigoAct" value="<?php echo $_POST['codigo']; ?>">
          <div class="col-lg-6 col-md-6 col-sm-6">
          
            <div class="form-group">
              <label class="control-label">Nombre:<span class="rojo">*</span></label>
              <input type="text" id="Ope_NombreAct" value="<?php echo $ope->getOpe_Nombre(); ?>" class="form-control" maxlength="30" required>
            </div>
            
            <div class="form-group">
              <label class="control-label">Apellido:<span class="rojo">*</span></label>
              <input type="text" id="Ope_ApellidoAct" value="<?php echo $ope->getOpe_Apellido(); ?>" class="form-control" maxlength="30" required>
            </div>
            
            <div class="form-group">
              <label class="control-label">Cédula:<span class="rojo">*</span></label>
              <input type="text" id="Ope_CedulaAct" value="<?php echo $ope->getOpe_Cedula(); ?>" class="form-control" maxlength="20" required>
            </div>
          
            <div class="form-group">
              <label class="control-label">Correo:</label>
              <input type="email" id="Ope_CorreoAct" value="<?php echo $ope->getOpe_Correo(); ?>" class="form-control" maxlength="100">
            </div>
            <div class="form-group">
              <label class="control-label">Teléfono:</label>
              <input type="text" id="Ope_TelefonoAct" value="<?php echo $ope->getOpe_Telefono(); ?>" class="form-control" maxlength="20">
            </div>
            <div class="form-group">
              <label class="control-label">Cargo:<span class="rojo">*</span></label>
              <input type="text" id="Ope_CargoAct" class="form-control" value="<?php echo $ope->getOpe_Cargo(); ?>" maxlength="" required>
            </div>
            <div class="form-group">
              <label class="control-label">Area:<span class="rojo">*</span></label>
              <select id="Ope_Area_CodigoAct" class="form-control" required>
                <?php foreach($resAre as $registro2){ ?>
                  <option value="<?php echo $registro2[0]; ?>" <?php echo $ope->getArea_Codigo() == $registro2[0] ? "selected" : ""; ?>><?php echo $registro2[1]; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Género:<span class="rojo">*</span></label>
              <select id="Ope_SexoAct" class="form-control" required>
                <option value=""  <?php echo $ope->getOpe_Sexo() == "" ? "selected" : ""; ?>>--</option>
                <option value="H"  <?php echo $ope->getOpe_Sexo() == "H" ? "selected" : ""; ?>>H</option>
                <option value="M"  <?php echo $ope->getOpe_Sexo() == "M" ? "selected" : ""; ?>>M</option>
              </select>
            </div>
          </div>
          
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
              <label class="control-label">Código De Centro Costos:<span class="rojo">*</span></label>
              <input type="text" id="Ope_CodigoCCostoAct" class="form-control" maxlength="" value="<?php echo $ope->getOpe_CodigoCCosto(); ?>" required>
            </div>
            <div class="form-group">
              <label class="control-label">Nombre De Centro Costos:<span class="rojo">*</span></label>
              <input type="text" id="Ope_NombreCCostoAct" class="form-control" maxlength="" value="<?php echo $ope->getOpe_NombreCCosto(); ?>" required>
            </div>
            <div class="form-group">
              <label class="control-label">Jefe:<span class="rojo">*</span></label>
              <input type="text" id="Ope_JefeAct" class="form-control" maxlength="" value="<?php echo $ope->getOpe_Jefe(); ?>" required>
            </div>
            <div class="form-group">
              <label class="control-label">Área LATAM:<span class="rojo">*</span></label>
              <input type="text" id="Ope_AreaLATAMAct" class="form-control" maxlength="" value="<?php echo $ope->getOpe_AreaLATAM(); ?>" required>
            </div>
            <div class="form-group">
              <label class="control-label">Tipo Función:<span class="rojo">*</span></label>
              <input type="text" id="Ope_TipoFuncionAct" class="form-control" maxlength="" value="<?php echo $ope->getOpe_TipoFuncion(); ?>" required>
            </div>
            <div class="form-group">
              <label class="control-label">Gerencia:<span class="rojo">*</span></label>
              <input type="text" id="Ope_GerenciaAct" class="form-control" maxlength="" value="<?php echo $ope->getOpe_Gerencia(); ?>" required>
            </div>
            <div class="form-group">
              <label class="control-label">Subárea:<span class="rojo">*</span></label>
              <?php /* <input type="text" id="Ope_SubAreaAct" class="form-control" maxlength="" value="<?php echo $ope->getOpe_SubArea(); ?>" required> */ ?>
              <select id="Ope_SubAreaAct" class="form-control" required>
                <?php foreach($resAre as $registro5){ ?>
                  <option value="<?php echo $registro5[1]; ?>" <?php echo $ope->getOpe_SubArea() == $registro5[1] ? "selected" : ""; ?>><?php echo $registro5[1]; ?></option>
                <?php } ?>
              </select>
            </div> 
            <div class="form-group">
              <label class="control-label">Planta<span class="rojo">*</span></label>
              <select id="Ope_Pla_CodigoAct" class="form-control" required>
                <option></option>
                <?php foreach($resPla as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>"  <?php echo $ope->getPla_Codigo() == $registro[0] ? "selected" : ""; ?>><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Estado:</label>
              <select id="Ope_EstadoAct" class="form-control">
                <option value="1" <?php echo $ope->getOpe_Estado() == "1" ? "selected" : ""; ?>>Activo</option>
                <option value="0" <?php echo $ope->getOpe_Estado() == "0" ? "selected" : ""; ?>>Inactivo</option>
              </select>
            </div>
            
          </div>
          
        </form>
      </div>
    </div>
  </div>
</div>