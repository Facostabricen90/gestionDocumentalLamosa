<?php 
include("op_sesion.php");
include("../class/parametros.php");
include("../class/areas.php");

$par = new parametros();
$resTipDoc = $par->listarParametroTipoo("1");
$are = new areas();
$resAre = $are->listarAreasPrincipal("1", $_SESSION['GD_Usuario']);
$usu1 = new usuarios();
$resUsu = $usu1->listarUsuariosCarge($_SESSION['GD_Usuario']);
//var_dump($resTipDoc);
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>CARGAR DOCUMENTO</strong>
      </div>

      <div class="panel-body">
        <form id="f_cargueDocumentosCrear" role="form">
          <div class="col-lg-6 col-md-6">
            <div class="form-group">
              <label class="control-label">Tipo Documento:<span class="rojo">*</span></label>
              <select id="Car_TipoDocumento" class="form-control" required>
                <option></option>
                <?php foreach($resTipDoc as $registro){ ?>
                  <option value="<?php echo $registro[1]; ?>"><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>

            <div class="form-group">
              <label class="control-label">Código:<span class="rojo">*</span></label>
              <input type="text" id="Car_Codigo" class="form-control">
            </div>

            <div class="form-group">
              <label class="control-label">Nombre:<span class="rojo">*</span></label>
              <input type="text" id="Car_Nombre" class="form-control">
            </div> 

            <div class="form-group">
              <label class="control-label">Versión:<span class="rojo">*</span></label>
              <input type="text" id="Car_Version" class="form-control">
            </div> 

            <div class="form-group">
              <label class="control-label">Área:<span class="rojo">*</span></label>
              <select id="Car_Area" class="form-control" required>
                <option></option>
                <?php foreach($resAre as $registro1){ ?>
                  <option value="<?php echo $registro1[0]; ?>"><?php echo $registro1[1]; ?></option>
                <?php } ?>
              </select>
            </div> 
          </div>
         
          <div class="col-lg-6 col-md-6">
            <div class="form-group">
              <label class="control-label">Usuario Solicita:<span class="rojo">*</span></label>
               <select id="Car_Usu" class="form-control" required>
                <option></option>
                <?php foreach($resUsu as $registro2){ ?>
                  <option value="<?php echo $registro2[0]; ?>"><?php echo $registro2[1]; ?></option>
                <?php } ?>
              </select>
            </div> 

            <div class="form-group">
              <label class="control-label">Observación:<span class="rojo">*</span></label>
              <textarea name="" id="Car_Observacion" cols="10" rows="10" class="form-control"></textarea>
            </div> 
          
          <!-- Imagen -->
            <div class="form-group">
              <label for="Car_SubirArchivo">PDF<span class="rojo">*</span></label>
              <div id="Car_SubirArchivo"></div>
              <input type="hidden" id="i_Car_SubirArchivo">
            </div>
          
        
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
  $("#Car_SubirArchivo").uploadFile({
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
      $("#i_Car_SubirArchivo").val(archivo);
      $("#Car_SubirArchivo .ajax-upload-dragdrop").hide();
    }
  });
});
</script>  