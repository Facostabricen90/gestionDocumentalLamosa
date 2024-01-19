<?php
include("op_sesion.php");
include("../class/parametros.php");
include("../class/flujos_aprobaciones.php");
include("../class/usuarios_areas.php");
include("../class/plantas.php");

$pla = new plantas();
$resPla = $pla->listarMarcaFilto($_SESSION['GD_Usuario']);

date_default_timezone_set("America/Bogota");

//$fecha = date("Y-m-d");
//$fechaInicio = date("Y-m-d", strtotime($fecha . "- 360 days"));

$usuA = new usuarios_areas();
$resUsuA = $usuA->listarAreasUsuariosFiltroPlanta($_SESSION['GD_Usuario']);

//$usuAre = new areas();
//$resUsuAre = $usuAre->listarAreasUsuariosFiltroPlanta($_SESSION['GD_Usuario']);

$cantAreas = count($resUsuA);

$par = new parametros();
$resPar = $par->listarParametroTipo("2", "Pasos");
$resTipDoc = $par->listarParametroTipoCatalogo("1");

$fluA = new flujos_aprobaciones();
$resFluA = $fluA->listarFlujoAprobacionesSolicitudesUsuariosTipoFlujo($_SESSION['GD_Usuario'], $usu->getUsu_TipoFlujo());

foreach ($resFluA as $registro2) {
    $Areas[$registro2[1]] = $registro2[1];
    $Paso[$registro2[1] . $registro2[2]] = $registro2[2];
    $PasoCrear[$registro2[2]] = $registro2[2];
}

$fecha = date("Y-m-d");
$fechaInicio = date("Y-m-d", strtotime($fecha . "- 30 days"));

