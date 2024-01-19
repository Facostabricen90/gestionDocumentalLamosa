<?php
include("op_sesion.php");
include("../class/operarios.php");
include("../class/solicitudes.php");
include("../class/capacitaciones_operarios.php");

date_default_timezone_set("America/Bogota");
setlocale(LC_TIME, 'spanish');

$fecha = date("Y-m-d");
$hora = date("H:i:s");

$sol = new solicitudes();
$sol->setSol_Codigo($_POST['codigo']);
$sol->consultar();

$ope = new operarios();
$resOpe = $ope->listarOperariosCapacitaciones($sol->getArea_Codigo());

$capO = new capacitaciones_operarios();
$resCapOpe = $capO->listarCapacitacionesOperariosSolicitudes($_POST['codigo']);

$resFecHorCap = $capO->capacitacionesDatoFechaHoras($_POST['codigo']);

if($resFecHorCap[0] != "" && $resFecHorCap[0] != NULL){
  $fechaCapacitacion = $resFecHorCap[0];
}else{
  $fechaCapacitacion = $fecha;
}

if($resFecHorCap[1] != "" && $resFecHorCap[1] != NULL){
  $horasCapacitacion = $resFecHorCap[1];
}else{
  $horasCapacitacion = "";
}

foreach($resCapOpe as $registro2){
	$vectorCapacitacion[$registro2[0]]['Codigo'] = $registro2[1];
	$vectorCapacitacion[$registro2[0]]['Capacitado'] = $registro2[2];
	$vectorCapacitacion[$registro2[0]]['Novedades'] = $registro2[3];
	$vectorCapacitacion[$registro2[0]]['Observaciones'] = $registro2[4];
}
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>Capacitaciones</strong>
      </div>

      <div class="panel-body">
        <div class="table-responsive">
          
          <div class="col-lg-4 col-md-4">
            <div class="form-group">
              <label class="control-label">Fecha Capacitación</label>
              <input type="text" id="CapOMM_Fecha" value="<?php echo $fechaCapacitacion; ?>" class="form-control fecha">
            </div>
          </div>
          
          <div class="col-lg-4 col-md-4">
            <div class="form-group">
              <label class="control-label">Horas Capacitación</label>
              <input type="text" id="CapOMM_HorasCapacitacion" value="<?php echo $horasCapacitacion; ?>" class="form-control" placeholder="Ejemplo: 10">
            </div>
          </div>
          
          <div class="limpiar"></div>
          <br>
					<table border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
						<thead>
							<tr class="encabezadoTab">
								<th class="text-center" align="center">Nombre</th>
								<th class="text-center" align="center">Capacitado</th>
								<th class="text-center" align="center">Novedades</th>
								<th class="text-center" align="center">Observaciones</th>
							</tr>
						</thead>
						<tbody class="buscar">
							<?php
							$cont = 0;
							foreach($resOpe as $registro){
							
								if(isset($vectorCapacitacion[$registro[0]]['Codigo'])){
									$accion = "1";
									$codigoCapacitacion = $vectorCapacitacion[$registro[0]]['Codigo'];
									if($vectorCapacitacion[$registro[0]]['Capacitado'] == "1"){
										$InpCapacitado = "checked";	
									}else{
										$InpCapacitado = "";
									}
									
									if($vectorCapacitacion[$registro[0]]['Novedades'] == "1"){
										$InpNovedades = "checked";
									}else{
										$InpNovedades = "";
									}
									
									$InpObservaciones = $vectorCapacitacion[$registro[0]]['Observaciones'];
								}else{
									$codigoCapacitacion = "-1";
									$InpCapacitado = "";
									$InpNovedades = "";
									$accion = "0";
									$InpObservaciones = "";
								}
								//Acción: 0-> Crear 1-> Actualizar
							?>
								<tr>
									<td><?php echo $registro[1]; ?></td>
									<td align="center"><input type="checkbox" class="CMM_Capacitado<?php echo $cont; ?>" name="<?php echo $registro[0]; ?>" <?php echo $InpCapacitado; ?>><input type="hidden" class="CMM_CodigoOperario<?php echo $cont; ?>" value="<?php echo $registro[0]; ?>"><input type="hidden" class="CMM_Accion<?php echo $cont; ?>" value="<?php echo $accion; ?>"><input type="hidden" class="CMM_CodigoCapacitacion<?php echo $cont; ?>" value="<?php echo $codigoCapacitacion; ?>"></td>
									<td align="center"><input type="checkbox" class="CMM_Novedades<?php echo $cont; ?>" name="<?php echo $registro[0]; ?>" <?php echo $InpNovedades; ?>></td>
									<td align="center"><input type="text" class="form-control CMM_Observaciones<?php echo $cont; ?>" style="height: 20px" value="<?php echo $InpObservaciones; ?>"></td>
								</tr>
							<?php $cont++; } ?>
						</tbody>
					</table>
				</div>
				<br>
				<div align="center">
                                    <button class="btn btn-success e_guardarCapacitacionesMasivasMM" data-cod="<?php echo $_POST['codigo']; ?>" data-num="<?php echo $cont; ?>">Guardar Capacitaciones</button>
				</div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">cargarfecha();</script>