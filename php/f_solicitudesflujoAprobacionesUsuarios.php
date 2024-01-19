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
include("../class/adjuntos.php");

$adj = new adjuntos();
$resAnt = $adj->listarAdjuntosNombre($_POST['codigo']);

$sol = new solicitudes();
$sol->setSol_Codigo($_POST['codigo']);
$sol->consultar();

$are = new areas();
$are->setArea_Codigo($sol->getArea_Codigo());
$are->consultar();

//var_dump($are);

$usu2 = new usuarios();
$usu2->setUsu_Codigo($sol->getUsu_Codigo());
$usu2->consultar();

$par = new parametros();
$resTipDoc = $par->listarParametroTipo("1");

$hisF = new historiales_flujos();
$resHisFlu = $hisF->listarHistorialFlujoSolicitudesGestion($_POST['codigo']);

$plan = new plantillas_documentos();
$resPlant = $plan->cargarPlantillaTipoDocumentoPlanta($sol->getSol_TipoDocumento(), $sol->getSol_Tipo());

$ope = new operarios();
$resCantOpe1 = $ope->listarOperariosCapacitaciones3($are->getArea_Nombre(), $sol->getSol_Tipo());
$resCantOpe = count($resCantOpe1);

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
                <form id="f_solicitudesGestionarCrear" role="form">
                    <input type="hidden" id="Sol_CodigoActualSolicitudProcesando" value="<?php echo $_POST['codigo']; ?>">
                    <input type="hidden" id="Sol_PasoActual" value="<?php echo $sol->getSol_PasoActual(); ?>">

                    <?php if ($sol->getSol_PasoActual() == "2") { ?>

                        <div class="alert encabezadoTab letra16" align="center">
                            <strong>Clasificación y Codificación</strong>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Documento:<span class="rojo">*</span></label>
                            <select id="Sol_AccionDocumentoGestionar" class="form-control" required>
                                <option></option>
                                <option value="Nuevo">Nuevo</option>
                                <option value="Actualización">Actualización</option>
                            </select>
                        </div>

                        <div class="Info_AccionesDocumentoPaso3_Gestionar">
                        </div>
                    <?php } ?>

                    <?php if ($sol->getSol_PasoActual() == "3") { ?>
                        <?php $resSolAnt = $sol->cargarPlantillaAnterior($sol->getSol_CodigoDocumento(), $sol->getSol_HistorialVersion()); ?>
                        <?php //echo $sol->getSol_CodigoDocumento().' - '. $sol->getSol_HistorialVersion(); ?>
                        <?php
                        if ($resSolAnt) {
                            if ($resSolAnt[3] != NULL && $resSolAnt[3] != '') {
                                $arc1 = $resSolAnt[4];
                                $valores1 = explode('.', $arc1);
                                $extension1 = end($valores1);
                                if (strtoupper($extension1) != 'PDF') {
                                    $formato = $resSolAnt[3];
                                } else {
                                    $formato = '';
                                }
                            } else {
                                $formato = '';
                            }
                        } else {

                            $formato = '';
                        }
                        ?>


                        <?php if ($formato != "" && $formato != NULL) { ?>
                            <div align="center">
                                <a href="../imagenes/formatos/<?php echo $formato; ?>"  target="_blank"><button type="button" class="btn btn-primary">Descargar Plantilla</button></a>
                            </div>
                        <?php } ?>


                        <div class="alert encabezadoTab letra16" align="center">
                            <strong>Asignación de Lineamientos</strong>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Asignación de Lineamiento:<span class="rojo">*</span></label>
                            <textarea id="HistF_ObservacionGestionarLineamientos" class="form-control" required style="height: 240px;"></textarea>
                        </div>
                        <br>
                        <div align="right">
                            <button type="submit" id="Btn_SolicitudesCrearForm" class="btn btn-success">Siguiente</button>
                        </div>
                    <?php } ?>
                    <?php if ($sol->getSol_PasoActual() == "4") { ?>

                        <div class="alert encabezadoTab letra16" align="center">
                            <strong>Elaboración Documento</strong>
                        </div>

                        <?php if ($sol->getSol_AccionDocumento() == "Nuevo") { ?>
                            <?php if ($sol->getSol_Formato() != NULL) { ?>
                                <?php if ($resPlant == NULL) { ?>
                                    <label for="">No existen plantillas o documento de <?php echo $sol->getSol_TipoDocumento(); ?></label>
                                    <?php
                                } else {
                                    ?>
                                    <div align="center">
                                        <a href="../imagenes/plantillas/<?php echo $resPlant; ?>" download="<?php echo preg_replace('/[0-9]+/', '', $resPlant); ?>" target="_blank"><button type="button" class="btn btn-primary">Descargar Plantilla</button></a>
                                    </div>
                                <?php } ?>
                            <?php } else { ?>
                                <label for="">No tiene plantilla cargada</label>
                            <?php } ?>
                            <br>
                            <div class="form-group">
                                <label class="control-label">Observaciones Documento Elaborado:<span class="rojo">*</span></label>
                                <textarea id="HistF_ObservacionGestionarDocumentoElaboracion" class="form-control" required></textarea>
                            </div>
                            <br>
                            <!-- Imagen -->
                            <div class="form-group">
                                <label for="Sol_FormatoGestionarElaboracion">Documento Elaborado<span class="rojo">*</span></label>
                                <div id="Sol_FormatoGestionarElaboracion"></div>
                                <input type="hidden" id="i_Sol_FormatoGestionarElaboracion">
                            </div>
                            <br>
                            <div class="Men_ObliCargarArcElaborado"></div>
                            <br>
                            <div align="right">
                                <button type="submit" id="Btn_SolicitudesCrearForm" class="btn btn-success">Siguiente</button>
                            </div>
                        <?php } ?>

                        <?php if ($sol->getSol_AccionDocumento() == "Actualización") { ?>
                            <?php if ($sol->getSol_Formato() != NULL) { ?>
                                <?php //echo $sol->getSol_Formato();  ?>

                                <?php
                                $resSolAnt = $sol->cargarPlantillaAnterior($sol->getSol_CodigoDocumento(), $sol->getSol_HistorialVersion());
                                // var_dump($resSolAnt);
                                if ($resSolAnt != NULL) {
                                    $formato = $resSolAnt[3];
                                }if ($formato == '' || $formato == NULL || !isset($formato)) {

                                    $formato = $sol->getSol_Formato();
                                }
                                //echo $sol->getSol_Formato();
                                ?>
                                <?php if ($formato != "" && $formato != NULL) { ?>
                                    <div align="center">
                                        <a href="../imagenes/formatos/<?php echo $formato; ?>"  target="_blank"><button type="button" class="btn btn-primary">Descargar Plantilla</button></a>
                                    </div>
                                <?php } else { ?>
                                    <label for="">No tiene plantilla cargada</label>
                                <?php } ?>
                            <?php } else { ?>
                                <label for="">No tiene plantilla cargada</label>
                            <?php } ?>
                            <br>
                            <div class="form-group">
                                <label class="control-label">Observaciones Documento Actualizado:<span class="rojo">*</span></label>
                                <textarea id="HistF_ObservacionGestionarDocumentoElaboracion" class="form-control" required></textarea>
                            </div>
                            <br>
                            <!-- Imagen -->
                            <div class="form-group">
                                <label for="Sol_FormatoGestionarElaboracion">Documento Actualizado<span class="rojo">*</span></label>
                                <div id="Sol_FormatoGestionarElaboracion"></div>
                                <input type="hidden" id="i_Sol_FormatoGestionarElaboracion">
                            </div>
                            <br>
                            <div class="Men_ObliCargarArcElaborado"></div>
                            <br>
                            <div align="right">
                                <button type="submit" id="Btn_SolicitudesCrearForm" class="btn btn-success">Siguiente</button>
                            </div>
                        <?php } ?>
                    <?php } ?>

                    <?php if ($sol->getSol_PasoActual() == "8") {// if($sol->getSol_PasoActual() == "5"){     ?>

                        <div class="alert encabezadoTab letra16" align="center">
                            <strong>Revisión</strong>
                        </div>

                        <div align="center">
                            <a href="../imagenes/formatos/<?php echo $sol->getSol_Formato(); ?>" download="<?php echo $sol->getSol_Formato(); ?>" target="_blank"><button type="button" class="btn btn-primary">Descargar Documento</button></a>
                        </div>
                        <br>

                        <div class="form-group">
                            <label class="control-label">Calificación<span class="rojo">*</span></label>
                            <select id="HistF_CaliificacionGestionarRevision" class="form-control" required>
                                <option></option>
                                <option value="Perfecto">Perfecto</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Observaciones de Revisión:<span class="rojo">*</span></label>
                            <textarea id="HistF_ObservacionGestionarRevision" class="form-control" required></textarea>
                        </div>
                        <!-- Imagen -->
                        <div class="form-group">
                            <label for="Sol_FormatoGestionarRevision">Documento Revisado<span class="rojo">*</span></label>
                            <div id="Sol_FormatoGestionarRevision"></div>
                            <input type="hidden" id="i_Sol_FormatoGestionarRevision">
                        </div>
                        <br>
                        <div class="Men_ObliCargarArcRevision"></div>
                        <br>
                        <div align="right">
                            <button type="submit" id="Btn_SolicitudesCrearForm" class="btn btn-success">Siguiente</button>
                        </div>
                    <?php } ?>

                    <?php if ($sol->getSol_PasoActual() == "7") {// if($sol->getSol_PasoActual() == "6"){     ?>

                        <div class="alert encabezadoTab letra16" align="center">
                            <strong>Ajuste</strong>
                        </div>

                        <div align="center">
                            <a href="../imagenes/formatos/<?php echo $sol->getSol_Formato(); ?>" download="<?php echo $sol->getSol_Formato(); ?>" target="_blank"><button type="button" class="btn btn-primary">Descargar Documento</button></a>
                        </div>
                        <br>

                        <div class="form-group">
                            <label class="control-label">Observaciones de Ajuste:<span class="rojo">*</span></label>
                            <textarea id="HistF_ObservacionGestionarAjuste" class="form-control" required></textarea>
                        </div>
                        <!-- Imagen -->
                        <div class="form-group">
                            <label for="Sol_FormatoGestionarAjuste">Documento Ajustado<span class="rojo">*</span></label>
                            <div id="Sol_FormatoGestionarAjuste"></div>
                            <input type="hidden" id="i_Sol_FormatoGestionarAjuste">
                        </div>
                        <br>
                        <div class="Men_ObliCargarArcAjuste"></div>
                        <br>
                        <div align="right">
                            <button type="submit" id="Btn_SolicitudesCrearForm" class="btn btn-success">Siguiente</button>
                        </div>
                    <?php } ?>

                    <?php /* ?><?php if($sol->getSol_PasoActual() == "8"){ ?>
                      CONFORMIDAD
                      <div class="form-group">
                      <label class="control-label">Calificación:<span class="rojo">*</span></label>
                      <select id="HistF_CalificacionGestionarConformidad" class="form-control" required>
                      <option></option>
                      <option value="Requiere Corrección">Requiere Corrección</option>
                      <option value="Aprobado">Aprobado</option>
                      </select>
                      </div>

                      <div class="form-group">
                      <label class="control-label">Observaciones de Ajuste:<span class="rojo">*</span></label>
                      <textarea id="HistF_ObservacionGestionarConformidad" class="form-control" required></textarea>
                      </div>
                      <br>
                      <div align="center">
                      <button type="submit" id="Btn_SolicitudesCrearForm" class="btn btn-primary">Aplicar Conformidad</button>
                      </div>
                      <?php } ?><?php */ ?>

                    <?php if ($sol->getSol_PasoActual() == "5") {//if($sol->getSol_PasoActual() == "7"){     ?>

                        <div class="alert encabezadoTab letra16" align="center">
                            <strong>Revisión y Aprobación EHS</strong>
                        </div>

                        <div align="center">
                            <a href="../imagenes/formatos/<?php echo $sol->getSol_Formato(); ?>" download="<?php echo $sol->getSol_Formato(); ?>" target="_blank"><button type="button" class="btn btn-primary">Descargar Documento</button></a>
                        </div>
                        <br>

                        <div class="form-group">
                            <label class="control-label">Calificación:<span class="rojo">*</span></label>
                            <select id="HistF_CalificacionGestionarRevisionAprobacionEHS" class="form-control" required>
                                <option></option>
                                <option value="Aprobado">Aprobado</option>
                                <option value="Requiere Ajustes">Requiere Ajustes</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Observaciones de Revisión y Aprobacion EHS:<span class="rojo">*</span></label>
                            <textarea id="HistF_ObservacionGestionarRevisionAprobacionEHS" class="form-control" required></textarea>
                        </div>
                        <br>
                        <!-- Imagen -->
                        <div class="form-group">
                            <label for="Sol_FormatoGestionarAjusteEHS">Documento Actualizado:<span class="rojo">*</span></label>
                            <div id="Sol_FormatoGestionarAjusteEHS"></div>
                            <input type="hidden" id="i_Sol_FormatoGestionarAjusteEHS">
                            <br>
                            <div class="Men_ObliCargarArcElaborado"></div>
                            <br>
                        </div>
                        <div align="right">
                            <button type="submit" id="Btn_SolicitudesCrearForm" class="btn btn-success">Siguiente</button>
                        </div>
                    <?php } ?>

                    <!--
                    <?php if ($sol->getSol_PasoActual() == "8") { ?>
                                                                                                
                                                                                                        <div class="alert encabezadoTab letra16" align="center">
                                                                                                                <strong>Ajuste EHS</strong>
                                                                                                        </div>
                                                                                                
                                                                                                        <div align="center">
                                                                                                                        <a href="../imagenes/formatos/<?php echo $sol->getSol_Formato(); ?>" download="<?php echo preg_replace('/[0-9]+/', '', $sol->getSol_Formato()); ?>" target="_blank"><button type="button" class="btn btn-primary">Descargar Documento</button></a>
                                                                                                        </div>
                                                                                                
                                                                                                        <div class="form-group">
                                                                                                                <label class="control-label">Observaciones de Ajuste EHS:<span class="rojo">*</span></label>
                                                                                                                <textarea id="HistF_ObservacionGestionarRevisionAjusteEHS" class="form-control" required></textarea>
                                                                    </div>
                                                                                                        <br>
                                                                                                         Imagen 
                                                                    <div class="form-group">
                                                                      <label for="Sol_FormatoGestionarAjusteEHS">Documento Ajustado<span class="rojo">*</span></label>
                                                                      <div id="Sol_FormatoGestionarAjusteEHS"></div>
                                                                      <input type="hidden" id="i_Sol_FormatoGestionarAjusteEHS">
                                                                    </div>
                                                                    <br>
                                                                    <div class="Men_ObliCargarArcAjusteEHS"></div>
                                                                    <br>
                                                                                                        <div align="right">
                                                                                                                <button type="submit" id="Btn_SolicitudesCrearForm" class="btn btn-success">Siguiente</button>
                                                                                                        </div>
                    <?php } ?>
                    -->

                    <?php if ($sol->getSol_PasoActual() == "6") { //if($sol->getSol_PasoActual() == "9"){      ?>

                        <div class="alert encabezadoTab letra16" align="center">
                            <strong>Revisión y Aprobación Jefe</strong>
                        </div>

                        <div align="center">
                            <a href="../imagenes/formatos/<?php echo $sol->getSol_Formato(); ?>" download="<?php echo $sol->getSol_Formato(); ?>" target="_blank"><button type="button" class="btn btn-primary">Descargar Documento</button></a>
                        </div>
                        <br>

                        <div class="form-group">
                            <label class="control-label">Calificación:<span class="rojo">*</span></label>
                            <select id="HistF_CalificacionGestionarRevisionAprobacionJefe" class="form-control" required>
                                <option></option>
                                <option value="Aprobado">Aprobado</option>
                                <option value="Requiere Ajustes">Requiere Ajustes</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Observaciones de Revisión y Aprobacion Jefe:<span class="rojo">*</span></label>
                            <textarea id="HistF_ObservacionGestionarRevisionAprobacionJefe" class="form-control" required></textarea>
                        </div>
                        <br>
                        <!-- Imagen -->
                        <div class="form-group">
                            <label for="Sol_FormatoGestionarAjusteJefeAprobadorFinal">Documento Actualizado:<span class="rojo">*</span></label>
                            <div id="Sol_FormatoGestionarAjusteJefeAprobadorFinal"></div>
                            <input type="hidden" id="i_Sol_FormatoGestionarAjusteJefeAprobadorFinal">
                        </div>
                        <br>
                        <div class="Men_ObliCargarArcElaborado"></div>
                        <br>
                        <div align="right">
                            <button type="submit" id="Btn_SolicitudesCrearForm" class="btn btn-success">Siguiente</button>
                        </div>

                        <!--
                                                                        <div class="alert encabezadoTab letra16" align="center">
                                                                                <strong>Aprobación</strong>
                                                                        </div>
                                                                
                                                                        <div align="center">
                                      <a href="../imagenes/formatos/<?php echo $sol->getSol_Formato(); ?>" download="<?php echo preg_replace('/[0-9]+/', '', $sol->getSol_Formato()); ?>" target="_blank"><button type="button" class="btn btn-primary">Descargar Documento</button></a>
                                    </div>
                                    <br>
                                                                
                                                                        <div class="form-group">
                                      <label class="control-label">Calificación:<span class="rojo">*</span></label>
                                      <select id="HistF_CalificacionGestionarAprobacion" class="form-control" required>
                                                                                        <option></option>
                                                                                        <option value="Subir PDF">Subir PDF</option>
                                                                                        <option value="Requiere Ajustes">Requiere Ajustes</option>
                                                                                </select>
                                    </div>
                                                                
                                                                        <div class="form-group">
                                                                                <label class="control-label">Observaciones de Aprobación:<span class="rojo">*</span></label>
                                                                                <textarea id="HistF_ObservacionGestionarAprobacion" class="form-control" required></textarea>
                                    </div>
                                                                        <br>
                                                                        <div align="right">
                                                                                <button type="submit" id="Btn_SolicitudesCrearForm" class="btn btn-success">Siguiente</button>
                                                                        </div>
                        -->
                    <?php } ?>

                    <?php if ($sol->getSol_PasoActual() == "9") {// if($sol->getSol_PasoActual() == "10"){     ?>

                        <div class="alert encabezadoTab letra16" align="center">
                            <strong>Jefe Aprobador Final</strong>
                        </div>

                        <div align="center">
                            <a href="../imagenes/formatos/<?php echo $sol->getSol_Formato(); ?>" download="<?php echo $sol->getSol_Formato(); ?>" target="_blank"><button type="button" class="btn btn-primary">Descargar Documento</button></a>
                        </div>
                        <br>

                        <div class="form-group">
                            <label class="control-label">Calificación:<span class="rojo">*</span></label>
                            <select id="HistF_CalificacionGestionarAprobacion" class="form-control" required>
                                <option></option>
                                <option value="Subir PDF">Subir PDF</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Observaciones de Aprobación:<span class="rojo">*</span></label>
                            <textarea id="HistF_ObservacionGestionarAprobacion" class="form-control" required></textarea>
                        </div>
                        <br>
                        <div align="right">
                            <button type="submit" id="Btn_SolicitudesCrearForm" class="btn btn-success">Siguiente</button>
                        </div>
                        <!--
                                                                        <div class="alert encabezadoTab letra16" align="center">
                                                                                <strong>Ajuste Jefe Aprobador Final</strong>
                                                                        </div>
                                                                
                                                                        <div align="center">
                                                                                <a href="../imagenes/formatos/<?php echo $sol->getSol_Formato(); ?>" download="<?php echo preg_replace('/[0-9]+/', '', $sol->getSol_Formato()); ?>" target="_blank"><button type="button" class="btn btn-primary">Descargar Documento</button></a>
                                                                        </div>
                                                                
                                                                        <div class="form-group">
                                                                                <label class="control-label">Observaciones de Ajuste Jefe Aprobador Final:<span class="rojo">*</span></label>
                                                                                <textarea id="HistF_ObservacionGestionarRevisionAjusteJefeAprobadorFinal" class="form-control" required></textarea>
                                    </div>
                                                                        <br>
                                                                         Imagen 
                                    <div class="form-group">
                                      <label for="Sol_FormatoGestionarAjusteJefeAprobadorFinal">Documento Ajustado<span class="rojo">*</span></label>
                                      <div id="Sol_FormatoGestionarAjusteJefeAprobadorFinal"></div>
                                      <input type="hidden" id="i_Sol_FormatoGestionarAjusteJefeAprobadorFinal">
                                    </div>
                                    <br>
                                    <div class="Men_ObliCargarArcAjusteJefeAprobadorFinal"></div>
                                    <br>
                                                                        <div align="right">
                                                                                <button type="submit" id="Btn_SolicitudesCrearForm" class="btn btn-success">Siguiente</button>
                                                                        </div>
                        -->
                    <?php } ?>

                    <?php if ($sol->getSol_PasoActual() == "10") {//  if($sol->getSol_PasoActual() == "11"){     ?>

                        <div class="alert encabezadoTab letra16" align="center">
                            <strong>PDF</strong>
                        </div>

                        <div align="center">
                            <label class="comentario">*Descarga el documento aprobado para convertirlo en pdf* </label>
                            <a href="../imagenes/formatos/<?php echo $sol->getSol_Formato(); ?>" download="<?php echo $sol->getSol_Formato() ?>" target="_blank"><button type="button" class="btn btn-primary">Descargar Documento</button></a>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <label class="control-label">Observaciones de PDF:<span class="rojo">*</span></label>
                            <textarea id="HistF_ObservacionGestionarRevisionPDF" class="form-control" required></textarea>
                        </div>
                        <br>
                        <!-- Imagen -->
                        <div class="form-group e_recargarCampo">
                            <label for="Sol_FormatoGestionarPDF">Documento PDF<span class="rojo">*</span></label>
                            <label class="comentario">*Previamente se descarga el documento y se debe convertir en PDF el cual se debe subir*</label>
                            <div class="Sol_FormatoGestionarPDF" align="center"></div>
                            <input type="hidden" id="i_Sol_FormatoGestionarPDF" align="center">
                        </div>
                        <br>

                        <div class="e_mensajeAprobacionPDF">	
                        </div>
                        <div align="right">
                            <button type="submit" id="Btn_SolicitudesCrearForm" class="btn btn-success">Subir PDF</button>
                        </div>
                    <?php } ?>

                    <?php if ($sol->getSol_PasoActual() == "11") {//12     ?>

                        <div class="alert encabezadoTab letra16" align="center">
                            <strong>Divulgación - Publicación</strong>
                        </div>

                        <div align="center">
                            <label class="comentario">*Descarga el documento PDF* </label>
                            <a href="../imagenes/PDF/<?php echo $sol->getSol_PDF(); ?>" download="<?php echo preg_replace('/[0-9]+/', '', $sol->getSol_PDF()); ?>" target="_blank"><button type="button" class="btn btn-primary">Descargar PDF</button></a>
                        </div>
                        <br>
                        <div align="center">
                            <button class="btn btn-warning e_cargarCapacitacionesSolicitudes" data-cod="<?php echo $_POST['codigo']; ?>">Capacitaciones</button>	
                        </div>
                        <br>
                        <div align="center">
                            <strong class="rojo letra16">Total Divulgación: <?php echo $resCantCapac[0] . "/" . $resCantOpe; ?></strong>
                            <br>
                            <strong class="rojo letra16">Porcentaje Divulgación: <?php
                                if ($resCantOpe > 0) {
                                    echo number_format($resCantCapac[0] / $resCantOpe * 100, 2, ",", ".") . "%";
                                } else {
                                    echo "0%";
                                }
                                ?></strong>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="control-label">Observaciones de Publicación:<span class="rojo">*</span></label>
                            <textarea id="HistF_ObservacionGestionarRevisionDivulgacion" class="form-control" required></textarea>
                        </div>
                        <br>
                        <div class="e_mensajeAprobacionPDF">	
                        </div>
                        <div class="col-lg-12 col-md-12 e_cargarDatosAdjuntos">
                            <div class="panel panel-primary">
                                <div class="panel-heading" align="center">
                                    <label class="letra16">Adjuntos</label>
                                </div>
                                <div class="panel-body">
                                    <label>Adjuntos<span class="rojo">*</span></label>
                                    <div id="AdjuntoA1"></div>
                                    <input id="i_AdjuntoA1" type="hidden">
                                    <div id="AdjuntoA2"></div>
                                    <input id="i_AdjuntoA2" type="hidden">
                                    <div id="AdjuntoA3"></div>
                                    <input id="i_AdjuntoA3" type="hidden">
                                    <div id="AdjuntoA4"></div>
                                    <input id="i_AdjuntoA4" type="hidden">
                                    <div id="AdjuntoA5"></div>
                                    <input id="i_AdjuntoA5" type="hidden">
                                    <br>
                                    <button type="button" id="Btn_AdjuntoPrestamoForm" class="btn btn-warning">Cargar</button>
                                </div>
                            </div>
                            <div class="panel panel-primary">
                                <div class="panel-heading" align="center">
                                    <label class="letra16">Listado Adjuntos</label>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive" id="imp_tabla">
                                        <table id="" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
                                            <thead>
                                                <tr class="ordenamiento encabezadoConex">
                                                    <th class="text-center">Nombre</th>
                                                    <th class="text-center"></th>
                                                    <th class="text-center" style="display: <?php echo $display; ?>"></th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($resAnt as $registro) { ?>
                                                    <tr>
                                                        <td><?php echo $registro[1]; ?></td>
                                                        <td class="text-center">
                                                            <span class="glyphicon glyphicon-eye-open manito e_VerAdjuntoSug" data-ubi="adjuntos" data-cod="<?php echo $registro[0]; ?>" title="Ver"></span>
                                                        </td>
                                                        <td class="text-center" style="display: <?php echo $display; ?>">
                                                            <span class="glyphicon glyphicon-trash manito e_EliminarAdjunto" data-cod="<?php echo $registro[0]; ?>" title="Eliminar"></span>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="cargarObligatorio"></div>
                            <div class="limpiar"></div>
                            <div align="left">
                                <?php // if($resCantCapacRegTotal[0] == $resCantOpe[0] && count($resAnt) >0){       ?>
                                <strong>Planilla Capacitación</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="excel_capacitacionesSolicitudes.php?cod=<?php echo $_POST['codigo']; ?>" title="Planilla Capacitación"><img src="../imagenes/excel.png" width="35px;"></a>
                                <br><br>
                                <?php
                                // var_dump($resAnt);
                                if ($resAnt != NULL && number_format($resCantCapac[0] / $resCantOpe * 100, 2, ",", ".") == '100,00') {
                                    ?>
                                    <button type="submit" id="Btn_SolicitudesCrearForm" class="btn btn-success">Publicar Documento</button>
                                    <?php // } ?>    
    <?php } else { ?>
                                    <div class="alert alert-warning">
                                        <strong>Recuerde completar toda la planilla de capacitación para poder Divulgar el documento.<br>
                                            Y debe de adjuntar el soporte de capacitación para publicar el documento.</strong>
                                    </div>
    <?php } ?>
                            </div>
                        </div>
                    <?php } ?>

<?php if ($sol->getSol_PasoActual() == "12") { ?>
                        <div class="alert encabezadoTab letra16" align="center">
                            <strong>Documento Publicado</strong>
                        </div>

                        <div align="center"> 
                            <a href="../imagenes/PDF/<?php echo $sol->getSol_PDF(); ?>" download="<?php echo preg_replace('/[0-9]+/', '', $sol->getSol_PDF()); ?>" target="_blank"><button type="button" class="btn btn-primary">Descargar PDF</button></a>
                        </div>
                        <br>
                        <div align="center">
                            <a href="../imagenes/formatos/<?php echo $sol->getSol_Formato(); ?>" download="<?php echo $sol->getSol_Formato(); ?>" target="_blank"><button type="button" class="btn btn-primary">Descargar Documento</button></a>
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
                    <strong class="letra14">Nombre Documento: </strong><?php echo ($sol->getSol_NombreDocumento() == NULL) ? $sol->getSol_Tema() : $sol->getSol_NombreDocumento(); ?>
                    <br>
                    <strong class="letra14">Código: </strong><?php echo $sol->getSol_CodigoDocumento(); ?>
                    <br>
                    <strong class="letra14">Versión: </strong><?php echo $sol->getSol_HistorialVersion(); ?>
                    <br>
                    <strong class="letra14">Área: </strong> <?php echo $are->getArea_Nombre(); ?>
                    <br>
                    <strong class="letra14">Fecha Solicitud: </strong><?php echo $sol->getSol_Fecha(); ?>   
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6">
                    <strong class="letra14">Usuario Solicitud: </strong><?php echo $usu2->getUsu_Nombre() . " " . $usu2->getUsu_Apellido(); ?>
                    <br>
                    <strong class="letra14">Tema: </strong><?php echo $sol->getSol_Tema(); ?>
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
                                            <?php $nombre_fichero = "../imagenes/formatos/" . $registro[6]; ?>
                                            <?php $nombre_fichero2 = "../imagenes/PDF/" . $registro[6]; ?>
                                            <?php if (file_exists($nombre_fichero)) { ?>
                                                <td nowrap><a href="../imagenes/formatos/<?php echo $registro[6]; ?>" download="Historial_<?php echo $registro[6]; ?>" target="_blank"><span class="glyphicon glyphicon-download-alt manito azul" title="Descargar Formato"></span></a></td>
                                                <?php
                                            } else {
                                                if (file_exists($nombre_fichero2)) {
                                                    ?>
                                                    <td nowrap><a href="../imagenes/PDF/<?php echo $registro[6]; ?>" download="Historial_<?php echo $registro[6]; ?>" target="_blank"><span class="glyphicon glyphicon-download-alt manito azul" title="Descargar Formato"></span></a></td>
                                                <?php } else {
                                                    ?>
                                                    <td></td>
                                                    <?php
                                                }
                                            }
                                            ?>
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
                <?php
                if ($sol->getSol_PasoActual() == "1") {
                    $lS = "letraSelect";
                    ?>
                    <img src="../imagenes/flechaPasosVerde.png" width="100px">	
                    <?php
                } else {
                    $lS = "";
                    ?>
                    <img src="../imagenes/flechaPasosGris.png" width="100px">	
<?php } ?>
            </div>
            <div class="letraPasos <?php echo $lS; ?>">
                <span class=""><strong>1. Solicitud</strong></span>
            </div>
        </div>
        <div class="lineaPasos" align="left">
            <div>
                <?php
                if ($sol->getSol_PasoActual() == "2") {
                    $lS = "letraSelect";
                    ?>
                    <img src="../imagenes/flechaPasosVerde.png" width="100px">	
                    <?php
                } else {
                    $lS = "";
                    ?>
                    <img src="../imagenes/flechaPasosGris.png" width="100px">	
<?php } ?>
            </div>
            <div class="letraPasos2 <?php echo $lS; ?>">
                <span class=""><strong>2. Clasificación y <br>Codificación</strong></span>
            </div>
        </div>
        <div class="lineaPasos" align="left">
            <div>
                <?php
                if ($sol->getSol_PasoActual() == "3") {
                    $lS = "letraSelect";
                    ?>
                    <img src="../imagenes/flechaPasosVerde.png" width="100px">	
                    <?php
                } else {
                    $lS = "";
                    ?>
                    <img src="../imagenes/flechaPasosGris.png" width="100px">	
<?php } ?>
            </div>
            <div class="letraPasos2 <?php echo $lS; ?>">
                <span class=""><strong>3. Asignación de <br>Lineamientos</strong></span>
            </div>
        </div>
        <div class="lineaPasos" align="left">
            <div>
                <?php
                if ($sol->getSol_PasoActual() == "4") {
                    $lS = "letraSelect";
                    ?>
                    <img src="../imagenes/flechaPasosVerde.png" width="100px">	
                    <?php
                } else {
                    $lS = "";
                    ?>
                    <img src="../imagenes/flechaPasosGris.png" width="100px">	
<?php } ?>
            </div>
            <div class="letraPasos2 <?php echo $lS; ?>">
                <span class=""><strong>4. Elaboración <br>Actualización</strong></span>
            </div>
        </div>
        <div class="lineaPasos" align="left">
            <div>
                <?php
                if ($sol->getSol_PasoActual() == "5") {
                    $lS = "letraSelect";
                    ?>
                    <img src="../imagenes/flechaPasosVerde.png" width="100px">	
                    <?php
                } else {
                    $lS = "";
                    ?>
                    <img src="../imagenes/flechaPasosGris.png" width="100px">	
<?php } ?>
            </div>
            <div class="letraPasos2 <?php echo $lS; ?>">
                <span class=""><strong>5. Revisión <br>Aprobación EHS</span>
                        </div>
                        </div>
                        <div class="lineaPasos" align="left">
                            <div>
                                <?php
                                if ($sol->getSol_PasoActual() == "6") {
                                    $lS = "letraSelect";
                                    ?>
                                    <img src="../imagenes/flechaPasosVerde.png" width="100px">	
                                    <?php
                                } else {
                                    $lS = "";
                                    ?>
                                    <img src="../imagenes/flechaPasosGris.png" width="100px">	
<?php } ?>
                            </div>
                            <div class="letraPasos2 <?php echo $lS; ?>">
                                <span class=""><strong>6. Revisión <br>Aprobación Jefe</span>
                                        </div>
                                        </div>
                                        <div class="lineaPasos" align="left">
                                            <div>
                                                <?php
                                                if ($sol->getSol_PasoActual() == "7") {
                                                    $lS = "letraSelect";
                                                    ?>
                                                    <img src="../imagenes/flechaPasosVerde.png" width="100px">	
                                                    <?php
                                                } else {
                                                    $lS = "";
                                                    ?>
                                                    <img src="../imagenes/flechaPasosGris.png" width="100px">	
<?php } ?>
                                            </div>
                                            <div class="letraPasos2 <?php echo $lS; ?>">
                                                <span class=""><strong>7. Ajuste<br>Lider Doc.</strong></span>
                                            </div>
                                        </div>
                                        <div class="lineaPasos" align="left">
                                            <div>
                                                <?php
                                                if ($sol->getSol_PasoActual() == "8") {
                                                    $lS = "letraSelect";
                                                    ?>
                                                    <img src="../imagenes/flechaPasosVerde.png" width="100px">	
                                                    <?php
                                                } else {
                                                    $lS = "";
                                                    ?>
                                                    <img src="../imagenes/flechaPasosGris.png" width="100px">	
<?php } ?>
                                            </div>
                                            <div class="letraPasos2 <?php echo $lS; ?>">
                                                <span class=""><strong>8. Revisión<br>Mejora Continua</strong></span>
                                            </div>
                                        </div>
                                        <div class="lineaPasos" align="left">
                                            <div>
                                                <?php
                                                if ($sol->getSol_PasoActual() == "9") {
                                                    $lS = "letraSelect";
                                                    ?>
                                                    <img src="../imagenes/flechaPasosVerde.png" width="100px">	
                                                    <?php
                                                } else {
                                                    $lS = "";
                                                    ?>
                                                    <img src="../imagenes/flechaPasosGris.png" width="100px">	
<?php } ?>
                                            </div>
                                            <div class="letraPasos2 <?php echo $lS; ?>">
                                                <span class=""><strong>9. Aprobador Final<br>Jefe</strong></span>
                                            </div>
                                        </div>
                                        <div class="lineaPasos" align="left">
                                            <div>
                                                <?php
                                                if ($sol->getSol_PasoActual() == "10") {
                                                    $lS = "letraSelect";
                                                    ?>
                                                    <img src="../imagenes/flechaPasosVerde.png" width="100px">	
                                                    <?php
                                                } else {
                                                    $lS = "";
                                                    ?>
                                                    <img src="../imagenes/flechaPasosGris.png" width="100px">	
<?php } ?>
                                            </div>
                                            <div class="letraPasos <?php echo $lS; ?>">
                                                <span class=""><strong>10. Subir PDF</strong></span>
                                            </div>
                                        </div>
                                        <div class="lineaPasos" align="left">
                                            <div>
                                                <?php
                                                if ($sol->getSol_PasoActual() == "11") {
                                                    $lS = "letraSelect";
                                                    ?>
                                                    <img src="../imagenes/flechaPasosVerde.png" width="100px">	
                                                    <?php
                                                } else {
                                                    $lS = "";
                                                    ?>
                                                    <img src="../imagenes/flechaPasosGris.png" width="100px">	
<?php } ?>
                                            </div>
                                            <div class="letraPasos <?php echo $lS; ?>">
                                                <span class=""><strong>11. Divulgación</strong></span>
                                            </div>
                                        </div>
                                        <!--
                                            <div class="lineaPasos" align="left">
                                                                <div>
                                        <?php
                                        if ($sol->getSol_PasoActual() == "12") {
                                            $lS = "letraSelect";
                                            ?>
                                                                                                                    <img src="../imagenes/flechaPasosVerde.png" width="100px">	
                                            <?php
                                        } else {
                                            $lS = "";
                                            ?>
                                                                                                                    <img src="../imagenes/flechaPasosGris.png" width="100px">	
<?php } ?>
                                                                </div>
                                                                <div class="letraPasos <?php echo $lS; ?>">
                                                                        <span class=""><strong>12. Divulgación</strong></span>
                                                                </div>
                                                        </div>
                                        -->

                                        </div>

                                        </div>


                                        <script>
                                            $(document).ready(function () {
                                                $(".Sol_FormatoGestionarPDF").uploadFile({
                                                    url: "../imgPHP/PDF.php",
                                                    maxFileSize: 20000 * 20000,
                                                    maxFileCount: 1,
                                                    fileName: "myfile",
                                                    showPreview: true,
                                                    previewHeight: "100px",
                                                    previewWidth: "200px",
                                                    uploadStr: "Subir PDF",
                                                    multiple: false,
                                                    dragDrop: true,
                                                    showDelete: false,
                                                    acceptFiles: '.pdf',

                                                    afterUploadAll: function (obj) {
                                                        archivo = obj.existingFileNames[0];
                                                        $("#i_Sol_FormatoGestionarPDF").val(archivo);
                                                        $(".e_mensajeAprobacionPDF").hide();
                                                        $(".Sol_FormatoGestionarPDF .ajax-upload-dragdrop").hide();
                                                    }

                                                });

                                                $("#Sol_FormatoGestionarElaboracion").uploadFile({
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
                                                        $("#i_Sol_FormatoGestionarElaboracion").val(archivo);
                                                        $("#Sol_FormatoGestionarElaboracion .ajax-upload-dragdrop").hide();
                                                    }
                                                });

                                                $("#Sol_FormatoGestionarRevision").uploadFile({
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
                                                        $("#i_Sol_FormatoGestionarRevision").val(archivo);
                                                        $("#Sol_FormatoGestionarRevision .ajax-upload-dragdrop").hide();
                                                    }
                                                });

                                                $("#Sol_FormatoGestionarAjuste").uploadFile({
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
                                                        $("#i_Sol_FormatoGestionarAjuste").val(archivo);
                                                        $("#Sol_FormatoGestionarAjuste .ajax-upload-dragdrop").hide();
                                                    }
                                                });

                                                $("#Sol_FormatoGestionarAjusteEHS").uploadFile({
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
                                                        $("#i_Sol_FormatoGestionarAjusteEHS").val(archivo);
                                                        $("#Sol_FormatoGestionarAjusteEHS .ajax-upload-dragdrop").hide();
                                                    }
                                                });

                                                $("#Sol_FormatoGestionarAjusteJefeAprobadorFinal").uploadFile({
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
                                                        $("#i_Sol_FormatoGestionarAjusteJefeAprobadorFinal").val(archivo);
                                                        $("#Sol_FormatoGestionarAjusteJefeAprobadorFinal .ajax-upload-dragdrop").hide();
                                                    }
                                                });

                                            });
                                            $(document).ready(function () {
                                                $("#AdjuntoA1").uploadFile({
                                                    url: "../imgPHP/subirAdjunto.php",
                                                    maxFileSize: 20000 * 20000,
                                                    maxFileCount: 5,
                                                    fileName: "myfile",
                                                    showPreview: true,
                                                    previewHeight: "100px",
                                                    previewWidth: "100px",
                                                    afterUploadAll: function (obj) {
                                                        archivos = obj.existingFileNames;
                                                        //console.log(archivos);
                                                        for (i = 0; i < archivos.length; i++) {
                                                            archivo = obj.existingFileNames[i];
                                                            $("#i_AdjuntoA" + (i + 1)).val(archivo);
                                                        }
                                                    }
                                                });
                                            });
                                        </script>