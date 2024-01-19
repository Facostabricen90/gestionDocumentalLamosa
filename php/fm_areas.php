<?php
include("op_sesion.php");
include("../class/plantas.php"); 

$pla = new plantas();
$resPla = $pla->listarMarcaFilto($_SESSION['GD_Usuario']);

$pAreas = $usuper->Permisos($_SESSION['GD_Usuario'], 4);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/areas.js"></script>
</head>
<?php include("s_menu.php"); ?>
<body>
  <div id="d_contenedor" class="container">
    <!-- Todo el Contenido -->
    
    <div class="col-lg-12 col-md-12">
      
      <div class="panel panel-primary">
        <div class="panel-heading">
        
          <div class="row">
            <div class="col-lg-1 col-md-1">
                <strong class="letra16">Áreas</strong>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3">
              <br>
              <div class="input-group"> <span class="input-group-addon"><strong>Buscar:</strong></span>
                <input id="filtrar_Areas" type="text" class="form-control">
              </div>
              
            </div>
            
            <div class="col-lg-2 col-md-2 col-sm-2">
              <div class="form-group">
                <label class="control-label">Estado:</label>
                <select id="FiltroAreas_Estado" class="form-control">
                  <option value="-1">Todos</option>
                  <option value="1" selected>Activos</option>
                  <option value="0">Inactivo</option>
                </select>
              </div>
            </div>
            
            <div class="col-lg-2 col-md-2 col-sm-2">
              <div class="form-group">
                <label class="control-label">País:</label>
                <select id="FiltroArea_Pais" class="form-control" multiple data-mod="FiltroArea_Planta">
                  <?php foreach($resPla as $registro){ ?>
                    <option value="<?php echo $registro[0]; ?>"><?php echo $registro[0]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 e_cargarFiltroAreaPlantas">
              <div class="form-group">
                <label class="control-label">Planta:</label>
                <select id="FiltroArea_Planta" class="form-control">
                </select>
              </div>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1">
              <br>
							<?php if(isset($pAreas) && $pAreas[5] == "1"){ ?>
              	<button id="Btn_AreasCrear" class="btn btn-success">Crear</button>
							<?php } ?>
            </div>
            
            <div class="col-lg-1 col-md-1 col-sm-1">
              <br>
                <button id="Btn_AreasBuscar" class="btn btn-primary">Buscar</button>
            </div>
            
            <div class="col-lg-1 col-md-1 col-sm-1">
              <br>
              <img src="../imagenes/excel.png" width="30px" class="excel_Areas manito" title="Exportar a Excel">
            </div>
            
          </div>
            
        </div>
        
        <div class="panel-body info_cargarAreasListar">
        
        
        </div>
      </div>
      
    </div>
    
  </div>
  <!-- Crear Areas -->
<div id="vtn_AreasCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_AreasCrear">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="Btn_AreasCrearForm" form="f_areasCrear">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Actualizar Areas -->
<div id="vtn_AreasActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_AreasActualizar">
      </div>
      <div class="modal-footer">
        <div class="d_mensajeAreasActualizar"></div>
				<?php if(isset($pAreas) && $pAreas[4] == "1"){ ?>
        	<button type="submit" id="Btn_AreasActualizarForm" class="btn btn-success" form="f_areasActualizar">Actualizar</button>
        <?php } ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
  
  <!-- Notificaciones Areas Crear -->
<div id="vtn_AreasNotificacionesCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_AreasNotificacionesCrear" align="center">
      </div>
      <div class="modal-footer">
        <button type="button" id="Btn_AreasNotificacionesCrear" class="btn btn-success">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones Areas Actualizar -->
<div id="vtn_AreasNotificacionesActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_AreasNotificacionesActualizar" align="center">
      </div>
      <div class="modal-footer">
        <button type="button" id="Btn_AreasNotificacionesActualizar" class="btn btn-success">Actualizar</button>
      </div>
    </div>
  </div>
</div>
  

</body>
</html>