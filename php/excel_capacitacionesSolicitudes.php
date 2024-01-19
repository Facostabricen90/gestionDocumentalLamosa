<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Capacitaciones.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<?php
include("op_sesion.php");
include("../class/capacitaciones_operarios.php");
include("../class/solicitudes.php");

date_default_timezone_set("America/Bogota");
setlocale(LC_TIME, 'spanish');

$fecha = date("Y-m-d");
$hora = date("H:i:s");

$capO = new capacitaciones_operarios();
$resCapO = $capO->excelCapacitacionesOperariosSolicitudes($_GET['cod']);

$sol = new solicitudes();
$sol->setSol_Codigo($_GET['cod']);
$sol->consultar();
?>
<meta charset="utf-8">
<h2 align="center">Capacitaciones</h2>
<p><strong>Tema:</strong> <?php echo $sol->getSol_NombreDocumento(); ?></p>
<p><strong>Fecha/Hora:</strong> <?php echo $fecha." ".$hora; ?></p>
<div class="table-responsive">
  <table border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr>
        <th align="center">TEMA</th>
        <th align="center">CÉDULA</th>
        <th align="center">NOMBRE DEL COLABORADOR</th>
        <th align="center">CARGO</th>
        <th align="center">CENTRO DE COSTOS</th>
        <th align="center">ÁREA LATAM</th>
        <th align="center">APLICA EVALUACIÓN</th>
        <th align="center">CALIFICACIÓN</th>
        <th align="center">PROVEEDOR</th>
        <th align="center">TIPO</th>
        <th align="center">MES</th>
        <th align="center">FECHA</th>
        <th align="center">HORAS TOTAL CAPACITACIÓN</th>
        <th align="center">VALOR POR PERSONA</th>
        <th align="center">GENERO</th>
        <th align="center">TIPO DE FUNCIÓN</th>
        <th align="center">TEMA</th>
        <th align="center">TIPO DE CAPACITACIÓN</th>
        <th align="center">GERENCIA/DIRECCIÓN</th>
        <th align="center">ÁREA</th>
        <th align="center">SUB-ÁREA</th>
      </tr>
    </thead>
    <tbody class="buscar">
      <?php foreach($resCapO as $registro){ ?>
        <tr>
          <td><?php echo $registro[0]; ?></td>
          <td align="right"><?php echo $registro[1]; ?></td>
          <td><?php echo $registro[2]; ?></td>
          <td><?php echo $registro[3]; ?></td>
          <td><?php echo $registro[4]; ?></td>
          <td><?php echo $registro[5]; ?></td>
          <td></td>
          <td></td>
          <td align="center"><?php echo $registro[6]; ?></td>
          <td align="center">CAPACITACIÓN</td>
          <td align="center"><?php echo strtoupper(ucfirst(strftime("%B",mktime(0, 0, 0, $registro[7], 1, 2000)))); ?></td>
          <td align="center"><?php echo $registro[8]; ?></td>
          <td align="center"><?php echo $registro[9]; ?></td>
          <td></td>
          <td align="center"><?php echo $registro[10]; ?></td>
          <td align="center"><?php echo $registro[11]; ?></td>
          <td align="center">TÉCNICO</td>
          <td align="center">EXTERNA</td>
          <td align="center"><?php echo $registro[12]; ?></td>
          <td align="center"><?php echo $registro[13]; ?></td>
          <td align="center"><?php echo $registro[14]; ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>