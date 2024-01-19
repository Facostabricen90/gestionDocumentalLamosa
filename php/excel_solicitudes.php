<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Solicitudes.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<?php
include("op_sesion.php");
include("../class/solicitudes.php");
include("../class/flujos_aprobaciones.php");
include("../class/parametros.php");
include("../class/festivos.php");

date_default_timezone_set("America/Bogota");
setlocale(LC_TIME, 'spanish');

$fechaHoy = date("Y-m-d");
$hora = date("H:i:s");

$fes = new festivos();

$sol = new solicitudes();
$resSol = $sol->listarSolicitudesPrinpal($_GET['fechaInicial'], $_GET['fechaFinal'], $_GET['estado'], $_GET['area'], $_GET['tipo']);

$fluA = new flujos_aprobaciones();
$resFluA = $fluA->listarFlujoAprobacionesSolicitudesUsuariosTipoFlujo($_SESSION['GD_Usuario'], $usu->getUsu_TipoFlujo());

foreach($resFluA as $registro2){
	$Areas[$registro2[1]] = $registro2[1];
	$Paso[$registro2[1].$registro2[2].$registro2[3]] = $registro2[2];
}

$par = new parametros();
$resParPas = $par->listarParametroTipo("2");

foreach($resParPas as $registro3){
	$PasosSig[$registro3[2]] = $registro3[1];
}

function cantidadValidarDias($estado){
	if($estado == "1" || $estado == "2" || $estado == "3"){
		$dias = 1;
		return $dias;
	}
	if($estado == "4"){
		$dias = 3;
		return $dias;
	}
	
	if($estado == "5" || $estado == "6" || $estado == "7" || $estado == "8" || $estado == "9" || $estado == "10"){
		$dias = 4;
		return $dias;
	}
	if($estado == "11"){
		$dias = 10;
		return $dias;
	}
	
}
?>
<meta charset="utf-8">

