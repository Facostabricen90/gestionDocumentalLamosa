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
        <form id="f_plantasCrear" role="form">
          <div class="form-group">
            <label class="control-label">Grupo:<span class="rojo">*</span></label>
            <input type="text" id="Pla_Grupo" class="form-control" maxlength="50" required>
          </div>
          
          <div class="form-group">
            <label class="control-label">Negocio:<span class="rojo">*</span></label>
            <input type="text" id="Pla_Negocio" class="form-control" maxlength="15" required>
          </div>
          
          <div class="form-group">
            <label class="control-label">Distribución:<span class="rojo">*</span></label>
            <input type="text" id="Pla_Distribucion" class="form-control" maxlength="15" required>
          </div>
          
          <div class="form-group">
            <label class="control-label">Marca:<span class="rojo">*</span></label>
            <input type="text" id="Pla_Marca" class="form-control" maxlength="15" required>
          </div>
          
          <div class="form-group">
            <label class="control-label">Nombre:<span class="rojo">*</span></label>
            <input type="text" id="Pla_Nombre" class="form-control" maxlength="15" required>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>