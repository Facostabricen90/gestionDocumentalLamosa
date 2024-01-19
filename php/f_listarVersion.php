<?php
include("op_sesion.php");
include("../class/solicitudes.php");
$sol = new solicitudes();
$resSol = $sol->listarCodigosAntiguos($_POST['codigo'],$_SESSION['GD_Usuario']);
?>

<div class="table-responsive" id="imp_tabla" style="max-height: 250px; overflow-y: scroll;">
  <table id="" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoConex">
        <th class="text-center vertical">Código Doc.</th>
        <th class="text-center vertical">Nombre</th>
        <th class="text-center vertical">Versión</th>
        <th class="text-center vertical">Estado</th>
      </tr>
    </thead>
    <tbody class="buscar">
      <?php foreach($resSol as $registro){ ?>
        <tr>
          <td class="vertical"><?php echo $registro[0]; ?></td>
          <td class="vertical"><?php echo $registro[1]; ?></td>
          <td class="vertical"><?php echo $registro[2]; ?></td>
          <td class="vertical"><?php echo $registro[3]; ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
