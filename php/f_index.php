<?php
include("op_sesion.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>

</head>

<body class="fondoPrinpal">
  <?php include("s_menu.php"); ?>
  <div id="d_contenedor" class="container-fluid">
    <div align="center" class="col-lg-12 col-md-12 text-center">  
      <?php if(isset($pCatalogoDoc) && $pCatalogoDoc[3] == "1"){?>
        <div class="col-lg-4 col-md-4 IconosInicioAni"> 
          <a class="manito" href="fm_catalogoDocumentos.php"><img src="../imagenes/icono-catalogo.png" class="Img_IconoInicio">
          <br>
          <strong class="letra22 lespMIni blanco">Catálogo de Documentos</strong></a>
        </div>
      <?php } ?>
      <?php if(isset($pCicloDoc) && $pCicloDoc[3] == "1"){?>
        <div class="col-lg-4 col-md-4 IconosInicioAni"> 
          <a class="manito" href="fm_solicitudes.php"><img src="../imagenes/icono ciclo documental-01.png" class="Img_IconoInicio">
          <br>
          <strong class="letra22 lespMIni blanco">Ciclo Documental</strong></a>
        </div>
      <?php } ?>
      <?php if(isset($pCicloMatriz) && $pCicloMatriz[3] == "1"){?>
        <div class="col-lg-4 col-md-4 IconosInicioAni"> 
          <a class="manito" href="fm_solicitudesMM.php"><img src="../imagenes/icono ciclo documental-01.png" class="Img_IconoInicio">
          <br>
          <strong class="letra22 lespMIni blanco">Ciclo Matriz IPERC/ Matriz EPP's/ Mapas de Seguridad</strong></a>
        </div>
      <?php } ?>
    </div>
    <div class="limpiar"></div>
    <hr class="punteado">
    <div class="limpiar"></div>
    <div align="center" class="col-lg-12 col-md-12 text-center">  
      <br>
    <br>
    <?php if(isset($pModeloSeguridad) && $pModeloSeguridad[3] == "1"){?>
      <div class="col-lg-4 col-md-4 IconosInicioAni"> 
        <a class="manito" href="fm_exploradorArchivosOsc.php?tipo=2"><img src="../imagenes/boton 1 .png" class="Img_IconoInicioOsc">
          <br>
          <strong class="letra22 lespMIni blanco">Modelo De Gestión De Seguridad</strong></a>
      </div>
    <?php } ?>
    <?php if(isset($pModeloOpera) && $pModeloOpera[3] == "1"){?>
      <div class="col-lg-4 col-md-4 IconosInicioAni"> 
        <a class="manito" href="fm_exploradorArchivosOsc.php?tipo=1"><img src="../imagenes/boton 2 .png" class="Img_IconoInicioOsc">
          <br>
          <strong class="letra22 lespMIni blanco">Modelo Excelencia Operacional</strong></a>
      </div>
    <?php } ?>
    <?php if(isset($pProtocolosLatam) && $pProtocolosLatam[3] == "1"){?>
      <div class="col-lg-4 col-md-4 IconosInicioAni"> 
        <a class="manito" href="fm_exploradorArchivosOsc.php?tipo=3"><img src="../imagenes/boton 3 .png" class="Img_IconoInicioOsc">
          <br>
          <strong class="letra22 lespMIni blanco">Protocolos de Operación LatAm</strong></a>
      </div>
    <?php } ?>
    </div>
  </div>
</body>
</html>