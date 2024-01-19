<?php
include("op_sesion.php");
include("../class/plantas.php");

$pla = new plantas();
$resPla = $pla->listarPlantasPrinpal($_POST['estado']);
?>
<div class="table-responsive">
  <table id="tbl_Plantas" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoTab">
        <th class="text-center" align="center">NOMBRE</th>  
        <th class="text-center" align="center">PAÍS</th>  
        <th class="text-center" align="center"></th>  
      </tr>
    </thead>
    <tbody class="buscar">
      <?php foreach($resPla as $registro){ ?>
        <tr>
          <td><?php echo $registro[1]; ?></td>  
          <td><?php echo $registro[2]; ?></td>  
          <td class="e_cargarPlantas" data-cod="<?php echo $registro[0]; ?>" align="center"><button class="btn btn-warning btn-xs">Editar</button></td>  
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>