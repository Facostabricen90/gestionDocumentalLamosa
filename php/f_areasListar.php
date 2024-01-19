<?php
include("op_sesion.php");
include("../class/areas.php");

$are = new areas();
$resAre = $are->listarAreasPrincipal($_POST['estado'], $_SESSION['GD_Usuario'], $_POST['planta']);
?>

<div class="table-responsive">
  <table id="tbl_Areas" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoTab">
        <th class="text-center" align="center">NOMBRE</th>
        <th class="text-center" align="center">PLANTA</th>
        <th class="text-center" align="center"></th>
      </tr>
    </thead>
    <tbody class="buscar">
      <?php foreach($resAre as $registro) { ?>
        <tr>
          <td><?php echo $registro[1]; ?></td>
          <td><?php echo $registro[2]; ?></td>
          <td align="center" class="e_cargarAreas" data-cod="<?php echo $registro[0]; ?>" align="center"><button class="btn btn-warning btn-xs">Editar</button></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
