<?php
include("op_sesion.php");
include("../class/solicitudes.php");
include("../class/flujos_aprobaciones.php");
include("../class/usuarios_areas.php");
include("../class/parametros.php");
include("../class/capacitaciones_operarios.php");
include("../class/operarios.php");
$par = new parametros();
$resLatam = $par->verificadorLatam();

$sol = new solicitudes();
$resSol = $sol->listarSolicitudesFiltroPublicadocater($_POST['area'], $_POST['tipo'], $_SESSION['GD_Usuario'], $_POST['planta']);
$resSolVer = $sol->listarSolicitudesFiltroPublicadoUltimaVersioncater($_POST['area'], $_POST['tipo'], $_SESSION['GD_Usuario'], $_POST['planta']);

$fluA = new flujos_aprobaciones();
$resFluA = $fluA->listarFlujoAprobacionesSolicitudesUsuarios($_SESSION['GD_Usuario']);

$usuA = new usuarios_areas();
$resUsuA = $usuA->listarAreasUsuariosFiltro($_SESSION['GD_Usuario']);

$cantAreas = count($resUsuA);

foreach ($resUsuA as $registro2) {
    $Areas[$registro2[0]] = $registro2[0];
    $AreasNombre[$registro2[0]] = $registro2[1];
}

foreach ($resLatam as $registro3) {
    $vectorLatam[$registro3[1]] = $registro3[1];
}

foreach ($resSolVer as $registro4) {
    $vectorUltVer[$registro4[0]] = $registro4[1];
}

