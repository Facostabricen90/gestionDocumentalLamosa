<?php
include("op_sesion.php");
include("../class/parametros.php");
include("../class/usuarios_areas.php");
include("../class/plantas.php"); 

$pla = new plantas();
$resPla = $pla->listarMarcaFilto($_SESSION['GD_Usuario']);

$par = new parametros();
$resTipDoc = $par->listarParametroTipoCatalogo("1");

$usuA = new usuarios_areas();
$resUsuA = $usuA->listarAreasUsuariosFiltro($_SESSION['GD_Usuario']);


$cantAreas = count($resUsuA);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/plantas.js"></script>
</head>
<?php include("s_menu.php"); ?>
<body>
  <div id="d_contenedor" class="container-fluid">
    <!-- Todo el Contenido -->
    
    <div class="col-lg-12 col-md-12">
      
      <div class="panel panel-primary">
        <div class="panel-heading">
        
          <div class="row">
            <div class="col-lg-1 col-md-1">
                <strong class="letra16">Catálogo Documentos</strong>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3">
              <br>
              <div class="input-group"> <span class="input-group-addon"><strong>Buscar:</strong></span>
                <input id="filtrar_Catalogo" type="text" class="form-control">
              </div>
            </div>
              <?php if ($resUsuA) { ?>
                  <?php if ($cantAreas >= 2) { ?>
                      <div class="form-group col-lg-2 col-md-2 col-sm-2">
                          <label class="control-label">Área:</label>
                          <select id="Cat_Area_Codigocater" class="form-control" required>
                              <option value="-1">Todos</option>
                              <?php foreach ($resUsuA as $registro) { ?>
                                  <option value="<?php echo $registro[1]; ?>"><?php echo $registro[1]; ?></option>
                              <?php } ?>	
                          </select>
                      </div>
                  <?php } else { ?>
                      <?php foreach ($resUsuA as $registro) { ?>
                          <input type="hidden" id="Cat_Area_Codigo" class="form-control" value="<?php echo $registro[0]; ?>">
                      <?php } ?>
                  <?php } ?>
              <?php } ?>

          <div class="form-group col-lg-2 col-md-2 col-sm-2">
            <label class="control-label">Tipo Documento:<span class="rojo">*</span></label>
            <select id="Cat_TipoDocumento" class="form-control" required>
              <option value="-1">Todos</option>
              <?php foreach($resTipDoc as $registro){ ?>
                <option value="<?php echo $registro[1]; ?>"><?php echo $registro[1]; ?></option>
              <?php } ?>
            </select>
          </div>
            
            
            <div class="col-lg-2 col-md-2 col-sm-2">
              <div class="form-group">
                <label class="control-label">País:</label>
                <select id="FiltroCatDoc_Pais" class="form-control" multiple data-mod="FiltroCatDoc_Planta">
                  <?php foreach($resPla as $registro){ ?>
                    <option value="<?php echo $registro[0]; ?>"><?php echo $registro[0]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 e_cargarFiltroCatDocPlantas">
              <div class="form-group">
                <label class="control-label">Planta:</label>
                <select id="FiltroCatDoc_Planta" class="form-control">
                </select>
              </div>
            </div>
            <div class="limpiar"></div>
            <div class="col-lg-1 col-md-1 col-sm-1">
              <br>
                <button id="Btn_CatDocsBuscar" class="btn btn-primary">Buscar</button>
            </div>
            
            <div class="col-lg-1 col-md-1 col-sm-1">
              <br>
              <form action="op_excelExportacion.php" method="post" id="f_exportarCatalogo" target="_blank">
                <img src="../imagenes/excel.png" width="30" height="30" id="btn_excelCatalogo" class="manito">
                <input type="hidden" name="nombre" value="Catálogo Documentos">
                <input type="hidden" name="resultado" id="input_resultadoCatalogo">
              </form>
            </div>
<!--
            <div class="col-lg-1 col-md-1 col-sm-1">
              <br>
              <img src="../imagenes/excel.png" width="30px" class="excel_Catalogo manito" title="Exportar a Excel">
            </div>
-->
            <div class="col-lg-1 col-md-1 col-sm-1">
              <br>
              <a href="fm_catalogoDocumentosVersiones.php"><button class="btn btn-info">Versiones</button></a>
            </div>
          </div>
        </div>
        <div class="panel-body info_catalogoDocumentosListar">

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
  <!-- Ver Historial Catalogo -->
  <div id="vtn_HistorialCatalogo" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body info_HistorialCatalogo">
        </div>
        <div class="modal-footer">
          <div class="d_mensajeHistorialCatalogo"></div>
          
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