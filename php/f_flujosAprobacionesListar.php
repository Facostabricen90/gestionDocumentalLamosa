<?php
include("op_sesion.php");
include("../class/flujos_aprobaciones.php");

$fluA = new flujos_aprobaciones();
$resFlu = $fluA->listarFlujosAprPrincipal($_POST['estado'], $_POST['area'], $_POST['usuario'], $_POST['tipoFlujo'], $_SESSION['GD_Usuario'], $_POST['planta']);

$totalreg = count($resFlu);
?>
Total: <?php echo $totalreg; ?>
<div class="table-responsive">
  <table id="tbl_FlujosAprobaciones" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoTab">
        <th class="text-center" align="center">NOMBRE ENCARGADO</th>
        <th class="text-center" align="center">PLANTA ENCARGADO</th>
        <th class="text-center" align="center">ÁREA ENCARGADO</th>
        <th class="text-center" align="center">N</th>
        <th class="text-center" align="center">PASO</th>
        <th class="text-center" align="center">PLANTA FLUJO</th>
        <th class="text-center" align="center"></th>
      </tr>
    </thead>
    <tbody class="buscar">
      <?php foreach($resFlu as $registro) { 
        if($registro[5] == "3"){
          $TipPas = "(EHS)";
        }else{
          $TipPas = "";
        }
      ?>
        <tr>
          <td><?php echo $registro[1]; ?></td>
          <td><?php echo ($registro[7] == 'PERÚ - PERÚ') ? 'PERÚ' : $registro[6]; ?></td>
          <td><?php echo $registro[2]; ?></td>
          <td><?php echo $registro[4]; ?></td>
          <td><?php echo $registro[4].". ".$registro[3]." ".$TipPas; ?></td>
          <td><?php echo $registro[7]; ?></td>
          <td align="center" class="e_cargarFlujosAprobaciones" data-cod="<?php echo $registro[0]; ?>" align="center"><button class="btn btn-warning btn-xs">Editar</button></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
