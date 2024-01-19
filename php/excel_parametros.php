<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Parametros.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<?php
include("op_sesion.php");
include("../class/parametros.php");

$par = new parametros();
$resPar = $par->listarParametrosPrinpal($_GET['estado'], $_SESSION['GD_Usuario']);
?>

<meta charset="utf-8">

<h3 align="center">Plantas</h3>
<br>

<div class="table-responsive">
  <table id="tbl_Parametros" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoTab">
        <th class="text-center" align="center">TIPO</th>  
        <th class="text-center" align="center">NOMBRE</th>  
      </tr>
    </thead>
    <tbody class="buscar">
      <?php foreach($resPar as $registro){ ?>
        <tr>
          <td class="text-center" align="center">
						<?php
							switch($registro[2]){
								case 1: $TipoM = "Tipo de Documento";
									break;
								case 2: $TipoM = "Pasos";
									break;
							}
							echo $TipoM; ?>
					</td>  
          <td><?php echo $registro[1]; ?></td>  
          
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>