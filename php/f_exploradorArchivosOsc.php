<?php
include("op_sesion.php");
include("../class/explorador_archivos.php");
$pUsuarios = $usuper->Permisos($_SESSION['GD_Usuario'], 14);

$exp = new explorador_archivos();
$resExp = $exp->listarArchivos($_POST['referencia'], $_POST['modulo']);

$refAnt = $exp->listarArchivosAnteriores($_POST['referencia'], $_POST['modulo']);

if($_POST['modulo'] == '1'){ 
  $pUsuarios = $usuper->Permisos($_SESSION['GD_Usuario'], 14);
}elseif($_POST['modulo'] == '2'){
  $pUsuarios = $usuper->Permisos($_SESSION['GD_Usuario'], 12);
}elseif($_POST['modulo'] == '3'){
  $pUsuarios = $usuper->Permisos($_SESSION['GD_Usuario'], 13);  
}
?>

<div class="panel panel-primary">
  <div class="panel-heading">
    <div class="row">
      <div class="col-lg-2 col-md-2 col-sm-2" style="text-align: center;">
        <div class="form-group letra22">
          <div class="row">
            <span class="glyphicon glyphicon-arrow-left blanco e_volverCarpeta manito" data-cod="<?php echo $refAnt; ?>" data-tip="2" ></span>
            <label class="control-label e_volverCarpeta manito" data-cod="<?php echo $refAnt[0]; ?>" data-tip="2" >Volver</label>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3">
        <br>
        <div class="input-group"> <span class="input-group-addon"><strong>Buscar:</strong></span>
          <input id="filtrar_ExploradorArc" type="text" class="form-control">
        </div>
      </div>
<!--
      <div class="col-lg-2 col-md-2 col-sm-2">
        <div class="form-group">
          <label class="control-label">Estado:</label>
          <select id="Filtro_Estado" class="form-control">
            <option value="1" selected>Activos</option>
            <option value="0">Inactivos</option>
          </select>                
        </div>
      </div>
      
-->
      <?php if(isset($pUsuarios) && $pUsuarios[5] == "1"){ ?>
        <div class="col-lg-2 col-md-2 col-sm-2">
          <div class="form-group">
            <div class="row letra16" >
              <br>
              <label class="control-label manito e_agregarCarpeta" data-cod="<?php echo $_POST['referencia']; ?>" data-tip="1">Carpeta:</label>
              <span class="glyphicon glyphicon-plus verde manito e_agregarCarpeta" data-cod="<?php echo $_POST['referencia']; ?>" data-tip="1"></span>
              <span class="glyphicon glyphicon-folder-close naranja manito e_agregarCarpeta" data-cod="<?php echo $_POST['referencia']; ?>" data-tip="1"></span>
            </div>
          </div>     
        </div>  

        <div class="col-lg-2 col-md-2 col-sm-2">
          <div class="form-group">
            <div class="row letra16" >
              <br>
              <label class="control-label manito e_agregarCarpeta" data-cod="<?php echo $_POST['referencia']; ?>" data-tip="2">Archivo:</label>
              <span class="glyphicon glyphicon-plus verde manito e_agregarCarpeta" data-cod="<?php echo $_POST['referencia']; ?>" data-tip="2"></span>
              <span class="glyphicon glyphicon-file blanco manito e_agregarCarpeta" data-cod="<?php echo $_POST['referencia']; ?>" data-tip="2"></span>
            </div>
          </div>
        </div>
      <?php } ?>
       
      
    </div>
  </div>
  <div class="table-responsive" id="imp_tabla">
    <div align="center">
      <label class="letra22"><?php echo $refAnt[1]; ?></label>
    </div>
    <table id="" class="table table-striped">
      <thead>
        <tr class="encabezadoConex">
          <th class="text-center vertical">Nombre</th>
          <th class="text-center vertical">Usuario modifica</th>
          <th class="text-center vertical">Ultima modificación</th>
          
          <?php if(isset($pUsuarios) && $pUsuarios[4] == "1"){ ?>
            <th class="text-center vertical"></th>
          <?php }if(isset($pUsuarios) && $pUsuarios[6] == "1"){ ?>
            <th class="text-center vertical"></th>
          <?php } ?>
        </tr>
      </thead>
      <tbody class="buscar">
        <?php foreach($resExp as $registro){ ?>
          <?php // ACÁ VAN LOS PERMISOS YA SEA POR USUARIO O POR PLANTA ?>
        <?php 
              $valores = explode('.', $registro[2]);
              $extension = end($valores); 
              //echo $extension;
        ?>
        <tr>
          <?php if($registro[3] == '1'){ ?>
            <td class="vertical e_abrirCarpeta manito" data-cod="<?php echo $registro[0]; ?>" nowrap><i><img src="../imagenes/folder.svg" width="30px"></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="manito row"><?php echo $registro[1]; ?> </label></td>
          <?php }else{ ?>
            <?php if(strtoupper($extension) =='PNG' ||strtoupper($extension) =='JPG' ||strtoupper($extension) =='JPEG'){ ?>
              <?php $tipo = 'photo'; ?>
            <?php }elseif(strtoupper($extension) =='PDF'){ ?>
              <?php $tipo = 'pdf'; ?>
            <?php }elseif(strtoupper($extension) =='DOC' || strtoupper($extension) =='DOCX'){ ?>
              <?php $tipo = 'docx'; ?>
            <?php }elseif(strtoupper($extension) =='XLS' || strtoupper($extension) =='XLSX'){ ?>
              <?php $tipo = 'xlsx'; ?>
            <?php }elseif(strtoupper($extension) =='PPTX' || strtoupper($extension) =='PPT'){ ?>
              <?php $tipo = 'pptx'; ?>
            <?php }elseif(strtoupper($extension) =='MP4'){ ?>
              <?php $tipo = 'video'; ?>
            <?php }else{ $tipo = 'txt'; } ?>
            <td class="vertical e_verDocumento manito" data-cod="<?php echo $registro[0]; ?>"><i><img src="../imagenes/<?php echo $tipo; ?>.svg" width="30px"></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="manito row"><?php echo $registro[1].'.'.$extension; ?> </label></td>
          <?php } ?>
          <td align="center"><?php echo $registro[5] ?></td>
          <td align="center"><?php echo $registro[6] ?></td>
          
          <?php if(isset($pUsuarios) && $pUsuarios[4] == "1"){ ?>
            <td align="center"><span class="glyphicon glyphicon-pencil naranja manito e_editarArchivo" data-cod="<?php echo $registro[0]; ?>" data-ref="<?php echo $_POST['referencia']; ?>"></span></td>
          <?php }if(isset($pUsuarios) && $pUsuarios[6] == "1"){ ?>
            <td align="center"><span class="glyphicon glyphicon-remove rojo manito e_eliminarArchivo" data-cod="<?php echo $registro[0]; ?>" data-ref="<?php echo $_POST['referencia']; ?>"></span></td>
          <?php } ?>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>