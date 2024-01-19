<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=HistorialCatalogo.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<?php 
include("op_sesion.php");
include("../class/historiales_flujos.php");
include("hora.php");


$hisF = new historiales_flujos();
$resHisFlu = $hisF->listarHistorialFlujoSolicitudesGestion($_GET['code']);
?>
<meta charset="utf-8">
<h3 align="center">HISTORIAL FLUJO</h3>
<br>

<div class="panel-body">
  <div class="table-responsive" id="tbl_HistorialFlujo">
    <input type="hidden" value="<?php echo $_POST['code']; ?>" id="HistorialCatalogoId">
    <table border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
      <thead>
        <tr class="encabezadoTab">
          <th class="text-center" align="center">PASO</th>
          <th class="text-center" align="center">CLASIFICACIÓN</th>
          <th class="text-center" align="center">OBSERVACIONES</th>
          <th class="text-center" align="center">FECHA</th>
          <th class="text-center" align="center">USUARIO</th>
        </tr>
      </thead>
      <tbody class="buscar">
        <?php foreach($resHisFlu as $registro){ ?>
          <tr>
            <td><?php echo $registro[7].". ".$registro[5]; ?></td>		
            <td><?php echo $registro[1]; ?></td>	
            <td class="letra11"><?php echo $registro[2]; ?></td>	
            <td nowrap align="right"><?php echo substr($registro[3], 0, 10)." ".PasarMilitaraAMPM(substr($registro[3], 11, 8)); ?>&nbsp;</td>	
            <td nowrap><?php echo $registro[4]; ?></td>	
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

</div>