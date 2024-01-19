<?php
include("op_sesion.php");
include("../class/solicitudes.php");
include("../class/flujos_aprobaciones.php");
include("../class/usuarios_areas.php");
include("../class/parametros.php");
include("../class/areas.php");

$par = new parametros();
$resLatam = $par->verificadorLatam();

$sol = new solicitudes();
$resSol = $sol->listarSolicitudesFiltroPublicadoInforme('-1', '-1', $_SESSION['GD_Usuario'], $_POST['planta']);
$resSolVer = $sol->listarSolicitudesFiltroPublicadoUltimaVersionInforme('-1', '-1', $_SESSION['GD_Usuario'], $_POST['planta']);
$totalgeneral = $sol->totalGeneralAreas($_POST['planta']);
//echo var_dump($resSolVer);

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
    $vectorUltVer[$registro4[0]][$registro4[2]] = $registro4[1];
}
$cont = 0;
foreach ($resSol as $registro) {
    if ($vectorUltVer[$registro[2]][$registro[3]] == $registro[4]) {
        if (!isset($vectorLatam[$registro[5]])) {
            $vectorAreaTipoDocumento[$registro[3]][$registro[1]] += 1;
        }
    }
}

$are = new areas();
$resAre = $are->listarAreasPlantasDistintas('1');

$par1 = new parametros();
$resTipDoc = $par1->listarTipoDocumentoConsolidado();

//var_dump($vectorAreaTipoDocumento);
?>
<h1>INFORME CATÁLOGO DOCUMENTAL</h1>
<h2>INVENTARIO DE TIPO DOCUMENTOS POR ÁREAS EN CATÁLOGO DOCUMENTAL</h2>
<div class="table-responsive" id="imp_tabla">
    <table id="" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
        <thead>
            <tr class="encabezadoTab">
                <th class="text-center vertical letra11">Área/Tipo Doc.</th>
                <?php foreach ($resTipDoc as $registro1) { ?>
                    <th class="text-center vertical letra11"><?php echo str_replace(' ', '<br>', $registro1[1]); ?>&nbsp;&nbsp;</th>
                <?php } ?>

                <th class="text-center vertical letra11">TOTAL:&nbsp;&nbsp;</th>
            </tr>
        </thead>
        <tbody class="buscar">
            <?php
            $total_horizontal = 0;
            foreach ($resAre as $registro3) {
                ?>  
                <tr class="">
                    <td class="vertical letra11"><?php echo $registro3['Area_Nombre']; ?></td>
                    <?php foreach ($resTipDoc as $registro2) { ?>
                        <td class="vertical letra11 e_cargarDatosCatalogo manito"  data-are="<?php echo $registro3['Area_Nombre']; ?>" data-docNom="<?php echo $registro2[1]; ?>" data-docCod="<?php echo $registro2[0]; ?>" data-tip='1' align="center">
                            <?php // echo $vectorAreaTipoDocumento[$registro3['Area_Nombre']][$registro2['Area_Nombre']]; ?>
                            <?php
                            $cantidadAreaTipo = $sol->totalAreasTipo($registro3['Area_Nombre'], $registro2['Par_Nombre'], $_POST['planta']);
                            if ($cantidadAreaTipo != 0) {
                                echo $cantidadAreaTipo;
                            }

                            $total_horizontal += $cantidadAreaTipo;
                            ?>
                        </td>
                        <?php //$totalArea[$registro3['Area_Nombre']] += $vectorAreaTipoDocumento[$registro3['Area_Nombre']][$registro2[1]]; ?>
                        <?php //$totalTipoDoc[$registro2[1]] += $vectorAreaTipoDocumento[$registro3['Area_Nombre']][$registro2[1]]; ?>
                    <?php } ?>
                    <td class="vertical letra11 e_cargarDatosCatalogo manito"  data-are="<?php echo $registro3['Area_Nombre']; ?>" data-docNom="-1" data-docCod="-1" data-tip='2' align="center">
                        <?php
                        $total_horizontal = $sol->totalAreasParametro($registro3['Area_Nombre'], $_POST['planta']);
                        if ($total_horizontal != 0) {
                            echo $total_horizontal;
                        }
                        ?>
                    </td>
                    <?php $prueba += $total_horizontal; ?>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot class="encabezadoTab">
            <tr class="">
                <td class="vertical letra11">Total:</td>
                <?php foreach ($resTipDoc as $registro2) { ?>  
                    <td class="vertical letra11 e_cargarDatosCatalogo manito"  data-are="-1" data-docNom="<?php echo $registro2[1]; ?>" data-docCod="<?php echo $registro2[0]; ?>" data-tip='3' align="center" align="center">
                        <?php // $total += $totalTipoDoc[$registro2[1]]; ?>
                        <?php
                        // $total += $totalTipoDoc[$registro2[1]]; 
                        $total_vertical = $sol->totalAreasNombreArea($registro2['Par_Nombre'], $_POST['planta']);
                        if ($total_vertical != 0) {
                            echo $total_vertical;
                        }
                        ?>
                    </td>
                <?php } ?>
                    <td style="font-size: 12px;"><?php echo $totalgeneral; ?></td>
            </tr>     
        </tfoot>
    </table>
</div>

<div class="e_cargarDatosCatalogoInforme"></div>