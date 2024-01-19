<?php
include("op_sesion.php");
include("../class/parametros.php");
include("../class/solicitudes.php");
include("../class/plantillas_documentos.php");
include("../class/plantas.php");
include("../class/areas.php");

$sol = new solicitudes();
$sol->setSol_Codigo($_POST['codigo']);
$sol->consultar();

$par = new parametros();
$resTipDoc = $par->listarParametroTipo("1", "NULL");
$resLisPas = $par->listarParametroTipo("2", "1");

$plan = new plantillas_documentos();
$resPlant = $plan->cargarPlantillaTipoDocumento($sol->getSol_TipoDocumento());
$pla = new plantas();
$resPla = $pla->listarFiltroAliasPlantas($_SESSION['GD_Usuario']);
$are = new areas();
$are->setPla_Codigo($sol->getSol_Tipo());
$resAre = $are->listarAreasPlantasFlujoTres();
?>

<div>
  <div class="letra12"><strong>Nombre Documento Usuario:</strong> <?php echo $sol->getSol_Tema(); ?></div>
  <div class="limpiar"></div>
  <div class="letra12"><strong>Observaciones Usuario:</strong> <?php echo $sol->getSol_Observaciones(); ?></div>
</div>
<br>
<input type="hidden" id="TipoDoc" value="<?php echo $_POST['accionDocumento']; ?>">
<div class="form-group">
  <label class="control-label">Paso Flujo:<span class="rojo">*</span></label>
  <select id="filtroPaso3SaltoPasos" class="form-control" required>
    <?php foreach($resLisPas as $registro2){ ?>
      <option value="<?php echo $registro2[2]; ?>" <?php echo $registro2[2] == "3" ? "selected" : ""; ?>><?php echo $registro2[2].". ".$registro2[1]; ?></option>
    <?php } ?>
  </select>
</div>
<div class="form-group">
  <label class="control-label">Nombre:<span class="rojo">*</span></label>
  <input type="text" id="Sol_NombreDocumentoGestionar" value="<?php echo $sol->getSol_Tema(); ?>" class="form-control" maxlength="100" required>
</div>
<?php if($_POST['accionDocumento'] == "Actualización"){ 
    ?>
<div class="col-lg-6 col-md-6 col-sm-6">
  <div class="form-group">
    <label class="control-label">Planta:<span class="rojo">*</span></label>
    <select id="Codigo_PlaAct" class="form-control" required>
      <?php foreach($resPla as $registro){ ?>
        <option value="<?php echo $registro[1]; ?>" <?php echo $sol->getSol_Tipo() == $registro[0] ? "selected" : ""; ?> data-cod="<?php echo $registro[0]; ?>"><?php echo $registro[2]; ?></option>
      <?php } ?>
    </select>
  </div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6">
  <div class="form-group">
    <label class="control-label">Tipo:<span class="rojo">*</span></label>
    <select id="Sol_TipoDocumentoGestionarAct" class="form-control">
      <?php foreach($resTipDoc as $registro){ ?>
        <option value="<?php echo $registro[1]; ?>" <?php echo $sol->getSol_TipoDocumento() == $registro[1] ? "selected" : ""; ?>><?php echo $registro[1]; ?></option>
      <?php } ?>
    </select>
  </div>
</div>
<div class="form-group e_tablaAnterior">
	<label class="control-label">Código:<span class="rojo">*</span></label>
        <input type="text" id="Sol_CodigoDocumentoGestionar" class="form-control" maxlength="30" required autocomplete="off">
</div>
<div class="form-group">
  <label class="control-label">Versión:<span class="rojo">*</span></label>
  <input type="text" id="Sol_HistorialVersionGestionar" class="form-control" maxlength="20" required autocomplete="off">
</div>
<div class="e_mensajeValVersion"></div>
<?php } ?>

<?php /* <---------------------------------------------------------------------------------------------------------> */ ?>

