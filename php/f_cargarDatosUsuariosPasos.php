<?php
include("op_sesion.php");
include("../class/solicitudes.php");
include_once("../class/usuarios.php");
include_once("../class/areas.php");
$sol = new solicitudes();

if ($_POST['tipo'] == '1' || $_POST['tipo'] == '2' || $_POST['tipo'] == '3') {
    $usu2 = new usuarios();
    $usu2->setUsu_Codigo($_POST['usuario']);
    $usu2->consultar();
} elseif ($_POST['tipo'] == '4' || $_POST['tipo'] == '5' || $_POST['tipo'] == '6' || $_POST['tipo'] == '7' || $_POST['tipo'] == '8' || $_POST['tipo'] == '9') {
    $are = new areas();
    $are->setArea_Nombre($_POST['usuario']);
    $are->consultar();
}
if ($_POST['tipo'] == '1') {
    $resSol = $sol->EspecificaAreasUsuariosFlujoConFecha($_POST['usuario'], $_POST['nom'], $_POST['planta'], $_POST['fechaIni'], $_POST['fechaFin']);
    $titulo = 'Detalle estado de documentos de ' . $usu2->getUsu_Nombre() . ' ' . $usu2->getUsu_Apellido() . ' del paso ' . $_POST['paso'] . '. ' . $_POST['nom'];
} elseif ($_POST['tipo'] == '2') {
    $resSol = $sol->EspecificaAreasUsuariosFlujoConFecha($_POST['usuario'], NULL, $_POST['planta'], $_POST['fechaIni'], $_POST['fechaFin']);
    $titulo = 'Detalle estado de documentos de ' . $usu2->getUsu_Nombre() . ' ' . $usu2->getUsu_Apellido();
} elseif ($_POST['tipo'] == '3') {
    $resSol = $sol->EspecificaAreasUsuariosFlujoConFecha(NULL, $_POST['nom'], $_POST['planta'], $_POST['fechaIni'], $_POST['fechaFin']);
    $titulo = 'Detalle estado de documentos del paso ' . $_POST['paso'] . '. ' . $_POST['nom'];
} elseif ($_POST['tipo'] == '4') {
    $resSol = $sol->EspecificaAreasTipoCorFecha($_POST['usuario'], $_POST['nom'],  $_POST['planta'], $_POST['fechaIni'], $_POST['fechaFin']);
    $titulo = 'Detalle estado de documentos del área ' . $are->getArea_Nombre() . ' del tipo de documento ' . $_POST['nom'];
} elseif ($_POST['tipo'] == '5') {
    $resSol = $sol->EspecificaAreasTipoCorFecha($_POST['usuario'], $_POST['nom'], $_POST['planta'],$_POST['fechaIni'], $_POST['fechaFin']);
    $titulo = 'Detalle estado de documentos del área: ' . $are->getArea_Nombre();
} elseif ($_POST['tipo'] == '6') {
    $resSol = $sol->EspecificaAreasTipoCorFecha($_POST['usuario'], $_POST['nom'], $_POST['planta'], $_POST['fechaIni'], $_POST['fechaFin']);
    $titulo = 'Detalle estado de documentos de tipo: ' . $_POST['nom'];
} elseif ($_POST['tipo'] == '7') {
    $resSol = $sol->EspecificaAreasPasosFlujoConFecha($_POST['usuario'], $_POST['nom'], $_POST['planta'], $_POST['fechaIni'], $_POST['fechaFin']);
    $titulo = 'Detalle estado de documentos del área: ' . $are->getArea_Nombre() . ' del paso: ' . $_POST['paso'] . '. ' . $_POST['nom'];
} elseif ($_POST['tipo'] == '8') {
    $resSol = $sol->EspecificaAreasPasosFlujoConFecha($_POST['usuario'], $_POST['nom'], $_POST['planta'], $_POST['fechaIni'], $_POST['fechaFin']);
    $titulo = 'Detalle estado de documentos del área: ' . $are->getArea_Nombre();
} elseif ($_POST['tipo'] == '9') {
    $resSol = $sol->EspecificaAreasPasosFlujoConFecha($_POST['usuario'], $_POST['nom'], $_POST['planta'], $_POST['fechaIni'], $_POST['fechaFin']);
    $titulo = 'Detalle estado de documentos del paso: ' . $_POST['paso'] . '. ' . $_POST['nom'];
}
?>
<br>
<label for=""><?php echo $titulo; ?> </label>
<div class="table-responsive" id="imp_tabla">
    <table id="" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
        <thead>
            <tr class="encabezadoTab">
                <th class="text-center letra11" align="center">CÓD</th>
                <?php if ($_POST['tipo'] != '1' && $_POST['tipo'] != '2') { ?>
                    <th class="text-center letra11" align="center">USUARIO</th>
                <?php } ?>
                <th class="text-center letra11" align="vertical">FECHA<br>SOLICITUD</th>
                <?php if ($_POST['tipo'] != '4' && $_POST['tipo'] != '5' && $_POST['tipo'] != '6' && $_POST['tipo'] != '7' && $_POST['tipo'] != '8') { ?>
                    <th class="text-center letra11" align="vertical">ÁREA</th>
                    <th class="text-center letra11" align="vertical">TIPO DOCUMENTO</th>
                <?php } ?>
                <?php if ($_POST['tipo'] == '5') { ?>
                    <th class="text-center letra11" align="vertical">TIPO DOCUMENTO</th>
                <?php } ?>
                <?php if ($_POST['tipo'] == '6') { ?>
                    <th class="text-center letra11" align="vertical">ÁREA</th>
                <?php } ?>
                <?php if ($_POST['tipo'] == '7') { ?>
                    <th class="text-center letra11" align="vertical">TIPO DOCUMENTO</th>
                <?php } ?>
                <?php if ($_POST['tipo'] == '8') { ?>
                    <th class="text-center letra11" align="vertical">TIPO DOCUMENTO</th>
                <?php } ?>
                <th class="text-center letra11" align="vertical">CÓDIGO DOCUMENTO</th>
                <th class="text-center letra11" align="vertical">NOMBRE DOCUMENTO</th>
                <th class="text-center letra11" align="vertical">VERSIÓN</th>

                <?php if ($_POST['tipo'] != '1' && $_POST['tipo'] != '3' && $_POST['tipo'] != '7' && $_POST['tipo'] != '9') { ?>
                    <th class="text-center letra11" align="vertical">ESTADO</th>
                <?php } ?>
                <th class="text-center letra11" align="vertical">TEMA</th>
                <th class="text-center letra11" align="vertical">HISTORIAL</th>

            </tr>
        </thead>
        <tbody class="buscar">
            <?php
            $cont = 0;
            foreach ($resSol as $registro) {
                ?>
                <tr>
                    <td align="center" class="letra11"><?php echo $registro[1]; ?></td> 
                    <?php if ($_POST['tipo'] != '1' && $_POST['tipo'] != '2') { ?> 
                        <td class="letra11" align=""><?php echo $registro[4]; ?></td>
                    <?php } ?>
                    <td class="letra11" align="right"><?php echo $registro[2]; ?></td> 

                    <?php if ($_POST['tipo'] != '4' && $_POST['tipo'] != '5' && $_POST['tipo'] != '6' && $_POST['tipo'] != '7' && $_POST['tipo'] != '8') { ?>
                        <td class="letra11"><?php echo $registro[3]; ?></td>  
                        <td class="letra11"><?php echo $registro[5]; ?></td> 
                    <?php } ?>
                    <?php if ($_POST['tipo'] == '5') { ?>
                        <td class="letra11"><?php echo $registro[5]; ?></td> 
                    <?php } ?>
                    <?php if ($_POST['tipo'] == '6') { ?>
                        <td class="letra11"><?php echo $registro[3]; ?></td> 
                    <?php } ?>
                    <?php if ($_POST['tipo'] == '7') { ?>
                        <td class="letra11"><?php echo $registro[5]; ?></td> 
                    <?php } ?>
                    <?php if ($_POST['tipo'] == '8') { ?>
                        <td class="letra11"><?php echo $registro[5]; ?></td> 
                    <?php } ?>
                    <td class="letra11"><?php echo $registro[6]; ?></td>  
                    <td class="letra11"><?php echo $registro[7]; ?></td>  
                    <td class="letra11" align="center"><?php echo $registro[15]; ?></td>
                    <?php if ($_POST['tipo'] != '3' && $_POST['tipo'] != '1' && $_POST['tipo'] != '7' && $_POST['tipo'] != '9') { ?>
                        <td class="letra11"><?php echo $registro[14] . ". " . $registro[10]; ?></td>
                    <?php } ?>
                    <td class="letra11"><?php echo $registro[8]; ?></td>  
                    <td class="vertical letra11" align=""><button class="btn btn-warning btn-xs e_cargarHistorialCOnsolidadoUsuario" data-cod="<?php echo $registro[0]; ?>">Ver</button></td>
                    <?php $cont++; ?>
                </tr>
            <?php } ?>
        </tbody>
        <tr class="encabezadoTab letra11">
            <td align="center" colspan="3"><strong>TOTAL: <?php echo $cont; ?></strong></td>
        </tr>
    </table>
</div>
