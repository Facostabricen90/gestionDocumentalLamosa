<?php
include("op_sesion.php");
include("../class/areas.php");
include("../class/plantas.php");
include("../class/usuarios_areas.php");
include("../class/usuarios_plantas.php");

//$usuA = new usuarios_areas();
$usuP = new usuarios_plantas();

$pla = new plantas();
if($_SESSION['GD_Usuario'] != 2){
$resPla = $pla->listarPlantasUsuarioCrear("1", $_SESSION['GD_Usuario']);
}else{
  $resPla = $pla->listarPlantasUsuarioCrearAdmin("1");
}
//$are = new areas();
//$resAre = $are->listarAreasPrincipal("1", $_SESSION['GD_Usuario']);

$resUsuPT = $usuP->listarPlantasUsuarioTiene($_POST['codigo']);

foreach($resUsuPT as $registro2){
  $vectorUsuPlantas[$registro2[0]] = $registro2[0];
}
?>
<div class="row">
  <div class="col-lg-6 col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>Seleccionar Planta</strong>
      </div>
       <div class="panel-body">
        <form id="f_usuariosPlantasCrear" role="form">
          <input type="hidden" id="UsuP_Usu_Codigo" value="<?php echo $_POST['codigo']; ?>">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
              <label class="control-label">Plantas<span class="rojo">*</span></label>
              <select id="UsuP_Pla_Codigo" class="form-control" multiple required>
                <?php foreach($resPla as $registro){ 
                if(!isset($vectorUsuPlantas[$registro[0]])){
                ?>
                
                  <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                <?php } 
                  }?>
              </select>
            </div>
            <div>
              <button type="submit" id="Btn_AgregarPlantasUsuP" class="btn btn-success">Agregar</button>  
            </div>
          </div>
        </form>
           
      </div>
        <br>
           <span style="color: red">*Nota: cada vez que agregues una o varias plantas, deberas añadir nuevamente las respectivas areas</span>
    </div>
  </div>
  <div class="col-lg-6 col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>Lista Plantas</strong>
      </div>
       <div class="panel-body">
        <div class="table-responsive">
          <br>
          <table id="tbl_UsuariosPlantas" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
            <thead>
              <tr class="ordenamiento encabezadoTab">
                <th class="text-center" align="center">Nombre Planta</th>  
                <th class="text-center" align="center"></th>  
              </tr>
            </thead>
            <tbody class="buscar">
              <?php foreach($resUsuPT as $registro2){ ?>
                <tr>
                  <td><?php echo $registro2[1]; ?></td>  
                  <td align="center"><button class="btn btn-danger btn-xs e_eliminarUsuariosPlantas" data-cod="<?php echo $registro2[2]; ?>">Eliminar</button></td> 
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
