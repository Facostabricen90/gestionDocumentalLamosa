<?php
include("op_sesion.php");

include_once("../class/usuarios.php");
include("../class/plantas.php");

$pla = new plantas();
$resPla = $pla->listarMarcaFilto($_SESSION['GD_Usuario']);
date_default_timezone_set("America/Bogota");

$fechaIni = date("Y-m-d", strtotime(' - 1 years'));
$fechaFin = date("Y-m-d");
?>
<script>
    /*
     $(document).ready(function(e) {
     $("#Btn_BuscarCicloDocumentalConsolidado").click();
     });*/
</script>
<div class="row">
    <div class="panel panel-primary">
        <div class="panel-heading">&nbsp;
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
                    <div class="form-group">
                        <label class="control-label">Fecha Inicial:</label>
                        <input type="text" id="filtroCicloDocumental_FechaIni" class="form-control fecha" value="<?php echo $fechaIni; ?>">
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
                    <div class="form-group">
                        <label class="control-label">Fecha Final:</label>
                        <input type="text" id="filtroCicloDocumental_FechaFin" class="form-control fecha" value="<?php echo $fechaFin; ?>">
                    </div>
                </div>			
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <div class="form-group">
                        <label class="control-label">País:</label>
                        <select id="FiltroCatDocInf_Pais" class="form-control" multiple data-mod="FiltroCatDocInf_Planta">
                            <?php foreach ($resPla as $registro) { ?>
                                <option value="<?php echo $registro[0]; ?>"<?php echo $pla->listarPlantasFiltroMarcaPorUsuario($_SESSION['GD_Usuario']) == $registro2[0] ? "selected" : ""; ?>><?php echo $registro[0]; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 e_cargarFiltroCatDocInfPlantas">
                    <div class="form-group">
                        <label class="control-label">Planta:</label>
                        <select id="FiltroCatDocInf_Planta" class="form-control">
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <br>
                    <div class="form-group">
                        <button class="btn btn-primary" id="Btn_BuscarCicloDocumentalConsolidado">Buscar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-body e_CargarListaCicloDocumentalConsolidado"></div>
    </div>      
</div>
<script>
    cargarfecha();
</script>