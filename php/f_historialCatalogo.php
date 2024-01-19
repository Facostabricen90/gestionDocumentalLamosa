<?php 
include("op_sesion.php");
include("../class/historiales_flujos.php");
include("../class/solicitudes.php");
include("hora.php");

include("../class/adjuntos.php");

$adj = new adjuntos();
$resAnt = $adj->listarAdjuntosNombre($_POST['code']);
$sol = new solicitudes();
$sol->setSol_Codigo($_POST['code']);
$sol->consultar();

$hisF = new historiales_flujos();
if($sol->getSol_TipoFlujo() == "3"){
  $resHisFlu = $hisF->listarHistorialFlujoSolicitudesMMGestion($_POST['code']);
}else{
  $resHisFlu = $hisF->listarHistorialFlujoSolicitudesGestion($_POST['code']); 
}
?>
<div class="col-lg-12 col-md-12">
  <div class="panel panel-primary">
    <div class="panel-heading row" align="center">
      <div class="col-lg-2 col-md-2 col-sm-2">
      </div>
      <div class="col-lg-8 col-md-8 col-sm-8">
        <strong class="letra18">HISTORIAL FLUJO</strong>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-2">
        <img src="../imagenes/excel.png" width="30px" class="excel_HistorialCatalogo manito" title="Exportar a Excel">
      </div>

    </div>
    <div class="panel-body">
      <div class="table-responsive" id="tbl_HistorialFlujo">
        <input type="hidden" value="<?php echo $_POST['code']; ?>" id="HistorialCatalogoId">
        <table border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
          <thead>
            <tr class="encabezadoTab">
              <th class="text-center" align="center">PASO</th>
              <th class="text-center" align="center">CLASIFICACIÓN</th>
              <th class="text-center" align="center">OBSERVACIONES</th>
              <th class="text-center" align="center">FECHA</th>
              <th class="text-center" align="center">USUARIO</th>
              <th></th>
            </tr>
          </thead>
          <tbody class="buscar">
            <?php foreach($resHisFlu as $registro){ ?>
              <?php $arc1 = $registro[6];
                    $valores1 = explode('.', $arc1);
                    $extension1 = end($valores1); 
              ?>
              <?php if(strtoupper($extension1) == 'PDF'){ ?>
                <?php $ruta = 'PDF'; ?>
              <?php }else{ ?>
                <?php $ruta = 'formatos'; ?>
              <?php } ?>
              <tr>
                <td><?php echo $registro[7].". ".$registro[5]; ?></td>		
                <td><?php echo $registro[1]; ?></td>	
                <td class="letra11"><?php echo $registro[2]; ?></td>	
                <td nowrap align="right"><?php echo substr($registro[3], 0, 10)." ".PasarMilitaraAMPM(substr($registro[3], 11, 8)); ?>&nbsp;</td>	
                <td nowrap><?php echo $registro[8]; ?></td>	
								<?php if($usu->getUsu_Rol() == "Administrador"){ ?>
									<?php if($registro[6] != "" && $registro[6] != NULL){ ?>
										<?php $nombre_fichero = "../imagenes/formatos/".$registro[6]; ?>
                    <?php $nombre_fichero2 = "../imagenes/PDF/".$registro[6]; ?>
                    <?php if (file_exists($nombre_fichero)) { ?>
                      <td nowrap><a href="../imagenes/formatos/<?php echo $registro[6]; ?>" download="Historial_<?php echo $registro[6]; ?>" target="_blank"><span class="glyphicon glyphicon-download-alt manito azul" title="Descargar Formato"></span></a></td>
                    <?php } else {
                      if (file_exists($nombre_fichero2)){?>
                        <td nowrap><a href="../imagenes/PDF/<?php echo $registro[6]; ?>" download="Historial_<?php echo $registro[6]; ?>" target="_blank"><span class="glyphicon glyphicon-download-alt manito azul" title="Descargar Formato"></span></a></td>
                    <?php
                      }else{?>
                        <td></td>
                    <?php
                      }
                    } ?>	
									<?php }else{ ?>
										<td></td>
									<?php } ?>
								<?php } ?>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>
<br>
&nbsp;
<div class="panel panel-primary">
	<div class="panel-heading" align="center">
		<label class="letra16">LISTADO CAPACITACIONES </label>
	</div>
	<div class="panel-body">
		<div class="table-responsive" id="imp_tabla">
			<table id="" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
				<thead>
					<tr class="ordenamiento encabezadoConex">
						<th class="text-center">Nombre</th>
						<th class="text-center"></th>
<!--						<th class="text-center" style="display: <?php echo $display;?>"></th>-->
					</tr>
				</thead>
				<tbody class="buscar">
					<?php foreach( $resAnt as $registro ){?>
						<tr>
							<td><?php echo $registro[1];?></td>
							<td class="text-center">
								<span class="glyphicon glyphicon-eye-open manito e_VerAdjuntoSug" data-ubi="adjuntos" data-cod="<?php echo $registro[0];?>" title="Ver"></span>
							</td>
<!--
							<td class="text-center" style="display: <?php echo $display;?>">
								<span class="glyphicon glyphicon-trash manito e_EliminarAdjunto" data-cod="<?php echo $registro[0];?>" title="Eliminar"></span>
							</td>
-->
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>