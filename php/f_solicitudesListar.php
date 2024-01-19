<?php
include("op_sesion.php");
include("../class/solicitudes.php");
include("../class/flujos_aprobaciones.php");
include("../class/parametros.php");
include("../class/festivos.php");
include("../class/areas.php");

date_default_timezone_set("America/Bogota");
setlocale(LC_TIME, 'spanish');

$fechaHoy = date("Y-m-d");
$hora = date("H:i:s");

$fes = new festivos();

$sol = new solicitudes();
$resSol = $sol->listarSolicitudesPrinpal($_POST['fechaInicial'], $_POST['fechaFinal'], $_POST['estado'], $_POST['area'], $_POST['tipo'], $_SESSION['GD_Usuario'], $_POST['planta'], Trim($_POST['busqueda']), $usu->getUsu_Rol());


$fluA = new flujos_aprobaciones();
$resFluA = $fluA->listarFlujoAprobacionesSolicitudesUsuariosTipoFlujo($_SESSION['GD_Usuario']);
$are = new areas();
$resAre = $are->listarUsuarioSolicitudesFlujo($_SESSION['GD_Usuario']);

foreach ($resAre as $registro1) {
    $Areas[$registro1[0]] = $registro1[0];
}
foreach ($resFluA as $registro2) {
    //$Areas[$registro2[1]] = $registro2[1];
    $Paso[$registro2[1] . $registro2[2] . $registro2[3]] = $registro2[2];
}

$par = new parametros();
$resParPas = $par->listarParametroTipo("2");

foreach ($resParPas as $registro3) {
    $PasosSig[$registro3[2]] = $registro3[1];
}

function cantidadValidarDias($estado) {
    if ($estado == "1" || $estado == "2" || $estado == "3") {
        $dias = 1;
        return $dias;
    }
    if ($estado == "4") {
        $dias = 3;
        return $dias;
    }

    if ($estado == "5" || $estado == "6" || $estado == "7" || $estado == "8" || $estado == "9" || $estado == "10") {
        $dias = 4;
        return $dias;
    }
    if ($estado == "11") {
        $dias = 2;
        return $dias;
    }
    if ($estado == "12") {
        $dias = 10;
        return $dias;
    }
}
?>
<div class="col-lg-2 col-md-4">
    <div class="input-group">
        <span class="input-group-addon"><strong>Buscar:</strong></span>
        <input id="filtrarSolicitudesCiclo" type="text" class="form-control">
    </div>
</div>
<div class="limpiar"></div>
<br>

