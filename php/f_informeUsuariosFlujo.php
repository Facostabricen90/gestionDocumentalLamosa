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
<style>
  .input-group-addon{
    font-size: 15px;
  }
  body{
    background: #ffffff !important;
    font-size: 14px;
  }
</style>
<script>
    $(document).ready(function (e) {
        $("#Btn_BuscarUsuariosFlujoConsolidado").click();
    });
</script>
<div class="row">
    <div class="panel panel-primary">
        <div class="panel-heading">&nbsp;
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
                    <div class="form-group">
                        <label class="control-label">Fecha Inicial:</label>
                        <input type="text" id="filtroUsuariosFlujo_FechaIni" class="form-control fecha" value="<?php echo $fechaIni; ?>">
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
                    <div class="form-group">
                        <label class="control-label">Fecha Final:</label>
                        <input type="text" id="filtroUsuariosFlujo_FechaFin" class="form-control fecha" value="<?php echo $fechaFin; ?>">
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <div class="form-group">
                        <label class="control-label">País:</label>
                        <select id="FiltroCatDocInf_PaisUsuarios" class="form-control" multiple data-mod="FiltroCatDocInf_PlantaUsuarios">
                            <?php foreach ($resPla as $registro) { ?>
                                <option value="<?php echo $registro[0]; ?>"><?php echo $registro[0]; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 e_cargarFiltroCatDocInfPlantasUsuarios">
                    <div class="form-group">
                        <label class="control-label">Planta:</label>
                        <select id="FiltroCatDocInf_PlantaUsuarios" class="form-control">
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <br>
                    <div class="form-group">
                        <button class="btn btn-primary" id="Btn_BuscarUsuariosFlujoConsolidado">Buscar</button>
                    </div>
                </div>
                <!--
                                                <div class="col-lg-1 col-md-1 col-sm-1">
                                                        <form action="op_excelExportacion.php" method="post" id="f_estadisticaUsuariosFlujoConsolidado" target="_blank">
                                                                <img src="../images/excel.png" width="30" height="30" id="b_excelUsuariosFlujoConsolidado">
                                                                <input type="hidden" name="nombre" value="UsuariosFlujoConsolidado">
                                                                <input type="hidden" name="resultado" id="input_resultadoUsuariosFlujoConsolidado">
                                                        </form>
                                                        <form action="op_excelExportacion.php" method="post" id="f_estadisticaUsuariosFlujoConsolidadoC" target="_blank">
                                                                <img src="../images/reportes.png" width="30" height="30" id="b_excelUsuariosFlujoConsolidadoC">
                                                                <input type="hidden" name="nombre" value="UsuariosFlujoConsolidado Comportamiento">
                                                                <input type="hidden" name="resultado" id="input_resultadoUsuariosFlujoConsolidadoC">
                                                        </form>
                                                </div>
                -->
            </div>
        </div>

        <div class="panel-body e_CargarListaUsuariosFlujoConsolidado"></div>
    </div>      
</div>
<script>
    cargarfecha();
</script><!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Documento sin título</title>
    </head>

    <body>
    </body>
</html>
