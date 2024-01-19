<?php 
include("op_sesion.php"); 
$pPlantas = $usuper->Permisos($_SESSION['GD_Usuario'], 3);
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
  <div id="d_contenedor" class="container">
    <!-- Todo el Contenido -->
    
    <div class="col-lg-12 col-md-12">
      
      <div class="panel panel-primary">
        <div class="panel-heading">
        
          <div class="row">
            <div class="col-lg-2 col-md-2">
              <strong class="letra16">Plantas</strong>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
              <br>
              <div class="input-group"> <span class="input-group-addon"><strong>Buscar:</strong></span>
                <input id="filtrar_Plantas" type="text" class="form-control">
              </div>
              
            </div>
            
            <div class="col-lg-2 col-md-2 col-sm-2">
              <div class="form-group">
                <label class="control-label">Estado:</label>
                <select id="FiltroPlantas_Estado" class="form-control">
                  <option value="-1">Todos</option>
                  <option value="1" selected>Activos</option>
                  <option value="0">Inactivo</option>
                </select>
              </div>
            </div>
            
            <div class="col-lg-2 col-md-2 col-sm-2">
              <br>
              <?php if(isset($pPlantas) && $pPlantas[5] == "1"){ ?>
                <button id="Btn_PlantasCrear" class="btn btn-success">Crear</button>
              <?php } ?>
            </div>
            
            <div class="col-lg-2 col-md-2 col-sm-2">
              <br>
              <img src="../imagenes/excel.png" width="30px" class="excel_Plantas manito" title="Exportar a Excel">
            </div>
            
          </div>
            
        </div>
        
        <div class="panel-body info_cargarPlantasListar">
        
        
        </div>
      </div>
      
    </div>
    
  </div>
  
<!-- Crear Plantas -->
<div id="vtn_PlantasCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_PlantasCrear">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="Btn_PlantasCrearForm" form="f_plantasCrear">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Actualizar Plantas -->
<div id="vtn_PlantasActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_PlantasActualizar">
      </div>
      <div class="modal-footer">
        <div class="d_mensajePlantasActualizar"></div>
        <?php if(isset($pPlantas) && $pPlantas[4] == "1"){ ?>
          <button type="submit" id="Btn_PlantasActualizarForm" class="btn btn-success" form="f_plantasActualizar">Actualizar</button>
        <?php } ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Notificaciones Plantas Crear -->
<div id="vtn_PlantasNotificacionesCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_PlantasNotificacionesCrear" align="center">
      </div>
      <div class="modal-footer">
        <button type="button" id="Btn_PlantasNotificacionesCrear" class="btn btn-success">Aceptar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Notificaciones Plantas Actualizar -->
<div id="vtn_PlantasNotificacionesActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_PlantasNotificacionesActualizar" align="center">
      </div>
      <div class="modal-footer">
        <button type="button" id="Btn_PlantasNotificacionesActualizar" class="btn btn-success">Aceptar</button>
      </div>
    </div>
  </div>
</div>
  
</body>
</html>