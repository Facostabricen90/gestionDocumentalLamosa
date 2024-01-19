<?php
include("op_sesion.php");
include("../class/parametros.php");
include("../class/plantillas_documentos.php");
include("../class/plantas.php");

$planD = new plantillas_documentos();
$resPlanD = $planD->listarPlantillasDocumentosPrinpal();

$par = new parametros();
$resTipDoc = $par->listarParametroTipo2(1);

foreach ($resPlanD as $registro) {
    $vectorExisten[$registro[1]] = $registro[1];
}

$plan = new plantas();
$respla =$plan->listarPlantasFiltroConUsuarioPermisos($_SESSION['GD_Usuario']);
?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <strong>Crear Plantilla</strong>
            </div>

            <div class="panel-body">
                <form id="f_plantillasDocumentosCrear" role="form">
                    <div class="form-group">
                        <label class="control-label">Planta:<span class="rojo">*</span></label>
                        <select id="planta_codigo" class="form-control" required>
                            <option></option>
                            <?php foreach ($respla as $registro) { ?>
                                    <option value="<?php echo $registro['Pla_Codigo']; ?>"><?php echo $registro['Pla_Nombre']; ?></option>
                                <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Tipo:<span class="rojo">*</span></label>
                        <select id="PlaD_Tipo" class="form-control" required>
                            <option></option>
                            <?php foreach ($resTipDoc as $registro) { ?>
                                <?php //if (!isset($vectorExisten[$registro[1]])) { ?>
                                    <option value="<?php echo $registro[1]; ?>"><?php echo $registro[1]; ?></option>
                                <?php //} ?>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-lg-6 col-md-6">
                        <label class="control-label">Año Retención:</label>
                        <select id="PlaD_Ano" class="form-control">
                            <option value="-1"></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-6 col-md-6">
                        <label class="control-label">Mes Retención:</label>
                        <select id="PlaD_Mes" class="form-control">
                            <option value="-1"></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                        </select>
                    </div>
                    <!-- Imagen -->
                    <div class="form-group">
                        <label for="PlaD_Plantilla">Plantilla</label>
                        <div id="PlaD_Plantilla"></div>
                        <input type="hidden" id="i_PlaD_Plantilla">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#PlaD_Plantilla").uploadFile({
            url: "../imgPHP/plantillas.php",
            maxFileSize: 20000 * 20000,
            maxFileCount: 1,
            fileName: "myfile",
            showPreview: true,
            previewHeight: "100px",
            previewWidth: "100px",
            uploadStr: "Subir Plantilla",
            afterUploadAll: function (obj) {
                archivo = obj.existingFileNames[0];
                $("#i_PlaD_Plantilla").val(archivo);
                $("#PlaD_Plantilla .ajax-upload-dragdrop").hide();
            }
        });
    });
</script>