?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <?php include("s_cabecera.php"); ?>
        <script src="../js/solicitudes.js?<?php echo rand() ?>"></script>
        <script>
            $(document).ready(function (e) {
                //$("#Btn_BuscarSolicitudes").click();
            });
        </script>
    </head>
    <?php include("s_menu.php"); ?>
    <body>
        <div id="d_contenedor" class="container-fluid">
            <br>
            <!-- Todo el Contenido -->
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-primary sinbordeTbl">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-lg-1 col-md-1">
                                    <strong class="letra16">Solicitudes&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                </div>
                                <div class="col-lg-1 col-md-1">
                                    <div class="form-group">
                                        <label class="control-label">Fecha Inicial:</label>
                                        <input type="text" id="filtroSolicitudes_FechaInicial" class="form-control fecha" value="<?php echo $fechaInicio; ?>" autocomplete="off">
                                    </div>
                                </div>

                                <div class="col-lg-1 col-md-1">
                                    <div class="form-group">
                                        <label class="control-label">Fecha Final:</label>
                                        <input type="text" id="filtroSolicitudes_FechaFinal" class="form-control fecha" value="<?php echo $fecha; ?>" autocomplete="off">
                                    </div>
                                </div>

                                <div class="col-lg-1 col-md-1">
                                    <div class="form-group">
                                        <label class="control-label">Estados:</label>
                                        <select id="filtroSolicitudes_Estado" class="form-control">
                                            <option value="-1">Todos</option>
                                            <?php foreach ($resPar as $registro) { ?>
                                                <option value="<?php echo $registro[2]; ?>"><?php echo $registro[2] . ". " . $registro[1]; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                                <?php /* if ($resUsuA) { ?>
                                  <?php if ($cantAreas >= 2) { */ ?>
                                <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                    <label class="control-label">Área:</label>
                                    <select id="Sol_Area_Nombres" class="form-control" required>
                                        <option value="-1">Todos</option>
                                        <?php foreach ($resUsuA as $registro) { ?>
                                            <option value="<?php echo $registro[1]; ?>"><?php echo $registro[1]; ?></option>
                                        <?php } ?>	
                                    </select>
                                </div>
                                <?php /* } else { ?>
                                  <?php foreach ($resUsuA as $registro) { ?>
                                  <input type="hidden" id="Sol_Area_Codigo" class="form-control" value="<?php echo $registro[0]; ?>">
                                  <?php } ?>
                                  <?php } ?>
                                  <?php } */ ?>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                    <label class="control-label">Tipo Documento:<span class="rojo">*</span></label>
                                    <select id="filtroSolicitudes_TipoDocumento" class="form-control" required>
                                        <option value="-1">Todos</option>
                                        <?php foreach ($resTipDoc as $registro) { ?>
                                            <option value="<?php echo $registro[1]; ?>"><?php echo $registro[1]; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>


                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <div class="form-group">
                                        <label class="control-label">País:</label>
                                        <select id="FiltroSol_Pais" class="form-control" multiple data-mod="FiltroSol_Planta">
                                            <?php foreach ($resPla as $registro) { ?>
                                                <option value="<?php echo $registro[0]; ?>"><?php echo $registro[0]; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 e_cargarFiltroSolPlantas">
                                    <div class="form-group">
                                        <label class="control-label">Planta:</label>
                                        <select id="FiltroSol_Planta" class="form-control">
                                        </select>
                                    </div>
                                </div>

                                <div class="limpiar"></div>
                                <div class="col-lg-4 col-md-6">
                                    <?php /* ?><div class="form-group">
                                      <label class="control-label">Buscar por: Nombre documento/ Área/Radicado/Tipo documento/Cod documento:</label>
                                      <input type="text" id="filtroNombredocumento" class="form-control"autocomplete="off">
                                      </div> */ ?>
                                </div>
                                <div class="col-lg-1 col-md-1">
                                    <br>
                                    <button id="Btn_BuscarSolicitudes" class="btn btn-info">Buscar</button>
                                </div>

                                <div class="col-lg-1 col-md-1">
                                    <br>

                                    <?php if ($usu->getUsu_Rol() == "Administrador") { ?>
                                        <button id="Btn_SolicitudesCrear" class="btn btn-success">Crear</button>
                                    <?php } else { ?>
                                        <?php if ($PasoCrear["1"]) { ?>
                                            <button id="Btn_SolicitudesCrear" class="btn btn-primary">Crear</button>
                                        <?php } ?>
                                    <?php } ?>
                                </div>

                                <div class="col-lg-1 col-md-1 col-sm-1">
                                    <br>
                                    <form action="op_excelExportacion.php" method="post" id="f_exportarSolicitudes" target="_blank">
                                        <img src="../imagenes/excel.png" width="30" height="30" id="btn_excelSolicitudes" class="manito">
                                        <input type="hidden" name="nombre" value="Listado Ciclo">
                                        <input type="hidden" name="resultado" id="input_resultadoSolicitudes">
                                    </form>
                                </div>
                                <!--
                                              <div class="col-lg-1 col-md-1 col-sm-1">
                                                <br>
                                                <img src="../imagenes/excel.png" width="30px" class="excel_Solicitudes manito" title="Exportar a Excel">
                                              </div>
                                -->
                                <div class="col-lg-1 col-md-1 col-sm-1">
                                    <br>
                                    <img src="../imagenes/instrucciones.png" width="30px" class="abrir_guia manito" title="Abrir Guías">
                                </div>

                            </div>
                        </div>

                        <div class="panel-body info_solicitudesListar">
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Crear Solicitudes -->
        <div id="vtn_SolicitudesCrear" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body info_SolicitudesCrear">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Gestionar Solicitudes -->
        <div id="vtn_SolicitudesGestionar" class="modal fade" role="dialog" style="overflow-y: scroll;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body info_SolicitudesGestionar">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Gestionar Consultar -->
        <div id="vtn_SolicitudesConsultar" class="modal fade" role="dialog" style="overflow-y: scroll;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body info_SolicitudesConsultar">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notificaciones Solicitudes Crear -->
        <div id="vtn_SolicitudesNotificacionesCrear" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body info_SolicitudesNotificacionesCrear" align="center">
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="Btn_SolicitudesNotificacionesCrear" class="btn btn-success">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notificaciones Solicitudes Aprobar -->
        <div id="vtn_SolicitudesNotificacionesAprobar" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body info_SolicitudesNotificacionesAprobar" align="center">
                    </div>
                    <?php /* <div class="modal-footer">
                      <button type="button" id="Btn_SolicitudesNotificacionesAprobar" class="btn btn-success">Aceptar</button>
                      </div> */ ?>
                </div>
            </div>
        </div>

        <!-- CapacitacionesOperarios -->
        <div id="vtn_CapacitacionesOperarios" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-body info_CapacitacionesOperarios">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Abrir Guia -->
        <div id="vtn_AbrirGuia" class="modal fade" role="dialog" style="overflow-y: scroll">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body info_AbrirGuia">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ver Ejemplo -->
        <div id="vtn_VerEjemplo" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body info_VerEjemplo">
                    </div>
                    <div class="modal-footer">
                        <div class="d_mensajeVerEjemplo"></div>

                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actualizar SolicitudesAdm -->
        <div id="vtn_SolicitudesAdmActualizar" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-body info_SolicitudesAdmActualizar">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="Btn_SolicitudesAdmActualizarForm" class="btn btn-warning" form="f_solicitudesAdminActualizar">Actualizar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notificaciones Solicitudes Crear -->
        <div id="vtn_SolicitudesAdmNotificaciones" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body info_SolicitudesAdmNotificaciones" align="center">
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="Btn_SolicitudesAdmNotificaciones" class="btn btn-success">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ver Imagen -->
        <div id="vtn_ImagenVer" class="modal fade" role="dialog" style="overflow-y: scroll;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body info_ImagenVer" align="center">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div> 
    </body>
</html>
<script type="text/javascript">cargarfecha();</script>