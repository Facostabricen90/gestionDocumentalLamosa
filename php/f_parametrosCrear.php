<?php
include("op_sesion.php");
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>CREAR PLANTA</strong>
      </div>

      <div class="panel-body">
        <form id="f_parametrosCrear" role="form">
          <div class="form-group">
            <label class="control-label">Nombre:<span class="rojo">*</span></label>
            <input type="text" id="Par_Nombre" class="form-control" maxlength="30" required>
          </div>
          
          <div class="form-group">
            <label class="control-label">Tipo:<span class="rojo">*</span></label>
            <select id="Par_Tipo" class="form-control" required>
              <option></option>
              <option value="1">Tipo de Documento</option>
              <option value="2">Pasos</option>
              <option value="3">Pasos EHS</option>
            </select>
          </div>
          
          <div class="form-group">
            <label class="control-label">Tipo Flujo: <span class="letra10 letraGris">Solo para Tipo Documento</span></label>
            <select id="Par_TipoFlujo" class="form-control">
              <option></option>
              <option value="1">Documentos Equipo Industrial</option>
              <option value="2">Perfil de Competencias</option>
              <option value="3">Matriz IPERC y/o Mapas de Seguridad</option>
            </select>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>