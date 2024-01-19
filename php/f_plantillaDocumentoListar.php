<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("op_sesion.php");
include("../class/plantillas_documentos.php");
include("hora.php");

$planD = new plantillas_documentos();
$planD->setPlanta_codigo($_POST['planta']);
$resPlanD = $planD->listarPlantillasDocumentosPrinpalPlanta();

?>
<div class="table-responsive">
    <table id="tbl_PlantillasDocumentos" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
        <thead>
            <tr class="ordenamiento encabezadoTab">
                <th align="center" class="text-center">Tipo Documento</th>
                <th align="center" class="text-center">Plantilla</th>
                <th align="center" class="text-center">Fecha</th>
                <th align="center" class="text-center">Usuario</th>
                <th align="center" class="text-center">Año Retención</th>
                <th align="center" class="text-center">Mes Retención</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="buscar">
            <?php
            $cant = 0;
            foreach ($resPlanD as $registro) {

                $dias = $registro[5];
                $ano = intval($dias / 360);
                $diaMes = $dias - ($ano * 360);
                $mes = intval($diaMes / 30.5);
                ?>
                <tr>
                    <td><?php echo $registro[1]; ?></td>	
                    <td><?php echo $registro[2]; ?></td>	
                    <td align="right"><?php echo substr($registro[3], 0, 10) . " " . PasarMilitaraAMPM(substr($registro[3], 11, 8)); ?>&nbsp;</td>	
                    <td>&nbsp;<?php echo $registro[4]; ?></td>
                    <?php if ($ano != 0) { ?>
                        <td align="center"><?php echo $ano; ?></td>
                    <?php } else { ?>
                        <td align="center"></td>
                    <?php } ?>
                    <?php if ($mes != 0) { ?>
                        <td align="center"><?php echo $mes; ?></td>
                    <?php } else { ?>
                        <td></td>
                    <?php } ?>
                        <?php if($usu->getUsu_Rol() == "Administrador"){ ?>
                    <td><button class="btn btn-warning btn-xs e_cargarPlantillasDocumentos" data-cod="<?php echo $registro[0]; ?>">Editar</button></td>
                        <?php } ?>
                    <?php if($usu->getUsu_Rol() != "Administrador"){ 
                        $plan = new plantillas_documentos();
                        $plan->setPlaD_Codigo($registro[0]);
                        $plan->consultar();
                        ?>
                    <td><a target="blank" href="../imagenes/plantillas/<?php echo $plan->getPlaD_Plantilla(); ?>"><button type="button" class="btn btn-success">Descargar</button></a></td>
                        <?php } ?>
                </tr>
                <?php
                $cant++;
            }
            ?>
        </tbody>
        <tfoot>
            <tr class="encabezadoTab">
                <td colspan="2">TOTAL: <?php echo $cant; ?></td>
            </tr>
        </tfoot>
    </table>
</div>