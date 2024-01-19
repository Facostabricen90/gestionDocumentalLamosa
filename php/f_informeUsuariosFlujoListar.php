<?php
include("op_sesion.php");
include("../class/solicitudes.php");
include_once("../class/usuarios.php");
include("../class/parametros.php");
$sol = new solicitudes();
$resSolFlujo = $sol->listarConsolidadoDocumentosFlujoUsuarios($_POST['fechaIni'], $_POST['fechaFin'], $_POST['planta']);
$totalgeneralConFechaUsuarios = $sol->totalTotalAreasUsuariosFlujosInfoDef($_POST['fechaIni'], $_POST['fechaFin'], $_POST['planta']);

$usu2 = new usuarios();
$resUsu = $usu2->listarUsuariosConsolidado();

$par = new parametros();
$resTipDoc = $par->listarTipoDocumentoConsolidado();
$resFlujo = $par->listarParametroTipoFluAConsolidado();

foreach ($resSolFlujo as $registro) {
    $vectorAreaFlujo[$registro[0]][$registro[3]] = $registro[2];
    $valUsuario[$registro[0]] = $registro[0];
}
//var_dump($vectorAreaFlujo);
?>

<?php /* ?>

  <div class="col-lg-12 col-md-12 col-sm-12 tituloEnc text-center">Flujo</div>
  <?php */ ?>
<div class="table-responsive" id="imp_tabla">
    <table id="" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
        <thead>
            <tr class="encabezadoTab">
                <th class="text-center vertical letra11">Usuarios/Flujo</th>
                <?php foreach ($resFlujo as $registro1) { ?>
                    <th class="text-center vertical letra11"><?php echo $registro1[2] . '. ' . str_replace(' ', '<br>', $registro1[1]); ?>&nbsp;&nbsp;</th>
                <?php } ?>

                <th class="text-center vertical letra11">TOTAL&nbsp;&nbsp;</th>
            </tr>
        </thead>
        <tbody class="buscar">
            <?php foreach ($resUsu as $registro3) { ?>
                <?php if (isset($valUsuario[$registro3[0]])) { ?>
                    <tr class="">
                        <td class="vertical letra11"><?php echo $registro3[1]; ?></td>
                        <?php foreach ($resFlujo as $registro2) { ?>
                            <td class="vertical letra11 e_usuariosPasos" align="center" data-usu="<?php echo $registro3[0]; ?>" data-nom="<?php echo $registro2[1]; ?>" data-paso="<?php echo $registro2[2]; ?>" data-tip='1'>
                                <?php
                                $cantidadAreaTipo = $sol->totalAreasUsuariosFlujos($registro3['Usu_Codigo'], $registro2['Par_Nombre'], $_POST['fechaIni'], $_POST['fechaFin'], $_POST['planta']);
                                if ($cantidadAreaTipo != 0) {
                                    echo $cantidadAreaTipo;
                                }
                                $total_horizontal += $cantidadAreaTipo;
                                ?>
                            </td>
                            <?php // $totalAreaFlujo[$registro3[0]]+= $vectorAreaFlujo[$registro3[0]][$registro2[2]];   ?>
                            <?php // $totalTipoDocFlujo[$registro2[2]]+= $vectorAreaFlujo[$registro3[0]][$registro2[2]];   ?>
                        <?php } ?>
                        <td class="vertical letra11 e_usuariosPasos" data-usu="<?php echo $registro3[0]; ?>" data-nom="-1" data-tip='2' align="center">
                            <?php
                            $total_horizontal = $sol->totalAreasParametroPorUsuariosFlujo($registro3['Usu_Codigo'], $_POST['planta'], $_POST['fechaIni'], $_POST['fechaFin']);
                            if ($total_horizontal != 0) {
                                echo $total_horizontal;
                            }
                            ?>
                        </td>
                        <?php $pruebaFlujo += $total_horizontal; ?>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
        <tfoot class="encabezadoTab">
            <tr class="">
                <td class="vertical letra11">Total:</td>
                <?php foreach ($resFlujo as $registro2) { ?>  
                    <td class="vertical letra11 e_usuariosPasos" align="center" data-nom="<?php echo $registro2[1]; ?>" data-paso="<?php echo $registro2[2]; ?>" data-usu="-1" data-tip='3' align="center">
                    <?php // $totalFlujo += $totalTipoDocFlujo[$registro2[2]]; ?>
                    <?php
                        $total_vertical = $sol->totalAreasNombreAreaPorUsuariosFlujoInforme($registro2['Par_Nombre'], $_POST['planta'], $_POST['fechaIni'], $_POST['fechaFin']);
                        if ($total_vertical != 0) {
                            echo $total_vertical;
                        }
                        ?>
                    </td>
                <?php } ?>
                <td class="vertical letra11" align="center"><?php echo $totalgeneralConFechaUsuarios; ?></td>
            </tr>
        </tfoot>
    </table>
</div>
<div class="e_cargarDatosUsuariosPasos"></div>