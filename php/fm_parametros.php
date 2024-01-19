<?php 
include("op_sesion.php"); 
$pParametros = $usuper->Permisos($_SESSION['GD_Usuario'], 2);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/parametros.js"></script>
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
              <strong class="letra16">Parámetros</strong>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
              <br>
              <div class="input-group"> <span class="input-group-addon"><strong>Buscar:</strong></span>
                <input id="filtrar_Parametros" type="text" class="form-control">
              </div>
              
            </div>
            
            <div class="col-lg-2 col-md-2 col-sm-2">
              <div class="form-group">
                <label class="control-label">Estado:</label>
                <select id="FiltroParametros_Estado" class="form-control">
                  <option value="-1">Todos</option>
                  <option value="1" selected>Activos</option>
                  <option value="0">Inactivo</option>
                </select>
              </div>
            </div>
            
            <div class="col-lg-2 col-md-2 col-sm-2">
              <br>
              <?php if(isset($pParametros) && $pParametros[5] == "1"){ ?>
                <button id="Btn_ParametrosCrear" class="btn btn-success">Crear</button>
              <?php } ?>
            </div>
            
            <div class="col-lg-2 col-md-2 col-sm-2">
              <br>
              <img src="../imagenes/excel.png" width="30px" class="excel_Parametros manito" title="Exportar a Excel">
            </div>
            
          </div>
            
        </div>
        
        <div class="panel-body info_cargarParametrosListar">
        
        
        </div>
      </div>
      
    </div>
    
  </div>
  
<!-- Crear Parametros -->
<div id="vtn_ParametrosCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_ParametrosCrear">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="Btn_ParametrosCrearForm" form="f_parametrosCrear">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Actualizar Parametros -->
<div id="vtn_ParametrosActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_ParametrosActualizar">
      </div>
      <div class="modal-footer">
        <div class="d_mensajeParametrosActualizar"></div>
        <?php if(isset($pParametros) && $pParametros[4] == "1"){ ?>
          <button type="submit" id="Btn_ParametrosActualizarForm" class="btn btn-success" form="f_parametrosActualizar">Actualizar</button>
        <?php } ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Notificaciones Parametros Crear -->
<div id="vtn_ParametrosNotificacionesCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_ParametrosNotificacionesCrear" align="center">
      </div>
      <div class="modal-footer">
        <button type="button" id="Btn_ParametrosNotificacionesCrear" class="btn btn-success">Aceptar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Notificaciones Parametros Actualizar -->
<div id="vtn_ParametrosNotificacionesActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_ParametrosNotificacionesActualizar" align="center">
      </div>
      <div class="modal-footer">
        <button type="button" id="Btn_ParametrosNotificacionesActualizar" class="btn btn-success">Aceptar</button>
      </div>
    </div>
  </div>
</div>
  
</body>
</html>