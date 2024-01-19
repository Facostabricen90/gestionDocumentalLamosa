<?php
include("op_sesion.php");
include("../class/operarios.php");
include("../class/areas.php");
include("../class/plantas.php");

$pla = new plantas();
$resPla = $pla->listarPlantasUsuarioCrear("1", $_SESSION['GD_Usuario']);

$ope1 = new operarios();
$ope1->setOpe_Codigo($_POST['codigo']);
$ope1->consultar();

$are1 = new areas();
$resAre1 = $are1->listarAreasFiltro($_SESSION['GD_Usuario']);

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>CREAR OPERARIO</strong>
      </div>

      <div class="panel-body">
        <form id="f_operariosCrear" role="form">
          
          <div class="col-lg-6 col-md-6 col-sm-6">
            
            <div class="form-group">
              <label class="control-label">Nombre:<span class="rojo">*</span></label>
              <input type="text" id="Ope_Nombre" class="form-control" maxlength="30" required>
            </div>

            <div class="form-group">
              <label class="control-label">Apellido:<span class="rojo">*</span></label>
              <input type="text" id="Ope_Apellido" class="form-control" maxlength="30" required>
            </div>
            <div class="form-group">
              <label class="control-label">Cédula:<span class="rojo">*</span></label>
              <input type="text" id="Ope_Cedula" class="form-control" maxlength="20" required>
            </div>
            <div class="form-group">
              <label class="control-label">Correo:</label>
              <input type="email" id="Ope_Correo" class="form-control" maxlength="80">
            </div>
             <div class="form-group">
              <label class="control-label">Telefono:</label>
              <input type="text" id="Ope_Telefono" class="form-control" maxlength="20">
            </div>
            <div class="form-group">
              <label class="control-label">Cargo:<span class="rojo">*</span></label>
              <input type="text" id="Ope_Cargo" class="form-control" maxlength=""required>
            </div>
            <div class="form-group">
              <label class="control-label">Género:<span class="rojo">*</span></label>
              <select id="Ope_Sexo" class="form-control" required>
                <option value="">--</option>
                <option value="H">H</option>
                <option value="M">M</option>
              </select>
            </div>
            
          </div>
          
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
              <label class="control-label">Código De Centro Costos:<span class="rojo">*</span></label>
              <input type="text" id="Ope_CodigoCCosto" class="form-control" maxlength=""required>
            </div>
            <div class="form-group">
              <label class="control-label">Nombre De Centro Costos:<span class="rojo">*</span></label>
              <input type="text" id="Ope_NombreCCosto" class="form-control" maxlength=""required>
            </div>
            <div class="form-group">
              <label class="control-label">Jefe:<span class="rojo">*</span></label>
              <input type="text" id="Ope_Jefe" class="form-control" maxlength=""required>
            </div>
            <div class="form-group">
              <label class="control-label">Área LATAM:<span class="rojo">*</span></label>
              <input type="text" id="Ope_AreaLATAM" class="form-control" maxlength=""required>
            </div>
            <div class="form-group">
              <label class="control-label">Tipo Función:<span class="rojo">*</span></label>
              <input type="text" id="Ope_TipoFuncion" class="form-control" maxlength=""required>
            </div>
            <div class="form-group">
              <label class="control-label">Gerencia:<span class="rojo">*</span></label>
              <input type="text" id="Ope_Gerencia" class="form-control" maxlength=""required>
            </div>
            <div class="form-group">
              <label class="control-label">Planta<span class="rojo">*</span></label>
              <select id="Ope_Pla_Codigo" class="form-control" required>
                <option></option>
                <?php foreach($resPla as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
              <div class="form-group">
              <label class="control-label">Area<span class="rojo">*</span></label>
              <select id="Ope_Area_Codigo" class="form-control" required>
                <option>--</option>
                <?php /* foreach($resAre1 as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                <?php }*/ ?>
              </select>
            </div>
              <div class="form-group">
              <label class="control-label">Subárea:<span class="rojo">*</span></label>
              <select id="Ope_SubArea" class="form-control" required>
                <option>--</option>
                <?php /* foreach($resAre1 as $registro){ ?>
                  <option value="<?php echo $registro[1]; ?>"><?php echo $registro[1]; ?></option>
                <?php }*/ ?>
              </select>
            </div> 
          </div>
          
         
        </form>
      </div>
    </div>
  </div>
</div>