<?php
include("op_sesion.php");

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>GUÍAS</strong>
      </div>

      <div class="panel-body">
        <ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#Guia_Definicion">Definiciones</a></li>
					<li><a data-toggle="tab" href="#Guia_Reglas" class="Btn_GuiaReglas">Reglas</a></li>
					<li><a data-toggle="tab" href="#Guia_Piramide" class="Btn_GuiaPiramide">Pirámide</a></li>
				</ul>
        <div class="tab-content">
          <div id="Guia_Definicion" class="tab-pane fade in active">
            <br>
            <form id="f_guiaDefiniciones" role="form">
            <div class="col-lg-12 col-md-12 col-sm-12">

              <div class="table-responsive">
                <table id="tbl_Areas" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
                  <thead>
                    <tr class="encabezadoTab">
                      <th colspan="3" align="center" class="text-center">Definiciones de pasos del ciclo documental</th>
                    </tr>
                  </thead>
                  <tbody class="buscar">
                    <tr>
                      <td>1. </td>
                      <td>Solicitud</td>
                      <td>Requerimiento realizado por Directores, jefes o supervisores para la elaboración o actualización de un documento.</td>
                    </tr>
                    <tr>
                      <td>2. </td>
                      <td>Clasificación y Codificación</td>
                      <td>El analista de procesos asigna código y versión del documento y valida que el tipo de documento solicitado coincida con lo requerido en el proceso.</td>                      
                    </tr>
                    <tr>
                      <td>3. </td>
                      <td>Asignación de Lineamientos</td>
                      <td>El gerente industrial asigna lineamientos al responsable de la elaboración del documento.</td>                      
                    </tr>
                    <tr>
                      <td>4. </td>
                      <td>Elaboración - Actualización</td>
                      <td>El responsable elabora o actualiza el documento descargándolo de la plataforma y subiendo el documento ajustado nuevamente a la plataforma.</td>                      
                    </tr>
                    <tr>
                      <td>5. </td>
                      <td>Revisión</td>
                      <td>El analista de procesos revisa el documento elaborado o actualizado y hace respectivos ajustes o recomendaciones. La descripción de ajustes y recomendaciones queda registrado en el documento en el párrafo de control de cambios.</td>                      
                    </tr>
                    <tr>
                      <td>6. </td>
                      <td>Ajuste</td>
                      <td>El responsable del documento hace ajustes según recomendaciones o cambios solicitados por el analista de procesos. Posteriormente debe subir el documento ajustado a la plataforma.</td>                      
                    </tr>
                    <tr>
                      <td>7. </td>
                      <td>Revisión - Aprobación EHS</td>
                      <td>El jefe EHS revisa el documento y solicita ajustes requeridos o aprueba si cumple los requerimientos de seguridad y medio ambiente.</td>                      
                    </tr>
                    <tr>
                      <td>8. </td>
                      <td>Ajuste EHS</td>
                      <td>El responsable del documento hace ajustes solicitados por el jefe EHS. Posteriormente debe subir el documento ajustado a la plataforma.</td>                      
                    </tr>
                    <tr>
                      <td>9. </td>
                      <td>Aprobación</td>
                      <td>El jefe del área revisa el documento y solicita ajustes requeridos o aprueba si cumple los requerimientos según el proceso.</td>        
                    </tr>
                    <tr>
                      <td>10. </td>
                      <td>Ajuste Jefe Aprobador Final</td>
                      <td>El responsable del documento hace ajustes solicitados por el jefe del área. Posteriormente debe subir el documento ajustado a la plataforma.</td>                      
                    </tr>
                    <tr>
                      <td>11. </td>
                      <td>Subir PDF</td>
                      <td>El analista de procesos incluye marca de agua en el documento y lo publica en PDF.</td>                      
                    </tr>
                    <tr>
                      <td>12. </td>
                      <td>Divulgación</td>
                      <td>El responsable del documento debe divulgarlo al 100% del equipo técnico u operativo del área.</td>                      
                    </tr>
                    <tr>
                      <td>13. </td>
                      <td>Publicado</td>
                      <td>El analista de procesos publica en PDF en la plataforma de catalogo documental.</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </form>
          </div>
          <div id="Guia_Reglas" class="tab-pane fade">
						<br>
						<div class="InfoGuia_Reglas">
							
						</div>
					</div>
          <div id="Guia_Piramide" class="tab-pane fade">
						<br>
						<div class="InfoGuia_Piramide">
							
						</div>
					</div>
        </div>
        
      </div>
    </div>
  </div>
</div>















