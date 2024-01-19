<?php
include("op_sesionOperarios.php");
include("../class/solicitudes.php");
include("../class/parametros.php");

$par = new parametros();
$resLatam = $par->verificadorLatam();

$sol = new solicitudes();
$resSol = $sol->listarSolicitudesFiltroPublicado($ope->getArea_Codigo(), $_POST['tipo']);

foreach($resLatam as $registro3){
	$vectorLatam[$registro3[1]] = $registro3[1];
}
?>
<?php if($ope->getArea_Codigo() != "" && $ope->getArea_Codigo() != NULL){ ?>
  <div class="table-responsive">
    <table id="tbl_catalogoDocumentosOpe" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
      <thead>
        <tr class="ordenamiento encabezadoTab">
          <th>CÓDIGO</th>
          <th>FECHA SOLICITUD</th>
          <th>ÁREA</th>
          <th>SOLICITA</th>
          <th>TIPO DOCUMENTO</th>
          <th>CÓDIGO DOCUMENTO</th>
          <th>NOMBRE DOCUMENTO</th>
          <th>TEMA</th>
          <th>OBSERVACIONES</th>
          <th>ESTADO ACTUAL</th>
          <th></th>
          <th></th>

        </tr>
      </thead>
      <tbody class="buscar"> 
        <?php
        $cont = 0;
        foreach($resSol as $registro){ 
          if(isset($vectorLatam[$registro[5]])){
            $ColorEsp = "latam";
          }else{
            $ColorEsp = "";
          }
          ?>
          <?php if($ope->getArea_Codigo() == $registro[13]){ ?>
            <tr class="<?php echo $ColorEsp; ?>">
              <td align="center"><?php echo $registro[1]; ?></td>  
              <td align="right"><?php echo $registro[2]; ?></td>  
              <td><?php echo $registro[3]; ?></td>  
              <td><?php echo $registro[4]; ?></td>  
              <td><?php echo $registro[5]; ?></td>  
              <td><?php echo $registro[6]; ?></td>  
              <td><?php echo $registro[7]; ?></td>  
              <td><?php echo $registro[8]; ?></td>  
              <td><?php echo $registro[9]; ?></td>  
              <td class="vertical" nowrap>&nbsp;<?php echo $registro[14].". ".$registro[10]; ?></td>		
              <td class="e_cargarCatalogo" data-cod="<?php echo $registro[0]; ?>" align="center"><button class="btn btn-warning btn-xs">Ver</button></td>
              <td class="e_cargarHistorial" data-codHis="<?php echo $registro[0]; ?>" align="center"><button class="btn btn-info btn-xs">Historial</button></td>
            </tr>
          <?php $cont++; } ?>
        <?php } ?>
      </tbody>
      <tr class="encabezadoTab">
        <td align="center" colspan="3"><strong>TOTAL: <?php echo $cont; ?></strong></td>
      </tr>
    </table>
  </div>
<?php }else{ ?>
  <div class="alert alert-warning" align="center">
    <strong class="letra16">NO TIENE ÁREA ASIGNADA</strong>
  </div>
<?php } ?>