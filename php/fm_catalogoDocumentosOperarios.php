<?php
include("op_sesionOperarios.php");
include("../class/parametros.php");
$par = new parametros();
$resTipDoc = $par->listarParametroTipoCatalogo("1");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/index.js"></script>
</head>
<body>
  <div id="d_contenedor" class="container-fluid">
    <!-- Todo el Contenido -->
    <br>
    <div class="col-lg-12 col-md-12">
      
      <div class="panel panel-primary">
        <div class="panel-heading">        
          <div class="row">
            <div class="col-lg-3 col-md-3">
              <strong class="letra16">Catalogo Documentos</strong>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
              <br>
              <div class="input-group"> <span class="input-group-addon"><strong>Buscar:</strong></span>
                <input id="filtrar_CatalogoOpe" type="text" class="form-control">
              </div>
            </div>
            <div class="form-group col-lg-2 col-md-2 col-sm-2">
              <label class="control-label">Tipo Documento:<span class="rojo">*</span></label>
              <select id="Cat_TipoDocumentoOpe" class="form-control" required>
                <option value="-1">Todos</option>
                <?php foreach($resTipDoc as $registro){ ?>
                  <option value="<?php echo $registro[1]; ?>"><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div>
        <div class="panel-body info_catalogoDocumentosOpeListar">

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
</body>
</html>