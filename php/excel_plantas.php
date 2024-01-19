<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Plantas.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<?php
include("op_sesion.php");
include("../class/plantas.php");

$pla = new plantas();
$resPla = $pla->listarPlantasPrinpal($_GET['estado']);
?>
<meta charset="utf-8">

<h3 align="center">Plantas</h3>
<br>
<div class="table-responsive">
  <table id="tbl_Plantas" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoTab">
        <th class="text-center" align="center">NOMBRE</th>  
        <th class="text-center" align="center">PAÍS</th>  
      </tr>
    </thead>
    <tbody class="buscar">
      <?php foreach($resPla as $registro){ ?>
        <tr>
          <td><?php echo $registro[1]; ?></td>  
          <td><?php echo $registro[2]; ?></td>  
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>