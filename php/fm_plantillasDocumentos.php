<?php
include("op_sesion.php");
include("../class/plantillas_documentos.php");
include("../class/plantas.php");
include("../class/usuarios_plantas.php");
include("hora.php");

$planD = new plantillas_documentos();
$resPlanD = $planD->listarPlantillasDocumentosPrinpal();
$pPlantillasDocs = $usuper->Permisos($_SESSION['GD_Usuario'], 8);

$plan = new plantas();
$respla = $plan->listarPlantasFiltroConUsuarioPermisos($_SESSION['GD_Usuario']);
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <?php include("s_cabecera.php"); ?>
        <script src="../js/plantillas_documentos.js"></script>
        <script type="text/javascript">
            $(document).ready(function (e) {
                $("#tbl_PlantillasDocumentos").tablesorter();
            });
        </script>
    </head>
    <?php include("s_menu.php"); ?>
    <body>
        <div id="d_contenedor" class="container">
            <!-- Todo el Contenido -->

            <div class="col-lg-12 col-md-12">

                <div class="panel panel-primary">
                    <div class="panel-heading">

                        <div class="row">

                            <div class="col-lg-3 col-md-3">
                                <br>
                                <strong class="letra16">Plantillas Documentos</strong>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Planta:</label>
                                    <select id="planta_codigoFiltro" class="form-control">
                                        <?php foreach ($respla as $registro) { ?>
                                            <option value="<?php echo $registro['Pla_Codigo']; ?>"><?php echo $registro['Pla_Nombre']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <br>
                                <div class="input-group">
                                    <span class="input-group-addon"><strong>Buscar:</strong></span>
                                    <input id="filtrarPlantillasDocumentos" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2">
                                <br>
                                <?php if (isset($pPlantillasDocs) && $pPlantillasDocs[5] == "1") { ?>
                                    <button id="Btn_PlantillasDocumentosCrear" class="btn btn-success">Crear</button>
                                <?php } ?>
                            </div>

                        </div>

                    </div>

                    <div class="panel-body" id="listarPlantillas">



                    </div>
                </div>

            </div>

        </div>

        <!-- Crear PlantillasDocumentos -->
        <div id="vtn_PlantillasDocumentosCrear" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body info_PlantillasDocumentosCrear">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="Btn_PlantillasDocumentosCrearForm" form="f_plantillasDocumentosCrear">Crear</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actualizar PlantillasDocumentos -->
        <div id="vtn_PlantillasDocumentosActualizar" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body info_PlantillasDocumentosActualizar">
                    </div>
                    <div class="modal-footer">
                        <?php if (isset($pPlantillasDocs) && $pPlantillasDocs[4] == "1") { ?>
                            <button type="submit" id="Btn_PlantillasDocumentosActualizarForm" class="btn btn-warning" form="f_plantillasDocumentosActualizar">Actualizar</button>
                        <?php } ?>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notificaciones -->
        <div id="vtn_PlantillasDocumentosNotificaciones" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body info_PlantillasDocumentosNotificaciones" align="center">
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="Btn_PlantillasDocumentosNotificaciones" class="btn btn-success">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>