$capO = new capacitaciones_operarios();
$ope = new operarios();
//var_dump($vectorUltVer);
?>
<?php if ($cantAreas > 0) { ?>
    <div class="table-responsive">
        <table id="tbl_catalogoDocumentos" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
            <thead>
                <tr class="ordenamiento encabezadoTab">
                    <th>CÓDIGO</th>
                    <th>FECHA SOLICITUD</th>
                    <th>ÁREA</th>
                    <th>SOLICITA/PLANTA</th>
                    <th>TIPO DOCUMENTO</th>
                    <th>CÓDIGO DOCUMENTO</th>
                    <th>VERSIÓN</th>
                    <th>NOMBRE DOCUMENTO</th>
                    <th>TEMA</th>
                    <th>% DIVULGACION</th>
                    <th>OBSERVACIONES</th>
                    <th>ESTADO ACTUAL</th>
                    <th></th>
                    <th></th>
                    <?php if ($usu->getUsu_Rol() == "Administrador") { ?>
                        <th></th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody class="buscar">
                <?php
                $cont = 0;
                foreach ($resSol as $registro) {

                    if ($vectorUltVer[$registro[6]] == $registro[15]) {
                        if (isset($vectorLatam[$registro[5]])) {
                            $ColorEsp = "latam";
                        } else {
                            $ColorEsp = "";
                        }
                        if ($registro[16] == "3") {
                            $ColorEsp = "verdeMatriz";
                        }
                        if ($AreasNombre[$registro[13]] == "EHS") {
                            $ColorEsp = "verdeMatriz";
                        }

                        $resCantCapac = $capO->cantidadCapacitacionesOperariosArea($registro['Sol_Codigo']);

                        $resCantOpe1 = $ope->listarOperariosCapacitaciones2($registro['Area_Nombre'], $registro['Sol_Tipo']);
                        $resCantOpe = count($resCantOpe1);
                        ?>
                        <?php if (!isset($vectorLatam[$registro[5]])) { ?>
                            <tr class="<?php echo $ColorEsp; ?>">
                                <td align="center"><?php echo $registro[1]; ?></td>  
                                <td align="right"><?php echo $registro[2]; ?></td>  
                                <td><?php echo $registro[3]; ?></td>   
                                <td><?php echo $registro[4] . ' ' . $registro[17]; ?></td>  
                                <td><?php echo $registro[5]; ?></td>  
                                <td><?php echo $registro[6]; ?></td> 

                                <td align="right"><?php echo $registro[15]; ?></td> 
                                <td><?php echo $registro[7]; ?></td>  
                                <td><?php echo $registro[8]; ?></td>  
                                <td><?php
                                    if ($resCantOpe > 0) {
                                        echo number_format($resCantCapac[0] / $resCantOpe * 100, 2, ",", ".") . "%";
                                    } else {
                                        echo "0%";
                                    };
                                    ?></td>  
                                <td><?php echo $registro[9]; ?></td>  
                                <td class="vertical" nowrap>&nbsp;<?php echo $registro[14] . ". " . $registro[10]; ?></td>	
                                <td align="center" class="vertical"><button class="btn btn-warning btn-xs e_cargarCatalogo" data-cod="<?php echo $registro[0]; ?>">Ver</button></td>
                                <td align="center" class="vertical"><button class="btn btn-info btn-xs e_cargarHistorial" data-codHis="<?php echo $registro[0]; ?>">Historial</button></td>
                                <?php if ($usu->getUsu_Rol() == "Administrador") { ?>
                                    <td class="vertical" align="center"><button class="btn btn-info btn-xs e_cargarSolicitudGestionAdminAct" data-cod="<?php echo $registro[0]; ?>">Adm</button></td> 

                            <?php }$cont++; ?>
                            </tr>
                        <?php } ?>
        <?php }
    }
    ?>
            </tbody>
            <tr class="encabezadoTab">
                <td align="center" colspan="3"><strong>TOTAL: <?php echo $cont; ?></strong></td>
            </tr>
        </table>
    </div>


    <div class="table-responsive" style="display: none;">
        <table id="tbl_catalogoDocumentosExp" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
            <thead>
                <tr class="ordenamiento encabezadoTab">
                    <th>CÓDIGO</th>
                    <th>FECHA SOLICITUD</th>
                    <th>ÁREA</th>
                    <th>SOLICITA/PLANTA</th>
                    <th>TIPO DOCUMENTO</th>
                    <th>CÓDIGO DOCUMENTO</th>
                    <th>VERSIÓN</th>
                    <th>NOMBRE DOCUMENTO</th>
                    <th>TEMA</th>
                    <th>OBSERVACIONES</th>
                    <th>ESTADO ACTUAL</th>
                </tr>
            </thead>
            <tbody class="buscar">
                <?php
                $cont = 0;
                foreach ($resSol as $registro) {

                    if ($vectorUltVer[$registro[6]] == $registro[15]) {
                        if (isset($vectorLatam[$registro[5]])) {
                            $ColorEsp = "latam";
                        } else {
                            $ColorEsp = "";
                        }
                        if ($registro[16] == "3") {
                            $ColorEsp = "verdeMatriz";
                        }
                        if ($AreasNombre[$registro[13]] == "EHS") {
                            $ColorEsp = "verdeMatriz";
                        }
                        ?>
            <?php if (!isset($vectorLatam[$registro[5]])) { ?>
                            <tr class="<?php echo $ColorEsp; ?>">
                                <td align="center"><?php echo $registro[1]; ?></td>  
                                <td align="right"><?php echo $registro[2]; ?></td>  
                                <td><?php echo $registro[3]; ?></td>   
                                <td><?php echo $registro[4] . ' ' . $registro[17]; ?></td>  
                                <td><?php echo $registro[5]; ?></td>  
                                <td><?php echo $registro[6]; ?></td> 

                                <td align="right"><?php echo $registro[15]; ?></td> 
                                <td><?php echo $registro[7]; ?></td>  
                                <td><?php echo $registro[8]; ?></td>  
                                <td><?php echo $registro[9]; ?></td>  
                                <td class="vertical" nowrap>&nbsp;<?php echo $registro[14] . ". " . $registro[10]; ?></td>	
                            </tr>
                            <?php $cont++;
                        }
                        ?>
        <?php }
    }
    ?>
            </tbody>
            <tr class="encabezadoTab">
                <td align="center" colspan="3"><strong>TOTAL: <?php echo $cont; ?></strong></td>
            </tr>
        </table>
    </div>
<?php } else { ?>
    <div class="alert alert-warning" align="center">
        <strong class="letra16">NO TIENE ÁREAS ASIGNADAS</strong>
    </div>
<?php } ?>