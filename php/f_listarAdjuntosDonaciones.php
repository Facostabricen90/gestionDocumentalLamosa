<?php 
include("op_sesion.php");
include("../class/adjuntos.php");

$adj = new adjuntos();
$resAnt = $adj->listarAdjuntosNombre($_POST['mcodigo']);
?>
<div class="panel panel-primary" style="display: <?php echo $display;?>">
	<div class="panel-heading" align="center">
		<label class="letra16">Adjuntos</label>
	</div>
	<div class="panel-body">
		<label>Adjuntos<div  id="cargarOblicatorio"></div></label>
		<div id="AdjuntoA1"></div>
		<input id="i_AdjuntoA1" type="hidden">
		<div id="AdjuntoA2"></div>
		<input id="i_AdjuntoA2" type="hidden">
		<div id="AdjuntoA3"></div>
		<input id="i_AdjuntoA3" type="hidden">
		<div id="AdjuntoA4"></div>
		<input id="i_AdjuntoA4" type="hidden">
		<div id="AdjuntoA5"></div>
		<input id="i_AdjuntoA5" type="hidden">
		<br>
                <button type="button" id="Btn_AdjuntoPrestamoForm" class="btn btn-warning">Cargar</button>
	</div>
</div>
<div class="panel panel-primary">
	<div class="panel-heading" align="center">
		<label class="letra16">Listado Adjuntos</label>
	</div>
	<div class="panel-body">
		<div class="table-responsive" id="imp_tabla">
			<table id="" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
				<thead>
					<tr class="ordenamiento encabezadoConex">
						<th class="text-center">Nombre</th>
						<th class="text-center"></th>
						<th class="text-center" style="display: <?php echo $display;?>"></th>
					</tr>
				</thead>
				<tbody class="buscar">
					<?php foreach( $resAnt as $registro ){?>
						<tr>
							<td><?php echo $registro[1];?></td>
							<td class="text-center">
								<span class="glyphicon glyphicon-eye-open manito e_VerAdjuntoSug" data-ubi="adjuntos" data-cod="<?php echo $registro[0];?>" title="Ver"></span>
							</td>
							<td class="text-center" style="display: <?php echo $display;?>">
								<span class="glyphicon glyphicon-trash manito e_EliminarAdjunto" data-cod="<?php echo $registro[0];?>" title="Eliminar"></span>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="cargarObligatorio"></div>
<script>
	$(document).ready(function(){
		$("#AdjuntoA1").uploadFile({
			url:"../imgPHP/subirAdjunto.php",
			maxFileSize: 20000*20000,
			maxFileCount: 5,
			fileName:"myfile",
			showPreview:true,
			previewHeight: "100px",
			previewWidth: "100px",
			afterUploadAll:function(obj){
				archivos = obj.existingFileNames;
				//console.log(archivos);
				for(i=0; i<archivos.length;i++){
				 archivo = obj.existingFileNames[i];
				 $("#i_AdjuntoA"+(i+1)).val(archivo);
				}
			}
		});
	});
</script>