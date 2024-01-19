<?php
include("op_sesion.php");
include("../class/usuarios_areas.php");
include("../class/plantas.php");

$pla = new plantas();
$resPla = $pla->listarMarcaFilto($_SESSION['GD_Usuario']);

$are = new usuarios_areas();
$resAre = $are->listarAreasUsuariosFiltroPlanta($_SESSION['GD_Usuario']);
$resSubAre = $are->listarAreasUsuariosFiltroPlanta($_SESSION['GD_Usuario']);
$pOperarios = $usuper->Permisos($_SESSION['GD_Usuario'], 7);
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <?php include("s_cabecera.php"); ?>
        <script src="../js/operarios.js?<?php echo rand()?>"></script>
    </head>
    <?php include("s_menu.php"); ?>
    <body>
        <div id="d_contenedor" class="container-fluid">
            <!-- Todo el Contenido -->


            <div class="col-lg-12 col-md-12">


                <div class="panel panel-primary ">
                    <div class="panel-heading">

                        <div class="row">
                            <div class="col-lg-2 col-md-2">
                                <strong class="letra16">Operarios</strong>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <br>
                                <div class="input-group"> <span class="input-group-addon"><strong>Buscar:</strong></span>
                                    <input id="filtrar_Operarios" type="text" class="form-control">
                                </div>

                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-2">
                                <div class="form-group">
                                    <label class="control-label">Estado:</label>
                                    <select id="FiltroOperarios_Estado" class="form-control">
                                        <option value="1" selected>Activos</option>
                                        <option value="0">Inactivo</option>
                                    </select>
                                </div>
                            </div>
<!--                            <input type="hidden" id="FiltroOperarios_Area" value="-1">-->
                            <div class="col-lg-2 col-md-2 col-sm-2">
                                <div class="form-group">
                                    <label class="control-label">Area:</label>
                                    <select id="FiltroOperarios_Area" class="form-control">
                                        <option value="-1" selected>Todos</option>
                                        <?php foreach ($resAre as $registro) { ?>
                                            <option value="<?php echo $registro[1]; ?>"><?php echo $registro[1]; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div> 

                            <div class="col-lg-2 col-md-2 col-sm-2">
                                <div class="form-group">
                                    <label class="control-label">Sub-Area:</label>
                                    <select id="FiltroOperarios_SubAreaNombre" class="form-control">
                                        <option value="-1" selected>Todos</option>
                                        <?php foreach ($resSubAre as $registro) { ?>
                                            <option value="<?php echo $registro[1]; ?>"><?php echo $registro[1]; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-2">
                                <div class="form-group">
                                    <label class="control-label">País:</label>
                                    <select id="FiltroOperario_Pais" class="form-control" multiple data-mod="FiltroOperario_Planta">
                                        <?php foreach ($resPla as $registro) { ?>
                                            <option value="<?php echo $registro[0]; ?>"><?php echo $registro[0]; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 e_cargarFiltroOperarioPlantas">
                                <div class="form-group">
                                    <label class="control-label">Planta:</label>
                                    <select id="FiltroOperario_Planta" class="form-control">
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-1 col-md-1 col-sm-1">
                                <br>
                                <button id="Btn_OperariosBuscar" class="btn btn-primary">Buscar</button>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2">
                                <br>
                                <?php if (isset($pOperarios) && $pOperarios[5] == "1") { ?>
                                    <button id="Btn_OperariosCrear" class="btn btn-success">Crear</button>
                                <?php } ?>
                            </div>

                            <div class="col-lg-1 col-md-1 col-sm-1">
                                <br>
                                <img src="../imagenes/excel.png" width="30px" class="excel_Operarios manito" title="Exportar a Excel">
                            </div>

                        </div>

                    </div>

                    <div class="panel-body info_cargarOperariosListar">
                    </div>

                </div>
            </div>
        </div>

        <!-- Crear Operarios -->
        <div id="vtn_OperariosCrear" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-body info_OperariosCrear">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="Btn_OperariosCrearForm" form="f_operariosCrear">Crear</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actualizar Operarios -->
        <div id="vtn_OperariosActualizar" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-body info_OperariosActualizar">
                    </div>
                    <div class="modal-footer">
                        <div class="d_mensajeOperariosActualizar"></div>
                        <?php if (isset($pOperarios) && $pOperarios[4] == "1") { ?>
                            <button type="submit" id="Btn_OperariosActualizarForm" class="btn btn-success" form="f_operariosActualizar">Actualizar</button>
                        <?php } ?>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notificaciones Operarios Crear -->
        <div id="vtn_OperariosNotificacionesCrear" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body info_OperariosNotificacionesCrear" align="center">
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="Btn_OperariosNotificacionesCrear" class="btn btn-success">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notificaciones Operarios Actualizar -->
        <div id="vtn_OperariosNotificacionesActualizar" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body info_OperariosNotificacionesActualizar" align="center">
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="Btn_OperariosNotificacionesActualizar" class="btn btn-success">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>