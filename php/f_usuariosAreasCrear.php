<?php
include("op_sesion.php");
include("../class/areas.php");
include("../class/usuarios_areas.php");

$usuA = new usuarios_areas();

$are = new areas();
$resAre = $are->listarAreasPrincipal("1", $_SESSION['GD_Usuario']);

$resUsuAT = $usuA->listarAreasUsuarioTiene($_POST['codigo']);

foreach($resUsuAT as $registro2){
  $vectorUsuAreas[$registro2[0]] = $registro2[0];
}
?>
<div class="row">
  <div class="col-lg-6 col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>Seleccionar Área</strong>
      </div>
       <div class="panel-body">
        <form id="f_usuariosAreasCrear" role="form">
          <input type="hidden" id="UsuA_Usu_Codigo" value="<?php echo $_POST['codigo']; ?>">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
              <label class="control-label">Área<span class="rojo">*</span></label>
              <select id="UsuA_Are_Codigo" class="form-control" multiple required>
                <?php /*foreach($resAre as $registro){ 
                if(!isset($vectorUsuAreas[$registro[0]])){
                ?>
                
                  <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                <?php } 
                  }*/?>
              </select>
            </div>
            <div>
              <button type="submit" id="Btn_AgregarAreaUsuA" class="btn btn-success">Agregar</button>  
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-lg-6 col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>Lista Áreas</strong>
      </div>
       <div class="panel-body">
        <div class="table-responsive">
          <br>
          <table id="tbl_UsuariosAreas" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
            <thead>
              <tr class="ordenamiento encabezadoTab">
                <th class="text-center" align="center">Nombre Área</th>  
                <th class="text-center" align="center"></th>  
              </tr>
            </thead>
            <tbody class="buscar">
              <?php foreach($resUsuAT as $registro2){ ?>
                <tr>
                  <td><?php echo $registro2[1]; ?></td>  
                  <td align="center"><button class="btn btn-danger btn-xs e_eliminarUsuariosAreas" data-cod="<?php echo $registro2[2]; ?>">Eliminar</button></td> 
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
