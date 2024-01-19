<?php
include("op_sesion.php");
include("../class/parametros.php");

$par = new parametros();
$resPar = $par->listarParametrosPrinpal($_POST['estado'], $_SESSION['GD_Usuario']);
?>
<div class="table-responsive">
  <table id="tbl_Parametros" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoTab">
        <th class="text-center" align="center">TIPO</th>  
        <th class="text-center" align="center">NOMBRE</th>  
        <th class="text-center" align="center">TIPO FLUJO</th>  
        <th class="text-center" align="center"></th>  
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
                case 3: $TipoM = "Pasos EHS";
									break;
							}
							echo $TipoM; ?>
					</td>  
          <td><?php echo $registro[1]; ?></td>  
          <td>
            <?php
							switch($registro[3]){
								case "": $TipoF = "";
									break;
                case 1: $TipoF = "Documentos Equipo Industrial";
									break;
								case 2: $TipoF = "Perfil de Competencias";
									break;
                case 3: $TipoF = "Matriz IPERC y/o Mapas de Seguridad";
									break;
							}
							echo $TipoF;
            ?>
          </td>  
          
          <td class="e_cargarParametros" data-cod="<?php echo $registro[0]; ?>" align="center"><button class="btn btn-warning btn-xs">Editar</button></td>  
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>