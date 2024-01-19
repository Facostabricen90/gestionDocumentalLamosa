<?php
include("op_sesion.php");
include("../class/permisos.php");

$usu2 = new usuarios();
$usu2->setUsu_Codigo($_POST['codigo']);
$usu2->consultar();

$per = new permisos();
$resPer = $per->listarPermisosTodos();
$resPerUsu = $per->listarPermisosSelect($_POST['codigo']);

foreach($resPerUsu as $registro2){
  $vectorPermisosUsuarios[$registro2[0]] = $registro2[0];
  
}
?>
<div class="rowlistarPermisosSelect">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>PERMISOS USUARIO</strong>
      </div>

      <div class="panel-body">
        
        <form id="f_usuariosPermisos" role="form">
          <input type="hidden" id="Usu_CodigoPer" value="<?php echo $_POST['codigo']; ?>">
            <div class="col-lg-12 col-md-12">
              <div class="col-lg-4 col-md-4">
                <div class="form-group">
                  <label class="control-label">Usuario:  <?php echo $usu2->getUsu_Usuario(); ?></label>
                </div>
              </div>
              <div class="col-lg-8 col-md-8">
                <div class="form-group">
                  <label class="control-label">Nombre completo: <?php echo $usu2->getUsu_Nombre(); ?> <?php echo $usu2->getUsu_Apellido(); ?></label>
                </div>
              </div>
            </div>
            <br>
            <br>
            <div class="form-group">
              <div class="col-lg-3 col-md-3">
                <label class="control-label">Permisos:</label>
              </div>
              <div class="col-lg-5 col-md-5">
                <select id="Usu_Per_CodigoPer" class="form-control">
                  <option><?php echo $per->getPer_Codigo(); ?></option>
                  <?php foreach($resPer as $registro){ ?>
                    <?php if(!isset($vectorPermisosUsuarios[$registro[0]]) ){ ?>
                      <option value="<?php echo $registro[0]; ?>" <?php echo $per->getPer_Codigo() ==   $registro[0] ? "selected" : ""; ?>><?php echo $registro[1]; ?></option>
                    <?php } ?>
                  <?php } ?>
                </select>
              </div>
           
            <div class="col-lg-3 col-md-3">
              <button type="submit" id="Btn_UsuariosPermisosForm" class="btn btn-success">Crear</button>
            </div>
          </div>
        </form>
				<br>
				<br>
				<br>
				<div class="col-lg-12 col-md-12">
					<div class="table-responsive">
						<table id="tbl_ListarPermisos" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
							<thead>
								<tr class="ordenamiento encabezadoTab">
									<th class="text-center" align="center">PERMISO</th>  
									<th class="text-center" align="center">VER</th>  
									<th class="text-center" align="center">CREAR</th>  
									<th class="text-center" align="center">MODIFICAR</th>  
									<th class="text-center" align="center">ELIMINAR</th>  
								</tr>
							</thead>
							<tbody class="buscar">
								<?php
								$con = 1;
								foreach($resPerUsu as $registro3){ ?>
									<tr>
										<td><?php echo $registro3[1]; ?></td>  

										<td class="text-center" align="center"><input type="checkbox" name="ver<?php echo $con; ?>" <?php echo $registro3[2]=="1" ? "checked" : ""; ?> data-num="<?php echo $con; ?>" data-cod="<?php echo $registro3[6]; ?>" class="e_PermisoUsuActualizar1"></td></td>
										<td class="text-center" align="center"><input type="checkbox" name="crear<?php echo $con; ?>" <?php echo $registro3[3]=="1" ? "checked" : ""; ?> data-num="<?php echo $con; ?>" data-cod="<?php echo $registro3[6]; ?>" class="e_PermisoUsuActualizar2"></td>
										<td class="text-center" align="center"><input type="checkbox" name="modificar<?php echo $con; ?>" <?php echo $registro3[4]=="1" ? "checked" : ""; ?> data-num="<?php echo $con; ?>" data-cod="<?php echo $registro3[6]; ?>" class="e_PermisoUsuActualizar3"></td>
										<td class="text-center" align="center"><input type="checkbox" name="eliminar<?php echo $con; ?>" <?php echo $registro3[5]=="1" ? "checked" : ""; ?> data-num="<?php echo $con; ?>" data-cod="<?php echo $registro3[6]; ?>" class="e_PermisoUsuActualizar4"></td>
									</tr>
								<?php $con++; } ?>
							</tbody>
						</table> 
					</div>
				</div>
				
      </div>
    </div>
  </div>
</div>