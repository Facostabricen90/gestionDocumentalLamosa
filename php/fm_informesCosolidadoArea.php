<?php
include("op_sesion.php");
date_default_timezone_set("America/Bogota");
setlocale(LC_TIME, 'spanish');

$fechaIni = date("Y-m-d", strtotime(' - 1 years'));
$fechaFin = date("Y-m-d");
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <?php include("s_cabecera.php"); ?>
        <script src="../js/informes.js?<?php echo rand(); ?>"></script>
        <script src="../ext/graficos/js/highcharts.js"></script>
        <script src="../ext/graficos/js/modules/exporting.js"></script>
        <style>
            .input-group-addon{
                font-size: 15px;
            }
            body{
                background: #ffffff !important;
                font-size: 14px;
            }
        </style>
        <?php /* ?>
        <script>
            $(document).ready(function (e) {
                $(".e_CargarCicloDocumental").click();
            });
        </script>
        <?php */ ?>
    </head>
    <?php include("s_menu.php"); ?>
    <body>
        <div id="d_contenedor" class="container-fluid">
            <!-- Todo el Contenido -->
            <div class="col-lg-12 col-md-12 col-sm-12 tituloEnc text-center">Informe Consolidado Áreas</div>

            <div class="panel-heading">
                <div class="row">
                    <ul class="nav nav-tabs">
                        <li><a data-toggle="tab" href="#CicloDocumental" class="e_CargarCicloDocumental">Áreas</a></li>
                        <li><a data-toggle="tab" href="#UsuariosFlujo" class="e_CargarUsuariosFlujo">Usuarios</a></li>
                    </ul>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="tab-content">
                        <div id="CicloDocumental" class="tab-pane fade active e_CargarDatosCicloDocumental"></div>
                        <div id="UsuariosFlujo" class="tab-pane fade e_CargarDatosUsuariosFlujo"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Crear Almacenes -->
        <div id="vtn_DetalleIngreso" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body info_DetalleIngreso"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- -->
        <div id="vtn_NotificacionTema" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body info_NotificacionTema" align="center">
                    </div>
                    <div class="modal-footer" align="center">
                        <button type="button" class="btn btn-success" id="Btn_AceptarNotificacionTema">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
<script type="text/javascript">cargarfecha();</script>