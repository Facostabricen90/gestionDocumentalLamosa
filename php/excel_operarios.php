<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Operarios.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
include("op_sesion.php");
include("../class/operarios.php");

$ope = new operarios();
//$resOpe = $ope->listarOperariosPrinpal($_GET['estado'],$_GET['area'], $_SESSION['GD_Usuario']);
$resOpe = $ope->listarOperariosPrinpal($_GET['estado'], $_GET['area'], $_GET['subArea'], $_SESSION['GD_Usuario']);
//var_dump($resOpe);

?>

<meta charset="utf-8">

<h3 align="center">Operarios</h3>
<br>

<div class="table-responsive">
  <table id="tbl_Operarios" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoTab">
        <th class="text-center" align="center">PLANTA</th>  
        <th class="text-center" align="center">NOMBRE</th>  
        <th class="text-center" align="center">CÉDULA</th>  
        <th class="text-center" align="center">SEXO</th>  
        <th class="text-center" align="center">CÓD. CCOSTO</th>  
        <th class="text-center" align="center">NOM. CCOSTO</th>  
        <th class="text-center" align="center">JEFE</th>  
        <th class="text-center" align="center">CARGO</th>  
        <th class="text-center" align="center">TIPO FUNCIÓN</th>  
        <th class="text-center" align="center">ÁREA LATAM</th>  
        <th class="text-center" align="center">GERENCIA</th>  
        <th class="text-center" align="center">ÁREA</th>  
        <th class="text-center" align="center">SUBÁREA</th>  
        <th class="text-center" align="center">CORREO</th>  
        <th class="text-center" align="center">TELÉFONO</th>  
      </tr>
    </thead>
    <tbody class="buscar">
      <?php foreach($resOpe as $registro){ ?>
        <tr>
          <td nowrap><?php echo $registro['planta_nombre']; ?></td>  
          <td nowrap><?php echo $registro[1]; ?></td>  
          <td><?php echo $registro[2]; ?></td>  
          <td><?php echo $registro[3]; ?></td>  
          <td><?php echo $registro[4]; ?></td>  
          <td><?php echo $registro[5]; ?></td>  
          <td><?php echo $registro[6]; ?></td>  
          <td><?php echo $registro[7]; ?></td>  
          <td><?php echo $registro[8]; ?></td>  
          <td><?php echo $registro[9]; ?></td>  
          <td><?php echo $registro[10]; ?></td>  
          <td><?php echo $registro[11]; ?></td>  
          <td><?php echo $registro[12]; ?></td>  
          <td><?php echo $registro[13]; ?></td>  
          <td><?php echo $registro[14]; ?></td>  
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>