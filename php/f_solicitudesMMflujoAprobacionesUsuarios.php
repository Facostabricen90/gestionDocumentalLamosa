<?php
include("op_sesion.php");
include("../class/parametros.php");
include("../class/solicitudes.php");
include("../class/historiales_flujos.php");
include("../class/plantillas_documentos.php");
include("../class/operarios.php");
include("../class/capacitaciones_operarios.php");
include("../class/areas.php");
include("hora.php");

$sol = new solicitudes();
$sol->setSol_Codigo($_POST['codigo']);
$sol->consultar();

$are = new areas();
$are->setArea_Codigo($sol->getArea_Codigo());
$are->consultar();

$usu2 = new usuarios();
$usu2->setUsu_Codigo($sol->getUsu_Codigo());
$usu2->consultar();

$par = new parametros();
$resTipDoc = $par->listarParametroTipo("1");

$hisF = new historiales_flujos();
$resHisFlu = $hisF->listarHistorialFlujoSolicitudesMMGestion($_POST['codigo']);

$plan = new plantillas_documentos();
$resPlant = $plan->cargarPlantillaTipoDocumento($sol->getSol_TipoDocumento());

$ope = new operarios();
$resCantOpe1 = $ope->listarOperariosCapacitaciones2($are->getArea_Nombre(), $sol->getSol_Tipo());
$resCantOpe = count($resCantOpe1);


