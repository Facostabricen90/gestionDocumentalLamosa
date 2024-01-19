<?php
include("op_sesion.php");

// error_reporting(E_ALL);
// ini_set('display_errors', 1);
include("../class/flujos_aprobaciones.php");
include("../class/areas.php");
include("../class/parametros.php");
include("../class/plantas.php");

$pla = new plantas();
$resPla = $pla->listarPlantasUsuarioCrear("1", $_SESSION['GD_Usuario']);

$usu1 = new usuarios();
$resUsu1 = $usu1->listarUsuariosFluA("-1", $_SESSION['GD_Usuario']);

$are= new areas();
$resAre = $are->listarAreasFiltro($_SESSION['GD_Usuario']);


$fluA = new flujos_aprobaciones();
$fluA->setFluA_Codigo($_POST['codigo']);
$fluA->consultar();

//$are_act = new areas($fluA->getArea_Codigo());
//$are_act->consultar();

$par = new parametros();

if ($fluA->getFluA_TipoFlujo() == "3") {
    $resPar = $par->listarParametroTipo("3", "-1");
} else {
    $resPar = $par->listarParametroTipo("2", "-1");
}
?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <strong>ACTUALIZAR FLUJO APROBACIÓN</strong>
            </div>

            <div class="panel-body">
                <form id="f_flujosAprobacionesActualizar" role="form">
                    <input type="hidden" id="FluA_CodigoAct" value="<?php echo $_POST['codigo']; ?>">
                    <div class="form-group">
                        <label class="control-label">Nombre:<span class="rojo">*</span></label>
                        <select id="Usu_CodigoAct" class="form-control" required>
                            <?php foreach ($resUsu1 as $registro1) { ?>
                                <option value="<?php echo $registro1[0]; ?>" <?php echo $fluA->getUsu_Codigo() == $registro1[0] ? "selected" : ""; ?>><?php echo $registro1[1]; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Responsable:<span class="rojo">*</span></label>
                        <select id="FluA_ResponsableAct" class="form-control" required>
                            <option value="" <?php echo $fluA->getFluA_Responsable() == "NULL" ? "selected" : ""; ?>></option>
                            <option value="1" <?php echo $fluA->getFluA_Responsable() == "1" ? "selected" : ""; ?>>Sí</option>
                            <option value="0" <?php echo $fluA->getFluA_Responsable() == "0" ? "selected" : ""; ?>>No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Tipo Flujo: <span class="rojo">*</span></label>
                        <select id="FluA_TipoFlujoAct" class="form-control" required>
                            <option></option>
                            <option value="1" <?php echo $fluA->getFluA_TipoFlujo() == "1" ? "selected" : ""; ?>>Documentos Equipo Industrial</option>
                            <option value="2" <?php echo $fluA->getFluA_TipoFlujo() == "2" ? "selected" : ""; ?>>Perfil de Competencias</option>
                            <option value="3" <?php echo $fluA->getFluA_TipoFlujo() == "3" ? "selected" : ""; ?>>Matriz IPERC y/o Mapas de Seguridad</option>
                        </select>
                    </div>

                    <div class="info_CargarPasoTipoFlujoCrearAdminAct"> 
                        <div class="form-group">
                            <label class="control-label">Paso: <span class="rojo">*</span></label>
                            <select id="FluA_PasoAct" class="form-control" required>
                                <option></option>
                                <?php foreach ($resPar as $registro2) { ?>
                                    <option value="<?php echo $registro2[2]; ?>" <?php echo $fluA->getFluA_Paso() == $registro2[2] ? "selected" : ""; ?>><?php echo $registro2[2] . ". " . $registro2[1]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Estado:</label>
                        <select id="FluA_EstadoAct" class="form-control">
                            <option value="1" <?php echo $fluA->getFluA_Estado() == "1" ? "selected" : ""; ?>>Activo</option>
                            <option value="0" <?php echo $fluA->getFluA_Estado() == "0" ? "selected" : ""; ?>>Inactivo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Planta<span class="rojo">*</span></label>
                        <select id="FluA_Pla_CodigoAct" class="form-control" required>
                            <option></option>
                            <?php foreach ($resPla as $registro) { ?>
                                <option value="<?php echo $registro[0]; ?>" <?php echo $fluA->getPla_Codigo() == $registro[0] ? "selected" : ""; ?>><?php echo $registro[1]; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Área:<span class="rojo">*</span></label>
                        <select id="Area_CodigoAct" class="form-control" required>
                            <?php /* foreach ($resAre as $registro2) { ?>
                            <option value="<?php echo $registro2[0]; ?>" <?php echo $are_act->getArea_Nombre() == $registro2[1] ? "selected" : ""; ?>><?php echo $registro2[1]; ?></option>
                            <?php } */ ?>
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>