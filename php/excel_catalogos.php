<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=CatalogoDocumentos.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<?php
include("op_sesion.php");
include("../class/solicitudes.php");
include("../class/flujos_aprobaciones.php");
include("../class/usuarios_areas.php");
include("../class/parametros.php");

$par = new parametros();
$resLatam = $par->verificadorLatam();

$sol = new solicitudes();
$resSol = $sol->listarSolicitudesFiltroPublicado($_GET['area'], $_GET['tipo']);

$fluA = new flujos_aprobaciones();

$usuA = new usuarios_areas();
$resUsuA = $usuA->listarAreasUsuariosFiltro($_SESSION['GD_Usuario']);

$cantAreas = count($resUsuA);

foreach($resFluA as $registro2){
	$Areas[$registro2[1]] = $registro2[1];
}

foreach($resLatam as $registro3){
	$vectorLatam[$registro3[1]] = $registro3[1];
}
?>
<meta charset="utf-8">
<h3 align="center">Catálogo Documentos</h3>
<br>
<?php if ($cantAreas > 0){ ?>
  <div class="table-responsive">
    <table id="tbl_catalogoDocumentos" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
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

        </tr>
      </thead>
      <tbody class="buscar">
        <?php if($usu->getUsu_Rol() == "Administrador"){ ?>
          <?php
          $cont = 0;
          foreach($resSol as $registro){
						if(isset($vectorLatam[$registro[5]])){
							$ColorEsp = "background-color: #99B4FD";
						}else{
							$ColorEsp = "";
						}
					?>
            <tr style="<?php echo $ColorEsp; ?>">
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
            </tr>
          <?php $cont++; } ?>
        <?php }else{ ?>
          <?php
          $cont = 0;
          foreach($resSol as $registro){ 
            if(isset($vectorLatam[$registro[5]])){
							$ColorEsp = "background-color: #99B4FD";
						}else{
							$ColorEsp = "";
						}
            ?>
            <?php if(isset($Areas[$registro[13]])){ ?>
              <tr style="<?php echo $ColorEsp; ?>">
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
              </tr>
            <?php $cont++; } ?>
          <?php } ?>
        <?php } ?>
      </tbody>
      <tr class="encabezadoTab">
        <td align="center" colspan="3"><strong>TOTAL: <?php echo $cont; ?></strong></td>
      </tr>
    </table>
  </div>
<?php }else{ ?>
  <div class="alert alert-warning" align="center">
    <strong class="letra16">NO TIENE ÁREAS ASIGNADAS</strong>
  </div>
<?php } ?>