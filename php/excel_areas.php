<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Areas.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<?php
include("op_sesion.php");
include("../class/areas.php");

$are = new areas();
$resAre = $are->listarAreasPrincipal($_GET['estado'], $_SESSION['GD_Usuario']);
?>

<meta charset="utf-8">

<h3 align="center">Areas</h3>
<br>

<div class="table-responsive">
  <table id="tbl_Areas" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoTab">
        <th class="text-center" align="center">NOMBRE</th>
      </tr>
    </thead>
    <tbody class="buscar">
      <?php foreach($resAre as $registro) { ?>
        <tr>
          <td><?php echo $registro[1]; ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>