<?php 
include("op_sesion.php");
if( $_GET['tipo'] == 1){
  $titulo = 'Modelo Excelencia Operacional';
}elseif( $_GET['tipo'] == 2){
  $titulo = 'Modelo Seguridad';
  
}elseif( $_GET['tipo'] ==3){
  
  $titulo = 'Protocolos LATAM';
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/explorador_archivos.js"></script>
</head>
<?php include("s_menu.php"); ?>
<body>
  <input type="hidden" id="TipoMod" value="<?php echo $_GET['tipo']; ?>">
  <div id="d_contenedor" class="container-fluid">
    <!-- Todo el Contenido -->
    <div class="col-lg-12 col-md-12 col-sm-12 alert panel-primary tituloEnc text-center letra22"><strong><?php echo $titulo; ?></strong></div>
    <div class="col-lg-12 col-md-12">
      <div class="panel-body info_cargarExploradorArcListar">
      
      </div>
      
    </div>
    
  </div>
  
  <!-- Crear ExploradorArc -->
  <div id="vtn_ExploradorArcCrear" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-body info_ExploradorArcCrear">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id="Btn_ExploradorArcCrearForm" form="f_exploradorArcCrear">Crear</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Actualizar ExploradorArc -->
  <div id="vtn_ExploradorArcActualizar" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body info_ExploradorArcActualizar">
        </div>
        <div class="modal-footer">
          <div class="d_mensajeExploradorArcActualizar"></div>
          <button type="submit" id="Btn_ExploradorArcActualizarForm" class="btn btn-warning" form="f_exploradorArcActualizar">Actualizar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Notificaciones ExploradorArc Crear -->
  <div id="vtn_ExploradorArcNotificacionesCrear" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body info_ExploradorArcNotificacionesCrear" align="center">
        </div>
        <div class="modal-footer">
          <button type="button" id="Btn_ExploradorArcNotificacionesCrear" class="btn btn-success">Aceptar</button>
        </div>
      </div>
    </div>
  </div>
  
  
<!-- Notificaciones ExploradorArc Actualizar -->
  <div id="vtn_ExploradorArcNotificacionesActualizar" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body info_ExploradorArcNotificacionesActualizar" align="center">
        </div>
        <div class="modal-footer">
          <button type="button" id="Btn_ExploradorArcNotificacionesActualizar" class="btn btn-success">Aceptar</button>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Crear EliminarExplorador -->
  <div id="vtn_EliminarExplorador" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body info_EliminarExplorador">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" id="Btn_EliminarExploradorCrearForm" form="f_eliminarExplorador">Sí</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Crear verDocumento -->
  <div id="vtn_verDocumentoCrear" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body info_verDocumentoCrear">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</body>
</html>