//var_dump($resCantOpe);
$capO = new capacitaciones_operarios();
$resCantCapac = $capO->cantidadCapacitacionesOperariosArea($_POST['codigo']);
$resCantCapacRegTotal = $capO->cantidadCapacitacionesOperariosRegistroPublicar($_POST['codigo']);
?>
<div class="row">

    <div class="col-lg-4 col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading" align="center">
                <strong class="letra18">GESTIONAR</strong>
            </div>

            <div class="panel-body">
                <form id="f_solicitudesMMGestionarCrear" role="form">
                    <input type="hidden" id="SolMM_CodigoActualSolicitudProcesando" value="<?php echo $_POST['codigo']; ?>">
                    <input type="hidden" id="SolMM_PasoActual" value="<?php echo $sol->getSol_PasoActual(); ?>">

                    <?php if ($sol->getSol_PasoActual() == "2") { ?>

                        <div class="alert encabezadoTab letra16" align="center">
                            <strong>Revisión Jefe Área</strong>
                        </div>
                        <div align="center">
                            <a href="../imagenes/formatos/<?php echo $sol->getSol_Formato(); ?>" download="<?php echo preg_replace('/[0-9]+/', '', $resPlant[0]); ?>" target="_blank"><button type="button" class="btn btn-primary">Descargar Documento</button></a>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="control-label">Calificación<span class="rojo">*</span></label>
                            <select id="HistF_CalificacionRevisionJefeArea" class="form-control" required>
                                <option></option>
                                <option value="Aprobado">Aprobado</option>
                                <option value="Rechazado">Rechazado</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Observaciones de Revisión:<span class="rojo">*</span></label>
                            <textarea id="HistF_ObservacionRevisionJefeArea" class="form-control" required></textarea>
                        </div>
                        <br>
                        <!-- Imagen -->
                        <div class="form-group">
                            <label for="SolMM_FormatoGestionarRevisionJefeArea1">Documento</label>
                            <div id="SolMM_FormatoGestionarRevisionJefeArea1"></div>
                            <input type="hidden" id="i_SolMM_FormatoGestionarRevisionJefeArea1">
                        </div>
                        <br>
                        <div align="right">
                            <button type="submit" id="Btn_SolicitudesMMCrearForm" class="btn btn-success">Siguiente</button>
                        </div>
                    <?php } ?>

                    <?php if ($sol->getSol_PasoActual() == "3") { ?>

                        <div class="alert encabezadoTab letra16" align="center">
                            <strong>Revisión EHS</strong>
                        </div>
                        <div align="center">
                            <a href="../imagenes/formatos/<?php echo $sol->getSol_Formato(); ?>" download="<?php echo preg_replace('/[0-9]+/', '', $resPlant[0]); ?>" target="_blank"><button type="button" class="btn btn-primary">Descargar Documento</button></a>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="control-label">Calificación<span class="rojo">*</span></label>
                            <select id="HistF_CalificacionRevisionEHS" class="form-control" required>
                                <option></option>
                                <option value="Aprobado">Aprobado</option>
                                <option value="Requiere Ajustes">Requiere Ajustes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Observaciones de Revisión:<span class="rojo">*</span></label>
                            <textarea id="HistF_ObservacionRevisionEHS" class="form-control" required></textarea>
                        </div>
                        <br>
                        <!-- Imagen -->
                        <div class="form-group">
                            <label for="SolMM_FormatoGestionarRevisionEHS1">Documento</label>
                            <div id="SolMM_FormatoGestionarRevisionEHS1"></div>
                            <input type="hidden" id="i_SolMM_FormatoGestionarRevisionEHS1">
                        </div>
                        <br>
                        <div align="right">
                            <button type="submit" id="Btn_SolicitudesMMCrearForm" class="btn btn-success">Siguiente</button>
                        </div>
                    <?php } ?>

                    <?php if ($sol->getSol_PasoActual() == "4") { ?>

                        <div class="alert encabezadoTab letra16" align="center">
                            <strong>Ajustar Documento</strong>
                        </div>

                        <div align="center">
                            <a href="../imagenes/formatos/<?php echo $sol->getSol_Formato(); ?>" download="<?php echo preg_replace('/[0-9]+/', '', $resPlant[0]); ?>" target="_blank"><button type="button" class="btn btn-primary">Descargar Documento</button></a>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="control-label">Observaciones Documento Ajustado:<span class="rojo">*</span></label>
                            <textarea id="HistF_ObservacionGestionarDocumentoAjustes" class="form-control" required></textarea>
                        </div>
                        <br>
                        <!-- Imagen -->
                        <div class="form-group">
                            <label for="SolMM_FormatoGestionarAjustes">Documento Ajustado<span class="rojo">*</span></label>
                            <div id="SolMM_FormatoGestionarAjustes"></div>
                            <input type="hidden" id="i_SolMM_FormatoGestionarAjustes">
                        </div>
                        <br>
                        <div class="Men_ObliCargarArcAjustesMM"></div>
                        <br>
                        <div align="right">
                            <button type="submit" id="Btn_SolicitudesMMCrearForm" class="btn btn-success">Siguiente</button>
                        </div>

                    <?php } ?>

                    <?php if ($sol->getSol_PasoActual() == "5") { ?>

                        <div class="alert encabezadoTab letra16" align="center">
                            <strong>Revisión Jefe Área</strong>
                        </div>

                        <div align="center">
                            <a href="../imagenes/formatos/<?php echo $sol->getSol_Formato(); ?>" download="<?php echo preg_replace('/[0-9]+/', '', $resPlant[0]); ?>" target="_blank"><button type="button" class="btn btn-primary">Descargar Documento</button></a>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="control-label">Observaciones Documento:<span class="rojo">*</span></label>
                            <textarea id="HistF_ObservacionGestionarDocumentoRevisionJefeArea2" class="form-control" required></textarea>
                        </div>
                        <br>
                        <!-- Imagen -->
                        <div class="form-group">
                            <label for="SolMM_FormatoGestionarRevisionJefeArea2">Documento Ajustado</label>
                            <div id="SolMM_FormatoGestionarRevisionJefeArea2"></div>
                            <input type="hidden" id="i_SolMM_FormatoGestionarRevisionJefeArea2">
                        </div>
                        <br>
                        <div align="right">
                            <button type="submit" id="Btn_SolicitudesMMCrearForm" class="btn btn-success">Siguiente</button>
                        </div>
                    <?php } ?>

                    <?php if ($sol->getSol_PasoActual() == "6") { ?>

                        <div class="alert encabezadoTab letra16" align="center">
                            <strong>Revisión EHS</strong>
                        </div>

                        <div align="center">
                            <a href="../imagenes/formatos/<?php echo $sol->getSol_Formato(); ?>" download="<?php echo preg_replace('/[0-9]+/', '', $resPlant[0]); ?>" target="_blank"><button type="button" class="btn btn-primary">Descargar Documento</button></a>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="control-label">Observaciones Documento:<span class="rojo">*</span></label>
                            <textarea id="HistF_ObservacionGestionarDocumentoRevisionEHS2" class="form-control" required></textarea>
                        </div>
                        <br>
                        <!-- Imagen -->
                        <div class="form-group">
                            <label for="SolMM_FormatoGestionarRevisionEHS2">Documento Ajustado</label>
                            <div id="SolMM_FormatoGestionarRevisionEHS2"></div>
                            <input type="hidden" id="i_SolMM_FormatoGestionarRevisionEHS2">
                        </div>
                        <br>
                        <div align="right">
                            <button type="submit" id="Btn_SolicitudesMMCrearForm" class="btn btn-success">Siguiente</button>
                        </div>
                    <?php } ?>

                    <?php if ($sol->getSol_PasoActual() == "7") { ?>

                        <div class="alert encabezadoTab letra16" align="center">
                            <strong>Subir PDF</strong>
                        </div>

                        <div align="center">
                            <label class="comentario">*Descarga el documento aprobado para convertirlo en pdf* </label>
                            <a href="../imagenes/formatos/<?php echo $sol->getSol_Formato(); ?>" download="<?php echo preg_replace('/[0-9]+/', '', $sol->getSol_Formato()); ?>" target="_blank"><button type="button" class="btn btn-primary">Descargar Documento</button></a>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <label class="control-label">Observaciones de PDF:<span class="rojo">*</span></label>
                            <textarea id="HistF_ObservacionGestionarSubirPDF" class="form-control" required></textarea>
                        </div>
                        <br>
                        <!-- Imagen -->
                        <div class="form-group">
                            <label for="SolMM_FormatoGestionarSubirPDF">Documento PDF<span class="rojo">*</span></label>
                            <label class="comentario">*Previamente se descarga el documento y se debe convertir en PDF el cual se debe subir*</label>
                            <div id="SolMM_FormatoGestionarSubirPDF" align="center"></div>
                            <input type="hidden" id="i_SolMM_FormatoGestionarSubirPDF" align="center">
                        </div>
                        <br>
                        <div align="right">
                            <button type="submit" id="Btn_SolicitudesCrearForm" class="btn btn-success">Subir PDF</button>
                        </div>
                    <?php } ?>

                    <?php if ($sol->getSol_PasoActual() == "8") { ?>

                        <div class="alert encabezadoTab letra16" align="center">
                            <strong>Divulgación - Publicación</strong>
                        </div>

                        <div align="center">
                            <label class="comentario">*Descarga el documento PDF* </label>
                            <a href="../imagenes/PDF/<?php echo $sol->getSol_PDF(); ?>" download="<?php echo preg_replace('/[0-9]+/', '', $sol->getSol_Formato()); ?>" target="_blank"><button type="button" class="btn btn-primary">Descargar PDF</button></a>
                        </div>
                        <br>
                        <div align="center">
                            <button class="btn btn-warning e_cargarCapacitacionesSolicitudesMM" data-cod="<?php echo $_POST['codigo']; ?>">Capacitaciones</button>	
                        </div>
                        <br>
                        <div align="center">
                            <strong class="rojo letra16">Total Divulgación: <?php echo $resCantCapac[0] . "/" . $resCantOpe[0]; ?></strong>
                            <br>
                            <strong class="rojo letra16">Porcentaje Divulgación: <?php if ($resCantOpe[0] > 0) {
                        echo number_format($resCantCapac[0] / $resCantOpe[0] * 100, 2, ",", ".") . "%";
                    } else {
                        echo "0%";
                    } ?></strong>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="control-label">Observaciones de Publicación:<span class="rojo">*</span></label>
                            <textarea id="HistF_ObservacionGestionarRevisionMMDivulgacion" class="form-control" required></textarea>
                        </div>
                        <br>
                        <div class="e_mensajeAprobacionPDF">	
                        </div>

                        <div align="right">
                            <?php if ($resCantCapacRegTotal[0] == $resCantOpe[0]) { ?>
                                <a href="excel_capacitacionesSolicitudes.php?cod=<?php echo $_POST['codigo']; ?>" title="Planilla Capacitación"><img src="../imagenes/excel.png" width="35px;"></a>
                                <br><br>
                                <button type="submit" id="Btn_SolicitudesCrearForm" class="btn btn-success">Publicar Documento</button>
                            <?php } else { ?>
                                <div class="alert alert-warning">
                                    <strong>Recuerde completar toda la planilla de capacitación para poder Divulgar el documento.</strong>
                                </div>
                        <?php } ?>
                        </div>
<?php } ?>

