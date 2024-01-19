<?php
include("op_sesion.php");
include("../class/areas.php");
include("../class/plantas.php");

$pla = new plantas();
$resPla = $pla->listarMarcaFilto($_SESSION['GD_Usuario']);
$are = new areas();
$resAre = $are->listarAreasFiltroFluA("-1", $_SESSION['GD_Usuario']);
$usu1 = new usuarios();
$resUsu1 = $usu1->listarUsuariosFluA("-1", $_SESSION['GD_Usuario']);
$pFlujoApro = $usuper->Permisos($_SESSION['GD_Usuario'], 6);
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <?php include("s_cabecera.php"); ?>
        <script src="../js/flujos_aprobaciones.js?<?php echo rand() ?>"></script>
    </head>
    <?php include("s_menu.php"); ?>
    <body>
        <div id="d_contenedor" class="container">
            <!-- Todo el Contenido -->


            <div class="col-lg-12 col-md-12">

                <div class="panel panel-primary">
                    <div class="panel-heading">

                        <div class="row">
                            <div class="col-lg-2 col-md-2">
                                <strong class="letra16">Flujo de aprobación</strong>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2">
                                <div class="form-group">
                                    <label class="control-label">Área:</label>
                                    <select id="FiltroAreaNombres" class="form-control">
                                        <option value="-1" selected>Todas</option>
                                        <?php foreach ($resAre as $registro) { ?>
                                            <option value="<?php echo $registro[1]; ?>"><?php echo $registro[1]; ?></option>
                                        <?php } ?>                  
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" value="-1" id="FiltroArea">
                            <div class="col-lg-2 col-md-2 col-sm-2">
                                <div class="form-group">
                                    <label class="control-label">Usuarios:</label>
                                    <select id="FiltroUsuario" class="form-control">
                                        <option value="-1" selected>Todos</option>
                                        <?php foreach ($resUsu1 as $registro) { ?>
                                            <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                                        <?php } ?>                  
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-2">
                                <label class="control-label">Estado:</label>
                                <select id="FiltroOperarios_Estado" class="form-control">
                                    <option value="-1">Todos</option>
                                    <option value="1" selected>Activos</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-2">
                                <div class="form-group">
                                    <label class="control-label">Tipo Flujo:</label>
                                    <select id="FiltroOperarios_TipoFlujo" class="form-control">
                                        <option value="1">Documentos Equipo Industrial</option>
                                        <option value="2">Perfil de Competencias</option>
                                        <option value="3">Matriz IPERC y/o Mapas de Seguridad</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2">
                                <div class="form-group">
                                    <label class="control-label">País:</label>
                                    <select id="FiltroFluA_Pais" class="form-control" multiple data-mod="FiltroFluA_Planta">
                                        <?php foreach ($resPla as $registro) { ?>
                                            <option value="<?php echo $registro[0]; ?>"><?php echo $registro[0]; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 e_cargarFiltroFluAPlantas">
                                <div class="form-group">
                                    <label class="control-label">Planta:</label>
                                    <select id="FiltroFluA_Planta" class="form-control">
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-1 col-md-1 col-sm-1">
                                <br>
                                <button id="Btn_FluABuscar" class="btn btn-primary">Buscar</button>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2">
                                <br>
                                <?php if (isset($pFlujoApro) && $pFlujoApro[5] == "1") { ?>
                                    <button id="Btn_FlujosAprobacionesCrear" class="btn btn-success">Crear</button>
                                <?php } ?>
                            </div>

                            <!--            <div class="col-lg-2 col-md-2 col-sm-2">
                                          <br>
                                          <img src="../imagenes/excel.png" width="30px" class="excel_FlujosAprobaciones manito" title="Exportar a Excel">
                                        </div>-->

                        </div>

                    </div>

                    <div class="panel-body info_cargarFlujosAprobacionesListar">


                    </div>
                </div>

            </div>

        </div>

        <!-- Crear FlujosAprobaciones -->
        <div id="vtn_FlujosAprobacionesCrear" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body info_FlujosAprobacionesCrear">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="Btn_FlujosAprobacionesCrearForm" form="f_flujosAprobacionesCrear">Crear</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actualizar FlujosAprobaciones -->
        <div id="vtn_FlujosAprobacionesActualizar" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body info_FlujosAprobacionesActualizar">
                    </div>
                    <div class="modal-footer">
                        <div class="d_mensajeFlujosAprobacionesActualizar"></div>
                        <?php if (isset($pFlujoApro) && $pFlujoApro[4] == "1") { ?>
                            <button type="submit" id="Btn_FlujosAprobacionesActualizarForm" class="btn btn-success" form="f_flujosAprobacionesActualizar">Actualizar</button>
                        <?php } ?>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notificaciones FlujosAprobaciones Crear -->
        <div id="vtn_FlujosAprobacionesNotificacionesCrear" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body info_FlujosAprobacionesNotificacionesCrear" align="center">
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="Btn_FlujosAprobacionesNotificacionesCrear" class="btn btn-success">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notificaciones FlujosAprobaciones Actualizar -->
        <div id="vtn_FlujosAprobacionesNotificacionesActualizar" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body info_FlujosAprobacionesNotificacionesActualizar" align="center">
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="Btn_FlujosAprobacionesNotificacionesActualizar" class="btn btn-success">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>


    </body>
</html>