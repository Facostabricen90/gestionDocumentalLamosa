<?php include("op_sesion.php"); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/usuarios.js"></script>
</head>
<?php include("s_menu.php"); ?>
<body>
  <div id="d_contenedor" class="container">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="panel panel-primary">
          <div class="panel-heading"><strong>Datos Personales</strong></div>
          <div class="panel-body">
            <form id="f_miCuentaActualizarDatosPersonales" role="form">
              <div class="form-group">
                <label class="control-label">Nombre:</label>
                <input type="text" class="form-control" value="<?php echo $usu->getUsu_Nombre(); ?>" id="Usu_Nombre" maxlength="100" required>
              </div>
              
              <div class="form-group">
                <label class="control-label">Telefonos:</label>
                <input type="text" id="Usu_Telefonos" value="<?php echo $usu->getUsu_Telefonos(); ?>" class="form-control" maxlength="40">
              </div>
              
              <div class="form-group">
                <label for="Usu_Direccion" class="control-label">Dirección:</label>
                <input type="text" id="Usu_Direccion" class="form-control" value="<?php echo $usu->getUsu_Direccion(); ?>" maxlength="50">
              </div>
              <br>
              <button type="submit" id="btn_miCuentaActualizarDatosPersonales" class="btn btn-warning">Actualizar</button>
              <br>
              <div id="d_mensajeActualizarDatos" class="verde"></div>
            </form>
          </div>
        </div>
      </div>
      
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="panel panel-primary">
          <div class="panel-heading"><strong>Cambiar Clave</strong></div>
          <div class="panel-body">
            <form id="f_miCuentaActualizarCambiarClave" role="form">
              <div class="form-group">
                <label class="control-label">Clave Actual</label>
                <input type="password" class="form-control" id="Usu_Password">
              </div>
              <div class="form-group">
                <label class="control-label">Nueva Clave</label>
                <input type="password" class="form-control" id="Usu_Password1">
              </div>
              <div class="form-group" id="c_clave">
                <label class="control-label">Repetir Clave</label>
                <input type="password" class="form-control" id="Usu_Password2">
                <span id="m_clave2"></span>
              </div>
              <br>
              <button class="btn btn-warning">Cambiar Clave</button>
              <br>
              <div id="d_mensajeCambioClave" class="verde"></div>
            </form>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</body>
</html>