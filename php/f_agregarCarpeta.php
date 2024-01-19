<?php
include("op_sesion.php");
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>CREAR <?php echo $_POST['tipo'] == '1' ? "CARPETA" : "ARCHIVO";  ?></strong>
      </div>

      <div class="panel-body">
        <form id="f_exploradorArcCrear" role="form">
          <input type="hidden" value="<?php echo $_POST['referencia']; ?>" id="EArc_Referencia">
          <input type="hidden" value="<?php echo $_POST['tipo']; ?>" id="EArc_Tipo">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
              <label class="control-label">Nombre:<span class="rojo">*</span></label>
              <input type="text" id="EArc_Nombre" class="form-control" maxlength="100" required>
            </div>
          </div>
          <div class="limpiar"></div>
          <?php if($_POST['tipo'] == '2'){ ?>
            <div class="panel panel-primary">
              <div class="panel-heading" align="center">
                <label class="letra16">Adjuntos</label>
              </div>
              <div class="panel-body">
                <label>Adjuntos<span class="rojo">*</span></label>
                <br>
                  <label>Carge el documento.</label>
                <div id="AdjuntoA1"></div>
                <input id="i_AdjuntoA1" type="hidden">
              </div>
            </div>
          <?php } ?>
        </form>
        <div class="limpiar">
          <div class="validarEspera"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
	$(document).ready(function(){
		$("#AdjuntoA1").uploadFile({
			url:"../imgPHP/subirArchivoExplorador.php",
			maxFileSize: 200000*200000,
			maxFileCount: 1,
			fileName:"myfile",
			showPreview:true,
			previewHeight: "100px",
			previewWidth: "100px",
			afterUploadAll:function(obj){
				archivos = obj.existingFileNames;
				//console.log(archivos);
				for(i=0; i<archivos.length;i++){
				 archivo = obj.existingFileNames[i];
				 $("#i_AdjuntoA"+(i+1)).val(archivo);
				}
			}
		});
    //$("#AdjuntoA1").hide();
	});
</script>