<?php if($_POST['accionDocumento'] == "Nuevo"){ ?>
<div class="col-lg-3 col-md-3 col-sm-3">
  <div class="form-group">
    <label class="control-label">Planta:<span class="rojo">*</span></label>
    <select id="Codigo_Pla" class="form-control" required>
      <?php foreach($resPla as $registro){ ?>
        <option value="<?php echo $registro[1]; ?>" <?php echo $sol->getSol_Tipo() == $registro[0] ? "selected" : ""; ?>  data-cod="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
      <?php } ?>
    </select>
  </div>
</div>
<div class="col-lg-3 col-md-3 col-sm-3">
  <div class="form-group">
    <label class="control-label">Tipo:<span class="rojo">*</span></label>
    <select id="Sol_TipoDocumentoGestionar" class="form-control Sol_TipoDocumentoGestionarPru" required>
      <?php foreach($resTipDoc as $registro){ ?>
        <option value="<?php echo $registro[1]; ?>" data-cod="<?php echo $registro[3]; ?>" <?php echo $sol->getSol_TipoDocumento() == $registro[1] ? "selected" : ""; ?>><?php echo $registro[3].' - '.$registro[1]; ?></option>
      <?php } ?>
    </select>
  </div>
</div>
<div class="col-lg-3 col-md-3 col-sm-3">
  <div class="form-group">
    <label class="control-label">Área:<span class="rojo">*</span></label>
    <select id="Sol_Are" class="form-control" required>
      <?php foreach($resAre as $registro){ ?>
        <option value="<?php echo $registro[2]; ?>" data-cod="<?php echo $registro[0]; ?>" <?php echo ($sol->getArea_Codigo() == $registro[0]) ? "selected" : ""; ?>><?php echo $registro[2].' - '.$registro[1]; ?></option>
      <?php } ?>
    </select>
  </div>
</div>
<div class="col-lg-3 col-md-3 col-sm-3">
  <div class="form-group">
    <label class="control-label">Código:<span class="rojo">*</span></label>
    <input type="number" id="Sol_CodigoDocumentoGestionarNuevo" class="form-control" maxlength="3" required autocomplete="off">
  </div>
</div>

<input type="hidden" id="Sol_CodigoDocumentoGestionar" class="form-control" value="" >
<label id="">Código</label>
<div id="Sol_CodigoDocumentoGestionarLabel"></div>
<div class="form-group e_tablaAnterior"></div>
<div class="form-group">
  <label class="control-label">Versión:<span class="rojo">*</span></label>
  <input type="text" id="Sol_HistorialVersionGestionar" class="form-control" maxlength="20" required autocomplete="off">
</div>
<div class="e_mensajeValVersion"></div>
<?php } ?>
<br>
<?php if($_POST['accionDocumento'] == "Nuevo"){ ?>
	<?php if($resPlant){ ?>
		
	<?php }else{ ?>
		<div class="alert alert-danger">
			<strong>No hay plantilla Cargada.</strong>
		</div>
	<?php } ?>
<?php } ?>
<?php if($_POST['accionDocumento'] == "Actualización"){ ?>
	<!-- Imagen -->
	<div class="form-group">
		<label for="Sol_FormatoGestionar">Documento</label>
		<div id="Sol_FormatoGestionar"></div>
		<input type="hidden" id="i_Sol_FormatoGestionar">
	</div>
<?php } ?>
<br>
<div align="right">
  <button type="submit" id="Btn_SolicitudesCrearForm" class="btn btn-success">Siguiente</button>
</div>

<?php if($_POST['accionDocumento'] == "Actualización"){ ?>
<script>
$(document).ready(function(){
  $("#Sol_FormatoGestionar").uploadFile({
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
      $("#i_Sol_FormatoGestionar").val(archivo);
      $("#Sol_FormatoGestionar .ajax-upload-dragdrop").hide();
    }
  });
});  
</script>
<?php } ?>