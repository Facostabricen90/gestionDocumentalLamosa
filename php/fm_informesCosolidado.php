<?php 
include("op_sesion.php");
include("../class/plantas.php"); 

$pla = new plantas();
$resPla = $pla->listarMarcaFilto($_SESSION['GD_Usuario']);
$resPlaFilter = $pla->listarPlantasFiltroMarcaPorUsuario($_SESSION['GD_Usuario']);
date_default_timezone_set("America/Bogota");
setlocale(LC_TIME, 'spanish');

$fechaIni = date("Y-m-d", strtotime(' - 1 years'));
$fechaFin = date("Y-m-d");

foreach ($resPlaFilter as $registro6)
    $vectUsuPlanta[$regsitro6[1]] = $registro6[0];
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/informes.js?<?php echo rand();?>"></script>
<script src="../ext/graficos/js/highcharts.js"></script>
<script src="../ext/graficos/js/modules/exporting.js"></script>
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
    /*
$(document).ready(function(e) {
  $("#Btn_BuscarCatalogoDocumentos").click();
}); */
</script>
</head>
<?php include("s_menu.php"); ?>
<body>
  <div id="d_contenedor" class="container-fluid">
    <!-- Todo el Contenido -->
    <div class="col-lg-12 col-md-12 col-sm-12 tituloEnc text-center">Informe Consolidado Catálogo</div>
    <div class="panel-heading">
      <div class="row">
        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#Solicitudes">Catalogo de documentos</a></li>
        </ul>
      </div>
    </div>
    <div class="panel-body">
      <div class="row">
        <div class="tab-content">
          <div id="Solicitudes" class="tab-pane fade in active">
            <div class="row">
              <div class="panel panel-primary">
                <div class="panel-heading">&nbsp;
                  <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2">
                      <div class="form-group">
                        <label class="control-label">País:</label>
                        <select id="FiltroCatDocInf_Pais" class="form-control" multiple data-mod="FiltroCatDocInf_Planta">
                          <?php foreach ($resPla as $registro) { ?>
                            <option value="<?php echo $registro[0]; ?>"<?php $vectUsuPlanta[$_SESSION['GD_Usuario']] == $registro[0] ? "selected" : ""; ?>><?php echo $registro[0]; ?></option>
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
                        <button class="btn btn-primary" id="Btn_BuscarCatalogoDocumentos">Buscar</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="panel-body e_CargarDatosCatalogoDocumentos"></div>
              </div>      
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
<!-- Crear Almacenes -->
<div id="vtn_DetalleIngreso" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body info_DetalleIngreso"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
    <!-- Ver Catalogo -->
  <div id="vtn_VerCatalogo" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body info_VerCatalogo">
        </div>
        <div class="modal-footer">
          <div class="d_mensajeVerCatalogo"></div>
          
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
<script type="text/javascript">cargarfecha();</script>