<?php if ($sol->getSol_PasoActual() == "13") { ?>
                        <div class="alert encabezadoTab letra16" align="center">
                            <strong>Documento Publicado</strong>
                        </div>

                        <div align="center"> 
                            <a href="../imagenes/PDF/<?php echo $sol->getSol_PDF(); ?>" download="<?php echo preg_replace('/[0-9]+/', '', $sol->getSol_PDF()); ?>" target="_blank"><button type="button" class="btn btn-primary">Descargar PDF</button></a>
                        </div>
                        <br>
                        <div align="center">
                            <a href="../imagenes/formatos/<?php echo $sol->getSol_Formato(); ?>" download="<?php echo preg_replace('/[0-9]+/', '', $sol->getSol_Formato()); ?>" target="_blank"><button type="button" class="btn btn-primary">Descargar Documento</button></a>
                        </div>
<?php } ?>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-8 col-md-8">
        <div class="panel panel-primary">
            <div class="panel-heading" align="center">
                <strong class="letra18">DATOS SOLICITUD</strong>
            </div>
            <div class="panel-body">

                <div class="col-lg-6 col-md-6 col-sm-6">
                    <strong class="letra14">Tipo Documento: </strong><?php echo $sol->getSol_TipoDocumento(); ?>
                    <br>
                    <strong class="letra14">Área: </strong> <?php echo $are->getArea_Nombre(); ?>
                    <br>
                    <strong class="letra14">Fecha Solicitud: </strong><?php echo $sol->getSol_Fecha(); ?>   
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6">
                    <strong class="letra14">Usuario Solicitud: </strong><?php echo $usu2->getUsu_Nombre() . " " . $usu2->getUsu_Apellido(); ?>
                    <br>
                    <strong class="letra14">Observaciones: </strong><?php echo $sol->getSol_Observaciones(); ?>   
                </div>


            </div>
        </div>
    </div>

    <div class="col-lg-8 col-md-8">
        <div class="panel panel-primary">
            <div class="panel-heading" align="center">
                <strong class="letra18">HISTORIAL FLUJO</strong>
            </div>
            <div class="panel-body">
                <div class="table-responsive" id="imp_tabla">
                    <table border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
                        <thead>
                            <tr class="encabezadoTab">
                                <th align="center" class="text-center">PASO</th>
                                <th align="center" class="text-center">CLASIFICACIÓN</th>
                                <th align="center" class="text-center">OBSERVACIONES</th>
                                <th align="center" class="text-center">FECHA</th>
                                <th align="center" class="text-center">USUARIO</th>
