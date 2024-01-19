<?php
include("op_sesion.php");
include("../class/parametros.php");
include("../class/usuarios_areas.php");

$par = new parametros();
$resTipDoc = $par->listarParametroTipoFlujoMatriz("1", "NULL");

$usuA = new usuarios_areas();
$resUsuA = $usuA->listarAreasUsuariosFiltroPlanta($_SESSION['GD_Usuario']);

$cantAreas = count($resUsuA);
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading" align="center">
        <strong class="letra18">CREAR SOLICITUD</strong>
      </div>

      <div class="panel-body">


        <form id="f_solicitudesMMCrear" role="form">
          
          <div class="col-lg-6 col-md-6">
            <?php if($resUsuA){ ?>
              <?php if($cantAreas > 1){ ?>
                <div class="form-group">
                  <label class="control-label">Área:</label>
                  <select id="SolMM_Area_Codigo" class="form-control" required>
                    <option></option>
                    <?php foreach($resUsuA as $registro){ ?>
                      <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                    <?php } ?>	
                  </select>
                </div>
              <?php }else{ ?>
                <?php foreach($resUsuA as $registro){ ?>
                  <input type="hidden" id="SolMM_Area_Codigo" class="form-control" value="<?php echo $registro[0]; ?>">
                <?php } ?>
              <?php } ?>
            <?php }else{ ?>
              <div class="form-group">
                <label class="control-label">Área:<span class="rojo">*</span></label>
                  <select id="SolMM_Area_Codigo" class="form-control" required>
                    <option></option>
                </select>
              </div>
            <?php } ?>
            <div class="form-group">
              <label class="control-label">Tipo Documento:<span class="rojo">*</span></label>
              <select id="SolMM_TipoDocumento" class="form-control" required>
                <option></option>
                <?php foreach($resTipDoc as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Documento:<span class="rojo">*</span></label>
              <select id="SolMM_AccionDocumento" class="form-control" required>
                <option value="Actualización">Actualización</option>
                <option value="Nuevo">Nuevo</option>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Código Documento:<span class="rojo">*</span></label>
              <input type="text" id="SolMM_CodigoDocumento" class="form-control" maxlength="30" required>
            </div>
            <div class="form-group">
              <label class="control-label">Nombre Documento:<span class="rojo">*</span></label>
              <input type="text" id="SolMM_NombreDocumento" class="form-control" maxlength="100" required>
            </div>
            <div class="form-group">
              <label class="control-label">Vérsión:<span class="rojo">*</span></label>
              <input type="text" id="SolMM_HistorialVersion" class="form-control" maxlength="20" required>
            </div>
            <div class="form-group">
              <label class="control-label">Tema:<span class="rojo">*</span></label>
              <input type="text" id="SolMM_Tema" class="form-control" maxlength="250" required>
            </div>            
          </div>
					
					<div class="col-lg-6 col-md-6">
            <!-- Imagen -->
            <div class="form-group">
              <label for="SolMM_FormatoSolicitud">Documento Solicitud<span class="rojo">*</span></label>
              <div id="SolMM_FormatoSolicitud"></div>
              <input type="hidden" id="i_SolMM_FormatoSolicitud">
            </div>

            <div class="form-group">
              <label class="control-label">Observaciones:<span class="rojo">*</span></label>
              <textarea id="SolMM_Observaciones" class="form-control" required></textarea>
            </div>
            <br>
            <div class="Men_ObliCargarArcSoliIniMM"></div>
            <div align="center">
              <button type="submit" id="Btn_SolicitudesMMCrearForm" class="btn btn-primary">CREAR SOLICITUD</button>
            </div>
          </div>          
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
  $("#SolMM_FormatoSolicitud").uploadFile({
    url:"../imgPHP/formatos.php",
    maxFileSize: 20000*20000,
    maxFileCount:1,
    fileName:"myfile",
    showPreview:true,
    previewHeight: "100px",
    previewWidth: "100px",
		uploadStr:"Subir Documento",
    afterUploadAll:function(obj){
      archivo = obj.existingFileNames[0];
      $("#i_SolMM_FormatoSolicitud").val(archivo);
      $("#SolMM_FormatoSolicitud .ajax-upload-dragdrop").hide();
    }
  });
});
</script>