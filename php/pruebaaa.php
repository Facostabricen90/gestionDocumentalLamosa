<?php 
include("op_sesion.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/asd.js"></script>
</head>
<?php include("s_menu.php"); ?>
<body>
  <div id="d_contenedor" class="container-fluid">
    <!-- Todo el Contenido -->
    <div class="col-lg-12 col-md-12 col-sm-12 alert alert-danger tituloEnc text-center">Temas</div>
    <div class="col-lg-12 col-md-12">
      
      <div class="panel panel-primary">
        <div class="panel-heading">
          <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3">
              <br>
              <div class="input-group"> <span class="input-group-addon"><strong>Buscar:</strong></span>
                <input id="filtrar_Usuarios" type="text" class="form-control">
              </div>
              
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2">
              <div class="form-group">
                <label class="control-label">Área:</label>
                <select id="Filtro_AreaUsuario" class="form-control">
                  <option value="-1">Todos</option>
                  <?php foreach($resAre as $registro){ ?>
                    <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2">
              <div class="form-group">
                <label class="control-label">Jefes:</label>
                <select id="Filtro_JefesUsuario" class="form-control">
                  <option value="-1">Todos</option>
                  <?php foreach($jefe as $registro1){ ?>
                    <option value="<?php echo $registro1[0]; ?>"><?php echo $registro1[1]; ?></option>
                  <?php } ?>
                </select>                
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2">
              <div class="form-group">
                <label class="control-label">Estado:</label>
                <select id="Filtro_Estado" class="form-control">
                  <option value="1" selected>Activos</option>
                  <option value="0">Inactivos</option>
                  
                </select>                
              </div>
            </div>
            
            <div class="col-lg-1 col-md-1 col-sm-1">
              <br>
              <button id="Btn_CrearUsuario" class="btn btn-success">Crear</button>
            </div>
            
          </div>
            
        </div>
        
        <div class="panel-body info_cargarUsuariosListar">
          <div class="col-lg-4 col-md-4">
              
          </div>
          <div class="col-lg-4 col-md-4">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <button type="button" class="btn btn-primary">Filtrar</button>    
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <button type="button" class="btn btn-primary">Quitar</button>    
            </div>
          </div>
        
        </div>
      </div>
      
    </div>
    
  </div>
  
  <!-- Crear Usuarios -->
  <div id="vtn_UsuariosCrear" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body info_UsuariosCrear">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id="Btn_UsuariosCrearForm" form="f_usuariosCrear">Crear</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Actualizar Usuarios -->
  <div id="vtn_UsuariosActualizar" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body info_UsuariosActualizar">
        </div>
        <div class="modal-footer">
          <div class="d_mensajeUsuariosActualizar"></div>
          <button type="submit" id="Btn_UsuariosActualizarForm" class="btn btn-warning" form="f_usuariosActualizar">Actualizar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Notificaciones Usuarios Crear -->
  <div id="vtn_UsuariosNotificacionesCrear" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body info_UsuariosNotificacionesCrear" align="center">
        </div>
        <div class="modal-footer">
          <button type="button" id="Btn_UsuariosNotificacionesCrear" class="btn btn-success">Aceptar</button>
        </div>
      </div>
    </div>
  </div>
  
  
<!-- Notificaciones Usuarios Actualizar -->
  <div id="vtn_UsuariosNotificacionesActualizar" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body info_UsuariosNotificacionesActualizar" align="center">
        </div>
        <div class="modal-footer">
          <button type="button" id="Btn_UsuariosNotificacionesActualizar" class="btn btn-success">Aceptar</button>
        </div>
      </div>
    </div>
  </div>
</body>
</html>