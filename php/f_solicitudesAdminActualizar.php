<?php
include("op_sesion.php");
include("../class/solicitudes.php");
include("../class/areas.php");
include("../class/parametros.php");
include("../class/plantas.php");

$sol = new solicitudes();
$sol->setSol_Codigo($_POST['codigo']);
$sol->consultar();

$resUsu = $usu->listarUsuariosFluA("-1", $_SESSION['GD_Usuario']);

$are = new areas();
$are->setPla_Codigo($sol->getSol_Tipo());
$resAre = $are->listarAreasPlantas();

$par = new parametros();
$resTipDoc = $par->listarParametroTipo("1", "NULL");
if($sol->getSol_TipoFlujo() == "3"){
  $resPas = $par->listarParametroTipo("3", "1");
}else{
  $resPas = $par->listarParametroTipo("2", "1"); 
}

$plant = new plantas($sol->getSol_Tipo());
$plant->consultar();
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>Actualizar Datos Solicitud</strong>
      </div>
        <p>Planta: <?php echo $plant->getPla_Nombre(); ?></p>
      <div class="panel-body">
        <form id="f_solicitudesAdminActualizar" role="form">
          <input type="hidden" id="SolAdm_Codigo" value="<?php echo $_POST['codigo']; ?>">
          <div class="col-lg-6 col-md-6">
            <div class="form-group">
              <label class="control-label">Usuario:<span class="rojo">*</span></label>
              <select id="SolAdm_Usu_Codigo" class="form-control" required>
                <?php foreach($resUsu as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>" <?php echo $sol->getUsu_Codigo() == $registro[0] ? "selected" : ""; ?>><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Área:<span class="rojo">*</span></label>
              <select id="SolAdm_Area_Codigo" class="form-control" required>
                <?php foreach($resAre as $registro2){ ?>
                  <option value="<?php echo $registro2[0]; ?>" <?php echo $sol->getArea_Codigo() == $registro2[0] ? "selected" : ""; ?>><?php echo $registro2[1]; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Código Radicado</label>
              <input type="number" id="SolAdm_CodigoRadicado" value="<?php echo $sol->getSol_CodigoRadicado(); ?>" class="form-control">
            </div>
            <div class="form-group">
              <label class="control-label">Código Documento</label>
              <input type="text" id="SolAdm_CodigoDocumento" value="<?php echo $sol->getSol_CodigoDocumento(); ?>" class="form-control">
            </div>
            <div class="form-group">
              <label class="control-label">Nombre Documento</label>
              <input type="text" id="SolAdm_NombreDocumento" value="<?php echo ($sol->getSol_NombreDocumento() == NULL) ? $sol->getSol_Tema() : $sol->getSol_NombreDocumento(); ?>" class="form-control">
            </div>
            <div class="form-group">
              <label class="control-label">Historial Versión</label>
              <input type="text" id="SolAdm_HistorialVersion" value="<?php echo $sol->getSol_HistorialVersion(); ?>" class="form-control">
            </div>
            <div class="form-group">
              <label class="control-label">Accíón Documento<span class="rojo">*</span></label>
              <select id="SolAdm_AccionDocumento" class="form-control" required>
                <option value="Nuevo" <?php echo $sol->getSol_AccionDocumento() == "Nuevo" ? "selected" : ""; ?>>Nuevo</option>
                <option value="Actualización" <?php echo $sol->getSol_AccionDocumento() == "Actualización" ? "selected" : ""; ?>>Actualización</option>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Tipo Documento<span class="rojo">*</span></label>
              <select id="SolAdm_TipoDocumento" class="form-control" required>
                <?php foreach($resTipDoc as $registro){ ?>
                  <option value="<?php echo $registro[1]; ?>" <?php echo $sol->getSol_TipoDocumento() == $registro[1] ? "selected" : ""; ?>><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-lg-6 col-md-6">
            <div class="form-group">
              <label class="control-label">Fecha Solicitud<span class="rojo">*</span></label>
              <input type="text" id="SolAdm_Fecha" value="<?php echo $sol->getSol_Fecha(); ?>" class="form-control fecha" required>
            </div>
            <div class="form-group">
              <label class="control-label">Paso Actual<span class="rojo">*</span></label>
              <select id="SolAdm_PasoActual" class="form-control" required>
                <?php foreach($resPas as $registro3){ ?>
                  <option value="<?php echo $registro3[2]; ?>" <?php echo $sol->getSol_PasoActual() == $registro3[2] ? "selected" : ""; ?>><?php echo $registro3[2].". ".$registro3[1]; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Tipo Flujo<span class="rojo">*</span></label>
              <select id="SolAdm_TipoFlujo" class="form-control" required>
                <option value="1" <?php echo $sol->getSol_TipoFlujo() == "1" ? "selected" : ""; ?>>Documentos Equipo Industrial</option>
                <option value="2" <?php echo $sol->getSol_TipoFlujo() == "2" ? "selected" : ""; ?>>Perfil de Competencias</option>
                <option value="3" <?php echo $sol->getSol_TipoFlujo() == "3" ? "selected" : ""; ?>>Matriz y Mapas Seguridad</option>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Estado<span class="rojo">*</span></label>
              <select id="SolAdm_Estado" class="form-control" required>
                <option value="1" <?php echo $sol->getSol_Estado() == "1" ? "selected" : ""; ?>>Activo</option>
                <option value="0" <?php echo $sol->getSol_Estado() == "0" ? "selected" : ""; ?>>Inactivo</option>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Observaciones:<span class="rojo">*</span></label>
              <textarea id="SolAdm_Observaciones" class="form-control"><?php echo $sol->getSol_Observaciones(); ?></textarea>
            </div>
            <!-- Imagen -->
            <div class="form-group">
              <label for="SolAdm_Formato">Formato</label>
              <?php if($sol->getSol_Formato() != "" && $sol->getSol_Formato() != NULL){ ?>
                <a href="../imagenes/formatos/<?php echo $sol->getSol_Formato(); ?>" download="<?php echo $sol->getSol_Formato(); ?>">Descargar Archivo</a>
              <?php } ?>
              <div id="SolAdm_Formato"></div>
              <input type="hidden" id="i_SolAdm_Formato">
            </div>
            <!-- Imagen -->
            <div class="form-group">
              <label for="SolAdm_PDF">PDF</label>
              <?php if($sol->getSol_PDF() != "" && $sol->getSol_PDF() != NULL){ ?>
                <a href="../imagenes/PDF/<?php echo $sol->getSol_PDF(); ?>" download="<?php echo $sol->getSol_PDF(); ?>">Descargar PDF</a>
              <?php } ?>
              <div id="SolAdm_PDF"></div>
              <input type="hidden" id="i_SolAdm_PDF">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">cargarfecha();</script>
<script>
$(document).ready(function(){
  $("#SolAdm_Formato").uploadFile({
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
      $("#i_SolAdm_Formato").val(archivo);
      $("#SolAdm_Formato .ajax-upload-dragdrop").hide();
    }
  });
  
  $("#SolAdm_PDF").uploadFile({
    url:"../imgPHP/PDF.php",
    maxFileSize: 20000*20000,
    maxFileCount:1,
    fileName:"myfile",
    showPreview:true,
    previewHeight: "100px",
    previewWidth: "100px",
		uploadStr:"Subir PDF",
    afterUploadAll:function(obj){
      archivo = obj.existingFileNames[0];
      $("#i_SolAdm_PDF").val(archivo);
      $("#SolAdm_PDF .ajax-upload-dragdrop").hide();
    }
  });
});
</script>