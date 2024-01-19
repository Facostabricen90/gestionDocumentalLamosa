<?php 
include("op_sesion.php");
include("../class/parametros.php");
include("../class/plantillas_documentos.php");
include("../class/areas.php");
include("hora.php");
$par = new parametros();
$resTipDoc = $par->listarParametroTipo("1");
$are = new areas();
$resAre = $are->listarAreasPrincipal("1", $_SESSION['GD_Usuario']);
$usu1 = new usuarios();
$resUsu = $usu1->listarUsuariosCarge($_SESSION['GD_Usuario']);

$pCargueDocs = $usuper->Permisos($_SESSION['GD_Usuario'], 5);

?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Documento sin título</title>
  <?php include("s_cabecera.php"); ?>
  <script src="../js/plantillas_documentos.js"></script>
</head>
<?php include("s_menu.php"); ?>
<body>
  <div id="d_contenedor" class="container">
    <!-- Todo el Contenido -->
    <div class="col-lg-12 col-md-12">
      <div class="panel panel-primary">
        <div class="panel-heading">
					<div class="row">
						<div class="col-lg-3 col-md-3">
							<br>
							<strong class="letra16">Cargue Documentos</strong>
						</div>
						
						<div class="col-lg-2 col-md-2">
							<br>
              <?php if(isset($pCargueDocs) && $pCargueDocs[5] == "1"){ ?>
							  <button id="Btn_CargueDocumentosCrear" class="btn btn-primary">Crear</button>
              <?php } ?>
						</div>
					</div>
        </div>
      </div>
    </div>
  </div>
<!-- Crear CargueDocumentos -->
  <div id="vtn_CargueDocumentosCrear" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-body info_CargueDocumentosCrear">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id="Btn_CargueDocumentosCrearForm" form="f_cargueDocumentosCrear">Crear</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
	
  <!-- Notificaciones -->
  <div id="vtn_CargueDocumentosNotificaciones" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body info_CargueDocumentosNotificaciones" align="center">
        </div>
        <div class="modal-footer">
          <button type="button" id="Btn_CargueDocumentosNotificaciones" class="btn btn-success">Aceptar</button>
        </div>
      </div>
    </div>
  </div>
</body>
</html>