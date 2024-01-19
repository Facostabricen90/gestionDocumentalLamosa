<?php
include("op_sesion.php");
include("../class/solicitudes.php");
include("../class/areas.php");
include("../class/parametros.php");
$sol = new solicitudes();
$resSol = $sol->listarConsolidadoDocumentosCiclo($_POST['fechaIni'], $_POST['fechaFin'], $_POST['planta']);
$resSolFlujo = $sol->listarConsolidadoDocumentosFlujo($_POST['fechaIni'], $_POST['fechaFin'], $_POST['planta']);
$totalgeneral = $sol->totalGeneralAreas($_POST['planta']);
$totalgeneralConFecha = $sol->totalGeneralAreasConFecha($_POST['planta'], $_POST['fechaIni'], $_POST['fechaFin']);
$totalgeneralFlujo = $sol->totalGeneralAreasPorFlujo($_POST['planta']);
//if ($_SESSION['GD_Usuario'] == "2") {
//    echo "<pre>";
//    var_dump($resSol);
//    echo "</pre>";
//}

$are = new areas();
$resAre = $are->listarAreasPlantasDistintas('1');
$resAre2 = $are->listarAreasPlantasDistintas2($_POST['planta']);

$par = new parametros();
$resTipDoc = $par->listarTipoDocumentoConsolidado();
$resFlujo = $par->listarParametroTipoFluAConsolidado();

foreach ($resSol as $registro) {
    $vectorAreaTipoDocumento[$registro[3]][$registro[1]] = $registro[2];
}
foreach ($resSolFlujo as $registro) {
    $vectorAreaFlujo[$registro[3]][$registro[1]] = $registro[2];
}
//var_dump($vectorAreaFlujo);
//<pre>";
//var_dump($resSol);
//"</pre>";
?>
<h1>INFORME CICLO DOCUMENTAL</h1>
<h2>INVENTARIO DE TIPO DOCUMENTOS EN CICLO POR ÁREAS</h2>
<!--<div class="col-lg-12 col-md-12 col-sm-12 tituloEnc text-center">Áreas</div>-->
<div class="table-responsive" id="imp_tabla">
    <table id="" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
        <thead>
            <tr class="encabezadoTab">
                <th class="text-center vertical letra11">Área/Tipo Doc.</th>
                <?php foreach ($resTipDoc as $registro1) { ?>
                    <th class="vertical letra11"><?php echo str_replace(' ', '<br>', $registro1[1]); ?>&nbsp;&nbsp;</th>
          <!--          <th class="vertical letra11 transformed"><?php echo $registro1[1]; //str_replace(' ','<br>',$registro1[1]);           ?>&nbsp;&nbsp;</th>-->
                <?php } ?>

                <th class="text-center vertical letra11">TOTAL&nbsp;&nbsp;</th>
            </tr>
        </thead>
        <tbody class="buscar">
            <?php
            foreach ($resAre as $registro3) {
                ?>  
                <tr class="">
                    <td class="vertical letra11"><?php echo $registro3[1]; ?></td>
                    <?php foreach ($resTipDoc as $registro2) { ?>
                        <td class="vertical letra11 e_usuariosPasos" align="center" data-are="<?php echo $registro3[1]; ?>" data-docNom="<?php echo $registro2[1]; ?>" data-docCod="<?php echo $registro2[0]; ?>" data-tip='4' align="center">
                            <?php
                            $cantidadAreaTipo = $sol->totalAreasTipoConFecha($registro3['Area_Nombre'], $registro2['Par_Nombre'], $_POST['fechaIni'], $_POST['fechaFin'], $_POST['planta']);
                            if ($cantidadAreaTipo != 0) {
                                echo $cantidadAreaTipo;
                            }
                            $total_horizontal += $cantidadAreaTipo;
                            ?>
                        </td>
                        <?php // $totalArea[$registro3[1]] += $vectorAreaTipoDocumento[$registro3[1]][$registro2[1]]; ?>
                        <?php // $totalTipoDoc[$registro2[1]] += $vectorAreaTipoDocumento[$registro3[1]][$registro2[1]]; ?>
                    <?php } ?>
                    <td class="vertical letra11 e_usuariosPasos" align="center" data-are="<?php echo $registro3[1]; ?>" data-docNom="-1" data-docCod="-1" data-tip='5' align="center">
                        <?php
                        $total_horizontal = $sol->totalAreasParametroConFecha($registro3['Area_Nombre'], $_POST['planta'], $_POST['fechaIni'], $_POST['fechaFin']);
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
                    <td class="vertical letra11 e_usuariosPasos" align="center" data-are="-1" data-docNom="<?php echo $registro2[1]; ?>" data-docCod="<?php echo $registro2[0]; ?>" data-tip='6' align="center">
                        <?php // $total += $totalTipoDoc[$registro2[1]]; ?>
                        <?php
                        $total_vertical = $sol->totalAreasNombreAreaConFecha($registro2['Par_Nombre'], $_POST['planta'], $_POST['fechaIni'], $_POST['fechaFin']);
                        if ($total_vertical != 0) {
                            echo $total_vertical;
                        }
                        ?>
                    </td>
                <?php } ?>
                <td class="vertical letra11" align="center"><?php echo $totalgeneralConFecha; ?></td>
            </tr>
        </tfoot>
    </table>
