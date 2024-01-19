<?php
include("op_sesion.php");
include("../class/parametros.php");
include("../class/solicitudes.php");
include("../class/historiales_flujos.php");
include("../class/areas.php");
include("hora.php");

$sol = new solicitudes();
$sol->setSol_Codigo($_POST['codigo']);
$sol->consultar();

$are = new areas();
$are->setArea_Codigo($sol->getArea_Codigo());
$are->consultar();

$usu2 = new usuarios();
$usu2->setUsu_Codigo($sol->getUsu_Codigo());
$usu2->consultar();

$par = new parametros();
$resTipDoc = $par->listarParametroTipo("1");

$hisF = new historiales_flujos();
$resHisFlu = $hisF->listarHistorialFlujoSolicitudesMMGestion($_POST['codigo']);
?>
<div class="row">


	<div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading" align="center">
          <strong class="letra18">DATOS SOLICITUD</strong>
      </div>
      <div class="panel-body">
				
				<div class="col-lg-6 col-md-6 col-sm-6">
          <strong class="letra14">Tipo Documento: </strong><?php echo $sol->getSol_TipoDocumento(); ?>
					<br>
					<strong class="letra14">Área: </strong> <?php echo $are->getArea_Nombre(); ?>
					<br>
					<strong class="letra14">Fecha Solicitud: </strong><?php echo $sol->getSol_Fecha(); ?>   
					</div>
				
				<div class="col-lg-6 col-md-6 col-sm-6">
					<strong class="letra14">Usuario Solicitud: </strong><?php echo $usu2->getUsu_Nombre()." ".$usu2->getUsu_Apellido(); ?>
					<br>
					<strong class="letra14">Observaciones: </strong><?php echo $sol->getSol_Observaciones(); ?>   
				</div>
				
				
      </div>
    </div>
  </div>
	
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading" align="center">
        <strong class="letra18">HISTORIAL FLUJO</strong>
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
								<th align="center" class="text-center">&nbsp;&nbsp;</th>
							</tr>
						</thead>
						<tbody class="buscar">
							<?php foreach($resHisFlu as $registro){ ?>
								<tr>
									<td><?php echo $registro[7].". ".$registro[5]; ?></td>	
									<td><?php echo $registro[1]; ?></td>	
									<td class="letra11"><?php echo $registro[2]; ?></td>	
									<td nowrap align="right"><?php echo substr($registro[3], 0, 10)." ".PasarMilitaraAMPM(substr($registro[3], 11, 8)); ?>&nbsp;</td>	
									<td nowrap><?php echo $registro[8]; ?></td>
                  <?php if($registro[6] != "" && $registro[6] != NULL){ ?>
                    <td nowrap><a href="../imagenes/formatos/<?php echo $registro[6]; ?>" download="Historial_<?php echo $registro[6]; ?>" target="_blank"><span class="glyphicon glyphicon-download-alt manito azul" title="Descargar Formato"></span></a></td>	
                  <?php }else{ ?>
                    <td></td>
                  <?php } ?>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				
      </div>
    </div>
  </div>
	
	<div class="limpiar"></div>
	
	<div align="center">
					
    <div class="lineaPasos" align="left">
			<div>
				<?php if($sol->getSol_PasoActual() == "1"){ $lS = "letraSelect"; ?>
					<img src="../imagenes/flechaPasosVerde.png" width="110px">	
				<?php }else{ $lS = ""; ?>
					<img src="../imagenes/flechaPasosGris.png" width="110px">	
				<?php } ?>
			</div>
			<div class="letraPasos <?php echo $lS; ?>">
				<span class=""><strong>1. Solicitud</strong></span>
			</div>
		</div>
		<div class="lineaPasos" align="left">
			<div>
				<?php if($sol->getSol_PasoActual() == "2"){ $lS = "letraSelect"; ?>
					<img src="../imagenes/flechaPasosVerde.png" width="110px">	
				<?php }else{ $lS = ""; ?>
					<img src="../imagenes/flechaPasosGris.png" width="110px">	
				<?php } ?>
			</div>
			<div class="letraPasos2 <?php echo $lS; ?>">
				<span class=""><strong>2. Revisión <br>Jefe Área</strong></span>
			</div>
		</div>
		<div class="lineaPasos" align="left">
			<div>
				<?php if($sol->getSol_PasoActual() == "3"){ $lS = "letraSelect"; ?>
					<img src="../imagenes/flechaPasosVerde.png" width="110px">	
				<?php }else{ $lS = ""; ?>
					<img src="../imagenes/flechaPasosGris.png" width="110px">	
				<?php } ?>
			</div>
			<div class="letraPasos <?php echo $lS; ?>">
				<span class=""><strong>3. Revisión EHS</strong></span>
			</div>
		</div>
		<div class="lineaPasos" align="left">
			<div>
				<?php if($sol->getSol_PasoActual() == "4"){ $lS = "letraSelect"; ?>
					<img src="../imagenes/flechaPasosVerde.png" width="110px">	
				<?php }else{ $lS = ""; ?>
					<img src="../imagenes/flechaPasosGris.png" width="110px">	
				<?php } ?>
			</div>
			<div class="letraPasos <?php echo $lS; ?>">
				<span class=""><strong>4. Ajustes</strong></span>
			</div>
		</div>
		<div class="lineaPasos" align="left">
			<div>
				<?php if($sol->getSol_PasoActual() == "5"){ $lS = "letraSelect"; ?>
					<img src="../imagenes/flechaPasosVerde.png" width="110px">	
				<?php }else{ $lS = ""; ?>
					<img src="../imagenes/flechaPasosGris.png" width="110px">	
				<?php } ?>
			</div>
			<div class="letraPasos2 <?php echo $lS; ?>">
				<span class=""><strong>5. Revisión <br>Jefe Área</strong></span>
			</div>
		</div>
		<div class="lineaPasos" align="left">
			<div>
				<?php if($sol->getSol_PasoActual() == "6"){ $lS = "letraSelect"; ?>
					<img src="../imagenes/flechaPasosVerde.png" width="110px">	
				<?php }else{ $lS = ""; ?>
					<img src="../imagenes/flechaPasosGris.png" width="110px">	
				<?php } ?>
			</div>
			<div class="letraPasos <?php echo $lS; ?>">
				<span class=""><strong>6. Revisión EHS</strong></span>
			</div>
		</div>
		<div class="lineaPasos" align="left">
			<div>
				<?php if($sol->getSol_PasoActual() == "7"){ $lS = "letraSelect"; ?>
					<img src="../imagenes/flechaPasosVerde.png" width="110px">	
				<?php }else{ $lS = ""; ?>
					<img src="../imagenes/flechaPasosGris.png" width="110px">	
				<?php } ?>
			</div>
			<div class="letraPasos <?php echo $lS; ?>">
				<span class=""><strong>7. Subir PDF</strong></span>
			</div>
		</div>
		<div class="lineaPasos" align="left">
			<div>
				<?php if($sol->getSol_PasoActual() == "8"){ $lS = "letraSelect"; ?>
					<img src="../imagenes/flechaPasosVerde.png" width="110px">	
				<?php }else{ $lS = ""; ?>
					<img src="../imagenes/flechaPasosGris.png" width="110px">	
				<?php } ?>
			</div>
			<div class="letraPasos <?php echo $lS; ?>">
				<span class=""><strong>8. Divulgación</strong></span>
			</div>
		</div>
  </div>

  </div>
	
</div>