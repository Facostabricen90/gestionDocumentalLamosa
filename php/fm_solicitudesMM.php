<?php
include("op_sesion.php");
include("../class/parametros.php");
include("../class/flujos_aprobaciones.php");
include("../class/usuarios_areas.php");
include("../class/plantas.php"); 

$pla = new plantas();
$resPla = $pla->listarMarcaFilto($_SESSION['GD_Usuario']);

date_default_timezone_set("America/Bogota");

$fecha = date("Y-m-d");
$fechaInicio = date("Y-m-d", strtotime($fecha."- 360 days"));

$usuA = new usuarios_areas();
$resUsuA = $usuA->listarAreasUsuariosFiltroPlanta($_SESSION['GD_Usuario']);

$cantAreas = count($resUsuA);

$par = new parametros();
$resPar = $par->listarParametroTipo("3", "Pasos");

$fluA = new flujos_aprobaciones();
$resFluA = $fluA->listarFlujoAprobacionesSolicitudesUsuariosTipoFlujoMM($_SESSION['GD_Usuario'], $usu->getUsu_TipoFlujo());

foreach($resFluA as $registro2){
	$Areas[$registro2[1]] = $registro2[1];
	$Paso[$registro2[1].$registro2[2]] = $registro2[2];
	$PasoCrear[$registro2[2]] = $registro2[2];
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/solicitudesMM.js?<?php echo rand()?>"></script>
<script>
  $(document).ready(function(e) {
    $("#Btn_BuscarSolicitudesMM").click();
  });
</script>
</head>
<?php include("s_menu.php"); ?>
<body>
  <div id="d_contenedor" class="container-fluid">
    <br>
    <!-- Todo el Contenido -->
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <div class="row">
              <div class="col-lg-1 col-md-1">
                <strong class="letra16">Solicitudes&nbsp;&nbsp;&nbsp;&nbsp;</strong>
              </div>
              <div class="col-lg-1 col-md-1">
                <div class="form-group">
                  <label class="control-label">Fecha Inicial:</label>
                  <input type="text" id="filtroSolicitudesMM_FechaInicial" class="form-control fecha" value="<?php echo $fechaInicio ?>">
                </div>
              </div>
              
              <div class="col-lg-1 col-md-1">
                <div class="form-group">
                  <label class="control-label">Fecha Final:</label>
                  <input type="text" id="filtroSolicitudesMM_FechaFinal" class="form-control fecha" value="<?php echo $fecha ?>">
                </div>
              </div>
              
              <div class="col-lg-2 col-md-2">
                <div class="form-group">
                  <label class="control-label">Estados:</label>
                  <select id="filtroSolicitudesMM_Estado" class="form-control">
                    <option value="-1">Todos</option>
                    <?php foreach($resPar as $registro){ ?>
											<option value="<?php echo $registro[2]; ?>"><?php echo $registro[2].". ".$registro[1]; ?></option>
										<?php } ?>
                  </select>
                </div>
              </div>
              
              <?php /* if($resUsuA){ ?>
                <?php if($cantAreas >= 2){ */ ?>
                  <div class="form-group col-lg-2 col-md-2 col-sm-2">
                    <label class="control-label">Área:</label>
                    <select id="SolMM_Area_Nombres" class="form-control" required>
                      <option value="-1">Todos</option>
                      <?php foreach($resUsuA as $registro){ ?>
                        <option value="<?php echo $registro[1]; ?>"><?php echo $registro[1]; ?></option>
                      <?php } ?>	
                    </select>
                  </div>
                <?php /* }else{ ?>
                  <?php foreach($resUsuA as $registro){ ?>
                    <input type="hidden" id="SolMM_Area_Codigo" class="form-control" value="<?php echo $registro[0]; ?>">
                  <?php } ?>
                <?php } ?>
              <?php } */ ?>
              <div class="col-lg-2 col-md-2 col-sm-2">
                <div class="form-group">
                  <label class="control-label">País:</label>
                  <select id="FiltroSolmm_Pais" class="form-control" multiple data-mod="FiltroSolmm_Planta">
                    <?php foreach($resPla as $registro){ ?>
                      <option value="<?php echo $registro[0]; ?>"><?php echo $registro[0]; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-lg-2 col-md-2 col-sm-2 e_cargarFiltroSolmmPlantas">
                <div class="form-group">
                  <label class="control-label">Planta:</label>
                  <select id="FiltroSolmm_Planta" class="form-control">
                  </select>
                </div>
              </div>
              <div class="limpiar"></div>
              <div class="col-lg-1 col-md-1">
                <br>
                <button id="Btn_BuscarSolicitudesMM" class="btn btn-info">Buscar</button>
              </div>
              
              <div class="col-lg-1 col-md-1">
                <br>
								
								<?php if($usu->getUsu_Rol() == "Administrador"){ ?>
                	<button id="Btn_SolicitudesMMCrear" class="btn btn-primary">Crear</button>
								<?php }else{ ?>
									<?php if($PasoCrear["1"]){ ?>
										<button id="Btn_SolicitudesMMCrear" class="btn btn-primary">Crear</button>
									<?php } ?>
								<?php } ?>
              </div>
              
              <div class="col-lg-1 col-md-1 col-sm-1">
                <br>
                <form action="op_excelExportacion.php" method="post" id="f_exportarSolicitudesmm" target="_blank">
                  <img src="../imagenes/excel.png" width="30" height="30" id="btn_excelSolicitudesmm" class="manito">
                  <input type="hidden" name="nombre" value="Listado Ciclo">
                  <input type="hidden" name="resultado" id="input_resultadoSolicitudesmm">
                </form>
              </div>
              <?php /*?><div class="col-lg-1 col-md-1 col-sm-1">
                <br>
                <img src="../imagenes/instrucciones.png" width="30px" class="abrir_guia manito" title="Abrir Guías">
              </div><?php */?>
              
            </div>
          </div>

          <div class="panel-body info_solicitudesMMListar">
            
          </div>
        </div>
      </div>
    </div>
    
  </div>
  
<!-- Crear Solicitudes -->
<div id="vtn_SolicitudesMMCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body info_SolicitudesMMCrear">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
  
  <!-- Gestionar Solicitudes -->
<div id="vtn_SolicitudesMMGestionar" class="modal fade" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body info_SolicitudesMMGestionar">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
  
<!-- Gestionar Consultar -->
<div id="vtn_SolicitudesMMConsultar" class="modal fade" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body info_SolicitudesMMConsultar">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Notificaciones Solicitudes Crear -->
<div id="vtn_SolicitudesMMNotificacionesCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_SolicitudesMMNotificacionesCrear" align="center">
      </div>
      <div class="modal-footer">
        <button type="button" id="Btn_SolicitudesMMNotificacionesCrear" class="btn btn-success">Aceptar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Notificaciones Solicitudes Aprobar -->
<div id="vtn_SolicitudesMMNotificacionesAprobar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_SolicitudesMMNotificacionesAprobar" align="center">
      </div>
      <div class="modal-footer">
        <button type="button" id="Btn_SolicitudesMMNotificacionesAprobar" class="btn btn-success">Aceptar</button>
      </div>
    </div>
  </div>
</div>
	
<!-- CapacitacionesOperarios -->
<div id="vtn_CapacitacionesMMOperarios" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body info_CapacitacionesMMOperarios">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Actualizar SolicitudesAdm -->
<div id="vtn_SolicitudesAdmActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body info_SolicitudesAdmActualizar">
      </div>
      <div class="modal-footer">
        <button type="submit" id="Btn_SolicitudesAdmActualizarForm" class="btn btn-warning" form="f_solicitudesAdminActualizar">Actualizar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Notificaciones Solicitudes Crear -->
<div id="vtn_SolicitudesAdmNotificaciones" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_SolicitudesAdmNotificaciones" align="center">
      </div>
      <div class="modal-footer">
        <button type="button" id="Btn_SolicitudesAdmNotificaciones" class="btn btn-success">Aceptar</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
<script type="text/javascript">cargarfecha();</script>