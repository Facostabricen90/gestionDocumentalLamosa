<?php
include("op_sesion.php");
include("../class/areas.php");
include("../class/plantas.php");

$pla = new plantas();
$resPla = $pla->listarPlantasUsuarioCrear("1", $_SESSION['GD_Usuario']);

$usu1 = new usuarios();
$resUsu1 = $usu1->listarUsuariosFluA("-1", $_SESSION['GD_Usuario']);

$are = new areas();
$resAre = $are->listarAreasFiltro();
?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <strong>CREAR FLUJO</strong>
            </div>

            <div class="panel-body">
                <form id="f_flujosAprobacionesCrear" role="form">
                    <div class="form-group">
                        <label class="control-label">Nombre: <span class="rojo">*</span></label>
                        <select id="Usu_Usu_Codigo" class="form-control" required>
                            <?php foreach ($resUsu1 as $registro1) { ?>
                                <option value="<?php echo $registro1[0]; ?>"><?php echo $registro1[1]; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Tipo Flujo: <span class="rojo">*</span></label>
                        <select id="FluA_TipoFlujo" class="form-control" required>
                            <option></option>
                            <option value="1">Documentos Equipo Industrial</option>
                            <option value="2">Perfil de Competencias</option>
                            <option value="3">Matriz IPERC y/o Mapas de Seguridad</option>
                        </select>
                    </div>

                    <div class="info_CargarPasoTipoFlujoCrearAdmin">
                        <div class="form-group">
                            <label class="control-label">Paso: <span class="rojo">*</span></label>
                            <select id="FluA_Paso" class="form-control" required>
                                <option></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Planta<span class="rojo">*</span></label>
                        <select id="FluA_Pla_Codigo" class="form-control" required>
                            <option></option>
                            <?php foreach ($resPla as $registro) { ?>
                                <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Área: <span class="rojo">*</span></label>
                        <select id="Usu_Are_Codigo" class="form-control" required>
                            <option></option>
                            <?php /* foreach ($resAre as $registro3) { ?>
                                <option value="<?php echo $registro3[0]; ?>"><?php echo $registro3[1]; ?></option>
                                
                            <?php }*/ ?>
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