<?php if ($usu->getUsu_Rol() == "Administrador") { ?>
                                    <th align="center" class="text-center">&nbsp;&nbsp;</th>
                            <?php } ?>
                            </tr>
                        </thead>
                        <tbody class="buscar">
<?php foreach ($resHisFlu as $registro) { ?>
                                <tr>
                                    <td><?php echo $registro[7] . ". " . $registro[5]; ?></td>	
                                    <td><?php echo $registro[1]; ?></td>	
                                    <td class="letra11"><?php echo $registro[2]; ?></td>	
                                    <td nowrap align="right"><?php echo substr($registro[3], 0, 10) . " " . PasarMilitaraAMPM(substr($registro[3], 11, 8)); ?>&nbsp;</td>	
                                    <td nowrap><?php echo $registro[8]; ?></td>

                                    <?php if ($usu->getUsu_Rol() == "Administrador") { ?>
                                        <?php if ($registro[6] != "" && $registro[6] != NULL) { ?>
                                            <td nowrap><a href="../imagenes/formatos/<?php echo $registro[6]; ?>" download="Historial_<?php echo $registro[6]; ?>" target="_blank"><span class="glyphicon glyphicon-download-alt manito azul" title="Descargar Formato"></span></a></td>	
        <?php } else { ?>
                                            <td></td>
                                    <?php } ?>
    <?php } ?>

                                </tr>
<?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="limpiar"></div>

    <div align="center">

        <div class="lineaPasos" align="left">
            <div>
                <?php if ($sol->getSol_PasoActual() == "1") {
                    $lS = "letraSelect"; ?>
                    <img src="../imagenes/flechaPasosVerde.png" width="110px">	
<?php } else {
    $lS = ""; ?>
                    <img src="../imagenes/flechaPasosGris.png" width="110px">	
<?php } ?>
            </div>
            <div class="letraPasos <?php echo $lS; ?>">
                <span class=""><strong>1. Solicitud</strong></span>
            </div>
        </div>
        <div class="lineaPasos" align="left">
            <div>
<?php if ($sol->getSol_PasoActual() == "2") {
    $lS = "letraSelect"; ?>
                    <img src="../imagenes/flechaPasosVerde.png" width="110px">	
<?php } else {
    $lS = ""; ?>
                    <img src="../imagenes/flechaPasosGris.png" width="110px">	
                <?php } ?>
            </div>
            <div class="letraPasos2 <?php echo $lS; ?>">
                <span class=""><strong>2. Revisión <br>Jefe Área</strong></span>
            </div>
        </div>
        <div class="lineaPasos" align="left">
            <div>
<?php if ($sol->getSol_PasoActual() == "3") {
    $lS = "letraSelect"; ?>
                    <img src="../imagenes/flechaPasosVerde.png" width="110px">	
                <?php } else {
                    $lS = ""; ?>
                    <img src="../imagenes/flechaPasosGris.png" width="110px">	
                <?php } ?>
            </div>
            <div class="letraPasos <?php echo $lS; ?>">
                <span class=""><strong>3. Revisión EHS</strong></span>
            </div>
        </div>
        <div class="lineaPasos" align="left">
            <div>
<?php if ($sol->getSol_PasoActual() == "4") {
    $lS = "letraSelect"; ?>
                    <img src="../imagenes/flechaPasosVerde.png" width="110px">	
                <?php } else {
                    $lS = ""; ?>
                    <img src="../imagenes/flechaPasosGris.png" width="110px">	
                <?php } ?>
            </div>
            <div class="letraPasos <?php echo $lS; ?>">
                <span class=""><strong>4. Ajustes</strong></span>
            </div>
        </div>
        <div class="lineaPasos" align="left">
            <div>
                <?php if ($sol->getSol_PasoActual() == "5") {
                    $lS = "letraSelect"; ?>
                    <img src="../imagenes/flechaPasosVerde.png" width="110px">	
                <?php } else {
                    $lS = ""; ?>
                    <img src="../imagenes/flechaPasosGris.png" width="110px">	
<?php } ?>
            </div>
            <div class="letraPasos2 <?php echo $lS; ?>">
                <span class=""><strong>5. Revisión <br>Jefe Área</strong></span>
            </div>
        </div>
        <div class="lineaPasos" align="left">
            <div>
                <?php if ($sol->getSol_PasoActual() == "6") {
                    $lS = "letraSelect"; ?>
                    <img src="../imagenes/flechaPasosVerde.png" width="110px">	
<?php } else {
    $lS = ""; ?>
                    <img src="../imagenes/flechaPasosGris.png" width="110px">	
<?php } ?>
            </div>
            <div class="letraPasos <?php echo $lS; ?>">
                <span class=""><strong>6. Revisión EHS</strong></span>
            </div>
        </div>
        <div class="lineaPasos" align="left">
            <div>
                <?php if ($sol->getSol_PasoActual() == "7") {
                    $lS = "letraSelect"; ?>
                    <img src="../imagenes/flechaPasosVerde.png" width="110px">	
<?php } else {
    $lS = ""; ?>
                    <img src="../imagenes/flechaPasosGris.png" width="110px">	
<?php } ?>
            </div>
            <div class="letraPasos <?php echo $lS; ?>">
                <span class=""><strong>7. Subir PDF</strong></span>
            </div>
        </div>
        <div class="lineaPasos" align="left">
            <div>
<?php if ($sol->getSol_PasoActual() == "8") {
    $lS = "letraSelect"; ?>
                    <img src="../imagenes/flechaPasosVerde.png" width="110px">	
<?php } else {
    $lS = ""; ?>
                    <img src="../imagenes/flechaPasosGris.png" width="110px">	
<?php } ?>
            </div>
            <div class="letraPasos <?php echo $lS; ?>">
                <span class=""><strong>8. Divulgación</strong></span>
            </div>
        </div>
    </div>

</div>


<script>
    $(document).ready(function () {
        $("#SolMM_FormatoGestionarAjustes").uploadFile({
            url: "../imgPHP/formatos.php",
            maxFileSize: 20000 * 20000,
            maxFileCount: 1,
            fileName: "myfile",
            showPreview: true,
            previewHeight: "100px",
            previewWidth: "100px",
            uploadStr: "Subir Documento",
            afterUploadAll: function (obj) {
                archivo = obj.existingFileNames[0];
                $("#i_SolMM_FormatoGestionarAjustes").val(archivo);
                $("#SolMM_FormatoGestionarAjustes .ajax-upload-dragdrop").hide();
            }
        });

        $("#SolMM_FormatoGestionarRevisionJefeArea1").uploadFile({
            url: "../imgPHP/formatos.php",
            maxFileSize: 20000 * 20000,
            maxFileCount: 1,
            fileName: "myfile",
            showPreview: true,
            previewHeight: "100px",
            previewWidth: "100px",
            uploadStr: "Subir Documento",
            afterUploadAll: function (obj) {
                archivo = obj.existingFileNames[0];
                $("#i_SolMM_FormatoGestionarRevisionJefeArea1").val(archivo);
                $("#SolMM_FormatoGestionarRevisionJefeArea1 .ajax-upload-dragdrop").hide();
            }
        });

        $("#SolMM_FormatoGestionarRevisionEHS1").uploadFile({
            url: "../imgPHP/formatos.php",
            maxFileSize: 20000 * 20000,
            maxFileCount: 1,
            fileName: "myfile",
            showPreview: true,
            previewHeight: "100px",
            previewWidth: "100px",
            uploadStr: "Subir Documento",
            afterUploadAll: function (obj) {
                archivo = obj.existingFileNames[0];
                $("#i_SolMM_FormatoGestionarRevisionEHS1").val(archivo);
                $("#SolMM_FormatoGestionarRevisionEHS1 .ajax-upload-dragdrop").hide();
            }
        });

        $("#SolMM_FormatoGestionarRevisionJefeArea2").uploadFile({
            url: "../imgPHP/formatos.php",
            maxFileSize: 20000 * 20000,
            maxFileCount: 1,
            fileName: "myfile",
            showPreview: true,
            previewHeight: "100px",
            previewWidth: "100px",
            uploadStr: "Subir Documento",
            afterUploadAll: function (obj) {
                archivo = obj.existingFileNames[0];
                $("#i_SolMM_FormatoGestionarRevisionJefeArea2").val(archivo);
                $("#SolMM_FormatoGestionarRevisionJefeArea2 .ajax-upload-dragdrop").hide();
            }
        });

        $("#SolMM_FormatoGestionarRevisionEHS2").uploadFile({
            url: "../imgPHP/formatos.php",
            maxFileSize: 20000 * 20000,
            maxFileCount: 1,
            fileName: "myfile",
            showPreview: true,
            previewHeight: "100px",
            previewWidth: "100px",
            uploadStr: "Subir Documento",
            afterUploadAll: function (obj) {
                archivo = obj.existingFileNames[0];
                $("#i_SolMM_FormatoGestionarRevisionEHS2").val(archivo);
                $("#SolMM_FormatoGestionarRevisionEHS2 .ajax-upload-dragdrop").hide();
            }
        });

        $("#SolMM_FormatoGestionarSubirPDF").uploadFile({
            url: "../imgPHP/PDF.php",
            maxFileSize: 20000 * 20000,
            maxFileCount: 1,
            fileName: "myfile",
            showPreview: true,
            previewHeight: "100px",
            previewWidth: "100px",
            uploadStr: "Subir PDF",
            afterUploadAll: function (obj) {
                archivo = obj.existingFileNames[0];
                $("#i_SolMM_FormatoGestionarSubirPDF").val(archivo);
                $("#SolMM_FormatoGestionarSubirPDF .ajax-upload-dragdrop").hide();
            }
        });

    });
</script>