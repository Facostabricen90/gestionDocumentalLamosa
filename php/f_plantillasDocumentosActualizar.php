<?php
include("op_sesion.php");
include("../class/plantillas_documentos.php");
include("../class/parametros.php");

$par = new parametros();
$resTipDoc = $par->listarParametroTipoo("1");

$plan = new plantillas_documentos();
$plan->setPlaD_Codigo($_POST['codigo']);
$plan->consultar();
$dias = $plan->getPlaD_TiempoRetencion();
$ano = intval($dias / 360);
$diaMes = $dias - ($ano * 360);
$mes = intval($diaMes / 30.5);
?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <strong>Actualizar Plantilla</strong>
            </div>

            <div class="panel-body">
                <form id="f_plantillasDocumentosActualizar" role="form">
                    <input type="hidden" id="PlaD_CodigoAct" value="<?php echo $_POST['codigo']; ?>">
                    <div class="form-group">
                        <label class="control-label">Tipo:<span class="rojo">*</span></label>
                        <select id="PlaD_TipoAct" class="form-control" required>
<?php foreach ($resTipDoc as $registro) { ?>
                                <option value="<?php echo $registro[1]; ?>" <?php echo $plan->getPlaD_Tipo() == $registro[1] ? "selected" : ""; ?>><?php echo $registro[1]; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-lg-6 col-md-6">
                        <label class="control-label">Año Retención:</label>
                        <select id="PlaD_AnoAct" class="form-control">
                            <option value="-1"></option>
                            <option value="1" <?php echo "1" == $ano ? "selected" : ""; ?>>1</option>
                            <option value="2" <?php echo "2" == $ano ? "selected" : ""; ?>>2</option>
                            <option value="3" <?php echo "3" == $ano ? "selected" : ""; ?>>3</option>
                            <option value="4" <?php echo "4" == $ano ? "selected" : ""; ?>>4</option>
                            <option value="5" <?php echo "5" == $ano ? "selected" : ""; ?>>5</option>
                            <option value="6" <?php echo "6" == $ano ? "selected" : ""; ?>>6</option>
                            <option value="7" <?php echo "7" == $ano ? "selected" : ""; ?>>7</option>
                            <option value="8" <?php echo "8" == $ano ? "selected" : ""; ?>>8</option>
                            <option value="9" <?php echo "9" == $ano ? "selected" : ""; ?>>9</option>
                            <option value="10" <?php echo "10" == $ano ? "selected" : ""; ?>>10</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-6 col-md-6">
                        <label class="control-label">Mes Retención:</label>
                        <select id="PlaD_MesAct" class="form-control">
                            <option value="-1"></option>
                            <option value="1" <?php echo "1" == $mes ? "selected" : ""; ?>>1</option>
                            <option value="2" <?php echo "2" == $mes ? "selected" : ""; ?>>2</option>
                            <option value="3" <?php echo "3" == $mes ? "selected" : ""; ?>>3</option>
                            <option value="4" <?php echo "4" == $mes ? "selected" : ""; ?>>4</option>
                            <option value="5" <?php echo "5" == $mes ? "selected" : ""; ?>>5</option>
                            <option value="6" <?php echo "6" == $mes ? "selected" : ""; ?>>6</option>
                            <option value="7" <?php echo "7" == $mes ? "selected" : ""; ?>>7</option>
                            <option value="8" <?php echo "8" == $mes ? "selected" : ""; ?>>8</option>
                            <option value="9" <?php echo "9" == $mes ? "selected" : ""; ?>>9</option>
                            <option value="10" <?php echo "10" == $mes ? "selected" : ""; ?>>10</option>
                            <option value="11" <?php echo "11" == $mes ? "selected" : ""; ?>>11</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Estado</label>
                        <select id="PlaD_EstadoAct" class="form-control">
                            <option value="1" <?php echo $plan->getPlaD_Estado() == "1" ? "selected" : ""; ?>>Activo</option>
                            <option value="0" <?php echo $plan->getPlaD_Estado() == "0" ? "selected" : ""; ?>>Inactivo</option>
                        </select>
                    </div>
                    <!-- Imagen -->
                    <div class="form-group">
                        <fielset><legend>Plantilla Actual</legend>
<?php if ($plan->getPlaD_Plantilla() != "" && $plan->getPlaD_Plantilla() != NULL) { ?>
                                <a target="blank" href="../imagenes/plantillas/<?php echo $plan->getPlaD_Plantilla(); ?>"><button type="button" class="btn btn-info">Descargar Plantilla</button></a>
                            <?php } ?>
                            </fieldset>
                            <div id="PlaD_PlantillaAct"></div>
                            <input type="hidden" id="i_PlaD_PlantillaAct" value="<?php echo $plan->getPlaD_Plantilla(); ?>">
                            </div>
                            </form>
                            </div>
                            </div>
                            </div>
                            </div>
                            <script>
                                $(document).ready(function () {
                                    $("#PlaD_PlantillaAct").uploadFile({
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
                                            $("#i_PlaD_PlantillaAct").val(archivo);
                                            $("#PlaD_PlantillaAct .ajax-upload-dragdrop").hide();
                                        }
                                    });
                                });
                            </script>