</div>

<div class="e_cargarDatosUsuariosPasos"></div>
<div class="limpiar"></div>




<h2>NÚMERO DE DOCUMENTOS POR ÁREA EN PASOS DEL CICLO DOCUMENTAL</h2>
<!--<div class="col-lg-12 col-md-12 col-sm-12 tituloEnc text-center">Flujo</div>-->
<div class="table-responsive" id="imp_tabla">
    <table id="" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
        <thead>
            <tr class="encabezadoTab">
                <th class="text-center vertical letra11">Área/Flujo</th>
                <?php foreach ($resFlujo as $registro1) { ?>
                    <th class="text-center vertical letra11"><?php echo $registro1[2] . '. ' . str_replace(' ', '<br>', $registro1[1]); ?>&nbsp;&nbsp;</th>
                <?php } ?>

                <th class="text-center vertical letra11">TOTAL&nbsp;&nbsp;</th>
            </tr>
        </thead>
        <tbody class="buscar">
            <?php foreach ($resAre as $registro3) { ?>  
                <tr class="">
                    <td class="vertical letra11"><?php echo $registro3[1]; ?></td> 
                    <?php foreach ($resFlujo as $registro2) { ?>
                        <td class="vertical letra11 e_usuariosPasos1" align="center" data-are="<?php echo $registro3[1]; ?>" data-docNom="<?php echo $registro2[1]; ?>" data-docCod="<?php echo $registro2[2]; ?>" data-tip='7'>
                        <?php
                        //XX
                            $cantidadAreaTipo = $sol->totalAreasPasoFlujoAprobacion($registro3['Area_Nombre'], $registro2['Par_Nombre'], $_POST['planta'], $_POST['fechaIni'], $_POST['fechaFin']);
                            if ($cantidadAreaTipo != 0) {
                                echo $cantidadAreaTipo;
                            }
                            $total_horizontal += $cantidadAreaTipo;
                            ?>
                        </td>
                            
                        <?php // $totalAreaFlujo[$registro3[1]] += $vectorAreaFlujo[$registro3[1]][$registro2[1]]; ?>
                        <?php // $totalTipoDocFlujo[$registro2[1]] += $vectorAreaFlujo[$registro3[1]][$registro2[1]];  XX?>
                    <?php } ?>
                    <td class="vertical letra11 e_usuariosPasos1" align="center" data-are="<?php echo $registro3[1]; ?>" data-docNom="-1" data-docCod="-1" data-tip='8'>
                    <?php
                        $total_horizontal = $sol->totalAreasParametroPorPasoFlujo($registro3['Area_Nombre'], $_POST['planta'], $_POST['fechaIni'], $_POST['fechaFin']);
                        if ($total_horizontal != 0) {
                            echo $total_horizontal;
                        }
                        ?>
                    </td>
                    <?php $pruebaFlujo += $total_horizontal; ?>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot class="encabezadoTab">
            <tr class="">
                <td class="vertical letra11">Total:</td>
                <?php foreach ($resFlujo as $registro2) { ?>  
                    <td class="vertical letra11 e_usuariosPasos1" align="center" data-are="-1" data-docNom="<?php echo $registro2[1]; ?>" data-docCod="<?php echo $registro2[2]; ?>" data-tip='9'>
                    <?php // $totalFlujo += $totalTipoDocFlujo[$registro2[1]]; ?>
                    <?php
                        $total_vertical = $sol->totalAreasNombreAreaPorPasoFlujo($registro2['Par_Nombre'], $_POST['planta'], $_POST['fechaIni'], $_POST['fechaFin']);
                        if ($total_vertical != 0) {
                            echo $total_vertical;
                        }
                        ?>
                    </td>
                <?php } ?>
                <td class="vertical letra11" align="center"><?php echo $pruebaFlujo; ?></td>
            </tr>
        </tfoot>
    </table>
</div>
<div class="e_cargarDatosUsuariosPasos1"></div>