<?php
include("op_sesion.php");
include("../class/parametros.php");
include("../class/usuarios_areas.php");
include("../class/usuarios_plantas.php");
include("../class/plantas.php");

$par = new parametros();
$resTipDoc = $par->listarParametroTipoFlujoNormal("1", "NULL");

$usuA = new usuarios_areas();
$resUsuA = $usuA->listarAreasUsuariosFiltroPlanta($_SESSION['GD_Usuario']);

$pla = new plantas();
$resPla = $pla->listarPlantasUsuarioCrear("1", $_SESSION['GD_Usuario']);

$uPla = new usuarios_plantas();
$resUsuPla = $uPla->listarPlantasUsuario($_SESSION['GD_Usuario']);
$cantPlantas = count($resUsuPla);
?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading" align="center">
                <strong class="letra18">CREAR SOLICITUD</strong>
            </div>
            <div class="panel-body">
                <form id="f_solicitudesCrear" role="form">
                    <?php if ($cantPlantas == 1) { ?>
                        <div class="form-group">    
                            <input type="hidden" value="<?php echo "-1" ?>" id="Sol_Pla_CodigoCrear">
                            <label class="control-label">Área:</label>
                            <select id="Sol_Area_Codigo" class="form-control" required>
                                <option></option>
                                <?php foreach ($resUsuA as $registro) { ?>
                                    <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                                <?php } ?>	
                            </select>
                        </div>
                    <?php  } else { ?>
                        <div class="form-group">
                            <label class="control-label">Planta<span class="rojo">*</span></label>
                            <select id="Sol_Pla_CodigoCrear" class="form-control" required>
                                <option value="-1"></option>
                                <?php foreach ($resPla as $registro) { ?>
                                    <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Área: <span class="rojo">*</span></label>
                            <select id="Sol_Area_Codigo" class="form-control" required>
                                <option value="-1"></option>
                            </select>
                        </div>
                    <?php } ?>

                    <div class="form-group">
                        <label class="control-label">Tipo Documento:<span class="rojo">*</span></label>
                        <select id="Sol_TipoDocumento" class="form-control" required>
                            <option></option>
                            <?php foreach ($resTipDoc as $registro) { ?>
                                <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Nombre Documento:<span class="rojo">*</span></label>
                        <input type="text" id="Sol_Tema" class="form-control" maxlength="250" required>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Observaciones:<span class="rojo">*</span></label>
                        <textarea id="Sol_Observaciones" class="form-control" required></textarea>
                    </div>
                    <br>
                    <div align="center">
                        <button type="submit" id="Btn_SolicitudesCrearForm" class="btn btn-primary">CREAR SOLICITUD</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>