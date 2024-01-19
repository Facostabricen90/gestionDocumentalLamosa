<?php
include("op_sesion.php");
include("../class/solicitudes.php");
include("../class/flujos_aprobaciones.php");
include("../class/usuarios_areas.php");
include("../class/parametros.php");
include_once("../class/areas.php");

$par = new parametros();
$resLatam = $par->verificadorLatam();

if($_POST['tipo'] == '1'){
  $are = new areas();
  $are->setArea_Codigo($_POST['area']);
  $are->consultar();
  $titulo = 'Detalle estado de documentos del área '.$are->getArea_Nombre().' del tipo de documento '.$_POST['nombre'];
}
if($_POST['tipo'] == '2'){
  $are = new areas();
  $are->setArea_Codigo($_POST['area']);
  $are->consultar();
  $titulo = 'Detalle estado de documentos del área '.$are->getArea_Nombre();
}
if($_POST['tipo'] == '3'){
  $titulo = 'Detalle estado de documentos del tipo de documento '.$_POST['nombre'];
}
$sol = new solicitudes();
$tablaGeneral = $sol->EspecificaAreasTipo($_POST['area'], $_POST['nombre'], $_POST['planta']);
//var_dump($tablaGeneral);
$resSol = $sol->listarSolicitudesFiltroPublicado($_POST['area'], $_POST['nombre'],$_SESSION['GD_Usuario'], $_POST['planta']);
$resSolVer = $sol->listarSolicitudesFiltroPublicadoUltimaVersion($_POST['area'], $_POST['nombre'], $_SESSION['GD_Usuario'], $_POST['planta']);
$fluA = new flujos_aprobaciones();
$resFluA = $fluA->listarFlujoAprobacionesSolicitudesUsuarios($_SESSION['GD_Usuario']);

$usuA = new usuarios_areas();
$resUsuA = $usuA->listarAreasUsuariosFiltro($_SESSION['GD_Usuario']);

$cantAreas = count($resUsuA);

foreach($resUsuA as $registro2){
	$Areas[$registro2[0]] = $registro2[0];
	$AreasNombre[$registro2[0]] = $registro2[1];
}

foreach($resLatam as $registro3){
	$vectorLatam[$registro3[1]] = $registro3[1];
}

foreach($resSolVer as $registro4){
  $vectorUltVer[$registro4[0]] = $registro4[1];
}
?>

<br>
<label for=""><?php echo $titulo; ?> </label>
<div class="table-responsive">
    <table id="tbl_catalogoDocumentos" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
      <thead>
        <tr class="ordenamiento encabezadoTab letra11">
          <th>CÓDIGO</th>
          <th>FECHA SOLICITUD</th>
          <?php if($_POST['tipo'] != '1'&&$_POST['tipo'] != '2'){ ?>
            <th>ÁREA</th>
          <?php } ?>
          <th>SOLICITA/PLANTA</th>
          <?php if($_POST['tipo'] != '1' && $_POST['tipo'] != '3'){ ?>
            <th>TIPO DOCUMENTO</th>
          <?php } ?>
          <th>CÓDIGO DOCUMENTO</th>
          <th>VERSIÓN</th>
          <th>NOMBRE DOCUMENTO</th>
          <th>TEMA</th>
          <th>OBSERVACIONES</th>
          <th></th>
        </tr>
      </thead>
      <tbody class="buscar">
          <?php
          $cont = 0;
          foreach($tablaGeneral as $registro){ ?>
          
              <tr class="<?php /* echo $ColorEsp; */ ?> letra11">
                <td align="center"><?php echo $registro['Sol_CodigoRadicado']; ?></td>  
                <td align="right"><?php echo $registro['Sol_Fecha']; ?></td>
                <?php if($_POST['tipo'] != '1'&&$_POST['tipo'] != '2'){ ?>
                  <td><?php echo $registro['Area_Nombre']; ?></td>   
                <?php } ?>
                <td><?php echo $registro['Usuario'].' '.$registro['plantaNombre']; ?></td>
                <?php if($_POST['tipo'] != '1' && $_POST['tipo'] != '3'){ ?>
                  <td><?php echo $registro['Sol_TipoDocumento']; ?></td>  
                <?php } ?>
                <td><?php echo $registro['Sol_CodigoDocumento']; ?></td> 
                
                <td align="right"><?php echo $registro['Sol_HistorialVersion']; ?></td> 
                <td><?php echo $registro['Sol_NombreDocumento']; ?></td>  
                <td><?php echo $registro['Sol_Tema']; ?></td>  
                <td><?php echo $registro['Sol_Observaciones']; ?></td>  
                <td align="center" class="vertical"><button class="btn btn-warning btn-xs e_cargarCatalogo" data-cod="<?php echo $registro['Sol_Codigo']; ?>">Ver</button></td>
                <?php $cont++; ?>
              </tr>
        <?php } ?>
      </tbody>
      <tr class="encabezadoTab letra11">
        <td align="center" colspan="3"><strong>TOTAL: <?php echo $cont; ?></strong></td>
      </tr>
    </table>
  </div>
