<?php
include("op_sesion.php");
include("../class/parametros.php");
include("../class/solicitudes.php");
include("../class/historiales_flujos.php");

$par = new parametros();
$resTipDoc = $par->listarParametroTipo("1");

$apr = new solicitudes();
$apr->setSol_Codigo($_POST['codigo']);
$apr->consultar();

$hisF = new historiales_flujos();
$resHisFlu = $hisF->listarHistorialFlujoSolicitudesGestion($_POST['codigo']);
?>
<div class="row">

    <div class="col-lg-6 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading" align="center">
                <strong class="letra18">GESTIONAR</strong>
            </div>

            <div class="panel-body">

                <form id="f_solicitudesAprobar" role="form">
                    <input type="hidden" id="Sol_CodigoApr" value="<?php echo $_POST['codigo'] ?>">
                    <div class="form-group">
                        <label class="control-label">Tipo Documento:</label>
                        <input type="text" id="Sol_TipoArp" class="form-control" value="<?php echo $apr->getSol_TipoDocumento(); ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Código Documento:</label>
                        <input type="text" id="Sol_CodigoDocumentoApr" class="form-control" maxlength="250" value="<?php echo $apr->getSol_NombreDocumento(); ?>" >
                    </div>

                    <div class="form-group">
                        <label class="control-label">Nombre Documento:</label>
                        <input type="text" id="Sol_NombreDocumentoApr" class="form-control" maxlength="250" value="<?php echo $apr->getSol_NombreDocumento(); ?>" >
                    </div>

                    <div class="form-group">
                        <label class="control-label">Tema Documento:</label>
                        <input type="text" id="Sol_TemaApr" class="form-control" maxlength="250" value="<?php echo $apr->getSol_Tema(); ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Observaciones:</label>
                        <textarea id="Sol_ObservacionesApr" class="form-control" readonly><?php echo $apr->getSol_Observaciones(); ?></textarea>
                    </div>
                    <br>

                    <div align="center">
                        <button type="submit" id="Btn_SolicitudesCrearForm" class="btn btn-primary">APROBAR SOLICITUD</button>
                    </div>

                    <div align="center">
                        <button id="Btn_SolicitudesRechazarForm" class="btn btn-danger e_rechazarSolicitud">RECHAZAR SOLICITUD</button>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <div class="col-lg-6 col-md-6">
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
                            </tr>
                        </thead>
                        <tbody class="buscar">
                            <?php foreach ($resHisFlu as $registro) { ?>
                                <tr>
                                    <td align="center"><?php echo $registro[0]; ?></td>	
                                    <td><?php echo $registro[1]; ?></td>	
                                    <td><?php echo $registro[2]; ?>&nbsp;</td>	
                                    <td align="right"><?php echo $registro[3]; ?></td>	
                                    <td><?php echo $registro[4]; ?></td>	
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>