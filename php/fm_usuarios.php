<?php 
include("op_sesion.php"); 
include("../class/plantas.php"); 
$pUsuarios = $usuper->Permisos($_SESSION['GD_Usuario'], 1);

$pla = new plantas();
$resPla = $pla->listarMarcaFilto($_SESSION['GD_Usuario']);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/usuarios.js?<?php echo rand()?>"></script>
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
              <strong class="letra16">Usuarios</strong>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3">
              <br>
              <div class="input-group"> <span class="input-group-addon"><strong>Buscar:</strong></span>
                <input id="filtrar_Usuarios" type="text" class="form-control">
              </div>
              
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2">
              <div class="form-group">
                <label class="control-label">País:</label>
                <select id="FiltroUsuarios_Pais" class="form-control" data-mod="FiltroUsuarios_Planta" multiple>
                  <?php foreach($resPla as $registro){ ?>
                    <option value="<?php echo $registro[0]; ?>"><?php echo $registro[0]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 e_cargarFiltroUsuarios">
              <div class="form-group">
                <label class="control-label">Planta:</label>
                <select id="FiltroUsuarios_Planta" class="form-control">
                </select>
              </div>
            </div>
            
            <div class="col-lg-2 col-md-2 col-sm-2">
              <div class="form-group">
                <label class="control-label">Estado:</label>
                <select id="FiltroUsuarios_Estado" class="form-control">
                  <option value="1" selected>Activos</option>
                  <option value="0">Inactivo</option>
                </select>
              </div>
            </div>
            
            <div class="col-lg-1 col-md-1 col-sm-1">
              <br>
              <?php if(isset($pUsuarios) && $pUsuarios[5] == "1"){ ?>
                <button id="Btn_UsuariosCrear" class="btn btn-success">Crear</button>
              <?php } ?>
            </div>
            
            <div class="col-lg-1 col-md-1 col-sm-1">
              <br>
                <button id="Btn_UsuarioBuscar" class="btn btn-primary">Buscar</button>
            </div>
            
            <div class="col-lg-1 col-md-1 col-sm-1">
              <br>
              <form action="op_excelExportacion.php" method="post" id="f_exportarUsuarios" target="_blank">
                <img src="../imagenes/excel.png" width="30" height="30" id="btn_excelUsuarios" class="manito">
                <input type="hidden" name="nombre" value="Listado Usuarios">
                <input type="hidden" name="resultado" id="input_resultadoUsuarios">
              </form>
            </div>
<!--
            <div class="col-lg-2 col-md-2 col-sm-2">
              <br>
              <img src="../imagenes/excel.png" width="30px" class="excel_Usuarios manito" title="Exportar a Excel">
            </div>
-->
            
          </div>
            
        </div>
        
        <div class="panel-body info_cargarUsuariosListar">
        
        
        </div>
      </div>
      
    </div>
    
  </div>
  
<!-- Crear Usuarios -->
<div id="vtn_UsuariosCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
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
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body info_UsuariosActualizar">
      </div>
      <div class="modal-footer">
        <div class="d_mensajeUsuariosActualizar"></div>
        
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
  
  <!-- Permisos Usuarios -->
<div id="vtn_UsuariosPermisos" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body info_UsuariosPermisos">
      </div>
      <div class="modal-footer">
        <div class="d_mensajeUsuariosPermisos"></div>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
  <!-- Notificaciones Usuarios Permisos -->
<div id="vtn_UsuariosNotificacionesPermisos" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_UsuariosNotificacionesPermisos" align="center">
      </div>
      <div class="modal-footer">
        <button type="button" id="Btn_UsuariosNotificacionesPermisos" class="btn btn-success">Aceptar</button>
      </div>
    </div>
  </div>
</div>
 
</body>
</html>