<div class="table-responsive" id="imp_tabla" style="width: 100%; height: 500px; overflow-y: scroll;">
<table id="tbl_Solicitudes" border="1px" class="table tableEstrecha table-hover table-bordered table-striped letra11">
    <thead>
        <tr class="ordenamiento encabezadoTab">
            <th class="text-center" align="center">CÓD</th>
            <th class="text-center" align="center">FECHA<br>SOLICITUD</th>
            <th class="text-center" align="center">ÁREA</th>
            <th class="text-center" align="center">SOLICITA</th>
            <th class="text-center" align="center">TIPO DOCUMENTO</th>
            <th class="text-center" align="center">CÓDIGO DOCUMENTO</th>
            <th class="text-center" align="center">NOMBRE DOCUMENTO</th>
            <th class="text-center" align="center">VERSIÓN</th>
            <th class="text-center" align="center">TEMA</th>
            <th class="text-center" align="center">OBSERVACIONES</th>
            <th class="text-center" align="center">ESTATUS</th>
            <th class="text-center" align="center" title="Siguiente Paso">SIG. PASO</th>
            <th class="text-center" align="center">&nbsp;&nbsp;</th>
            <th class="text-center" align="center">ACCIÓN</th>
            <?php if ($usu->getUsu_Rol() == "Administrador") { ?>
                <th class="text-center" align="center"></th>
            <?php } ?>
        </tr>
    </thead>
    <tbody class="buscar">
        <?php if ($usu->getUsu_Rol() == "Administrador") {
            
            ?>
            <?php
            $cont = 0;
            foreach ($resSol as $registro) {
                ?>
                <?php
                if ($registro[10] != "Publicado") {
                    $diasF = cantidadValidarDias($registro[14]);

                    $fechaMax1 = date("Y-m-d", strtotime($registro[2] . " + " . $diasF . " days"));

                    $diasNoH = $fes->cantidadDiasFestivosFechas($registro[2], $fechaMax);

                    if ($diasNoH > 0) {
                        $fechaMax2 = date("Y-m-d", strtotime($fechaMax1 . " + " . $diasNoH . " days"));

                        $diasNoH2 = $fes->cantidadDiasFestivosFechas($fechaMax1, $fechaMax2);
                        if ($diasNoH2 > 0) {
                            $fechaMax = date("Y-m-d", strtotime($fechaMax2 . " + " . $diasNoH2 . " days"));
                        } else {
                            $fechaMax = $fechaMax2;
                        }
                    } else {
                        $fechaMax = $fechaMax1;
                    }

                    $diasNoHReal = $fes->cantidadDiasFestivosFechas($registro[2], $fechaHoy);

                    $segundos = strtotime('now') - strtotime($registro[2]);
                    $diferencia_dias = intval($segundos / 60 / 60 / 24) + 1;
                    $diferencia_dias = $diferencia_dias - $diasNoHReal;

                    if ($fechaHoy <= $fechaMax) {
                        if ($diferencia_dias <= $diasF) {
                            $ValFec = "VFVerde";
                        } else {
                            $ValFec = "VFRojo";
                        }
                    } else {
                        $ValFec = "VFRojo";
                    }
                    ?>
                    <tr data-fecmax="<?php echo $fechaMax; ?>">
                        <td align="center"><?php echo $registro[1]; ?></td>  
                        <td align="right"><?php echo $registro[2]; ?></td>  
                        <td><?php echo $registro[3]; ?></td>  
                        <td><?php echo $registro[4]; ?></td>  
                        <td><?php echo $registro[5]; ?></td>  
                        <td><?php echo $registro[6]; ?></td>  
                        <td><?php echo ($registro['Sol_NombreDocumento'] == NULL) ? $registro['Sol_Tema'] : $registro['Sol_NombreDocumento']; ?></td>  
                        <td align="center"><?php echo $registro[15]; ?></td>  
                        <td><?php echo $registro[8]; ?></td>  
                        <td><?php echo $registro[9]; ?></td>  
                        <td class="vertical" nowrap>&nbsp;<?php echo $registro[14] . ". " . $registro[10]; ?></td>
                        <td class="vertical" nowrap>&nbsp;<?php echo ($registro[14] + 1) . ". " . $PasosSig[$registro[14] + 1]; ?></td>
                        <td align="center" class="vertical" nowrap><div class="Circ_ValFec <?php echo $ValFec; ?>"><strong><?php echo $diferencia_dias . "/" . $diasF; ?></strong></div></td>
                        <td class="vertical" align="center"><button class="btn btn-warning btn-xs e_cargarSolicitudGestion" data-cod="<?php echo $registro[0]; ?>">Gestionar</button></td>
                        <?php if ($usu->getUsu_Rol() == "Administrador") { ?>
                            <td class="vertical" align="center"><button class="btn btn-info btn-xs e_cargarSolicitudGestionAdminAct" data-cod="<?php echo $registro[0]; ?>">Adm</button></td>  
                        <?php } ?>
                    </tr>
                    <?php
                    $cont++;
                }
            }
            ?>		
        <?php } else { ?>
            <?php
            $cont = 0;
        
            foreach ($resSol as $registro) {
                ?>
                <?php // if (isset($Areas[$registro[13]])) { ?>	

                    <?php
                    if ($registro[10] != "Publicado") {
                        $diasF = cantidadValidarDias($registro[14]);

                        $fechaMax1 = date("Y-m-d", strtotime($registro[2] . " + " . $diasF . " days"));

                        $diasNoH = $fes->cantidadDiasFestivosFechas($registro[2], $fechaMax);

                        if ($diasNoH > 0) {
                            $fechaMax2 = date("Y-m-d", strtotime($fechaMax1 . " + " . $diasNoH . " days"));

                            $diasNoH2 = $fes->cantidadDiasFestivosFechas($fechaMax1, $fechaMax2);
                            if ($diasNoH2 > 0) {
                                $fechaMax = date("Y-m-d", strtotime($fechaMax2 . " + " . $diasNoH2 . " days"));
                            } else {
                                $fechaMax = $fechaMax2;
                            }
                        } else {
                            $fechaMax = $fechaMax1;
                        }

                        $diasNoHReal = $fes->cantidadDiasFestivosFechas($registro[2], $fechaHoy);

                        $segundos = strtotime('now') - strtotime($registro[2]);
                        $diferencia_dias = intval($segundos / 60 / 60 / 24);
                        $diferencia_dias = $diferencia_dias - $diasNoHReal;

                        if ($fechaHoy <= $fechaMax) {
                            if ($diferencia_dias <= $diasF) {
                                $ValFec = "VFVerde";
                            } else {
                                $ValFec = "VFRojo";
                            }
                        } else {
                            $ValFec = "VFRojo";
                        }
                        ?>
                        <tr>
                            <td align="center"><?php echo $registro[1]; ?></td>  
                            <td align="right"><?php echo $registro[2]; ?></td>  
                            <td><?php echo $registro[3]; ?></td>  
                            <td><?php echo $registro[4]; ?></td>  
                            <td><?php echo $registro[5]; ?></td>  
                            <td><?php echo $registro[6]; ?></td>  
                            <td><?php echo ($registro['Sol_NombreDocumento'] == NULL) ? $registro['Sol_Tema'] : $registro['Sol_NombreDocumento']; ?></td>  
                            <td align="center"><?php echo $registro[15]; ?></td>  
                            <td><?php echo $registro[8]; ?></td>  
                            <td><?php echo $registro[9]; ?></td>  
                            <td class="vertical" nowrap>&nbsp;<?php echo $registro[14] . ". " . $registro[10]; ?></td>
                            <td class="vertical" nowrap>&nbsp;<?php echo ($registro[14] + 1) . ". " . $PasosSig[$registro[14] + 1]; ?></td>
                            <td align="center" class="vertical" nowrap><div class="Circ_ValFec <?php echo $ValFec; ?>"><strong><?php echo $diferencia_dias . "/" . $diasF; ?></strong></div></td>

                            <?php 
                               // var_dump($registro[13] );
                               // var_dump($registro[14] );
                               // var_dump($registro[17] );
                            if (isset($Paso[$registro[13] . $registro[14] . $registro[17]])) { ?>
                                <td class="vertical" align="center"><button class="btn btn-warning btn-xs e_cargarSolicitudGestion" data-cod="<?php echo $registro[0]; ?>">Gestionar</button></td>
                            <?php } else { ?>
                                <td class="vertical" align="center"><button class="btn btn-info btn-xs e_cargarSolicitudVerHistorial" data-cod="<?php echo $registro[0]; ?>">Consultar</button></td>
                            <?php } ?>
                        </tr>
                        <?php
                        $cont++;
                    }
                    ?>
                <?php // } ?>

            <?php } ?>
        <?php } ?>
    </tbody>
    <tr class="encabezadoTab">
        <td align="center" colspan="3"><strong>TOTAL: <?php echo $cont; ?></strong></td>
    </tr>
