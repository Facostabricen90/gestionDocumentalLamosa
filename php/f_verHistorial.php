<?php
include("op_sesion.php");
include("../class/parametros.php");
include("../class/solicitudes.php");
include("../class/historiales_flujos.php");

$par = new parametros();
$resTipDoc = $par->listarParametroTipo("1");

$apr = new solicitudes();
$apr->setSol_Codigo($_POST['codigo']);
$apr->consultar();

$hisF = new historiales_flujos();
$resHisFlu = $hisF->listarHistorialFlujoSolicitudesGestion($_POST['codigo']);
?>

<div class="panel panel-primary">
  <div class="panel-heading" align="center">
    <strong class="letra18">HISTORIAL FLUJO SOLICITUD # <?php echo $_POST['codigo']; ?></strong>
  </div>
  <div class="panel-body">
    <div class="table-responsive" id="imp_tabla">
      <table border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
        <thead>
          <tr class="encabezadoTab">
            <th align="center" class="text-center">PASO</th>
            <th align="center" class="text-center">CLASIFICACIÓN</th>
            <th align="center" class="text-center">OBSERVACIONES</th>
            <th align="center" class="text-center">FECHA</th>
            <th align="center" class="text-center">USUARIO</th>
          </tr>
        </thead>
        <tbody class="buscar">
          <?php foreach($resHisFlu as $registro){ ?>
            <tr>
              <td align="center" class="vertical"><?php echo $registro[0]; ?></td>	
              <td align="" class=""><?php echo $registro[1]; ?></td>	
              <td align="" class=""><?php echo $registro[2]; ?>&nbsp;</td>	
              <td align="right" align="center" class="vertical"><?php echo $registro[3]; ?></td>	
              <td align="" class=""><?php echo $registro[8]; ?></td>	
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

  </div>
</div>