<h3 align="center">Solicitudes</h3>
<br>
<div class="table-responsive">
  <table id="tbl_Solicitudes" border="1px" class="table tableEstrecha table-hover table-bordered table-striped letra11">
    <thead>
      <tr class="ordenamiento encabezadoTab">
        <th class="text-center" align="center">CÓD</th>
        <th class="text-center" align="center">FECHA<br>SOLICITUD</th>
        <th class="text-center" align="center">ÁREA</th>
        <th class="text-center" align="center">SOLICITA</th>
        <th class="text-center" align="center">TIPO DOCUMENTO</th>
        <th class="text-center" align="center">CÓDIGO DOCUMENTO</th>
        <th class="text-center" align="center">NOMBRE DOCUMENTO</th>
        <th class="text-center" align="center">VERSIÓN</th>
        <th class="text-center" align="center">TEMA</th>
        <th class="text-center" align="center">OBSERVACIONES</th>
        <th class="text-center" align="center">ESTATUS</th>
        <th class="text-center" align="center" title="Siguiente Paso">SIG. PASO</th>
        <th class="text-center" align="center">&nbsp;&nbsp;</th>
      </tr>
    </thead>
    <tbody class="buscar">
			<?php if($usu->getUsu_Rol() == "Administrador"){ ?>
				<?php
				$cont = 0;
				foreach($resSol as $registro){ ?>
					<?php if($registro[10] != "Publicado"){
						$diasF = cantidadValidarDias($registro[14]);
				
						$fechaMax1 = date("Y-m-d",strtotime($registro[2]." + ".$diasF." days"));
					
						$diasNoH = $fes->cantidadDiasFestivosFechas($registro[2], $fechaMax);
					
						if($diasNoH > 0){
							$fechaMax2 = date("Y-m-d",strtotime($fechaMax1." + ".$diasNoH." days"));
							
							$diasNoH2 = $fes->cantidadDiasFestivosFechas($fechaMax1, $fechaMax2);
							if($diasNoH2 > 0){
								$fechaMax = date("Y-m-d",strtotime($fechaMax2." + ".$diasNoH2." days"));
							}else{
								$fechaMax = $fechaMax2;
							}
						}else{
							$fechaMax = $fechaMax1;
						}
					
						$diasNoHReal = $fes->cantidadDiasFestivosFechas($registro[2], $fechaHoy);
					
						$segundos = strtotime('now') - strtotime($registro[2]);
						$diferencia_dias = intval($segundos/60/60/24) + 1;
						$diferencia_dias = $diferencia_dias - $diasNoHReal;
					
						if($fechaHoy <= $fechaMax){
							if($diferencia_dias <= $diasF){
								$ValFec = "VFVerde";
							}else{
								$ValFec = "VFRojo";
							}
						}else{
							$ValFec = "VFRojo";
						}

					?>
						<tr data-fecmax="<?php echo $fechaMax; ?>">
							<td align="center"><?php echo $registro[1]; ?></td>  
							<td align="right"><?php echo $registro[2]; ?></td>  
							<td><?php echo $registro[3]; ?></td>  
							<td><?php echo $registro[4]; ?></td>  

							<td><?php echo $registro[5]; ?></td>  
							<td><?php echo $registro[6]; ?></td>  
							<td><?php echo $registro[7]; ?></td>  
							<td align="center"><?php echo $registro[15]; ?></td>  
							<td><?php echo $registro[8]; ?></td>  
							<td><?php echo $registro[9]; ?></td>  
							<td class="vertical" nowrap>&nbsp;<?php echo $registro[14].". ".$registro[10]; ?></td>
							<td class="vertical" nowrap>&nbsp;<?php echo ($registro[14]+1).". ".$PasosSig[$registro[14]+1]; ?></td>
							<td align="center" class="vertical" nowrap><div class="Circ_ValFec <?php echo $ValFec; ?>"><strong><?php echo $diferencia_dias." de ".$diasF; ?></strong></div></td>
						</tr>
				<?php $cont++; } } ?>		
			<?php }else{ ?>
				<?php
				$cont = 0;
				foreach($resSol as $registro){ ?>
					<?php if(isset($Areas[$registro[13]])){ ?>	
					
							<?php if($registro[10] != "Publicado"){
									$diasF = cantidadValidarDias($registro[14]);
				
									$fechaMax1 = date("Y-m-d",strtotime($registro[2]." + ".$diasF." days"));

									$diasNoH = $fes->cantidadDiasFestivosFechas($registro[2], $fechaMax);

									if($diasNoH > 0){
										$fechaMax2 = date("Y-m-d",strtotime($fechaMax1." + ".$diasNoH." days"));

										$diasNoH2 = $fes->cantidadDiasFestivosFechas($fechaMax1, $fechaMax2);
										if($diasNoH2 > 0){
											$fechaMax = date("Y-m-d",strtotime($fechaMax2." + ".$diasNoH2." days"));
										}else{
											$fechaMax = $fechaMax2;
										}
									}else{
										$fechaMax = $fechaMax1;
									}

									$diasNoHReal = $fes->cantidadDiasFestivosFechas($registro[2], $fechaHoy);

									$segundos = strtotime('now') - strtotime($registro[2]);
									$diferencia_dias = intval($segundos/60/60/24);
									$diferencia_dias = $diferencia_dias - $diasNoHReal;

									if($fechaHoy <= $fechaMax){
										if($diferencia_dias <= $diasF){
											$ValFec = "VFVerde";
										}else{
											$ValFec = "VFRojo";
										}
									}else{
										$ValFec = "VFRojo";
									}
								?>
								<tr>
									<td align="center"><?php echo $registro[1]; ?></td>  
									<td align="right"><?php echo $registro[2]; ?></td>  
									<td><?php echo $registro[3]; ?></td>  
									<td><?php echo $registro[4]; ?></td>  
									<td><?php echo $registro[5]; ?></td>  
									<td><?php echo $registro[6]; ?></td>  
									<td><?php echo $registro[7]; ?></td>
									<td align="center"><?php echo $registro[15]; ?></td>  
									<td><?php echo $registro[8]; ?></td>  
									<td><?php echo $registro[9]; ?></td>  
									<td class="vertical" nowrap>&nbsp;<?php echo $registro[14].". ".$registro[10]; ?></td>
									<td class="vertical" nowrap>&nbsp;<?php echo ($registro[14]+1).". ".$PasosSig[$registro[14]+1]; ?></td>
									<td align="center" class="vertical" nowrap><div class="Circ_ValFec <?php echo $ValFec; ?>"><strong><?php echo $diferencia_dias." de ".$diasF; ?></strong></div></td>
									
								</tr>
							<?php $cont++; } ?>
						<?php } ?>
					
				<?php } ?>
			<?php } ?>
    </tbody>
    <tr class="encabezadoTab">
      <td align="center" colspan="3"><strong>TOTAL: <?php echo $cont; ?></strong></td>
    </tr>
  </table>
</div>