</table>
</div>
<div class="table-responsive" style="display: none">
    <table id="tbl_Cicloexp" border="1px" class="table tableEstrecha table-hover table-bordered table-striped letra11">
        <thead>
            <tr class="ordenamiento encabezadoTab">
                <th class="text-center" align="center">CÓD</th>
                <th class="text-center" align="center">FECHA<br>SOLICITUD</th>
                <th class="text-center" align="center">ÁREA</th>
                <th class="text-center" align="center">SOLICITA</th>
                <th class="text-center" align="center">TIPO DOCUMENTO</th>
                <th class="text-center" align="center">CÓDIGO DOCUMENTO</th>
                <th class="text-center" align="center">NOMBRE DOCUMENTO</th>
                <th class="text-center" align="center">VERSIÓN</th>
                <th class="text-center" align="center">TEMA</th>
                <th class="text-center" align="center">OBSERVACIONES</th>
                <th class="text-center" align="center">ESTATUS</th>
                <th class="text-center" align="center" title="Siguiente Paso">SIG. PASO</th>
                <th class="text-center" align="center">&nbsp;&nbsp;</th>
            </tr>
        </thead>
        <tbody class="buscar">
            <?php
            $cont = 0;
         
            foreach ($resSol as $registro) {
                ?>
                <?php if (isset($Areas[$registro[13]])) { ?>	

                    <?php
                    if ($registro[10] != "Publicado") {
                        $diasF = cantidadValidarDias($registro[14]);

                        $fechaMax1 = date("Y-m-d", strtotime($registro[2] . " + " . $diasF . " days"));

                        $diasNoH = $fes->cantidadDiasFestivosFechas($registro[2], $fechaMax);

                        if ($diasNoH > 0) {
                            $fechaMax2 = date("Y-m-d", strtotime($fechaMax1 . " + " . $diasNoH . " days"));

                            $diasNoH2 = $fes->cantidadDiasFestivosFechas($fechaMax1, $fechaMax2);
                            if ($diasNoH2 > 0) {
                                $fechaMax = date("Y-m-d", strtotime($fechaMax2 . " + " . $diasNoH2 . " days"));
                            } else {
                                $fechaMax = $fechaMax2;
                            }
                        } else {
                            $fechaMax = $fechaMax1;
                        }

                        $diasNoHReal = $fes->cantidadDiasFestivosFechas($registro[2], $fechaHoy);

                        $segundos = strtotime('now') - strtotime($registro[2]);
                        $diferencia_dias = intval($segundos / 60 / 60 / 24);
                        $diferencia_dias = $diferencia_dias - $diasNoHReal;

                        if ($fechaHoy <= $fechaMax) {
                            if ($diferencia_dias <= $diasF) {
                                $ValFec = "VFVerde";
                            } else {
                                $ValFec = "VFRojo";
                            }
                        } else {
                            $ValFec = "VFRojo";
                        }
                        ?>
                        <tr>
                            <td align="center"><?php echo $registro[1]; ?></td>  
                            <td align="right"><?php echo $registro[2]; ?></td>  
                            <td><?php echo $registro[3]; ?></td>  
                            <td><?php echo $registro[4]; ?></td>  
                            <td><?php echo $registro[5]; ?></td>  
                            <td><?php echo $registro[6]; ?></td>  
                            <td><?php echo ($registro['Sol_NombreDocumento'] == NULL) ? $registro['Sol_Tema'] : $registro['Sol_NombreDocumento']; ?></td>  
                            <td align="center"><?php echo $registro[15]; ?></td>  
                            <td><?php echo $registro[8]; ?></td>  
                            <td><?php echo $registro[9]; ?></td>  
                            <td class="vertical" nowrap>&nbsp;<?php echo $registro[14] . ". " . $registro[10]; ?></td>
                            <td class="vertical" nowrap>&nbsp;<?php echo ($registro[14] + 1) . ". " . $PasosSig[$registro[14] + 1]; ?></td>
                            <td align="center" class="vertical" nowrap><div class="Circ_ValFec <?php echo $ValFec; ?>"><strong><?php echo $diferencia_dias . "/." . $diasF; ?></strong></div></td>
                        </tr>
                        <?php
                        $cont++;
                    }
                    ?>
                <?php } ?>
            <?php } ?>
        </tbody>
        <tr class="encabezadoTab">
            <td align="center" colspan="3"><strong>TOTAL: <?php echo $cont; ?></strong></td>
        </tr>
    </table>
</div>